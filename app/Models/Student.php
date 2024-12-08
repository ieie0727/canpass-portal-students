<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Student extends Model implements AuthenticatableContract
{
    use Notifiable, SoftDeletes, Authenticatable;

    protected $fillable = [
        'role',
        'family_name',
        'given_name',
        'email',
        'birth_date',
        'admission_date',
        'withdrawal_date',
        'status',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthIdentifierName()
    {
        return 'email';
    }
}
