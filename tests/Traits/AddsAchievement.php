<?php

namespace Tests\Traits;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Models\Comment;
use App\Models\User;

trait AddsAchievement
{

    /**
     * Dispatch AchievementUnlocked event
     */
    private function addAchievement($achievementTitle)
    {
        $user = User::find(1);
        AchievementUnlocked::dispatch($achievementTitle, $user);
    }
}