<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_mhs', function (Blueprint $table) {
            $table->id();
            $table->string('nim', 15)->unique();
            $table->string('nama', 150);
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('jenjang_prodi', 255);
            $table->string('status_saat_ini', 50);
            $table->date('tanggal_masuk');
            $table->string('semester_awal', 30);
            $table->string('status_awal_mhs', 50);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_mhs');
    }
};

/*
INSERT INTO `data_mhs` (`id`, `nim`, `nama`, `jenis_kelamin`, `jenjang_prodi`, `status_saat_ini`, `tanggal_masuk`, `semester_awal`, `status_awal_mhs`, `created_at`, `updated_at`) VALUES 
(NULL, 'M0523001', 'Azzam Tsabitul Jamil', 'Laki-laki', 'S1 Informatika', 'Cuti', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'), 
(NULL, 'I0423002', 'Adella Putri Ayu', 'Perempuan', 'S1 Teknik Mesin', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'), 
(NULL, 'I8623003', 'Adik Anugrahing Gusti', 'Laki-laki', 'D3 Teknik Mesin', 'Mengundurkan Diri', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'), 
(NULL, 'K1523004', 'Aditya Sheva Pratama', 'Laki-laki', 'S1 Pendidikan Teknik Bangunan', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'), 
(NULL, 'K3523005', 'AFIF NUR AZAM', 'Laki-laki', 'S1 Pendidikan Teknik Sigma', 'Lulus', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'A1223006', 'Putri Diana Sari', 'Perempuan', 'S1 Akuntansi', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'H7123007', 'Bagus Setiawan', 'Laki-laki', 'S1 Hukum', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'F0323008', 'Citra Mustika Dewi', 'Perempuan', 'D4 Kebidanan', 'Cuti', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'P1123009', 'Eko Prasetyo', 'Laki-laki', 'S1 Farmasi', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'G0023010', 'Fitriani Solikha', 'Perempuan', 'S1 Ilmu Komunikasi', 'Lulus', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'J0123011', 'Genta Wirayudha', 'Laki-laki', 'S1 Sastra Inggris', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'E2123012', 'Hana Maharani', 'Perempuan', 'D3 Administrasi Bisnis', 'Mengundurkan Diri', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'L0123013', 'Irfan Maulana', 'Laki-laki', 'S1 Ilmu Politik', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'N1323014', 'Kartika Cahyani', 'Perempuan', 'S1 Arsitektur', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'O1523015', 'Lukman Hakim', 'Laki-laki', 'S1 Perencanaan Wilayah dan Kota', 'Cuti', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'D0423016', 'Mega Safitri', 'Perempuan', 'D3 Teknik Sipil', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'K4123017', 'Naufal Rizky', 'Laki-laki', 'S1 Pendidikan Sejarah', 'Lulus', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'S1223018', 'Olivia Permata', 'Perempuan', 'S1 Gizi', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'T0123019', 'Rafi Ramadhan', 'Laki-laki', 'S1 Teknik Elektro', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'U2223020', 'Siti Maryam', 'Perempuan', 'D4 Akuntansi Sektor Publik', 'Mengundurkan Diri', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'V0323021', 'Teguh Santoso', 'Laki-laki', 'S1 Geografi', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'W0123022', 'Vina Amelia', 'Perempuan', 'S1 Biologi', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'X1123023', 'Yoga Pratama', 'Laki-laki', 'S1 Kimia', 'Cuti', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'Y0023024', 'Zahra Khoirunnisa', 'Perempuan', 'D3 Perhotelan', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'),
(NULL, 'Z0523025', 'Dimas Aryasena', 'Laki-laki', 'S1 Ekonomi Pembangunan', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09');*/