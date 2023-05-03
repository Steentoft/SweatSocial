<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'challenge' => 'App\Models\Challenge',
            'event' => 'App\Models\Event',
            'group' => 'App\Models\Group',
            'mealplan' => 'App\Models\Mealplan',
            'workout' => 'App\Models\Workout'
        ]);
    }
}
