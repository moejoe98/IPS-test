<?php

namespace Tests\Feature\Comment;

use App\Services\Achievements\AchievementsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\AddsComment;

class CommentWrittenTest extends TestCase
{
    use RefreshDatabase, AddsComment;


    protected function setUp(): void
    {
        parent::setUp();
        $this->seed([
            'DatabaseSeeder',
        ]);

    }
    /**
     * This Test Insert Number of comments and checks achievements
     */
    public function testUserCommentEvent(): void
    {
        $achievements = AchievementsService::getCommentsAchievements()->toArray();
        $maxRankAchiement = $achievements[count($achievements) - 1]['rank'];

        for ($i = 1; $i <= $maxRankAchiement; $i++) {
            $this->addComment();
            sleep(1);
            $this->checkAchievements($i, $achievements);
        }

    }


    protected function checkAchievements($numberOfCommentsAdded, $achievements)
    {
        $response = $this->getJson('/users/1/achievements');
        $response->assertStatus(200);

        $data = json_decode($response->getContent());

        $isAchieved = array_filter($achievements, function ($item) use ($numberOfCommentsAdded) {
            return $item['rank'] == $numberOfCommentsAdded;
        });

        if (!empty($isAchieved)) {
            $this->assertContains($isAchieved[array_key_first($isAchieved)]['title'], $data->unlocked_achievements);
            $this->checkNextAchievement($numberOfCommentsAdded, $achievements, $response);
        }

    }

    protected function checkNextAchievement($numberOfCommentsAdded, $achievements, $response)
    {

        $currentIndex = array_search("$numberOfCommentsAdded", array_column($achievements, 'rank'));
        $currentIndex++;
        $nextAchievement = $currentIndex >= count($achievements) ? null : $achievements[$currentIndex];

        if ($nextAchievement) {
            $response->assertJsonPath('next_available_achievements.next_comment_achievement', $nextAchievement['title']);
        }
    }
}