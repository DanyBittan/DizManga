<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'volume',
        'img',
        'publisher',
        'ISBN',
        'launch_date',
        'price',
        'sinopsis',
        'slug'
    ];

    public function Review()
    {
        return $this->hasMany(Review::class);
    }

    public function MyBooks()
    {
        return $this->belongsToMany(User::class, "my_books", "comic_id", "user_id");
    }
}
