<?php

namespace App\Services\Statistics;

use App\Models\UserStatistic;

class StatisticsService
{
    public static function addComment($userId)
    {
        return UserStatistic::where('user_id', $userId)
            ->increment('written_comments_number')
            ->value('written_comments_number');
    }

    public static function addAchievement($userId)
    {
        return UserStatistic::where('user_id', $userId)
            ->increment('achievements_number')
            ->value('achievements_number');
    }

}