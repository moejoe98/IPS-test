<?php

namespace Tests\Feature;

use App\Services\Achievements\AchievementsService;
use App\Services\Badges\BadgesService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AddsComment;
use Tests\Traits\AddsWatchLesson;
use Tests\Traits\CheckAchievement;

class BadgeTest extends TestCase
{
    use RefreshDatabase, AddsComment, AddsWatchLesson, CheckAchievement;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'DatabaseSeeder',
        ]);

    }
    /**
     * This Test Insert Number of comments and lessons randomly, it checks achievements and badges.
     */
    public function testBadge(): void
    {
        $lessonsAchievements = AchievementsService::getLessonsAchievements()->toArray();
        $commentsAchievements = AchievementsService::getCommentsAchievements()->toArray();
        $badges = BadgesService::getBadges()->toArray();

        $maxLessonsRank = $lessonsAchievements[count($lessonsAchievements) - 1]['rank'];
        $maxCommentsRank = $commentsAchievements[count($commentsAchievements) - 1]['rank'];

        $actions = ['comment', 'lesson'];
        $commentCounter = 1;
        $lessonCounter = 1;

        while ($commentCounter <= $maxCommentsRank || $lessonCounter <= $maxLessonsRank) {
            $randomAction = $actions[array_rand($actions)];

            if ($randomAction === 'comment' && $commentCounter <= $maxCommentsRank) {
                $this->addComment();
                sleep(1);
                $this->checkAchievements($commentCounter, $commentsAchievements, 'comment', $badges);
                $commentCounter++;
            } elseif ($randomAction === 'lesson' && $lessonCounter <= $maxLessonsRank) {
                $this->AddWatchLessons($lessonCounter);
                sleep(1);
                $this->checkAchievements($lessonCounter, $lessonsAchievements, 'lesson', $badges);
                $lessonCounter++;
            }

        }
    }

}