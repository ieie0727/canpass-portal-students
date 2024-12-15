<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Record;
use App\Models\Student;
use App\Models\Section;

class RecordsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // 全ての学生とセクションを取得
    $students = Student::all();
    $sections = Section::all();

    foreach ($students as $student) {
      foreach ($sections as $section) {
        for ($i = 1; $i <= 30; $i++) {
          // スコアをランダムに生成（0〜10）
          $score = rand(0, 10);
          // 合否判定（スコア5以上で合格とする）
          $isPassed = $score >= 5;

          // 正解と不正解の問題番号をランダムに生成
          $corrects = collect(range(1, 10))->random($score)->implode(',');
          $incorrects = collect(range(1, 10))->diff(explode(',', $corrects))->implode(',');

          Record::create([
            'student_id' => $student->id,
            'section_id' => $section->id,
            'attempt_number' => $i,
            'score' => $score,
            'is_passed' => $isPassed,
            'corrects' => $corrects,
            'incorrects' => $incorrects,
          ]);
        }
      }
    }
  }
}
