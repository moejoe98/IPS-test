<?php

namespace App\Services\Badges;

use App\Models\Badge;

class BadgesService
{
    public static function getBadges()
    {
        return Badge::get();
    }

}