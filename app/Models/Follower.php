<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $fillable = [
        'user_id',
        'following_user_id'
    ];

    public function follower(){
        return $this->hasOne(User::class);
    }

    public function followed(){
        return $this->hasOne(User::class);
    }
}
