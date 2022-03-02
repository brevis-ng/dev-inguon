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
    public function index($page=null)
    {
        $newMoviesToday = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            'pg' => $page
        ])->json()['list'];
        $pageMovies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
        ])->json()['pagecount'];

        $hightlightMovies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
        ])->json()['list'];

        $viewModel = new MoviesViewModel($newMoviesToday,$hightlightMovies,$pageMovies);

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

        $viewModel = new MovieViewModel($movie, $related_movies);

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
    public function genre($genre_name,$page=null)
    {
        switch ($genre_name) {
            case 'phim-hoat-hinh':
                $movies = $this->get_movies_genre(4,$page,'phim-hoat-hinh');
                break;
            case 'phim-hanh-dong':
                $movies = $this->get_movies_genre(6,$page,'phim-hanh-dong');
                break;
            case 'phim-hai':
                $movies = $this->get_movies_genre(7,$page,'phim-hai');
                break;
            case 'phim-tinh-cam':
                $movies = $this->get_movies_genre(8,$page,'phim-tinh-cam');
                break;
            case 'phim-khoa-hoc-vien-tuong':
                $movies = $this->get_movies_genre(9,$page,'phim-khoa-hoc-vien-tuong');
                break;
            case 'phim-khung-bo':
                $movies = $this->get_movies_genre(10,$page,'phim-khung-bo');
                break;
            case 'phim-toi-pham':
                $movies = $this->get_movies_genre(11,$page,'phim-toi-pham');
                break;
            case 'phim-chien-tranh':
                $movies = $this->get_movies_genre(12,$page,'phim-chien-tranh');
                break;
            case 'phim-tai-lieu':
                $movies = $this->get_movies_genre(20,$page,'phim-tai-lieu');
                break;
            case 'phim-kich-tinh':
                $movies = $this->get_movies_genre(21,$page,'phim-kich-tinh');
                break;
            default:
                abort(404);
        };
        $hightlightMovies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
        ])->json()['list'];
        $viewModel = new MoviesViewModel($movies[0], $hightlightMovies, $movies[1],'THE LOAI',$movies[2]);
        return view('movies.index', $viewModel);
    }

    /**
     * Display the specified resource from api.
     *
     * @param  str  $country_name
     * @return \Illuminate\Http\Response
     */
    public function countries($country_name,$page=null)
    {
        switch ($country_name) {
            case 'phim-trung-quoc':
                $movies = $this->get_movies_genre(13,$page,'phim-trung-quoc');
                break;
            case 'phim-nhat-ban':
                $movies = $this->get_movies_genre(23,$page,'phim-nhat-ban');
                break;
            case 'phim-thai-lan':
                $movies = $this->get_movies_genre(13,$page,'phim-thai-lan');
                break;
            case 'phim-han-quoc':
                $movies = $this->get_movies_genre(22,$page,'phim-han-quoc');
                break;
            case 'phim-au-my':
                $movies = $this->get_movies_genre(16,$page,'phim-au-my');
                break;
            case 'phim-dai-loan':
                $movies = $this->get_movies_genre(15,$page,'phim-dai-loan');
                break;
            case 'phim-hong-kong':
                $movies = $this->get_movies_genre(14,$page,'phim-hong-kong');
                break;
            case 'phim-an-do':
                $movies = $this->get_movies_genre(13,$page,'phim-an-do');
                break;
            default:
                abort(404);
        };
        $hightlightMovies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
        ])->json()['list'];
        $viewModel = new MoviesViewModel($movies[0], $hightlightMovies,$movies[1], 'QUOC GIA', $movies[2]);
        return view('movies.index', $viewModel);
    }

    /**
     * Display the specified resource from api.
     *
     * @param  str  $country_name
     * @return \Illuminate\Http\Response
     */
    public function list($type,$page=1)
    {
        $typeMovies = null;
        switch ($type) {
            case 'phim-le':
                $movies = $this->get_movies_type(1);
                $typeMovies = 'phim-le';
                break;
            case 'phim-bo':
                $movies = $this->get_movies_type(2);
                $typeMovies = 'phim-bo';
                break;
            default:
                abort(404);
        };
        $hightlightMovies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
        ])->json()['list'];
        $viewModel = new MoviesViewModel(collect($movies[$page-1]), $hightlightMovies,count($movies), $type == 'phim-le' ? 'PHIM LẺ' : 'PHIM BỘ',$typeMovies);
        return view('movies.index', $viewModel);
    }

    private function get_movies_type($type)
    {
        $movies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail'
        ])->json()['list'];
        $list = collect($movies);
        $list_filter = $list->where('type_id_1', (string)$type)->all();
        $list_filter = array_values($list_filter);
        $arrMovies= array_chunk($list_filter, 30);
        return $arrMovies;
    }

    private function get_movies_genre($id,$page,$type)
    {
        $movies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            't' => $id,
            'pg' => $page
        ])->json()['list'];

        $pageMovies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
            't' => $id,
        ])->json()['pagecount'];
        if(count($movies)==0)
            abort(404);    
        return [$movies,$pageMovies,$type];
    }

    public function year($number,$page=1)
    {
        $movies = $this->get_movies_year($number);
        $hightlightMovies = Http::get('http://api.nguonphim.tv/api.php/provide/vod', [
            'ac' => 'detail',
        ])->json()['list'];
        $viewModel = new MoviesViewModel(collect($movies[$page-1]), $hightlightMovies,count($movies), 'NAM',$number);
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
        if(count($movies_filter)==0)
        abort(404);
        $arrMovies= array_chunk($movies_filter, 30);
        return $arrMovies;
    }
}
