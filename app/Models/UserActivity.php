<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'user_interest');
    }

    public function favorites()
    {
        return $this->belongsToMany(Favorite::class, 'user_favorites');
    }

    public function diseases()
    {
        return $this->belongsToMany(Disease::class, 'user_disease');
    }

    public function allergies()
    {
        return $this->belongsToMany(Allergy::class, 'user_allergy');
    }
}
