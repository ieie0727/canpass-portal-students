<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array
     */
    protected $except = [
        // パスワードやその他のトリムしたくないフィールドがあればここに追加
        'password',
        'password_confirmation',
    ];
}
