<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str as Str;
use Inertia\Response;


class ComicController extends Controller
{
    public function index()
    {
        $allComics = Comic::all();
        $latestComic = Comic::take(10)->latest()->get();
        return Inertia::render('Home', [
            "allComics" => $allComics,
            "latest" => $latestComic
        ]);
    }
    public function details($id)
    {
        $comic = Comic::find($id);
        return Inertia::render('Comics/ComicDetails', [
            "comic" => $comic
        ]);
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
        compact('comics');
    }
    public function deleteComic($id)
    {
        Comic::destroy($id);
        return to_route('adminComicsView');
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
            'type' => $request->get('type'),
            'genres' => $request->get('genres'),
            'price' => $request->get('price'),
            'ISBN' => $isbn,
            'sinopsis' => $request->get('sinopsis'),
            'slug' => $slug
        ]);
        $comics->save();

        return redirect(route('adminComicsView'));
    }
}
