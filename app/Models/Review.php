<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comic_id',
        'comment',
        'likes',
        'dislikes',
        'rating'
    ];

    public function ReviewMedia()
    {
        return $this->hasManyThrough(User::class, Comic::class, 'id', 'id', 'user_id', 'comic_id');
    }
}
