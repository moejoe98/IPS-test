<?php

namespace Tests\Traits;

use Tests\Traits\CheckNextBadge;

trait CheckBadge
{
    use CheckNextBadge;

    protected function checkBadges($numberOfAchievementsAdded, $badges)
    {
        $response = $this->getJson('/users/1/achievements');
        $response->assertStatus(200);

        $data = json_decode($response->getContent());

        //Check if user unlocked badge
        $isBadgeUnlocked = array_filter($badges, function ($item) use ($numberOfAchievementsAdded) {
            return $item['rank'] == $numberOfAchievementsAdded;
        });

        if (!empty($isAchieved)) {
            $this->assertStringContainsString($isAchieved[array_key_first($isAchieved)]['title'], $data->current_badge);
            $this->checkNextBadge($numberOfAchievementsAdded, $badges, $response);
        }

    }

}