<?php

namespace App\Http\Actions\Achievements\Lessons;

use App\Services\Comments\CommentsService;
use App\Services\Achievements\AchievementsService;

class CheckForLessonsAchievementAction
{
    public function execute($user, $lessonsCount)
    {
        $lessonAchievements = AchievementsService::getLessonsAchievements();
        foreach ($lessonAchievements as $achievement) {
            if ($lessonsCount == $achievement->rank) {
                $user->achievements()->attach($achievement->id);
                return $achievement;
            }
        }
        return null;
    }
}