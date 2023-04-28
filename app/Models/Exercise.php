<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'exercise_name',
    ];

    public function workout(){
        return $this->belongsToMany(Workout::class);
    }

    public function sessionData(){
        return $this->hasMany(WorkoutSessionData::class);
    }
}
