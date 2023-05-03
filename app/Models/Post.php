<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasRelationships;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasRelationships;

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
        return $this->belongsTo(User::class);
    }

    public function group(){
        return $this->hasOne(Group::class);
    }

    public function images(){
        return $this->hasMany(PostImage::class);
    }

    public static function attachImages($images, $post_id){
        foreach ($images as $image){
            $path = $image->store('public');
            PostImage::create([
                'post_id' => $post_id,
                'image_path' => $path
            ]);
        }
    }
}
