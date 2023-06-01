<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str as Str;
use Inertia\Response;


class ComicController extends Controller
{
    public function index()
    {
        $allComics = Comic::all();
        return Inertia::render('Home', [
            "allComics" => $allComics
        ]);
    }
    public function details($id)
    {
        $comic = Comic::find($id);
        return Inertia::render('Comics/ComicDetails', [
            "comic" => $comic
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

        // return redirect()->route('updateForm', $comics->id);
        return to_route('comicDetails', $comics->id);
        compact('comics');
    }
    public function deleteComic($id)
    {
        Comic::destroy($id);
        return to_route('home');
    }
    public function addComic(Request $request)
    {

        $slug = Str::slug($request->get('title'), '-');
        $isbn = rand(100000000, 999999999);
        $fecha = Carbon::now()->format('Y-m-d');

        $comics = new Comic([
            'title' => $request->get('title'),
            'publisher' => $request->get('publisher'),
            'img' => $request->get('img'),
            'launch_date' => $fecha,
            'type' => $request->get('type'),
            'genres' => $request->get('genre'),
            'price' => $request->get('price'),
            'ISBN' => $isbn,
            'sinopsis' => $request->get('sinopsis'),
            'slug' => $slug
        ]);
        $comics->save();

        return redirect('/newComicform');
    }
}
