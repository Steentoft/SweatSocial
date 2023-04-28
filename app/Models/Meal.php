<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable = [
        'meal_name',
        'meal_description',
        'recipe_id'
    ];

    public function recipe(){
        return $this->hasOne(Recipe::class);
    }


    public function mealplanMeal(){
        return $this->belongsTo(MealplanMeal::class);
    }
}
