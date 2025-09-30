<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataMahasiswa;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil Total Keseluruhan
        $total_mahasiswa = DataMahasiswa::count();
        
        // 2. Ambil Statistik Berdasarkan Status
        
        $mahasiswa_aktif = DataMahasiswa::where('status_saat_ini', 'Aktif')->count();
        $mahasiswa_lulus = DataMahasiswa::where('status_saat_ini', 'Lulus')->count();
        $mahasiswa_cuti = DataMahasiswa::where('status_saat_ini', 'Cuti')->count();
        $mahasiswa_mengundurkan_diri = DataMahasiswa::where('status_saat_ini', 'Mengundurkan Diri')->count();

        // 3. Ambil data status lainnya
        $status_distribusi = DataMahasiswa::select('status_saat_ini', \DB::raw('count(*) as total'))
                                    ->groupBy('status_saat_ini')
                                    ->get()
                                    ->pluck('total', 'status_saat_ini')
                                    ->toArray();

        $data = [
            'total_mahasiswa' => $total_mahasiswa,
            'mahasiswa_aktif' => $mahasiswa_aktif,
            'mahasiswa_lulus' => $mahasiswa_lulus,
            'mahasiswa_cuti' => $mahasiswa_cuti,
            'mahasiswa_mengundurkan_diri' => $mahasiswa_mengundurkan_diri,
            'status_distribusi' => $status_distribusi,
        ];

        return view('home', $data);
    }
}
