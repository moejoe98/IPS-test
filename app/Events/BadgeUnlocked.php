<?php

namespace App\Events;

use App\Models\User;
use App\Models\Badge;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class BadgeUnlocked
{
    use Dispatchable, SerializesModels;

    public $badgeTitle;
    public $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($badgeTitle, User $user)
    {
        $this->badgeTitle = $badgeTitle;
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getBadgeTitle()
    {
        return $this->badgeTitle;
    }
}