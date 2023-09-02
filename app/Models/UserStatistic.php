<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatistic extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'watched_lessons_number',
        'written_comments_number'
    ];
 
    /**
     * Get the user that have the statistics.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

