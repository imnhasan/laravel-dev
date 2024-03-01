<?php

use App\Http\Controllers\Eloquent\EloquentPart3Controller;
use App\Http\Controllers\Eloquent\EloquentPart4Controller;
use App\Http\Controllers\Eloquent\EloquentPart5Controller;
use App\Http\Controllers\Eloquent\EloquentPart6Controller;
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


Route::get('users-logins', [EloquentPart3Controller::class, 'index'])->name('eloquent_part_3.logins');
Route::get('users-logins-ip', [EloquentPart4Controller::class, 'index'])->name('eloquent_part_4.logins_ip');
Route::get('status-count', [EloquentPart5Controller::class, 'index'])->name('eloquent_part_5.status_count');
Route::get('feature-show/{feature}', [EloquentPart6Controller::class, 'show'])->name('eloquent_part_6.feature_show');
