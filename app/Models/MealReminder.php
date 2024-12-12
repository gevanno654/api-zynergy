<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'meal_name',
        'meal_hour',
        'meal_minute',
        'meal_frequency',
        'meal_time',
        'toggle_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}