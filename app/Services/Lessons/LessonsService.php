<?php

namespace App\Services\Lessons;

use App\Models\UserLesson;

class LessonsService
{
    //add watched lesson to user_lessons table
    public static function lessonWatched($userId, $lessonId)
    {
        UserLesson::create([
            'user_id' => $userId,
            'lesson_id' => $lessonId,
        ]);
    }

}