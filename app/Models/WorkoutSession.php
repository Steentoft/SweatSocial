<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutSession extends Model
{
    protected $fillable = [
        'workout_id',
        'ended'
    ];

    public function workout(){
        return $this->belongsTo(Workout::class);
    }

    public function workoutSessionData(){
        return $this->belongsTo(WorkoutSessionData::class);
    }
}
