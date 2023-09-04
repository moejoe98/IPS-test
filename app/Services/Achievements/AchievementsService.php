<?php

namespace App\Services\Achievements;

use App\Models\Achievement;
use App\Models\UserAchievement;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AchievementsService
{
  public static function getCommentsAchievements()
  {
    return Cache::remember('comment_achievements', now()->addHours(1), function () {
      return Achievement::where('type', 'comment')->orderBy('rank', 'asc')->get();
    });
  }

  public static function getLessonsAchievements()
  {
    return Cache::remember('lesson_achievements', now()->addHours(1), function () {
      return Achievement::where('type', 'lesson')->orderBy('rank', 'asc')->get();
    });
  }

  public static function unlockedAchievements($user)
  {
    $achievements = $user->achievements()->get();
    $achievementTitles = $achievements->map(function ($userAchievement) {
      return $userAchievement->achievement->title;
    })->toArray();
    return $achievementTitles;
  }

  public static function currentAchievementByType($user, $type)
  {
    $res = $user->achievements()
      ->whereHas('achievement', function ($query) use ($type) {
        $query->where('type', $type);
      })
      ->orderBy('created_at', 'desc')
      ->first();

    if ($res) {
      return $res->achievement->rank;
    } else {
      return 0;
    }

  }

  public static function nextAchievementByType($user, $type)
  {
    $currentCommentAchievementRank = self::currentAchievementByType($user, $type);
    return Achievement::where('type', $type)->where('rank', '>', $currentCommentAchievementRank)
      ->orderBy('rank', 'asc')
      ->first();
  }

  public static function nextAvailableAchievements($user)
  {
    $nextCommentsAchievement = self::nextAchievementByType($user, 'comment');
    $nextLessonsAchievement = self::nextAchievementByType($user, 'lesson');
    return [
      'next_lesson_achievement' => $nextLessonsAchievement ? $nextLessonsAchievement->title : $nextLessonsAchievement,
      'next_comment_achievement' => $nextCommentsAchievement ? $nextCommentsAchievement->title : $nextCommentsAchievement
    ];

  }

  public static function achievementUnlocked($userId, $achievementId)
  {
    UserAchievement::create([
      'user_id' => $userId,
      'achievement_id' => $achievementId,
    ]);
  }

}