<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'students', // provider を students に設定
        ],
    ],

    'providers' => [
        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'students',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
