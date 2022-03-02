<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

Route::get('/{page?}', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');

Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');

Route::get('/actors', 'ActorsController@index')->name('actors.index');
Route::get('/actors/page/{page?}', 'ActorsController@index');

Route::get('/actors/{id}', 'ActorsController@show')->name('actors.show');

// Phim theo thể loại (genre)
Route::get('genre/{genre_name}/{page?}', [MoviesController::class, 'genre'])->name('movies.genre');

// Phim theo quốc gia (country)
Route::get('country/{country_name}/{page?}', [MoviesController::class, 'countries'])->name('movies.countries');

// Phim lẻ và Phim bộ
Route::get('list/{type}/{page?}', [MoviesController::class, 'list'])->name('movies.list');

// Phim theo năm
Route::get('year/{number}', [MoviesController::class, 'year'])->name('movies.year');

// Xem phim
Route::get('/play/{id}', [MoviesController::class, 'play'])->name('movies.play');
Route::get('year/{number}/{page?}', [MoviesController::class, 'year'])->name('movies.year');
