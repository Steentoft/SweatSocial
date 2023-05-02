<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealplanMeal extends Model
{
    protected $fillable = [
        'user_id',
        'mealplan_id',
        'meal_id',
        'week_day',
        'time',
        'portion_size'
    ];

    public function mealplan(){
        return $this->hasOne(Mealplan::class);
    }

    public function meal(){
        return $this->hasOne(Mealplan::class);
    }
}
