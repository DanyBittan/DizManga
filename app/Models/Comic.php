<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $volume
 * @property string $img
 * @property string $publisher
 * @property string $ISBN
 * @property string $launch_date
 * @property string $price
 * @property string $sinopsis
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $MyBooks
 * @property-read int|null $my_books_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Review> $Review
 * @property-read int|null $review_count
 * @method static \Database\Factories\ComicFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Comic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comic query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic whereISBN($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic whereLaunchDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic wherePublisher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic whereSinopsis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comic whereVolume($value)
 * @mixin \Eloquent
 */
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
