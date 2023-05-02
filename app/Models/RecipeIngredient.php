<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\In;

class RecipeIngredient extends Model
{
    protected $fillable = [
        'recipe_id',
        'ingredient_id',
        'quantity'
    ];

    public function ingredient(){
        return $this->hasOne(Ingredient::class);
    }

    public function recipe(){
        return $this->hasOne(Recipe::class);
    }
}
