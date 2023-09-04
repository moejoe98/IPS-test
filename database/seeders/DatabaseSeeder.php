<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Lesson;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\UserAchievement;
use App\Models\UserBadge;
use App\Models\UserLesson;
use App\Models\UserStatistic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            AchievementsSeeder::class
        ]);

        $this->call([
            BadgeSeeder::class
        ]);

        $this->call([
            UserSeeder::class
        ]);

        Lesson::factory()
            ->count(10)
            ->create();

    }
}