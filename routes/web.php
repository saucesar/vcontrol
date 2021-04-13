<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::resource('company', CompanyController::class);
	
	Route::resource('products', ProductController::class)->except(['create', 'edit']);
	Route::prefix('products')->group(function(){
		Route::match(['get', 'post'],'to/search', [ProductController::class, 'search'])->name('products.search');
	});

	Route::resource('categories', CategoryController::class)->except(['create', 'edit']);
	Route::prefix('categories')->group(function(){
		Route::match(['get', 'post'],'to/search', [CategoryController::class, 'search'])->name('categories.search');
	});

	Route::resource('emails', EmailController::class)->except(['create', 'show', 'edit']);
	Route::prefix('emails')->group(function(){
		Route::match(['get', 'post'],'to/search', [EmailController::class, 'search'])->name('emails.search');
	});

	Route::resource('dates', DateController::class)->except(['index', 'create', 'show', 'edit']);
	Route::prefix('dates')->group(function(){
		Route::post('add-amount/{date}',[DateController::class, 'addAmount'])->name('dates.addAmount');
		Route::post('decr-amount/{date}',[DateController::class, 'decreaseAmount'])->name('dates.decrAmount');
		Route::post('undone-movement/{movement}',[DateController::class, 'undoneMovement'])->name('dates.decrAmount');
	});

	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	 Route::get('map', function () {return view('pages.maps');})->name('map');
	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});