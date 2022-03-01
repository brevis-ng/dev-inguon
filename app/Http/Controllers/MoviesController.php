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

        $viewModel = new MovieViewModel($movie);

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
        switch ($genre_name)
        {
            case 'phim-hoat-hinh':
                $movies = $this->get_movies_genre(4);
                break;
            case 'phim-hanh-dong':
                $movies = $this->get_movies_genre(6);
                break;
            case 'phim-hai':
                $movies = $this->get_movies_genre(7);
                break;
            case 'phim-tinh-cam':
                $movies = $this->get_movies_genre(8);
                break;
            case 'phim-khoa-hoc-vien-tuong':
                $movies = $this->get_movies_genre(9);
                break;
            case 'phim-khung-bo':
                $movies = $this->get_movies_genre(10);
                break;
            case 'phim-toi-pham':
                $movies = $this->get_movies_genre(11);
                break;
            case 'phim-chien-tranh':
                $movies = $this->get_movies_genre(12);
                break;
            case 'phim-tai-lieu':
                $movies = $this->get_movies_genre(20);
                break;
            case 'phim-kich-tinh':
                $movies = $this->get_movies_genre(21);
                break;
            default:
                abort(404);
        };
        $viewModel = new MoviesViewModel($movies, 'THE LOAI');
        return view('movies.index', $viewModel);
    }

    /**
     * Display the specified resource from api.
     *
     * @param  str  $country_name
     * @return \Illuminate\Http\Response
     */
    public function countries($country_name)
    {
        switch ($country_name)
        {
            case 'phim-trung-quoc':
                $movies = $this->get_movies_genre(13);
                break;
            case 'phim-nhat-ban':
                $movies = $this->get_movies_genre(23);
                break;
            case 'phim-thai-lan':
                $movies = $this->get_movies_genre(13);
                break;
            case 'phim-han-quoc':
                $movies = $this->get_movies_genre(22);
                break;
            case 'phim-au-my':
                $movies = $this->get_movies_genre(16);
                break;
            case 'phim-dai-loan':
                $movies = $this->get_movies_genre(15);
                break;
            case 'phim-hong-kong':
                $movies = $this->get_movies_genre(14);
                break;
            case 'phim-an-do':
                $movies = $this->get_movies_genre(13);
                break;
            default:
                abort(404);
        };
        $viewModel = new MoviesViewModel($movies, 'QUOC GIA');
        return view('movies.index', $viewModel);
    }

    /**
     * Display the specified resource from api.
     *
     * @param  str  $country_name
     * @return \Illuminate\Http\Response
     */
    public function list($type)
    {
        switch ($type)
        {
            case 'phim-le':
                // $movies = $this->get_movies_genre(1);
                $movies = $this->get_movies_genre(6);
                break;
            case 'phim-bo':
                // $movies = $this->get_movies_genre(2);
                $movies = $this->get_movies_genre(22);
                break;
            default:
                abort(404);
        };
        $viewModel = new MoviesViewModel($movies, 'PHIM LE');
        return view('movies.index', $viewModel);
    }

    private function get_movies_genre($id)
    {
        $movies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            't' => $id,
        ])->json()['list'];
        
        return $movies;
    }

    public function year($number)
    {
        switch ($number)
        {
            case '2017':
                $movies = $this->get_movies_year(2017);
                break;
            case '2018':
                $movies = $this->get_movies_year(2018);
                break;
            case '2019':
                $movies = $this->get_movies_year(2019);
                break;
            case '2020':
                $movies = $this->get_movies_year(2020);
                break;
            case '2021':
                $movies = $this->get_movies_year(2021);
                break;
            case '2022':
                $movies = $this->get_movies_year(2022);
                break;
            default:
                abort(404);
        };
        $viewModel = new MoviesViewModel($movies, 'NAM');
        return view('movies.index', $viewModel);
    }

    private function get_movies_year($number)
    {
        $movies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
        ])->json()['list'];
        $movies = collect($movies);
        $movies_filter = $movies->where('vod_year', (string)$number)->all();  
        $movies_filter = array_values($movies_filter);
        return collect($movies_filter);
    }
}
