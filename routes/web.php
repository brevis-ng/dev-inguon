<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

use function PHPSTORM_META\type;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');

Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');

Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');

Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');

// Phim theo thể loại (genre)
Route::get('genre/{genre_name}', [MoviesController::class, 'genre'])->name('movies.genre');