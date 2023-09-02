<?php

namespace App\Http\Controllers;

use App\Http\Actions\UserBadgeAchievementsInfo;
use App\Models\Achievement;
use App\Models\User;
use App\Services\Badges\BadgesService;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user, UserBadgeAchievementsInfo $action)
    {

        $response = $action->execute($user);
        return response()->json($response);
    }
}