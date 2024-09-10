<?php

return [

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
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
        'digital_marketing' => [ // Tambahkan ini
            'driver' => 'session',
            'provider' => 'digital_marketings',
        ],
        'sdm' => [ // Tambahkan ini
            'driver' => 'session',
            'provider' => 'sdms',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'digital_marketings' => [ // Tambahkan ini
            'driver' => 'eloquent',
            'model' => App\Models\DigitalMarketing::class,
        ],
        'sdms' => [ // Tambahkan ini
            'driver' => 'eloquent',
            'model' => App\Models\Sdm::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
