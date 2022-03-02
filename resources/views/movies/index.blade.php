@extends('layouts.main')

@section('content')
    @include('layouts.slider')
    <div class="container mx-auto px-4 pt-2" style="display:flex" id="movies-content">
        <div class="popular-movies w-4/5">
            <h2 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold">@isset($msg){{ $msg }}@else Phim Mới Cập Nhật @endisset</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($movies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
            <div class="page-movies flex flex-row row-span-1 mt-8" style="margin-left: -0.75em;vertical-align: middle;">
                @for($i = 1; $i <= $pageMovies; $i++)
                    @if($msg =="QUOC GIA" and $pageMovies >1)
                    <div class="w-10 text-center bg-blue-600 ml-3 rounded-sm" ><a href="{{ route('movies.countries', ['page' => $i,'country_name' => $typeMovies]) }}">{{$i}}</a></div>
                    @elseif($msg =="THE LOAI" and $pageMovies >1)
                    <div class="w-10 text-center bg-blue-600 ml-3 rounded-sm" ><a href="{{ route('movies.genre', ['page' => $i,'genre_name' => $typeMovies]) }}">{{$i}}</a></div>
                    @elseif($msg =="NAM" and $pageMovies >1)
                    <div class="w-10 text-center bg-blue-600 ml-3 rounded-sm" ><a href="{{ route('movies.year', ['page' => $i,'number' => $typeMovies]) }}">{{$i}}</a></div>
                    @elseif($msg =="PHIM LE" and $pageMovies >1)
                    <div class="w-10 text-center bg-blue-600 ml-3 rounded-sm" ><a href="{{ route('movies.list', ['page' => $i,'type' => $typeMovies]) }}">{{$i}}</a></div>
                    @elseif($msg==null and $pageMovies >1)
                    <div class="w-10 text-center bg-blue-600 ml-3 rounded-sm" ><a href="{{ route('movies.index', ['page' => $i-1]) }}">{{$i}}</a></div>
                    @endif
                @endfor
            </div>
        </div> <!-- end pouplar-movies -->
        <div class="top-movies w-1/5 ml-5" >
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold ml-4">Top Phim</h2>
            <div class="grid grid-cols-1 gap-8 shadow-2xl p-3" >
                @foreach ($movies ->sortBy('score')-> take(10) as $movie)
                    <x-movie-rank :movie="$movie" />
                @endforeach
            </div>
        </div> <!-- end pouplar-movies -->
    </div>
@endsection
