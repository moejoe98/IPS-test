<?php

namespace Database\Factories;

use App\Models\Achievement;
use App\Models\User;
use App\Models\UserAchievement;
use App\Models\UserStatistic;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserStatisticFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserStatistic::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::inRandomOrder()->first();
        return [
            'user_id' => $user->id,
            'watched_lessons_number' => $user->lessons->count(),
            'written_comments_number' => $user->comments->count(),
            'achievements_number' => $user->achievements->count(),
        ];
    }
}