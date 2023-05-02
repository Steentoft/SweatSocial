<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
        'comment',
        'reply_id'
    ];

    public function parentComment(){
        return $this->hasMany(Comment::class, 'reply_id', 'id');
    }

    public function post(){
        return $this->hasOne(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
