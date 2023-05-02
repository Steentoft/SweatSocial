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
        'linkable_id',
        'linkable_type',
    ];

    public function linkable() {
        return $this->morphTo();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function likes(){
        return $this->belongsToMany(User::class, 'post_likes');
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function group(){
        return $this->hasOne(Group::class);
    }

    public function images(){
        return $this->hasMany(PostImage::class);
    }

}
