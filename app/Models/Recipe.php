<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'recipe_instructions',
        'prep_time',
        'cooking_time',
        'servings'
    ];
}
