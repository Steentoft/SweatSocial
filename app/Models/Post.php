<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'group_id',
        'content',
        'likes',
        'linkable_id',
        'linkable_type',
    ];

    public function linkable() {
        return $this->morphTo();
    }
}
