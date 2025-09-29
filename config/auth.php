<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\AkunMahasiswa::class,
        ],
        'admins' => [ 
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users', 
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
