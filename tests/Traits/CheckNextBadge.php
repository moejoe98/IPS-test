<?php

namespace Tests\Traits;

use Tests\Traits\CheckNextAchievement;

trait CheckNextBadge
{
    use CheckNextAchievement;

    /**
     * Check next badge to unlock
     */
    protected function checkNextBadge($numberOfAchievementsAdded, $badges, $response)
    {

        $currentIndex = array_search("$numberOfAchievementsAdded", array_column($badges, 'rank'));
        $currentIndex++;
        $nextBadge = $currentIndex >= count($badges) ? null : $badges[$currentIndex];

        $nextBadge ? $remainingTillNextBadge = $nextBadge['rank'] - $numberOfAchievementsAdded : $remainingTillNextBadge = null;

        if ($nextBadge) {
            $response->assertJsonPath('next_badge', $nextBadge['title']);
            $response->assertJsonPath('remaing_to_unlock_next_badge', $remainingTillNextBadge);
        }
    }

}