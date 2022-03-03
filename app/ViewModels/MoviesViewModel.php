<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $movies;
    public $hightlightMovies;
    public $nowPlayingMovies;
    public $msg;
    public $pages;
    public $uri;

    public function __construct($movies, $hightlightMovies = null, $pages = null, $msg = null, $uri=null)
    {
        $this->movies = $movies;
        $this->hightlightMovies = $hightlightMovies;
        $this->msg = $msg;
        $this->pages = $pages;
        $this->uri = $uri;
    }

    public function movies()
    {
        return $this->formatMovies($this->movies);
    }

    public function hightlightMovies()
    {
        return $this->formatHightlightMovies($this->hightlightMovies);
    }

    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function msg()
    {
        return $this->msg;
    }

    public function formatHightlightMovies($hightlightMovies)
    {
        return collect($hightlightMovies)->map(function ($movie) {
            return [
                'poster_path' => $movie['vod_pic'],
                'title' => $movie['vod_name'],
                'id' => $movie['vod_id'],
            ];
        });
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
