<?php

namespace App\Http\Controllers;
use App\Http\Controllers\CountryController;

use App\Http\Controllers\MoviesController;
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




Route::resource('movies', MoviesController::class);


Route::get('/acteurs',[MoviesController::class, 'acteurs'])->name('acteurs');
Route::get('/showActeur/{id}',[MoviesController::class, 'showActeur'])->name('showActeur');

Route::get('/',[MoviesController::class, 'index'])->name('home');
//Route::get('/movies/{movie}','MoviesController@show')->name('movies.show');
