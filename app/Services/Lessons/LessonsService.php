<?php

namespace App\Services\Lessons;

use App\Models\UserLesson;

class LessonsService
{
    public static function lessonWatched($userId, $lessonId)
    {
        UserLesson::create([
            'user_id' => $userId,
            'lesson_id' => $lessonId,
        ]);
    }

}