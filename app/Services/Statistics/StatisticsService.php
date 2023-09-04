<?php

namespace App\Services\Statistics;

use App\Models\UserStatistic;

class StatisticsService
{
    public static function addComment($userId)
    {
        $inc = UserStatistic::where('user_id', $userId)->first();
        $inc->increment('written_comments_number');
        return $inc->written_comments_number;

    }

    public static function addAchievement($userId)
    {
        $inc = UserStatistic::where('user_id', $userId)->first();
        $inc->increment('achievements_number');
        return $inc->achievements_number;
    }


    public static function addLessonWatched($userId)
    {
        $inc = UserStatistic::where('user_id', $userId)->first();
        $inc->increment('watched_lessons_number');
        return $inc->watched_lessons_number;
    }

}