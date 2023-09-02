<?php

namespace App\Services\Badges;

use App\Models\Badge;

class BadgesService
{
    public static function getBadges()
    {
        return Badge::get();
    }

    public static function getCurrentBadges($user)
    {
        return $user->userBadges()
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
            'nextBadge' => $nextBadge ? $nextBadge->title : null,
            'currentBadge' => $currentBadge,
            'remainingToUnlock' => $remainingToNextBadge
        ];
    }


}