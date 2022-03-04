<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;
use App\Comment;
use PhpOption\None;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = null)
    {
        $jsonResponse = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            'pg' => $page
        ])->json();

        $movies = $jsonResponse['list'];
        $pageMovies = $jsonResponse['pagecount'];

        $slideMovies = collect($movies)->shuffle();

        $viewModel = new MoviesViewModel($movies, $slideMovies, $pageMovies);
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

        if (empty($movie)) {
            abort(404);
        }

        $related_movies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            't' => $movie[0]['type_id'],
        ])->json()['list'];

        $viewModel = new MovieViewModel($movie, $related_movies);

        return view('movies.show', $viewModel);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function play($id)
    {
        $movie = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            'ids' => $id,
        ])->json()['list'];

        if (empty($movie)) {
            abort(404);
        }

        $related_movies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            't' => $movie[0]['type_id'],
        ])->json()['list'];

        $comment = Comment::where('IdVod', $id)->orderBy('created_at', 'DESC')->get()->groupBy(function ($data) {
            return $data->created_at->format('Y-m-d');
        })->toArray();
        $viewModel = new MovieViewModel($movie, $related_movies, $comment);

        return view('movies.play', $viewModel);
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
    public function genre($genre_name, $page = null)
    {
        switch ($genre_name) {
            case 'phim-hoat-hinh':
                $movies = $this->get_movies_genre(4, $page);
                $msg = 'PHIM HOẠT HÌNH';
                break;
            case 'phim-hanh-dong':
                $movies = $this->get_movies_genre(6, $page);
                $msg = 'PHIM HÀNH ĐỘNG';
                break;
            case 'phim-hai':
                $movies = $this->get_movies_genre(7, $page);
                $msg = 'PHIM HÀI HƯỚC';
                break;
            case 'phim-tinh-cam':
                $movies = $this->get_movies_genre(8, $page);
                $msg = 'PHIM TÌNH CẢM';
                break;
            case 'phim-khoa-hoc-vien-tuong':
                $movies = $this->get_movies_genre(9, $page);
                $msg = 'PHIM KHOA HỌC VIỄN TƯỞNG';
                break;
            case 'phim-khung-bo':
                $movies = $this->get_movies_genre(10, $page);
                $msg = 'PHIM KHỦNG BỐ';
                break;
            case 'phim-toi-pham':
                $movies = $this->get_movies_genre(11, $page);
                $msg = 'PHIM TỘI PHẠM';
                break;
            case 'phim-chien-tranh':
                $movies = $this->get_movies_genre(12, $page);
                $msg = 'PHIM CHIẾN TRANH';
                break;
            case 'phim-tai-lieu':
                $movies = $this->get_movies_genre(20, $page);
                $msg = 'PHIM TÀI LIỆU';
                break;
            case 'phim-kich-tinh':
                $movies = $this->get_movies_genre(21, $page);
                $msg = 'PHIM KỊCH TÍNH';
                break;
            default:
                abort(404);
        };
        $slideMovies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', ['ac' => 'detail',])->json()['list'];
        $slideMovies = collect($slideMovies)->shuffle();
        $uri = route('movies.genre', ['genre_name' => $genre_name]);
        $viewModel = new MoviesViewModel($movies[0], $slideMovies, $movies[1], $msg, $uri);
        return view('movies.index', $viewModel);
    }

    /**
     * Display the specified resource from api.
     *
     * @param  str  $country_name
     * @return \Illuminate\Http\Response
     */
    public function countries($country_name, $page = null)
    {
        switch ($country_name) {
            case 'phim-trung-quoc':
                $movies = $this->get_movies_genre(13, $page);
                $msg = 'PHIM TRUNG QUỐC';
                break;
            case 'phim-nhat-ban':
                $movies = $this->get_movies_genre(23, $page);
                $msg = 'PHIM NHẬT BẢN';
                break;
            case 'phim-thai-lan':
                $movies = $this->get_movies_genre(13, $page);
                $msg = 'PHIM THÁI LAN';
                break;
            case 'phim-han-quoc':
                $movies = $this->get_movies_genre(22, $page);
                $msg = 'PHIM HÀN QUỐC';
                break;
            case 'phim-au-my':
                $movies = $this->get_movies_genre(16, $page);
                $msg = 'PHIM ÂU MỸ';
                break;
            case 'phim-dai-loan':
                $movies = $this->get_movies_genre(15, $page);
                $msg = 'PHIM ĐÀI LOAN';
                break;
            case 'phim-hong-kong':
                $movies = $this->get_movies_genre(14, $page);
                $msg = 'PHIM HỒNG KÔNG';
                break;
            case 'phim-an-do':
                $movies = $this->get_movies_genre(13, $page);
                $msg = 'PHIM ẤN ĐỘ';
                break;
            default:
                abort(404);
        };

        $slideMovies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', ['ac' => 'detail',])->json()['list'];
        $slideMovies = collect($slideMovies)->shuffle();
        $uri = route('movies.countries', ['country_name' => $country_name]);
        $viewModel = new MoviesViewModel($movies[0], $slideMovies, $movies[1], $msg, $uri);
        return view('movies.index', $viewModel);
    }

    /**
     * Display the specified resource from api.
     *
     * @param  str  $country_name
     * @return \Illuminate\Http\Response
     */
    public function list($type, $page = 1)
    {
        switch ($type) {
            case 'phim-le':
                $movies = $this->get_movies_type(1);
                $msg = 'PHIM LẺ';
                break;
            case 'phim-bo':
                $movies = $this->get_movies_type(2);
                $msg = 'PHIM BỘ';
                break;
            default:
                abort(404);
        };
        $slideMovies = collect($movies[0])->shuffle();
        $moviesWithType = $movies[1];
        $uri = route('movies.list', ['type' => $type]);
        $viewModel = new MoviesViewModel($moviesWithType[$page - 1], $slideMovies, count($movies), $msg, $uri);
        return view('movies.index', $viewModel);
    }
    /////////////////////////////////////// will modify in future -----------------------------------------------------------------------
    private function get_movies_type($type)
    {
        $response = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
        ])->json();

        $movies = $response['list'];
        $films = [];
        $pageCount = $response['pagecount'];

        if ($type == 1) {
            $moviesWithType = collect($movies)->where('type_id_1', (string)$type)->all();
            $moviesWithType = array_values($moviesWithType);
            $noMovies = count($moviesWithType);
            if ($noMovies == 0)
                abort(404);
            $moviesWithType = collect(array_chunk($moviesWithType, 24));
            return [$movies, $moviesWithType];
        } else {
            for ($i = 0; $i < $pageCount; $i++) {
                $list = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
                    'ac' => 'detail',
                    'pg' => $i,
                ])->json()['list'];
                $moviesWithType = collect($list)->where('type_id_1', (string)$type)->all();
                $moviesWithType = array_values($moviesWithType);

                $films = array_merge($films, $moviesWithType);
                $countt = count($films);
                if ($countt == 24) {
                    return [$movies, $films];
                }
            }
            $noMovies = count($list);
            if ($noMovies == 0)
                abort(404);

            $films = collect(array_chunk($films, 24));
            return [$movies, $films];
        }

        // $movies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
        //     'ac' => 'detail'
        // ])->json()['list'];

        // $moviesWithType = collect($movies)->where('type_id_1', (string)$type)->all();
        // $moviesWithType = array_values($moviesWithType);
        // $noMovies = count($moviesWithType);
        // if ($noMovies == 0)
        //     abort(404);
        // $moviesWithType = collect(array_chunk($moviesWithType, 24));
        // return [$movies, $moviesWithType];
    }
    /////////////////////////////////////// will modify in future -----------------------------------------------------------------------
    private function get_movies_genre($id, $page)
    {
        $jsonResponse = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            't' => $id,
            'pg' => $page
        ])->json();

        $movies = $jsonResponse['list'];
        $pages = $jsonResponse['pagecount'];

        if (count($movies) == 0)
            abort(404);
        return [$movies, $pages];
    }

    public function year($number, $page = 1)
    {
        $movies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
        ])->json()['list'];
        $moviesInYear = collect($movies)->where('vod_year', (string)$number)->all();
        $moviesInYear = array_values($moviesInYear);
        $noMovies = count($moviesInYear);
        if ($noMovies == 0)
            abort(404);
        $moviesInYearChunk = collect(array_chunk($moviesInYear, 30));
        $uri = route('movies.year', ['number' => $number]);
        $viewModel = new MoviesViewModel($moviesInYearChunk[$page - 1], collect($movies)->shuffle(), $noMovies, 'PHIM NĂM ' . $number, $uri);
        return view('movies.index', $viewModel);
    }
}
