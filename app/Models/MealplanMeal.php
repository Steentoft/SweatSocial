<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealplanMeal extends Model
{
    protected $fillable = [
        'mealplan_id',
        'meal_id',
        'week_day',
        'time',
        'portion_size'
    ];
}
