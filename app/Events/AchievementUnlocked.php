<?php

namespace App\Events;

use App\Models\User;
use App\Models\Achievement;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class AchievementUnlocked
{
    use Dispatchable, SerializesModels;

    public $achievement_name ;
    public $user ;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Achievement $achievement_name, User $user)
    {
        $this->achievement_name = $achievement_name;
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getAchievement()
    {
        return $this->achievement_name;
    }
}
