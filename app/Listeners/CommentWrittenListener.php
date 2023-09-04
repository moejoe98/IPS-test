<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Http\Actions\Achievements\Comments\CheckForCommentsAchievementAction;
use App\Services\Statistics\StatisticsService;
use Illuminate\Support\Facades\Log;

class CommentWrittenListener
{
    /**
     * The CheckForCommentsAchievementAction instance.
     *
     * @var CheckForCommentsAchievementAction
     */
    private $checkForCommentsAchievementAction;

    /**
     * Create the event listener.
     *
     * @param CheckForCommentsAchievementAction $checkForCommentsAchievementAction
     */
    public function __construct(CheckForCommentsAchievementAction $checkForCommentsAchievementAction)
    {
        $this->checkForCommentsAchievementAction = $checkForCommentsAchievementAction;
    }

    /**
     * Handle the event.
     */
    public function handle(CommentWritten $event): void
    {
        $comment = $event->getComment();
        $user = $comment->user;

        //increment written_comments in statistics table
        $commentsCount = StatisticsService::addComment($user->id);

        //check if achievemeny is unlocked
        $isAchievementUnlocked = $this->checkForCommentsAchievementAction->execute($user, $commentsCount);

        //if achievement is unlocked, dispatch AchievementUnlocked Event
        if ($isAchievementUnlocked) {
            AchievementUnlocked::dispatch($isAchievementUnlocked->title, $user);
        }
    }
}