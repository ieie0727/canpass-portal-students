<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'family_name',
        'given_name',
        'email_company',
        'phone_company',
        'email_private',
        'phone_private',
        'birth_date',
        'hire_date',
        'retirement_date',
        'status',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 認証に使用するカラム名を指定
    public function getAuthIdentifierName()
    {
        return 'email_company';
    }
}
