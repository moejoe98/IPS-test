<?php

namespace App\Http\Actions\Achievements\Comments;

use App\Services\Achievements\AchievementsService;

class CheckForCommentsAchievementAction
{
    public function execute($user, $commentsCount)
    {
        $commentAchievements = AchievementsService::getCommentsAchievements();
        foreach ($commentAchievements as $achievement) {
            if ($commentsCount == $achievement->rank) {
                AchievementsService::achievementUnlocked($user->id, $achievement->id);
                return $achievement;
            }
        }
        return null;
    }
}