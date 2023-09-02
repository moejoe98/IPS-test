<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAchievement extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'achievement_id'
    ];

    protected $with = ['achievement'];

    
    /**
     * Get the user that have the achievement.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     /**
     * Get the achievement.
     */
    public function achievement()
    {
        return $this->belongsTo(Achievement::class);
    }
}
