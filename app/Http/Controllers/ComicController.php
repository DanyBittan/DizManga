<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str as Str;




class ComicController extends Controller
{

    public function landing()
    {
        $comics = Comic::take(14)->select('comics.img')->get();
        return Inertia::render('LandingPage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'comics' => $comics
        ]);
    }

    public function index(Request $request)
    {
        $all_comics = Comic::take(3)->get();
        $latest_comic = Comic::take(10)->latest()->get();
        /* $search_comic = Comic::query()
            ->when($request->get('searcher'), function ($query, $search) {
                $query->where("title", "like", "%{$search}%");
            })
            ->take(10)
            ->get(); */
        return Inertia::render('Home', [
            "allComics" => $all_comics,
            "latest" => $latest_comic,
        ]);
    }

    public function showSearch(Request $request)
    {
        $search = $request->get('search');
        $search_comic = Comic::query()
            ->where("title", "like", "%{$search}%")
            ->get();

        return Inertia::render('Comics/SearchResult', [
            "search" => $search_comic
        ]);
    }

    public function details($id)
    {
        $comic = Comic::find($id);
        /*         $user_id = Auth::user()->id; */
        $comic_reviews = $comic->Review()
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select('reviews.*', 'users.user_img', 'users.name')
            ->orderBy('likes', 'desc')
            ->get();
        /*         $wishlist = Wishlist::where(['user_id' => "{$user_id}", 'comic_id' => "{$id}"])->get(); */

        return Inertia::render('Comics/ComicDetails', [
            "comic" => $comic,
            "reviews" => $comic_reviews,
            /*             "wishlist" => $wishlist, */
        ]);
    }

    public function postReview(Request $request, $id)
    {
        $comic = Comic::find($id);
        $user_id = Auth::user()->id;
        $review = new Review([
            'user_id' => $user_id,
            'comic_id' => $comic->id,
            'comment' => $request->get('new_review'),
            'likes' => 0,
            'dislikes' => 0,
            'rating' => $request->get('rating'),
        ]);
        $review->save();

        return back();
    }

    public function deleteReview($id)
    {
        Review::destroy($id);

        return back();
    }

    public function showMyBooks()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $my_comics = $user->MyBooks()->get();

        return Inertia::render('Comics/MyBooks', [
            "myComics" => $my_comics
        ]);
    }

    public function showWishList()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $my_wishlist = $user->WishList()->get();

        return Inertia::render('Comics/WishList', [
            "myWishList" => $my_wishlist
        ]);
    }
    /* 
    public function saveWishlist($id, $saved)
    {
        $user_id = Auth::user()->id;
        $wishlist = Wishlist::where(['user_id' => "{$user_id}", 'comic_id' => "{$id}"])->get();
        $new_wishlist = new Wishlist([
            'user_id' => $user_id,
            'comic_id' => $id,
        ]);
        $saved ? $wishlist->each->destroy() : $new_wishlist->save();
        return back();
    }
 */
    public function updateComic(Request $request, $id)
    {

        $slug = Str::slug($request->get('title'), '-');
        $comics = Comic::find($id);
        Comic::where('id', $id)->update([
            'title' => $request->get('title'),
            'publisher' => $request->get('publisher'),
            'launch_date' => $request->get('launch'),
            'img' => $request->get('img'),
            'price' => $request->get('price'),
            'sinopsis' => $request->get('sinopsis'),
            'slug' => $slug,
        ]);

        return to_route('comicDetails', $comics->id);
    }
    public function deleteComic($id)
    {
        Comic::destroy($id);
        return back();
    }
    public function addComic(Request $request)
    {
        $slug = Str::slug($request->get('title'), '-');
        $isbn = rand(100000000, 999999999);

        $comics = new Comic([
            'title' => $request->get('title'),
            'publisher' => $request->get('publisher'),
            'img' => $request->get('img'),
            'launch_date' => $request->get('launch'),
            'price' => $request->get('price'),
            'ISBN' => $isbn,
            'sinopsis' => $request->get('sinopsis'),
            'slug' => $slug
        ]);
        $comics->save();

        return redirect(route('adminComicsView'));
    }
}
