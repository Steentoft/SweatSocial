<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'group_owner_id',
        'group_name',
        'group_description',
        'locked'
    ];

    public function posts() {
        return $this->morphMany(Post::class, 'linkable');
    }
}
