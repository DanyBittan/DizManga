<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'img',
        'publisher',
        'ISBN',
        'launch_date',
        'type',
        'genres',
        'price',
        'sinopsis',
        'slug'
    ];

    public function WishList()
    {
        return $this->belongsToMany(User::class, "wishlists", "comic_id", "user_id");
    }

    public function Review()
    {
        return $this->hasMany(Review::class, "comic_id");
    }

    public function MyBooks()
    {
        return $this->belongsToMany(User::class, "my_books", "comic_id", "user_id");
    }
}
