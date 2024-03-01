<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TestController;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('data', [TestController::class, 'index'])->name('test');

Route::group(['prefix' => 'cache', 'as' => 'cache.'], function (){
    Route::controller(PostController::class)->group(function (){
        Route::get('cache-posts', 'cachePost')->name('cache_posts');
        Route::get('items', 'item')->name('items');
        Route::get('clear', 'clear')->name('clear');
    });
});



/*
|---------------------------------------------------------------------------
| pagination
|---------------------------------------------------------------------------
*/
Route::group(['prefix' => 'page', 'as' => 'page.'], function (){
    Route::controller(PageController::class)->group(function (){
        Route::get('/page', 'index')->name('index');
        Route::get('/page-card', 'pageCard')->name('page_card');
        Route::get('/page-in-page', 'pageInPage')->name('page-in-page');
    });
});



/*
|---------------------------------------------------------------------------
| Resource Router
|---------------------------------------------------------------------------
*/

Route::resource('schools', SchoolController::class);
Route::resource('students', StudentController::class);

Route::get('insert-data', [StudentController::class, 'insertData']);

Route::get('posts', [PostController::class, 'index'])->name('posts');

/*
|---------------------------------------------------------------------------
| Test Router
|---------------------------------------------------------------------------
*/
Route::get('test', [TestController::class, 'index']);


/*
|---------------------------------------------------------------------------
| Category crud with modal
|---------------------------------------------------------------------------
*/
Route::group(['prefix' => 'categories', 'as' => 'category.'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::post('store-update', [CategoryController::class, 'storeUpdate'])->name('store_update');
    Route::delete('delete/{alert}', [CategoryController::class, 'destroy'])->name('destroy');
});


