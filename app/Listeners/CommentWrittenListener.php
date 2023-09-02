<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use App\Events\CommentWritten;
use App\Http\Actions\Achievements\CheckForAchievementAction;
use App\Services\Statistics\StatisticsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\Comments\CommentsService;

class CommentWrittenListener
{
    /**
     * The CheckForAchievementAction instance.
     *
     * @var CheckForAchievementAction
     */
    private $checkForAchievementAction;

    /**
     * Create the event listener.
     *
     * @param CheckForAchievementAction $checkForAchievementAction
     */
    public function __construct(CheckForAchievementAction $checkForAchievementAction)
    {
        $this->checkForAchievementAction = $checkForAchievementAction;
    }

    /**
     * Handle the event.
     */
    public function handle(CommentWritten $event): void
    {
        $comment = $event->getComment();
        $user = $comment->user;
        $commentsCount = StatisticsService::addComment($user->id);
        $isAchievementUnlocked = $this->checkForAchievementAction->execute($user, $commentsCount);

        if ($isAchievementUnlocked) {
            event(new AchievementUnlocked($isAchievementUnlocked->title, $user));
        }
    }
}