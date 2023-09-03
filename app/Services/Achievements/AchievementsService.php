<?php

namespace App\Services\Achievements;

use App\Models\Achievement;
use App\Models\UserAchievement;
use Illuminate\Support\Facades\Cache;

class AchievementsService
{
  public static function getCommentsAchievements()
  {
    return Cache::remember('comment_achievements', now()->addHours(1), function () {
      return Achievement::where('type', 'comment')->get();
    });
  }

  public static function getLessonsAchievements()
  {
    return Cache::remember('lesson_achievements', now()->addHours(1), function () {
      return Achievement::where('type', 'lesson')->get();
    });
  }

  public static function unlockedAchievements($user)
  {
    return $user->achievements()->pluck('title')->toArray();
  }

  public static function currentArchievement($user)
  {
    return $user->UserAchievement()
      ->orderBy('created_at', 'desc')
      ->first();
  }

  public static function nextAchievement($user)
  {
    $currentAchievement = self::currentArchievement($user);
    return Achievement::where('rank', '>', $currentAchievement->rank)
      ->orderBy('rank', 'asc')
      ->first();
  }

  public static function achievementUnlocked($userId, $achievementId)
  {
    UserAchievement::create([
      'user_id' => $userId,
      'achievement_id' => $achievementId,
    ]);
  }

}