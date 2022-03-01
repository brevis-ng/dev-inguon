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

    public function __construct($movies, $hightlightMovies = null, $msg = null)
    {
        $this->movies = $movies;
        $this->hightlightMovies = $hightlightMovies;
        $this->msg = $msg;
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
            $m3u8Links = explode('$$$', $movie['vod_play_url'])[1];
            $m3u8Links = collect(explode("#", $m3u8Links))->map(function ($link) {
                return explode('$', $link)[1];
            });
            return [
                'poster_path' => $movie['vod_pic'],
                'title' => $movie['vod_name'],
                'vote_average' => (int)$movie['vod_up'],
                'release_date' => $movie['vod_pubdate'] === "" ? $movie['vod_year'] : $movie['vod_pubdate'],
                'genres' => $movie['vod_class'],
                'lang' => $movie['vod_lang'],
                // 'overview' => str_replace(str_split('<p>,</p>'), "", $movie['vod_content']),
                'overview' => $movie['vod_content'],
                'serial' => $movie['vod_serial'],
                'score' => $movie['vod_score'],
                'videos' => $m3u8Links,
                'remarks' => $movie['vod_remarks'],
                'area' => $movie['vod_area'],
                'actor' => $movie['vod_actor'],
                'actor' => preg_split("/[^A-Za-z0-9\s+]/", $movie['vod_actor']),
                'director' => $movie['vod_director'],
                'update' => $movie['vod_time'],
                'down_url' => $movie['vod_down_url'],
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
