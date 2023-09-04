<?php

namespace Tests\Traits;



trait CheckNextAchievement
{

    /**
     * Checks the next achievement to unlock
     */
    protected function checkNextAchievement($numberOfRanks, $achievements, $response, $type)
    {
        $currentIndex = array_search("$numberOfRanks", array_column($achievements, 'rank'));
        $currentIndex++;
        $nextAchievement = $currentIndex >= count($achievements) ? null : $achievements[$currentIndex];

        if ($nextAchievement) {
            $nextAchievementKey = "next_available_achievements.next_{$type}_achievement";
            $response->assertJsonPath($nextAchievementKey, $nextAchievement['title']);
        }
    }

}