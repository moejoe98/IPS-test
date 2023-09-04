<?php

namespace Tests\Traits;

use App\Events\LessonWatched;
use App\Models\User;
use App\Models\UserLesson;

trait AddsWatchLesson
{

    /**
     * Dispatch LessonWatched event
     */
    private function AddWatchLessons($lessonId)
    {
        $user = User::find(1);
        $lesson = new UserLesson([
            'user_id' => $user->id,
            'lesson_id' => $lessonId,
            'watched' => true
        ]);

        LessonWatched::dispatch($lesson, $user);
    }
}