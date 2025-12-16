<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataMahasiswa;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminActionNotification;
use App\Models\AkunMahasiswa;

class MahasiswaCrudController extends Controller
{
    // READ - Ambil semua data
    public function index()
    {
        $mahasiswa = DataMahasiswa::all();
        return $mahasiswa;
    }

    // IMPORT CSV - menerima file CSV dan memproses baris per baris
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        $handle = fopen($path, 'r');
        if ($handle === false) {
            return redirect()->route('admin.dashboard')->withErrors(['Tidak dapat membuka file CSV.']);
        }

        // Attempt to detect delimiter from first line (common: comma, semicolon, tab, pipe)
        $firstLine = '';
        if (!feof($handle)) {
            $pos = ftell($handle);
            $firstLine = fgets($handle);
            fseek($handle, $pos); // rewind to previous position
        }

        $possibleDelimiters = [',',';','\t','|'];
        $delimiter = ',';
        $bestCount = -1;
        foreach ($possibleDelimiters as $d) {
            $count = 0;
            if ($d === '\t') {
                $count = substr_count($firstLine, "\t");
            } else {
                $count = substr_count($firstLine, $d);
            }
            if ($count > $bestCount) {
                $bestCount = $count;
                $delimiter = $d;
            }
        }

        $header = null;
        $defaultHeader = ['nim','nama','jenis_kelamin','jenjang_prodi','tanggal_masuk','semester_awal','status_awal_mhs','status_saat_ini'];
        $inserted = 0;
        $skipped = 0;
        $rowErrors = [];
        $rowNumber = 1;

        // Helper: sanitize a raw CSV line to fix common malformed quoting issues
        $sanitizeLine = function($line) {
            // remove BOM
            $line = preg_replace('/^\xEF\xBB\xBF/', '', $line);
            $line = rtrim($line, "\r\n");

            $trimmed = trim($line);
            if ($trimmed === '') return '';

            // If entire line is wrapped in quotes, remove outer quotes
            if (Str::startsWith($trimmed, '"') && Str::endsWith($trimmed, '"')) {
                // remove only one leading and trailing quote
                $trimmed = substr($trimmed, 1, -1);
            }

            // Replace paired double-quotes "" -> " (common malformed duplication in exported CSV)
            $trimmed = str_replace('""', '"', $trimmed);

            return $trimmed;
        };

        while (!feof($handle)) {
            $raw = fgets($handle);
            if ($raw === false) break;

            $line = $sanitizeLine($raw);
            if ($line === '') { $rowNumber++; continue; }

            // parse CSV line using detected delimiter
            $row = str_getcsv($line, $delimiter, '"');

            // skip completely empty rows
            if (count(array_filter($row)) === 0) { $rowNumber++; continue; }

            if ($header === null) {
                // Heuristic: detect if first row is a header by checking for known header keywords
                $firstRowTrimmed = array_map(function($h){ return trim($h); }, $row);
                $lower = array_map(function($v){ return Str::lower($v); }, $firstRowTrimmed);

                $knownKeys = ['nim','npm','nama','name','jenis_kelamin','gender','jenjang_prodi','program','tanggal_masuk','tanggal','semester_awal','semester','status_awal_mhs','status_awal','status_saat_ini','status'];
                $isHeader = false;
                foreach ($lower as $cell) {
                    foreach ($knownKeys as $k) {
                        if (Str::contains($cell, $k)) { $isHeader = true; break 2; }
                    }
                }

                if ($isHeader) {
                    // Normalize header names
                    $normalized = array_map(function($h){ return Str::lower(preg_replace('/[^a-z0-9_]/', '_', $h)); }, $firstRowTrimmed);
                    $header = $normalized;
                    $rowNumber++;
                    continue;
                } else {
                    // No header present: use default header mapping and process this row as data
                    $header = $defaultHeader;
                    // do not continue — process the current $row as data below
                }
            }

            // Trim trailing empty columns (often caused by trailing delimiter)
            while (count($row) > 0 && trim(end($row)) === '') {
                array_pop($row);
            }

            if (count($row) !== count($header)) {
                // try to skip completely empty rows
                if (count(array_filter($row)) === 0) { $rowNumber++; continue; }
                $rowErrors[] = "Baris {$rowNumber}: jumlah kolom tidak sesuai dengan header (delimiter atau struktur file mungkin berbeda). Detected delimiter: '{$delimiter}'";
                $skipped++;
                $rowNumber++;
                continue;
            }

            $data = array_combine($header, $row);

            // Map fields - accept several header names
            $nim = $data['nim'] ?? ($data['npm'] ?? null);
            $nama = $data['nama'] ?? ($data['name'] ?? null);
            $jenis_kelamin = $data['jenis_kelamin'] ?? ($data['gender'] ?? null);
            $jenjang_prodi = $data['jenjang_prodi'] ?? ($data['program'] ?? null);
            $tanggal_masuk = $data['tanggal_masuk'] ?? ($data['tanggal'] ?? null);
            $semester_awal = $data['semester_awal'] ?? ($data['semester'] ?? null);
            $status_awal_mhs = $data['status_awal_mhs'] ?? ($data['status_awal'] ?? null);
            $status_saat_ini = $data['status_saat_ini'] ?? ($data['status'] ?? null);

            // basic trimming
            $nim = $nim !== null ? trim($nim) : null;
            $nama = $nama !== null ? trim($nama) : null;

            // convert tanggal if format DD/MM/YYYY
            if ($tanggal_masuk && strpos($tanggal_masuk, '/') !== false) {
                $parts = explode('/', $tanggal_masuk);
                if (count($parts) === 3) {
                    $tanggal_masuk = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
                }
            }

            // build validator rules per row
            $validator = Validator::make([
                'nim' => $nim,
                'nama' => $nama,
                'jenis_kelamin' => $jenis_kelamin,
                'jenjang_prodi' => $jenjang_prodi,
                'status_saat_ini' => $status_saat_ini,
                'tanggal_masuk' => $tanggal_masuk,
                'semester_awal' => $semester_awal,
                'status_awal_mhs' => $status_awal_mhs,
            ], [
                'nim' => 'required|max:15|unique:data_mhs,nim',
                'nama' => 'required|max:150',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'jenjang_prodi' => 'required|max:255',
                'status_saat_ini' => 'required|max:50',
                'tanggal_masuk' => 'required|date',
                'semester_awal' => 'required|max:30',
                'status_awal_mhs' => 'required|max:50',
            ]);

            if ($validator->fails()) {
                $messages = implode('; ', $validator->errors()->all());
                $rowErrors[] = "Baris {$rowNumber} (NIM: {$nim}): {$messages}";
                $skipped++;
                $rowNumber++;
                continue;
            }

            // insert row
            try {
                DataMahasiswa::create([
                    'nim' => $nim,
                    'nama' => $nama,
                    'jenis_kelamin' => $jenis_kelamin,
                    'jenjang_prodi' => $jenjang_prodi,
                    'status_saat_ini' => $status_saat_ini,
                    'tanggal_masuk' => $tanggal_masuk,
                    'semester_awal' => $semester_awal,
                    'status_awal_mhs' => $status_awal_mhs,
                ]);
                $inserted++;
            } catch (\Exception $e) {
                $rowErrors[] = "Baris {$rowNumber} (NIM: {$nim}): gagal disimpan ({$e->getMessage()}).";
                $skipped++;
            }

            $rowNumber++;
        }

