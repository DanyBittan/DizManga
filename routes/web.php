<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ComicController::class, 'index'])->name('home');

Route::get('/comic/{id}', [ComicController::class, 'details'])->name('comicDetails');
Route::get('/searchView', [ComicController::class, 'showSearch'])->name('searchView');
Route::get('/search-suggestions', [ComicController::class, 'searchSuggestions'])->name('searchSuggestions');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/mybooks', [ComicController::class, 'showMyBooks'])->middleware(['auth', 'verified'])->name('myBooks');
    Route::get('/imagegeneration', [ComicController::class, 'generateCoverPrompt'])->name('imageGeneration');
    Route::get('/generateCover', [ComicController::class, 'generateAiCover'])->name('coverGenerator');
    Route::get('/wishList', [ComicController::class, 'showWishList'])->middleware(['auth', 'verified'])->name('wishList');
    Route::get('/{id}/saveWishlist', [ComicController::class, 'saveWishlist'])->middleware(['auth', 'verified'])->name('saveWishlist');
    Route::post('/{id}/postReview', [ComicController::class, 'postReview'])->middleware(['auth', 'verified'])->name('postReview');
    Route::get('/{id}/deleteReview', [ComicController::class, 'deleteReview'])->middleware(['auth', 'verified'])->name('deleteReview');
});

Route::middleware(['auth', 'Admin'])->group(function () {
    Route::get('/adminView/users', [AdminController::class, 'adminPanelUsers'])->middleware(['auth', 'verified'])->name('adminUsersView');
    Route::get('/{id}/adminDeleteUser/', [AdminController::class, 'adminUserDelete'])->middleware(['auth', 'verified'])->name('adminUserDelete');
    Route::patch('/{id}/updateComic', [ComicController::class, 'updateComic'])->middleware(['auth', 'verified'])->name('updateComic');
    Route::post('/addComic', [ComicController::class, 'addComic'])->middleware(['auth', 'verified'])->name('addComic');
    Route::delete('/{id}/deleteComic', [ComicController::class, 'deleteComic'])->middleware(['auth', 'verified'])->name('deleteComic');
    Route::get('/adminView/comics', [AdminController::class, 'adminPanelComics'])->middleware(['auth', 'verified'])->name('adminComicsView');
});



require __DIR__ . '/auth.php';
