<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LightActivityReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_name',
        'activity_hour',
        'activity_minute',
        'activity_frequency',
        'activity_time',
        'toggle_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
