<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comic;
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
            'publisher' => $request->get('editorial'),
            'img' => $request->get('portada'),
            'type' => $request->get('type'),
            'genres' => $request->get('genre'),
            'price' => $request->get('price'),
            'sinopsis' => $request->get('sinopsis'),
            'slug' => $slug,
        ]);

        // return redirect()->route('updateForm', $comics->id);
        return to_route('comicDetails');
        compact('comics');
    }
    public function deleteComic($id)
    {
        Comic::destroy($id);
        return to_route('home');
    }
}
