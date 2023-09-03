<?php

namespace App\Http\Actions\Achievements\Lessons;

use App\Services\Achievements\AchievementsService;
use App\Services\Lessons\LessonsService;

class CheckForLessonsAchievementAction
{
    public function execute($user, $lessonsCount)
    {
        $lessonAchievements = AchievementsService::getLessonsAchievements();
        foreach ($lessonAchievements as $achievement) {
            if ($lessonsCount == $achievement->rank) {
                AchievementsService::achievementUnlocked($user->id, $achievement->id);
                return $achievement;
            }
        }
        return null;
    }
}