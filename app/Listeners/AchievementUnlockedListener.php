<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Services\Statistics\StatisticsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Http\Actions\Badges\CheckForBadgesAction;

class AchievementUnlockedListener
{

    /**
     * The CheckForBadgesAction instance.
     *
     * @var CheckForBadgesAction
     */
    private $checkForBadgesAction;
    /**
     * Create the event listener.
     *
     * @param CheckForBadgesAction $checkForBadgesAction
     */

    /**
     * Create the event listener.
     */
    public function __construct(CheckForBadgesAction $checkForBadgesAction)
    {
        $this->checkForBadgesAction = $checkForBadgesAction;
    }

    /**
     * Handle the event.
     */
    public function handle(AchievementUnlocked $event): void
    {
        $user = $event->getUser();
        $achievement = $event->getAchievementTitle();

        //increment achievements_number in statistics table
        $achievementsNumber = StatisticsService::addAchievement($user->id);

        //Check if badge is unlocked
        $isBadgeUnlocked = $this->checkForBadgesAction->execute($user, $achievementsNumber);

        //if achievement is unlocked, dispatch AchievementUnlocked Event
        if ($isBadgeUnlocked) {
            BadgeUnlocked::dispatch($isBadgeUnlocked->title, $user);
        }
    }
}