        fclose($handle);

        $successMessage = "Import selesai: {$inserted} baris berhasil, {$skipped} baris di-skip.";

        if (count($rowErrors) > 0) {
            return redirect()->route('admin.dashboard')
                ->with('success', $successMessage)
                ->withErrors($rowErrors);
        }

        return redirect()->route('admin.dashboard')->with('success', $successMessage);
    }

    // DOWNLOAD TEMPLATE CSV
    public function template()
    {
        $filename = 'template_import_mahasiswa.csv';
        $columns = ['nim','nama','jenis_kelamin','jenjang_prodi','tanggal_masuk','semester_awal','status_awal_mhs','status_saat_ini'];
        $example = ['K3524001','AFIF NAMA','Laki-laki','S1 - Informatika','31/08/2023','Ganjil 2023/2024','Peserta Didik Baru','Aktif'];

        $callback = function() use ($columns, $example) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fputcsv($file, $example);
            fclose($file);
        };

        return response()->stream($callback, 200, [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ]);
    }

    // CREATE - Menyimpan data baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|unique:data_mhs|max:15',
            'nama' => 'required|max:150',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jenjang_prodi' => 'required|max:255',
            'status_saat_ini' => 'required|max:50',
            'tanggal_masuk' => 'required|date',
            'semester_awal' => 'required|max:30',
            'status_awal_mhs' => 'required|max:50',
        ]);

        $mahasiswa = DataMahasiswa::create($validatedData);

        // Notify related account (if exists) that their data was created/added by admin
        try {
            $account = AkunMahasiswa::where('nim', $mahasiswa->nim)->first();
            if ($account) {
                $details = [
                    'nim' => $mahasiswa->nim,
                    'nama' => $mahasiswa->nama,
                ];
                Mail::to($account->akun)->send(new AdminActionNotification($account, 'created', $details));
            }
        } catch (\Exception $e) {
            logger()->error('Gagal mengirim notifikasi email CRUD (create): ' . $e->getMessage());
        }

        return redirect()->route('admin.dashboard')->with('success', 'Data mahasiswa baru berhasil ditambahkan!');
    }

    // UPDATE - Memperbarui data yang ada
    public function update(Request $request, DataMahasiswa $mahasiswa)
    {
        $validatedData = $request->validate([
            'nim' => 'required|max:15|unique:data_mhs,nim,' . $mahasiswa->id, // Kecualikan id saat cek unique
            'nama' => 'required|max:150',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jenjang_prodi' => 'required|max:255',
            'status_saat_ini' => 'required|max:50',
            'tanggal_masuk' => 'required|date',
            'semester_awal' => 'required|max:30',
            'status_awal_mhs' => 'required|max:50',
        ]);

        $mahasiswa->update($validatedData);

        // Notify related account (if exists) that their data was updated by admin
        try {
            $account = AkunMahasiswa::where('nim', $mahasiswa->nim)->first();
            if ($account) {
                $details = $validatedData;
                Mail::to($account->akun)->send(new AdminActionNotification($account, 'updated', $details));
            }
        } catch (\Exception $e) {
            logger()->error('Gagal mengirim notifikasi email CRUD (update): ' . $e->getMessage());
        }

        return redirect()->route('admin.dashboard')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    // DELETE - Menghapus data
    public function destroy(DataMahasiswa $mahasiswa)
    {
        // Keep a copy of data for notification
        $dataCopy = $mahasiswa->toArray();
        $mahasiswa->delete();

        // Notify related account (if exists) that their data was deleted by admin
        try {
            $account = AkunMahasiswa::where('nim', $dataCopy['nim'] ?? null)->first();
            if ($account) {
                $details = $dataCopy;
                Mail::to($account->akun)->send(new AdminActionNotification($account, 'deleted', $details));
            }
        } catch (\Exception $e) {
            logger()->error('Gagal mengirim notifikasi email CRUD (delete): ' . $e->getMessage());
        }

        return redirect()->route('admin.dashboard')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}
