<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str as Str;

class AdminController extends Controller
{
    public function adminPanel()
    {
        $allComics = Comic::all();
        return Inertia::render('Admin/AdminPanel', [
            "allComics" => $allComics
        ]);
    }
}
