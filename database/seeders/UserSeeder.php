<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserBadge;
use App\Models\UserStatistic;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->count(1)
            ->create();

        //add default "Beginner" badge and userStatistics for each new user
        User::all()->each(function ($user) {
            UserBadge::create([
                'user_id' => $user->id,
                'badge_id' => 1,
            ]);
            UserStatistic::create([
                'user_id' => $user->id,
                'watched_lessons_number' => 0,
                'written_comments_number' => 0,
                'achievements_number' => 0,
            ]);
        });

    }
}