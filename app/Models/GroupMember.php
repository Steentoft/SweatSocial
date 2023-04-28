<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $fillable = [
        'group_id',
        'user_id',
        'invited'
    ];


    public function group(){
        return $this->hasOne(Group::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

}
