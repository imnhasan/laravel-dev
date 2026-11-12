<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Cache\CacheController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\ImageController;
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
use App\Http\Controllers\ValidationTestController;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

/*
|-----------------------------------------------------------------------------------------------------------------------
| Web Routes
|-----------------------------------------------------------------------------------------------------------------------
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
|-----------------------------------------------------------------------------------------------------------------------
| pagination
|-----------------------------------------------------------------------------------------------------------------------
*/
Route::group(['prefix' => 'page', 'as' => 'page.'], function (){
    Route::controller(PageController::class)->group(function (){
        Route::get('/page', 'index')->name('index');
        Route::get('/page-card', 'pageCard')->name('page_card');
        Route::get('/page-in-page', 'pageInPage')->name('page_in_page');
    });
});



/*
|-----------------------------------------------------------------------------------------------------------------------
| Resource Router
|-----------------------------------------------------------------------------------------------------------------------
*/

Route::resource('schools', SchoolController::class);
Route::resource('students', StudentController::class);

Route::get('insert-data', [StudentController::class, 'insertData']);

Route::get('posts', [PostController::class, 'index'])->name('posts');

/*
|-----------------------------------------------------------------------------------------------------------------------
| Test Router
|-----------------------------------------------------------------------------------------------------------------------
*/
Route::get('test', [TestController::class, 'index']);


/*
|-----------------------------------------------------------------------------------------------------------------------
| Category crud with modal
|-----------------------------------------------------------------------------------------------------------------------
*/
Route::group(['prefix' => 'categories', 'as' => 'category.'], function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::post('store-update', [CategoryController::class, 'storeUpdate'])->name('store_update');
    Route::delete('delete/{alert}', [CategoryController::class, 'destroy'])->name('destroy');
});

/*
|-----------------------------------------------------------------------------------------------------------------------
| Image crud with modal
|-----------------------------------------------------------------------------------------------------------------------
*/
Route::group(['prefix' => 'images', 'as' => 'image'], function () {
    Route::get('/', [ImageController::class, 'index'])->name('index');
    Route::post('store', [ImageController::class, 'storeUpdate'])->name('store');
    Route::get('edit/{image}', [ImageController::class, 'index'])->name('edit');
    Route::put('update/{image}', [ImageController::class, 'storeUpdate'])->name('update');
    Route::delete('delete/{alert}', [ImageController::class, 'destroy'])->name('destroy');
});

/*
|-----------------------------------------------------------------------------------------------------------------------
| Ajax form submit
|-----------------------------------------------------------------------------------------------------------------------
*/
Route::get('/ajax/index', [AjaxController::class, 'index'])->name('ajax.index');
Route::post('/ajax/store', [AjaxController::class, 'store'])->name('ajax.store');

Route::get('/ajax/crud/index', [AjaxController::class, 'indexCrud'])->name('ajax.index.crud');
Route::post('/ajax/crud/store', [AjaxController::class, 'storeCrud'])->name('ajax.store.crud');

/*
|-----------------------------------------------------------------------------------------------------------------------
| Datatable form submit
|-----------------------------------------------------------------------------------------------------------------------
*/
Route::get('data-table/', [DataTableController::class, 'index'])->name('datatable.index');


/*
|-----------------------------------------------------------------------------------------------------------------------
| Cache system
|-----------------------------------------------------------------------------------------------------------------------
*/
Route::group(['prefix' => 'cache', 'as' => 'cache.'], function (){
    Route::controller(CacheController::class)->group(function (){
        Route::get('/cache-post', 'cachePost')->name('cache-post');
        Route::get('/page-card', 'pageCard')->name('page_card');
        Route::get('/page-in-page', 'pageInPage')->name('page-in-page');
    });
});


/*
|-----------------------------------------------------------------------------------------------------------------------
| Validation
|-----------------------------------------------------------------------------------------------------------------------
*/
Route::group(['prefix' => 'validation', 'as' => 'validation.'], function(){
    Route::get('this-validation-create', [ValidationTestController::class, 'thisValidationCreate'])->name('this-validation-create');
    Route::post('this-validation-store', [ValidationTestController::class, 'thisValidationStore'])->name('this-validation-store');
    // --------------------
    Route::get('manual-validation-create', [ValidationTestController::class, 'manualValidationCreate'])->name('manual-validation-create');
    Route::post('manual-validation-store', [ValidationTestController::class, 'manualValidationStore'])->name('manual-validation-store');
});

/*
|-----------------------------------------------------------------------------------------------------------------------
| Adapter
|-----------------------------------------------------------------------------------------------------------------------
*/
Route::group(['prefix' => 'adapter', 'as' => 'adapter.'], function() {
    Route::get('/', [\App\Http\Controllers\Adapter\AdapterController::class, 'index'])->name('index');
});

/*
|-----------------------------------------------------------------------------------------------------------------------
| Adapter - Playstation - XBOX
|-----------------------------------------------------------------------------------------------------------------------
*/
Route::group(['prefix' => 'adapter-playstation', 'as' => 'adapter_playstation.'], function() {
    Route::get('/', [\App\Http\Controllers\Adapter\PlaystationController::class, 'gamePlay'])->name('game_play');
});
