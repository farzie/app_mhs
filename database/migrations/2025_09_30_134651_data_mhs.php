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