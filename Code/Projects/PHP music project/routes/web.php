<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/welcome', function (){
    return view('welcome');
});

Route::get('/artistlist', [ArtistController::class, 'index'])->name('artist-list')
->middleware(['auth', 'verified']);

Route::get('/albumlist', [AlbumController::class, 'index'])->name('album-list')
->middleware(['auth', 'verified']);

Route::get('/createartist', [ArtistController::class, 'create'])
->middleware(['auth', 'verified'])->name('artist-create');

Route::get('/createalbum', [AlbumController::class, 'create'])
->middleware(['auth', 'verified'])->name('album-create');

Route::post('/createartist', [ArtistController::class, 'store'])
->middleware(['auth', 'verified'])->name('artist-store');

Route::post('/createalbum', [AlbumController::class, 'store'])
->middleware(['auth', 'verified'])->name('album-store');
    
Route::get('/artist/{id}', [ArtistController::class, 'show'])
->middleware(['auth', 'verified'])->name('artist-show');
    
Route::get('/album/{id}', [AlbumController::class, 'show'])
->middleware(['auth', 'verified'])->name('album-show');

Route::delete('/artist/{id}', [ArtistController::class, 'destroy'])
->name('artist-delete')->middleware('auth');

Route::delete('/album/{id}', [AlbumController::class, 'destroy'])
->name('album-delete')->middleware('auth');    

Route::post('/album/{id}/review', [AlbumReviewController::class, 'store'])
->middleware(['auth', 'verified'])->name('album-review-store');

Route::delete('/album-review/{id}', [AlbumReviewController::class, 'destroy'])
->name('album-review-delete')->middleware('auth');

Route::get('/userlist', [AdminUserController::class, 'index'])
->name('admin-userlist')->middleware(('auth'));

Route::delete('/userlist/{id}', [AdminUserController::class, 'destroy'])
->name('user-delete')->middleware('auth');

Route::get('/user/{id}', [UserController::class, 'show'])
->name('user-info')->middleware('auth');

Route::put('/user/{id}/description', [ProfileController::class, 'updateDescription'])
->name('update-description')->middleware('auth');

require __DIR__.'/auth.php';
