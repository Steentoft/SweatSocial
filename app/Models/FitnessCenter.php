<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FitnessCenter extends Model
{
    protected $fillable = [
        'center_name',
        'center_address',
        'center_description',
        'center_facilities',
        'contact_info'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
