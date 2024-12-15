<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use Notifiable;

    // 一括代入可能な属性
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

    // 非表示にする属性
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * 認証に使用するカラムを指定
     */
    public function getAuthIdentifierName()
    {
        return 'email';
    }

    /**
     * Recordモデルとのリレーション
     */
    public function records()
    {
        return $this->hasMany(Record::class);
    }

    /**
     * Scoreモデルとのリレーション
     */
    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    /**
     * Gradeモデルとのリレーション
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
