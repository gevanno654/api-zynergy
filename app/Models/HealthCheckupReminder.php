<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCheckupReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'checkup_type',
        'next_checkup_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
