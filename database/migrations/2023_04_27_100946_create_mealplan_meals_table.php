<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mealplan_meals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mealplan_id')->constrained('mealplans');
            $table->foreignId('meal_id')->constrained('meals');
            $table->integer('week_day');
            $table->time('time');
            $table->string('portion_size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mealplan_meals');
    }
};
