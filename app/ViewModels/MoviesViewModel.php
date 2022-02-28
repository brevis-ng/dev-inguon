<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $movies;

    // public function __construct($popularMovies, $nowPlayingMovies, $genres)
    public function __construct($movies)
    {
        $this->movies = $movies;
    }

    public function movies()
    {
        return $this->formatMovies($this->movies);
    }

    private function formatMovies($movies)
    {
        return collect($movies)->map(function($movie) {
            return [
                'title' => $movie['vod_name'],
                'poster_path' => $movie['vod_pic'],
                'id' => $movie['vod_id'],
                'type' => $movie['type_name'],
                'remarks' => $movie['vod_remarks'],
                'score' => $movie['vod_score'],
            ];
        });
    }
}
