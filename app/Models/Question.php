<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'question_text',
        'question_image',
        'number',
        'choice1',
        'choice2',
        'choice3',
        'choice4',
        'correct_answer',
    ];

    /**
     * リレーション設定: Questionは1つのTestに関連します
     */
    public function test()
    {
        return $this->belongsTo(Section::class);
    }
}
