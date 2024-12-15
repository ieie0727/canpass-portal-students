<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;

class GradesSeeder extends Seeder
{
    public function run(): void
    {
        $students = DB::table('students')->pluck('id');

        foreach ($students as $student_id) {
            for ($grade = 1; $grade <= 3; $grade++) {
                for ($term = 1; $term <= 4; $term++) {
                    Grade::create([
                        'student_id' => $student_id,
                        'grade' => $grade,
                        'term' => $term,
                        'japanese' => rand(1, 5),
                        'math' => rand(1, 5),
                        'english' => rand(1, 5),
                        'social' => rand(1, 5),
                        'science' => rand(1, 5),
                        'music' => rand(1, 5),
                        'art' => rand(1, 5),
                        'physical' => rand(1, 5),
                        'industrial' => rand(1, 5),
                    ]);
                }
            }
        }
    }
}
