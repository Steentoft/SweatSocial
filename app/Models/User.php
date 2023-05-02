<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'profile_image_path',
        'birthdate',
        'biography',
        'height',
        'weight'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->belongsTo(Post::class);
    }

    public function groups(){
        return $this->belongsToMany(Group::class, 'group_members');
    }

    public function mealplans(){
        return $this->belongsTo(MealplanMeal::class);
    }

    public function meals(){
        return $this->belongsTo(Meal::class);
    }

    public function recipes(){
        return $this->belongsTo(Recipe::class);
    }

    public function events(){
        return $this->belongsToMany(Event::class, 'event_participants');
    }

    public function challenges(){
        return $this->belongsToMany(Challenge::class, 'challenge_participants');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
