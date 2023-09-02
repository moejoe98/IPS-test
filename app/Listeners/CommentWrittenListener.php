<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Http\Actions\Achievements\Comments\CheckForCommentsAchievementAction;
use App\Services\Statistics\StatisticsService;

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

        $commentsCount = StatisticsService::addComment($user->id);
        $isAchievementUnlocked = $this->checkForCommentsAchievementAction->execute($user, $commentsCount);

        if ($isAchievementUnlocked) {
            event(new AchievementUnlocked($isAchievementUnlocked->title, $user));
        }
    }
}