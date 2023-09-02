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

        $lessonsWatchedCount = StatisticsService::addLessonWatched($user->id);
        $isAchievementUnlocked = $this->CheckForLessonsAchievementAction->execute($user, $lessonsWatchedCount);

        if ($isAchievementUnlocked) {
            event(new AchievementUnlocked($isAchievementUnlocked->title, $user));
        }

    }
}