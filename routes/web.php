<?php

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Backend\backEndController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
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
Route::get('/', [FrontendController::class, 'index'])->name('Front.index');
Route::get('/search', [FrontendController::class, 'search'])->name('Front.search');
Route::get('/all-post', [FrontendController::class, 'all_post'])->name('Front.all_post');
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('Front.category');
Route::get('/tag/{slug}', [FrontendController::class, 'tag'])->name('Front.tag');
Route::get('/category/{cat_slug}/{sub_cat_slug}', [FrontendController::class, 'sub_category'])->name('Front.sub_category');
Route::get('/single-post', [FrontendController::class, 'single'])->name('Front.single');
Route::get('/single-post/{slug}', [FrontendController::class, 'single'])->name('Front.single');

route::group(['prefix'=>'dashboard'], function(){
    Route::get('/admin', [BackEndController::class, 'index'])->name('Backend.index');
    Route::resource('category', CategoryController::class);
    Route::resource('tag', TagController::class);
    Route::get('get-subcategory/{id}', [SubCategoryController::class, 'getSubCategoryIdByCategoryId']);
    Route::resource('sub_category', SubCategoryController::class);
    Route::resource('post', PostController::class);
});

Route::get('/dashboard', function () {
    return view('Backend.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';