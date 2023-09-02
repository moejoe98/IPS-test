<?php

namespace App\Services\Achievements;

use App\Models\Achievement;
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
}