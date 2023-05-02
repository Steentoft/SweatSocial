<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'share_token'
    ];

    public function posts() {
        return $this->morphMany(Post::class, 'linkable');
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'workout_exercises');
    }

    public function sessions()
    {
        return $this->belongsTo(WorkoutSession::class);
    }
}
