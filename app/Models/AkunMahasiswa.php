<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AkunMahasiswa extends Authenticatable
{
    use Notifiable;

    protected $table = 'login_akun_mhs';

    protected $fillable = [
        'nim', 'nama', 'akun',
    ];

    protected $hidden = [
        'nim', // kalau nanti nim dijadikan password
    ];
}
