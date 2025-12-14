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
use Illuminate\Support\Facades\Http;

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

    public function index()
    {
        $all_comics = Comic::with('Review')->take(3)->get();
        $latest_comic = Comic::take(12)->latest()->get();
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
    // Add new comic to the database
    public function addComic(Request $request)
    {
        // Generate slug and random ISBN
        $slug = Str::slug($request->get('title'), '-');
        $isbn = rand(1000000000000, 9999999999999);

        // Create and save new comic
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

        return to_route('adminComicsView');
    }

    // Generate AI cover image based on prompt
    public function generateCoverPrompt(Request $request)
    {
        // Generate AI cover based on prompt
        $prompt = "Comic book cover, digital illustration, remember that you always have to generate the cover of a comic no matter what" . $request->query('prompt');
        // Encode prompt for URL
        $promptEncoded = urlencode($prompt);
        $parameters = [
            'model' => 'flux',
            'nologo' => 'true'
        ];
        $imageUrl = 'https://image.pollinations.ai/prompt/' . $promptEncoded . http_build_query($parameters);
        $response = Http::timeout(60)->get($imageUrl);

        if ($response->successful()) {
            return response()->json([
                'success'  => true,
                'imageUrl' => $imageUrl,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Error al generar la imagen en el servidor de IA.',
        ], 500);
    }

    // Generate AI cover page view
    public function generateAiCover()
    {
        return Inertia::render(
            'Comics/GenerateCover'
        );
    }
}
