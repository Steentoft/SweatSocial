<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'user_id',
        'recipe_instructions',
        'prep_time',
        'cooking_time',
        'servings'
    ];

    public function user(){
        return $this->hasOne(User::class);
    }

    public function meal(){
        return $this->belongsTo(Meal::class);
    }

    public function recipeIngredient(){
        return $this->belongsTo(RecipeIngredient::class);
    }
}
