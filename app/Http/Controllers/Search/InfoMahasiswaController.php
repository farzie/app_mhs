<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\DataMahasiswa;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class InfoMahasiswaController extends Controller
{
    /**
     * Menampilkan data lengkap mahasiswa berdasarkan ID terenkripsi (hash).
     */
    public function show(string $hash_id)
    {
        try {
            // 1. Dekripsi ID terenkripsi
            $id = Crypt::decryptString($hash_id);

            // 2. Cari data mahasiswa berdasarkan ID asli
            $mahasiswa = DataMahasiswa::findOrFail($id);

            // 3. Tampilkan view detail
            return view('mahasiswa.info', [
                'mahasiswa' => $mahasiswa,
            ]);

        } catch (DecryptException $e) {
            // Jika hash tidak valid/gagal didekripsi
            return redirect()->route('home')->with('error', 'Tautan data mahasiswa tidak valid.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Jika data tidak ditemukan setelah didekripsi
            return redirect()->route('home')->with('error', 'Data mahasiswa tidak ditemukan.');
        }
    }
}