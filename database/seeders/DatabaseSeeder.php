<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\StudentsSeeder;
use Database\Seeders\GradesSeeder;
use Database\Seeders\ScoresSeeder;
use Database\Seeders\RecordsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(StudentsSeeder::class);
        $this->call(GradesSeeder::class);
        $this->call(ScoresSeeder::class);
        $this->call(RecordsSeeder::class);
    }
}
