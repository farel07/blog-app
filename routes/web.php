<?php

use App\Http\Controllers\AdminCategoryController;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangeProfile;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Dashboard_postController;
use App\Http\Controllers\ReplyCommentController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    $data = [
        'title' => 'Home',
        'active' => 'Home'
    ];
    return view('home', $data);
});

// pengelola halaman about
Route::get('/about', function () {
    $data = [
        'title' => 'About',
        'active' => 'About',
        'name' => 'Farrel Aqeel Danendra',
        'email' => 'farrqeel@gmail.com'
    ];
    return view('about', $data);
});

// pengelola halaman blog
Route::get('/blog', [BlogController::class, 'index']);

Route::get('/blog/{post:slug}', [BlogController::class, 'detail_post']);
Route::post('/blog/{post:slug}/comment', [BlogController::class, 'comment']);

// pengelola halaman category
Route::get('/categories', [CategoriesController::class, 'index']);

Route::get('/categories/{category:slug}', [CategoriesController::class, 'category']);

Route::get('/author/posts/{user:username}', [AuthorController::class, 'posts']);

// login routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);
// regoster routes
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);
// aashboard routes
Route::get('/dashboard', function () {
    return view('dashboard.index', ['active' => 'dashboard']);
})->middleware('auth');

Route::get('/dashboard/posts/create_slug', [Dashboard_postController::class, 'create_slug']);
Route::resource('/dashboard/posts', Dashboard_postController::class)->middleware('auth');

Route::post('/dashboard/change_profile', [ChangeProfile::class, 'change_profile'])->name('change_profile');
Route::post('/dashboard/edit_info', [ChangeProfile::class, 'edit_info']);

// route admin
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');
Route::get('/dashboard/categories/create_slug', [AdminCategoryController::class, 'create_slug']);

Route::post('post/reply_comment/{postComment:id}', [BlogController::class, 'reply_comment']);
