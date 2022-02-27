<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public $listCategory;

    public function __construct($movie,$listCategory)
    {
        $this->movie = $movie;
        $this->listCategory = $listCategory;
    }

    public function listCategory()
    {
        return $this->formatCategory($this->listCategory);
    }

    private function formatCategory($categories)
    {
        return collect($categories)->map(function($category) {
            return [
                'type_id' => $category['type_id'],
                'name' => $category['type_name'],
                'pipid' => $category['type_pid'],
            ];     
        });
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
                'overview' => str_replace(str_split('<p>,</p>'), "", $movie['vod_content']),
                'serial' => $movie['vod_serial'],
                'videos' => $m3u8Links,
            ];
        });
    }
}
