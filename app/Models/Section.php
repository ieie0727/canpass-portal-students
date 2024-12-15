<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'number',
        'name',
    ];

    /**
     * リレーション設定: Testには複数のQuestionが関連します
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
