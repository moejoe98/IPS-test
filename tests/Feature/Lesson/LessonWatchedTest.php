<?php

namespace Tests\Feature\Comment;

use App\Services\Achievements\AchievementsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AddsComment;
use Tests\Traits\AddsWatchLesson;

class LessonWatchedTest extends TestCase
{
    use RefreshDatabase, AddsComment, AddsWatchLesson;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'DatabaseSeeder',
        ]);

    }
    /**
     * This Test Insert Number of lessons and checks achievements
     */
    public function testLessonWatchedEvent(): void
    {
        $achievements = AchievementsService::getLessonsAchievements()->toArray();
        $maxRankAchiement = $achievements[count($achievements) - 1]['rank'];

        for ($i = 1; $i <= $maxRankAchiement; $i++) {
            $this->AddWatchLessons($i);
            sleep(1);
            $this->checkAchievements($i, $achievements);
        }
    }


    protected function checkAchievements($numberOfLessonsWatched, $achievements)
    {
        $response = $this->getJson('/users/1/achievements');
        $response->assertStatus(200);

        $data = json_decode($response->getContent());

        $isAchieved = array_filter($achievements, function ($item) use ($numberOfLessonsWatched) {
            return $item['rank'] == $numberOfLessonsWatched;
        });

        if (!empty($isAchieved)) {
            $this->assertContains($isAchieved[array_key_first($isAchieved)]['title'], $data->unlocked_achievements);
            $this->checkNextAchievement($numberOfLessonsWatched, $achievements, $response);
        }

    }

    protected function checkNextAchievement($numberOfLessonsWatched, $achievements, $response)
    {

        $currentIndex = array_search("$numberOfLessonsWatched", array_column($achievements, 'rank'));
        $currentIndex++;
        $nextAchievement = $currentIndex >= count($achievements) ? null : $achievements[$currentIndex];

        if ($nextAchievement) {
            $response->assertJsonPath('next_available_achievements.next_lesson_achievement', $nextAchievement['title']);
        }
    }
}