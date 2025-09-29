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
INSERT INTO `data_mhs` (`id`, `nim`, `nama`, `jenis_kelamin`, `jenjang_prodi`, `status_saat_ini`, `tanggal_masuk`, `semester_awal`, `status_awal_mhs`, `created_at`, `updated_at`) VALUES (NULL, 'M0523001', 'Azzam Tsabitul Jamil', 'Laki-laki', 'S1 Informatika', 'Cuti', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'), (NULL, 'I0423002', 'Adella Putri Ayu', 'Perempuan', 'S1 Teknik Mesin', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'), (NULL, 'I8623003', 'Adik Anugrahing Gusti', 'Laki-laki', 'D3 Teknik Mesin', 'Mengundurkan Diri', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'), (NULL, 'K1523004', 'Aditya Sheva Pratama', 'Laki-laki', 'S1 Pendidikan Teknik Bangunan', 'Aktif', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09'), (NULL, 'K3523005', 'AFIF NUR AZAM', 'Laki-laki', 'S1 Pendidikan Teknik Informatika dan Komputer', 'Lulus', '2023-08-01', 'Ganjil 2023/2024', 'Peserta Didik Baru', '2025-09-29 19:22:09', '2025-09-29 19:22:09')
*/