<?php

namespace App\Http\Actions\Achievements;

use App\Services\Comments\CommentsService;
use App\Services\Achievements\AchievementsService;

class CheckForAchievementAction
{
    public function execute($user, $commentsCount)
    {
        $commentAchievements = AchievementsService::getCommentsAchievements();
        foreach ($commentAchievements as $achievement) {
            if ($commentsCount == $achievement->rank) {
                $user->achievements()->attach($achievement->id);
                return $achievement;
            }
        }
        return null;
    }
}