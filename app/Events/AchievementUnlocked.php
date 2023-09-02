<?php

namespace App\Events;

use App\Models\User;
use App\Models\Achievement;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class AchievementUnlocked
{
    use Dispatchable, SerializesModels;

    public $achievementTitle;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($achievementTitle, User $user)
    {
        $this->achievementTitle = $achievementTitle;
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getAchievementTitle()
    {
        return $this->achievementTitle;
    }
}