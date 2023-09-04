<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\LessonWatched;
use App\Services\Statistics\StatisticsService;
use App\Http\Actions\Achievements\Lessons\CheckForLessonsAchievementAction;

class LessonWatchedListener
{ /**
  * The CheckForLessonsAchievementAction instance.
  *
  * @var CheckForLessonsAchievementAction
  */
    private $CheckForLessonsAchievementAction;

    /**
     * Create the event listener.
     *
     * @param CheckForLessonsAchievementAction $CheckForLessonsAchievementAction
     */
    public function __construct(CheckForLessonsAchievementAction $CheckForLessonsAchievementAction)
    {
        $this->CheckForLessonsAchievementAction = $CheckForLessonsAchievementAction;
    }

    public function handle(LessonWatched $event): void
    {
        $user = $event->getUser();
        $lesson = $event->getLesson();

        //increment lessons_watched in statistics table
        $lessonsWatchedCount = StatisticsService::addLessonWatched($user->id);

        //Check if achievement unlocked
        $isAchievementUnlocked = $this->CheckForLessonsAchievementAction->execute($user, $lessonsWatchedCount);

        //if achievement is unlocked, dispatch AchievementUnlocked Event
        if ($isAchievementUnlocked) {
            AchievementUnlocked::dispatch($isAchievementUnlocked->title, $user);

        }

    }
}