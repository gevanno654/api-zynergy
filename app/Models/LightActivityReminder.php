<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LightActivityReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_type',
        'frequency_in_hours',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
