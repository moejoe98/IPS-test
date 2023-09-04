<?php

namespace Tests\Traits;

use Tests\Traits\CheckNextAchievement;
use Tests\Traits\CheckBadge;

trait CheckAchievement
{
    use CheckNextAchievement, CheckBadge;

    protected $achievementCounter = 0;

    protected function checkAchievements($numberOfRanks, $achievements, $type, $badges)
    {
        $response = $this->getJson('/users/1/achievements');
        $response->assertStatus(200);

        $data = json_decode($response->getContent());

        //Check if user unlocked any achievement
        $isAchieved = array_filter($achievements, function ($item) use ($numberOfRanks) {
            return $item['rank'] == $numberOfRanks;
        });

        if (!empty($isAchieved)) {
            $this->assertContains($isAchieved[array_key_first($isAchieved)]['title'], $data->unlocked_achievements);
            $this->achievementCounter++;

            $this->checkNextAchievement($numberOfRanks, $achievements, $response, $type);
            $this->checkBadges($this->achievementCounter, $badges);
        }

    }
    public function getAchievementCounter()
    {
        return $this->achievementCounter;
    }
}