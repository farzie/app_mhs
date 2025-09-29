<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'data_mhs'; 

    protected $fillable = [
        'nim',
        'nama',
        'jenis_kelamin',
        'jenjang_prodi',
        'status_saat_ini',
        'tanggal_masuk',
        'semester_awal',
        'status_awal_mhs',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];
}