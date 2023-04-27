<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mealplan extends Model
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
}
