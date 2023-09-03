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
        $lessons = Lesson::factory()
            ->count(20)
            ->create();

        $users = User::factory()
            ->count(20)
            ->create();

        $comments = Comment::factory()
            ->count(20)
            ->create();

        $this->call([
            AchievementsSeeder::class
        ]);

        $this->call([
            BadgeSeeder::class
        ]);

        $userAchievement = UserAchievement::factory()
            ->count(20)
            ->create();

        $userBadge = UserBadge::factory()
            ->count(20)
            ->create();

        $userLesson = UserLesson::factory()
            ->count(20)
            ->create();

        $userStatistics = UserStatistic::factory()
            ->count(20)
            ->create();
    }
}