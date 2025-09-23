<?php

namespace App\Models;

use App\Http\Controllers\Mahasiswa;
use Illuminate\Database\Eloquent\Model;

class mahasiswas extends Model
{
    protected $table = 'mahasiswas'; // nama tabel sesuai database

    protected $fillable = ['nama'];
}
