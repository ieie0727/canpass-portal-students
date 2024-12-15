<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $fillable = [
        'student_id',
        'grade',
        'term',
        'japanese',
        'math',
        'english',
        'social',
        'science',
        'music',
        'art',
        'physical',
        'industrial',
    ];

    /**
     * リレーション: 生徒
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
