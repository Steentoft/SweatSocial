<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSessionData extends Model
{
    protected $fillable = [
        'workout_session_id',
        'exercise_id',
        'weight',
        'reps'
    ];

    public function workoutSession(){
        return $this->hasOne(WorkoutSession::class);
    }

    public function exercise(){
        return $this->hasOne(Exercise::class);
    }
}
