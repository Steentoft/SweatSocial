<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'tag_name',
    ];

    public function post(){
        return $this->belongsToMany(Post::class, 'post_tags');
    }

    public function interests(){
        return $this->belongsToMany(User::class, 'user_interests');
    }

    public function mealplan(){
        return $this->belongsToMany(Mealplan::class, 'mealplan_tags');
    }
}
