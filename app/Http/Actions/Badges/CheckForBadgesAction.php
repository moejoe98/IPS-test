<?php

namespace App\Http\Actions\Badges;

use App\Services\Achievements\AchievementsService;
use App\Services\Badges\BadgesService;

class CheckForBadgesAction
{
    public function execute($user, $achievementCount)
    {
        $badges = BadgesService::getBadges();
        foreach ($badges as $badge) {
            if ($achievementCount == $badge->rank) {

                //Add badge record to user_badges table
                BadgesService::badgeUnlocked($user->id, $badge->id);
                return $badge;
            }
        }
        return null;
    }
}