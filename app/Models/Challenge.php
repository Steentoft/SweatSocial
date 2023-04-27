<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'challenge_name',
        'challenge_description',
        'start_date',
        'end_date'
    ];

    public function posts() {
        return $this->morphMany(Post::class, 'linkable');
    }
}
