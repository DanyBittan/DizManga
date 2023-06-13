<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('LandingPage', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/home', [ComicController::class, 'index'])->name('home');
Route::get('/comic/{id}', [ComicController::class, 'details'])->name('comicDetails');
Route::get('/adminView/comics', [AdminController::class, 'adminPanelComics'])->middleware(['auth', 'verified'])->name('adminComicsView');
Route::get('/mybooks', [ComicController::class, 'showMyBooks'])->middleware(['auth', 'verified'])->name('myBooks');
Route::get('/adminView/users', [AdminController::class, 'adminPanelUsers'])->middleware(['auth', 'verified'])->name('adminUsersView');
Route::get('/{id}/adminDeleteUser/', [AdminController::class, 'adminUserDelete'])->middleware(['auth', 'verified'])->name('adminUserDelete');
Route::any('/{id}/updateComic', [ComicController::class, 'updateComic'])->middleware(['auth', 'verified'])->name('updateComic');
Route::any('/addComic', [ComicController::class, 'addComic'])->middleware(['auth', 'verified'])->name('addComic');
Route::get('/{id}/deleteComic', [ComicController::class, 'deleteComic'])->middleware(['auth', 'verified'])->name('deleteComic');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
