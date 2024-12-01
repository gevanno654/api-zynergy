<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleepReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bedtime',
        'wake_up_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
