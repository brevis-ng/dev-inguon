<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
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
                'vote_average' => $movie['vod_up'] . " 赞成",
                'release_date' => $movie['vod_pubdate'] === "" ? $movie['vod_year'] : $movie['vod_pubdate'],
                'genres' => $movie['vod_class'],
                'lang' => $movie['vod_lang'],
                // 'overview' => str_replace(str_split('<p>,</p>'), "", $movie['vod_content']),
                'overview' => $movie['vod_content'],
                'serial' => $movie['vod_serial'],
                'score' => $movie['vod_score'],
                'videos' => $m3u8Links,
            ];
        });
    }
}
