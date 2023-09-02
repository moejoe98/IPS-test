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
                $user->badges()->attach($badge->id);
                return $badge;
            }
        }
        return null;
    }
}