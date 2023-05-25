<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $table = "group_members";

    protected $fillable = [
        'group_id',
        'user_id',
        'invited'
    ];


    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

}
