<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DataMhsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $data = [
            [
                'nim' => 'M0523001', 
                'nama' => '\'Azzam Tsabitul Jamil', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Informatika', 
                'status_saat_ini' => 'Cuti', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'I0423002', 
                'nama' => 'Adella Putri Ayu', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'S1 Teknik Mesin', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'I8623003', 
                'nama' => 'Adik Anugrahing Gusti', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'D3 Teknik Mesin', 
                'status_saat_ini' => 'Mengundurkan Diri', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'K1523004', 
                'nama' => 'Aditya Sheva Pratama', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Pendidikan Teknik Bangunan', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'K3523005', 
                'nama' => 'Afif Nur Azam', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Pendidikan Teknik Sigma', 
                'status_saat_ini' => 'Lulus', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'A1223006', 
                'nama' => 'Putri Diana Sari', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'S1 Akuntansi', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'H7123007', 
                'nama' => 'Bagus Setiawan', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Hukum', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'F0323008', 
                'nama' => 'Citra Mustika Dewi', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'D4 Kebidanan', 
                'status_saat_ini' => 'Cuti', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'P1123009', 
                'nama' => 'Eko Prasetyo', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Farmasi', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'G0023010', 
                'nama' => 'Fitriani Solikha', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'S1 Ilmu Komunikasi', 
                'status_saat_ini' => 'Lulus', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'J0123011', 
                'nama' => 'Genta Wirayudha', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Sastra Inggris', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'E2123012', 
                'nama' => 'Hana Maharani', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'D3 Administrasi Bisnis', 
                'status_saat_ini' => 'Mengundurkan Diri', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'L0123013', 
                'nama' => 'Irfan Maulana', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Ilmu Politik', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'N1323014', 
                'nama' => 'Kartika Cahyani', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'S1 Arsitektur', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'O1523015', 
                'nama' => 'Lukman Hakim', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Perencanaan Wilayah dan Kota', 
                'status_saat_ini' => 'Cuti', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'D0423016', 
                'nama' => 'Mega Safitri', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'D3 Teknik Sipil', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'K4123017', 
                'nama' => 'Naufal Rizky', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Pendidikan Sejarah', 
                'status_saat_ini' => 'Lulus', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'S1223018', 
                'nama' => 'Olivia Permata', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'S1 Gizi', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'T0123019', 
                'nama' => 'Rafi Ramadhan', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Teknik Elektro', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'U2223020', 
                'nama' => 'Siti Maryam', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'D4 Akuntansi Sektor Publik', 
                'status_saat_ini' => 'Mengundurkan Diri', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'V0323021', 
                'nama' => 'Teguh Santoso', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Geografi', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'W0123022', 
                'nama' => 'Vina Amelia', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'S1 Biologi', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'X1123023', 
                'nama' => 'Yoga Pratama', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Kimia', 
                'status_saat_ini' => 'Cuti', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'Y0023024', 
                'nama' => 'Zahra Khoirunnisa', 
                'jenis_kelamin' => 'Perempuan', 
                'jenjang_prodi' => 'D3 Perhotelan', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
            [
                'nim' => 'Z0523025', 
                'nama' => 'Dimas Aryasena', 
                'jenis_kelamin' => 'Laki-laki', 
                'jenjang_prodi' => 'S1 Ekonomi Pembangunan', 
                'status_saat_ini' => 'Aktif', 
                'tanggal_masuk' => '2023-08-01', 
                'semester_awal' => 'Ganjil 2023/2024', 
                'status_awal_mhs' => 'Peserta Didik Baru'
            ],
        ];

        // Memasukkan data ke database
        $records = array_map(function ($item) use ($now) {
            return array_merge($item, [
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }, $data);

        DB::table('data_mhs')->insert($records);
    }
}