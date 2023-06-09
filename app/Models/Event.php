<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'fitness_center_id',
        'event_name',
        'event_description',
        'event_date',
        'event_location',
        'event_type',
        'max_participants'
    ];

    public function posts() {
        return $this->morphMany(Post::class, 'linkable');
    }

    public function fitnessCenter(){
        return $this->hasOne(FitnessCenter::class);
    }

    public function participants(){
        return $this->belongsToMany(User::class, 'event_participants');
    }
}
