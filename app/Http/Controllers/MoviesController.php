<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\MovieViewModel;
use App\ViewModels\MoviesViewModel;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Promise\Utils;
use Illuminate\Http\Client\Pool;
use App\Comment;
use PhpOption\None;
use Illuminate\Support\Facades\DB;

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
                $msg = 'PHIM HO???T H??NH';
                break;
            case 'phim-hanh-dong':
                $movies = $this->get_movies_genre(6, $page);
                $msg = 'PHIM H??NH ?????NG';
                break;
            case 'phim-hai':
                $movies = $this->get_movies_genre(7, $page);
                $msg = 'PHIM H??I H?????C';
                break;
            case 'phim-tinh-cam':
                $movies = $this->get_movies_genre(8, $page);
                $msg = 'PHIM T??NH C???M';
                break;
            case 'phim-khoa-hoc-vien-tuong':
                $movies = $this->get_movies_genre(9, $page);
                $msg = 'PHIM KHOA H???C VI???N T?????NG';
                break;
            case 'phim-khung-bo':
                $movies = $this->get_movies_genre(10, $page);
                $msg = 'PHIM KH???NG B???';
                break;
            case 'phim-toi-pham':
                $movies = $this->get_movies_genre(11, $page);
                $msg = 'PHIM T???I PH???M';
                break;
            case 'phim-chien-tranh':
                $movies = $this->get_movies_genre(12, $page);
                $msg = 'PHIM CHI???N TRANH';
                break;
            case 'phim-tai-lieu':
                $movies = $this->get_movies_genre(20, $page);
                $msg = 'PHIM T??I LI???U';
                break;
            case 'phim-kich-tinh':
                $movies = $this->get_movies_genre(21, $page);
                $msg = 'PHIM K???CH T??NH';
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
                $msg = 'PHIM TRUNG QU???C';
                break;
            case 'phim-nhat-ban':
                $movies = $this->get_movies_genre(23, $page);
                $msg = 'PHIM NH???T B???N';
                break;
            case 'phim-thai-lan':
                $movies = $this->get_movies_genre(13, $page);
                $msg = 'PHIM TH??I LAN';
                break;
            case 'phim-han-quoc':
                $movies = $this->get_movies_genre(22, $page);
                $msg = 'PHIM H??N QU???C';
                break;
            case 'phim-au-my':
                $movies = $this->get_movies_genre(16, $page);
                $msg = 'PHIM ??U M???';
                break;
            case 'phim-dai-loan':
                $movies = $this->get_movies_genre(15, $page);
                $msg = 'PHIM ????I LOAN';
                break;
            case 'phim-hong-kong':
                $movies = $this->get_movies_genre(14, $page);
                $msg = 'PHIM H???NG K??NG';
                break;
            case 'phim-an-do':
                $movies = $this->get_movies_genre(13, $page);
                $msg = 'PHIM ???N ?????';
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
                $msg = 'PHIM L???';
                break;
            case 'phim-bo':
                $movies = $this->get_movies_type(2);
                $msg = 'PHIM B???';
                break;
            default:
                abort(404);
        };
        // $users = DB::table('movies_single')->get();
        // dump($users);
        $slideMovies = collect($movies[0])->shuffle();
        $moviesWithType = $movies[1];
        $listsMovies = array_slice($moviesWithType, $page - 1, 30);
        $uri = route('movies.list', ['type' => $type]);
        $viewModel = new MoviesViewModel($listsMovies, $slideMovies, floor(count($moviesWithType) / 30 + 1), $msg, $uri);
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

        $url = 'http://api.nguonphim.tv/api.php/provide/vod';
        $responses = Http::pool(function (Pool $pool) use ($url, $pageCount) {
            return collect()
                ->range(1, $pageCount)
                ->map(fn ($page) => $pool->get($url . "?ac=detail&pg={$page}"));
        });
        foreach ($responses as $res) {
            $films = array_merge($films, $res['list']);
        }

        $moviesWithTypes = collect($films)->where('type_id_1', (string)$type)->all();
        $moviesWithTypes = array_values($moviesWithTypes);
        if (count($moviesWithTypes) == 0) {
            abort(404);
        }
        return [$movies, $moviesWithTypes];
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
        $viewModel = new MoviesViewModel($moviesInYearChunk[$page - 1], collect($movies)->shuffle(), $noMovies, 'PHIM N??M ' . $number, $uri);
        return view('movies.index', $viewModel);
    }
}
