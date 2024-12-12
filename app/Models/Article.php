<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'interest_id', 'is_general', 'image_url'];

    public function interest()
    {
        return $this->belongsTo(Interest::class);
    }
}