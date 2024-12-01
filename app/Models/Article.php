<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'interest_id', 'favorite_id', 'disease_id'];

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }

    public function favorite()
    {
        return $this->belongsTo(Favorite::class);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }
}
