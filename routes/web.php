<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactUsFormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//profile
Route::singleton('profile', ProfileController::class);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

//Posts
Route::resource('posts', PostController::class);
Route::get('/search', [PostController::class, 'search'])->name('search');
Route::get('/search-post', [PostController::class, 'searchPost'])->name('search-post');

//Likes
Route::post('/like/{post}', [PostController::class, 'like'])->name('like');
Route::post('/dislike/{post}', [PostController::class, 'dislike'])->name('dislike');
//Route::post('/unlike/{post}', [PostController::class, 'unlike'])->name('unlike');
//Comments
Route::post('comments.store', [CommentController::class, 'store'])->name('comments.store');

//Contact
Route::get('/contact', [ContactUsFormController::class, 'createForm'])->name('contact');
Route::post('/contact', [ContactUsFormController::class, 'ContactUsForm'])->name('contact.store');
