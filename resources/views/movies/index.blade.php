@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16" style="display:flex">
        <div class="popular-movies w-4/5">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Newest Updated Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($popularMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div> <!-- end pouplar-movies -->
        <div class="top-movies w-1/5 ml-5" >
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Top Phim</h2>
            <div class="grid grid-cols-1 gap-8 shadow-2xl p-3" >
                @foreach ($popularMovies ->sortBy('score')-> take(10) as $movie)
                    <x-movie-rank :movie="$movie" />
                @endforeach

            </div>
        </div> <!-- end pouplar-movies -->
    </div>
@endsection
