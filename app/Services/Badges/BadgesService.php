<?php

namespace App\Services\Badges;

use App\Models\Badge;
use App\Models\UserAchievement;
use App\Models\UserBadge;
use Cache;

class BadgesService
{
    public static function getBadges()
    {
        return Cache::remember('badges', now()->addHours(1), function () {
            return Badge::orderBy('rank', 'asc')->get();
        });
    }

    public static function getCurrentBadges($user)
    {
        return $user->badges()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    //get user Badges details
    public static function userBadgeDetails($user)
    {
        $currentBadge = self::getCurrentBadges($user);
        $currentRank = $currentBadge->badge->rank;

        $nextBadge = Badge::where('rank', '>', $currentRank)
            ->orderBy('rank', 'asc')
            ->first();

        $achievementsNumber = $user->achievements()->count();

        $remainingToNextBadge = $nextBadge ? $nextBadge->rank - $achievementsNumber : 0;

        return [
            'nextBadge' => $nextBadge ? $nextBadge->title : $nextBadge,
            'currentBadge' => $currentBadge->badge->title,
            'remainingToUnlock' => $remainingToNextBadge
        ];
    }

    //add badge to user_badges table
    public static function badgeUnlocked($userId, $badgeId)
    {
        UserBadge::create([
            'user_id' => $userId,
            'badge_id' => $badgeId,
        ]);
    }
}