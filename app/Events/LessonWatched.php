<?php

namespace App\Events;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class LessonWatched
{
    use Dispatchable, SerializesModels;

    public $lesson;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($lesson, User $user)
    {
        $this->lesson = $lesson;
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getLesson()
    {
        return $this->lesson;
    }
}