<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    // テーブル名
    protected $table = 'records';

    // フィールドの設定
    protected $fillable = [
        'student_id',
        'section_id',
        'attempt_number',
        'score',
        'is_passed',
        'corrects',
        'incorrects',
    ];

    // リレーション: 学生情報
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // リレーション: セクション情報
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
