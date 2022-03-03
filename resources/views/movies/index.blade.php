@extends('layouts.main')

@section('content')
    @include('layouts.slider')
    <div class="container mx-auto px-4 pt-2 flex flex-col sm:flex-row md:flex-row" id="movies-content">
        <div class="popular-movies w-4/5">
            <h2 class="uppercase tracking-wider text-orange-500 text-2xl font-semibold py-4">@isset($msg){{ $msg }}@else Phim Mới Cập Nhật @endisset</h2>
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($movies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
            </div>
            <div class="justify-center page-movies flex flex-row row-span-1 mt-8" style="margin-left: -0.75em;vertical-align: middle;">
                @if ($pages > 1)
                    @for ($idx = 1; $idx <= $pages; $idx++)
                        <div id="page_{{ $idx }}" class="w-10 text-center ml-3 rounded-sm" >
                            <a class="toPage" href="{{ $uri }}/{{ $idx }}" data-page="page_{{ $idx }}">{{ $idx }}</a>
                        </div>
                    @endfor
                @endif
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

@section('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        console.log(localStorage['curPage'] || 'defaultValue');

        $('#' + localStorage['curPage']).css('background-color', 'rgb(51 65 85)');
        localStorage['curPage'] = 'page_1';

        $('.toPage').bind('click', function(e) {
            localStorage['curPage'] = $(this).attr('data-page');

            $(this).closest('div').parent().children('div').css('background-color', '');
            $('#' + localStorage['curPage']).css('background-color', 'rgb(51 65 85)');
        })
    });
</script>
@endsection
