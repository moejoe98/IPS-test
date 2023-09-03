<?php

namespace App\Services\Badges;

use App\Models\Badge;
use App\Models\UserBadge;

class BadgesService
{
    public static function getBadges()
    {
        return Badge::get();
    }

    public static function getCurrentBadges($user)
    {
        return $user->badges()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public static function userBadgeDetails($user)
    {
        $currentBadge = self::getCurrentBadges($user);
        $currentRank = $currentBadge->badge->rank;

        $nextBadge = Badge::where('rank', '>', $currentRank)
            ->orderBy('rank', 'asc')
            ->first();

        $remainingToNextBadge = $nextBadge ? $nextBadge->rank - $currentRank : 0;

        return [
            'nextBadge' => $nextBadge ? $nextBadge->title : $nextBadge,
            'currentBadge' => $currentBadge->badge->title,
            'remainingToUnlock' => $remainingToNextBadge
        ];
    }

    public static function badgeUnlocked($userId, $badgeId)
    {
        UserBadge::create([
            'user_id' => $userId,
            'badge_id' => $badgeId,
        ]);
    }
}