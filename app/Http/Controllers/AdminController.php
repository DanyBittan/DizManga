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
    public function adminPanelComics()
    {
        $allComics = Comic::orderBy('created_at', 'desc')->get();
        return Inertia::render('Admin/AdminPanelComics', [
            "allComics" => $allComics
        ]);
    }
    public function adminPanelUsers()
    {
        $users = User::all();
        return Inertia::render('Admin/AdminPanelUsers', [
            "users" => $users
        ]);
    }

    public function adminUserDelete($id)
    {
        User::destroy($id);
        return to_route('adminUsersView');
    }
}
