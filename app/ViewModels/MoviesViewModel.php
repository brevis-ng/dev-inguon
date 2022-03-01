<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $movies;
    public $nowPlayingMovies;
    public $msg;
    public $pageMovies;

    public function __construct($movies ,$msg = null, $pageMovies=null)
    {
        $this->movies = $movies;
        $this->msg = $msg;
        $this->pageMovies = $pageMovies;
    }

    public function movies()
    {
        return $this->formatMovies($this->movies);
    }

    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function msg()
    {
        return $this->msg;
    }

    private function formatMovies($movies)
    {
        return collect($movies)->map(function ($movie) {
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
