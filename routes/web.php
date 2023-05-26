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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [ComicController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::get('/comic/{id}', [ComicController::class, 'details'])->name('comicDetails');
Route::get('/adminView', [AdminController::class, 'adminPanel'])->name('adminView');
Route::any('/{id}/updateComic', [ComicController::class, 'updateComic'])->middleware(['auth', 'verified'])->name('updateComic');
Route::get('/{id}/deleteComic', [ComicController::class, 'deleteComic'])->name('deleteComic');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__ . '/auth.php';
