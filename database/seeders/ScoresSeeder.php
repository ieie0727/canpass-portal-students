<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Score;
use Illuminate\Support\Facades\DB;


class ScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = DB::table('students')->pluck('id');

        foreach ($students as $student_id) {
            for ($grade = 1; $grade <= 3; $grade++) {
                for ($term = 1; $term <= 4; $term++) {
                    Score::create([
                        'student_id' => $student_id,
                        'grade' => $grade,
                        'term' => $term,
                        'japanese' => rand(0, 100),
                        'math' => rand(0, 100),
                        'english' => rand(0, 100),
                        'social' => rand(0, 100),
                        'science' => rand(0, 100),
                        'music' => rand(0, 100),
                        'art' => rand(0, 100),
                        'physical' => rand(0, 100),
                        'industrial' => rand(0, 100),
                    ]);
                }
            }
        }
    }
}
