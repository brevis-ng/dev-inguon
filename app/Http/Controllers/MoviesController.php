<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;
use PhpOption\None;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $newMoviesToday = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
        ])->json()['list'];

        $viewModel = new MoviesViewModel($newMoviesToday);

        return view('movies.index', $viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            'ids' => $id,
        ])->json()['list'];

        $listCategory = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'list',
             't' => '1',
        ])->json()['class'];

        $viewModel = new MovieViewModel($movie, $listCategory);

        return view('movies.show', $viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Display the specified resource from api.
     *
     * @param  str  $genre_name
     * @return \Illuminate\Http\Response
     */
    public function genre($genre_name)
    {
        $genre_id = 1;
        switch ($genre_name)
        {
            case 'phim-hoat-hinh':
                $genre_id = 4;
                $movies = $this->get_movies_genre($genre_id);
                break;
            case 'phim-hanh-dong':
                $genre_id = 6;
                $movies = $this->get_movies_genre($genre_id);
                break;
            case 'phim-hai':
                $genre_id = 7;
                $movies = $this->get_movies_genre($genre_id);
                break;
            case 'phim-tinh-cam':
                $genre_id = 8;
                $movies = $this->get_movies_genre($genre_id);
                break;
            case 'phim-khoa-hoc-vien-tuong':
                $genre_id = 9;
                $movies = $this->get_movies_genre($genre_id);
                break;
            case 'phim-khung-bo':
                $genre_id = 10;
                $movies = $this->get_movies_genre($genre_id);
                break;
            case 'phim-toi-pham':
                $genre_id = 11;
                $movies = $this->get_movies_genre($genre_id);
                break;
            case 'phim-chien-tranh':
                $genre_id = 12;
                $movies = $this->get_movies_genre($genre_id);
                break;
            case 'phim-tai-lieu':
                $genre_id = 20;
                $movies = $this->get_movies_genre($genre_id);
                break;
            case 'phim-kich-tinh':
                $genre_id = 21;
                $movies = $this->get_movies_genre($genre_id);
                break;
            default:
                abort(404);
        };
        $viewModel = new MoviesViewModel($movies);
        return view('movies.index', $viewModel);
    }

    private function get_movies_genre($genre_id)
    {
        $movies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            't' => $genre_id,
        ])->json()['list'];
        
        return $movies;
    }
}
