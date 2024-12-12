<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleepReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sleep_time',
        'sleep_name',
        'sleep_hour',
        'sleep_minute',
        'wake_hour',
        'wake_minute',
        'sleep_frequency',
        'toggle_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}