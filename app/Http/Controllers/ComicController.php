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
    // Show landing page
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

    // Show all comics on home page
    public function index()
    {

        $top_comics = Comic::select('id', 'title', 'volume', 'img')
            ->withAvg('Review', 'rating')
            ->orderByDesc('review_avg_rating')
            ->take(3)
            ->get()
            ->map(function ($comic) {
                $comic->review_avg_rating = (int) round($comic->review_avg_rating);
                return $comic;
            });
        $latest_comic = Comic::take(12)->latest()->get();
        return Inertia::render('Home', [
            "allComics" => $top_comics,
            "latest" => $latest_comic,

        ]);
    }
    // Provide search suggestions for autocomplete
    public function searchSuggestions(Request $request)
    {
        // Get search query from request
        $search_query = $request->query('q');
        $comic_suggestions = Comic::where('title', 'like', "%{$search_query}%")
            ->limit(5)
            ->select('id', 'title', 'img', 'volume')
            ->get();

        return response(['suggestions' => $comic_suggestions]);
    }
    // Show search results and view
    public function showSearch(Request $request)
    {
        $search = $request->query('search');
        $search_comic = Comic::query()
            ->where("title", "like", "%{$search}%")
            ->get();

        return Inertia::render('Comics/SearchResult', [
            "search" => $search_comic
        ]);
    }

    // Show comic details
    public function details($id)
    {
        $comic = Comic::find($id);
        /*         $user_id = Auth::user()->id; */
        // Get comic reviews with user info
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

    // Post a new review
    public function postReview(Request $request, $id)
    {
        // Find the comic and create a new review using the user id to know who created it
        $user_id = Auth::user()->id;
        $review = new Review([
            'user_id' => $user_id,
            'comic_id' => $id,
            'comment' => $request->get('new_review'),
            'likes' => 0,
            'dislikes' => 0,
            'rating' => $request->get('rating'),
        ]);
        $review->save();

        return back();
    }

    // Delete a review
    public function deleteReview($id)
    {
        Review::destroy($id);
        return back();
    }

    // Show user's owned comics
    public function showMyBooks()
    {
        // Get user's owned comics
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $my_comics = $user->MyBooks()->get();

        // Return view with owned comics
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
        // Generate slug from title
        $slug = Str::slug($request->get('title'), '-');

        // Finds and updates the comic
        $comics = Comic::find($id);
        Comic::where('id', $id)->update([
            'title' => $request->get('title'),
            'volume' => $request->get('volume'),
            'publisher' => $request->get('publisher'),
            'launch_date' => $request->get('launch'),
            'img' => $request->get('img'),
            'price' => $request->get('price'),
            'sinopsis' => $request->get('sinopsis'),
            'slug' => $slug,
        ]);

        return to_route('comicDetails', $comics->id);
    }

    // Delete comic from the database
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
            'volume' => $request->get('volume'),
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
        $prompt_encoded = urlencode($prompt);
        $parameters = [
            'model' => 'flux',
            'nologo' => 'true'
        ];
        $image_url = 'https://image.pollinations.ai/prompt/' . $prompt_encoded . http_build_query($parameters);
        $response = Http::timeout(60)->get($image_url);

        // Return image URL or error message
        if ($response->successful()) {
            return response()->json([
                'success'  => true,
                'imageUrl' => $image_url,
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
