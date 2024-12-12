<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthCheckupReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'checkup_name',
        'checkup_year',
        'checkup_month',
        'checkup_date',
        'checkup_hour',
        'checkup_minute',
        'checkup_note',
        'toggle_value',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
