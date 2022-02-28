<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $listCategory;
    public $genres;
    public $nowPlayingMovies;

    // public function __construct($popularMovies, $nowPlayingMovies, $genres)
    public function __construct($newMoviesToday,$listCategory)
    {
        $this->popularMovies = $newMoviesToday;
        $this->listCategory = $listCategory;

    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function listCategory()
    {
        return $this->formatCategory($this->listCategory);
    }

    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            // return [$genre['type_id'] => $genre['type_name']];
            return [$genre['id'] => $genre['name']];
        });
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
            ];
        });
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
}
