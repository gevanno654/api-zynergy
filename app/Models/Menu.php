<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'favorite_id', 'allergy_id'];

    public function favorite()
    {
        return $this->belongsTo(Favorite::class);
    }

    public function allergy()
    {
        return $this->belongsTo(Allergy::class);
    }
}
