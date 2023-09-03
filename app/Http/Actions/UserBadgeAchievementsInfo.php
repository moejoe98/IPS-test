<?php

namespace App\Http\Actions;

use App\Models\Achievement;
use App\Services\Achievements\AchievementsService;
use App\Services\Badges\BadgesService;

class UserBadgeAchievementsInfo
{
    public function execute($user)
    {
        $unlockedAchievements = AchievementsService::unlockedAchievements($user);
        $nextAvailableAchievements = AchievementsService::nextAvailableAchievements($user);

        $UserBadgeDetails = BadgesService::userBadgeDetails($user);

        return [
            'unlocked_achievements' => $unlockedAchievements,
            'next_available_achievements' => $nextAvailableAchievements,
            'current_badge' => $UserBadgeDetails['currentBadge'],
            'next_badge' => $UserBadgeDetails['nextBadge'],
            'remaing_to_unlock_next_badge' => $UserBadgeDetails['remainingToUnlock'],
        ];
    }
}