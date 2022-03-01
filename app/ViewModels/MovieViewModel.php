<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public $relatedMovies;

    public function __construct($movie, $relatedMovies = null)
    {
        $this->movie = $movie;
        $this->relatedMovies = $relatedMovies;
    }

    public function related()
    {
        $relates = collect($this->relatedMovies)->map(function($movie) {
            return [
                'title' => $movie['vod_name'],
                'poster_path' => $movie['vod_pic'],
                'id' => $movie['vod_id'],
                'type' => $movie['type_name'],
                'remarks' => $movie['vod_remarks'],
                'score' => $movie['vod_score'],
            ];
        });
        $count = $relates->count() >= 6 ? 6 : $relates->count();
        return $relates->random($count);
    }

    public function movie()
    {
        return collect($this->movie)->mapWithKeys(function($movie) {
            $m3u8Links = explode('$$$', $movie['vod_play_url'])[1];
            $m3u8Links = collect(explode("#", $m3u8Links))->map(function($link) {
                return explode('$', $link)[1];
            });
            return [
                'poster_path' => $movie['vod_pic'],
                'title' => $movie['vod_name'],
                'vote_average' => (int)$movie['vod_up'],
                'release_date' => $movie['vod_pubdate'] === "" ? $movie['vod_year'] : $movie['vod_pubdate'],
                'genres' => $movie['vod_class'] == "" ? $movie['type_name'] : $movie['vod_class'],
                'lang' => $movie['vod_lang'],
                // 'overview' => str_replace(str_split('<p>,</p>'), "", $movie['vod_content']),
                'overview' => $movie['vod_content'],
                'serial' => $movie['vod_serial'],
                'score' => $movie['vod_score'],
                'videos' => $m3u8Links,
                'remarks' => $movie['vod_remarks'],
                'area' => preg_split("/[,，、.；;]/", $movie['vod_area']),
                'actor' => $movie['vod_actor'],
                'actor' => preg_split("/[,，、.；;]/", $movie['vod_actor']),
                'director' => $movie['vod_director'],
                'update' => $movie['vod_time'],
                'down_url' => $movie['vod_down_url'],
                'id' => $movie['vod_id'],
            ];
        });
    }
}
