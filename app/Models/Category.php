<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'parent_id'
    ];

    public function parentCategory(){
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function exercises(){
        return $this->belongsToMany(Exercise::class, 'exercise_categories');
    }
}
