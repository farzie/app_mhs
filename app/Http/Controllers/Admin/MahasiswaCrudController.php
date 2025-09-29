<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataMahasiswa;

class MahasiswaCrudController extends Controller
{
    // READ - Ambil semua data
    public function index()
    {
        $mahasiswa = DataMahasiswa::all();
        return $mahasiswa;
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

        DataMahasiswa::create($validatedData);

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

        return redirect()->route('admin.dashboard')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    // DELETE - Menghapus data
    public function destroy(DataMahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Data mahasiswa berhasil dihapus!');
    }
}