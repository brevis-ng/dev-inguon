@extends('layouts.main')

@section('content')
    <div class="movie-info ">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row">
            <div class="relative flex-none inline-block w-[272px] h-96 my-auto">
                <div class="absolute bg-pink-500 opacity-50 rounded-lg blur object-cover w-full h-full"></div>
                <a href="javascript:void(0);" class="items-center relative">
                    <img src="{{ $movie['poster_path'] }}" alt="{{ $movie['title'] }} poster" class="py-1 object-cover rounded-xl w-full h-full">
                </a>
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl mt-4 md:mt-0 font-semibold">{{ $movie['title'] }}</h2>
                <div class="flex flex-wdrap items-center text-gray-400 text-sm pt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 fill-current text-orange-500" viewBox="0 0 24 24">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-1">{!!($movie['vote_average'] + rand(999, 9999)) * 2.17 !!} lượt xem</span>
                    <span class="mx-2">|</span>
                    <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24">
                        <g data-name="Layer 2">
                            <path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/>
                        </g>
                    </svg>
                    <span class="ml-1">{!!($movie['vote_average'] + rand(999, 9999)) * 1.23 !!} lượt thích</span>
                </div>
                <div class="entry-data inline-grid grid-cols-2 w-full sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                    <p class="text-gray-300 mt-4">
                        Ngôn ngữ: {{ $movie['lang'] }}
                    </p>
                    <p class="text-gray-300 mt-4">
                        Trạng thái: {{ $movie['remarks'] }}
                    </p>
                    <p class="text-gray-300 mt-4">
                        @php
                            $y = $movie['release_date']
                        @endphp
                        Năm phát hành: <a href="{{ route('movies.year', $y) }}" class="hover:text-orange-500">{{ $movie['release_date'] }}</a>
                    </p>
                    <p class="text-gray-300 mt-4">
                        Thể loại:
                        @if (count($movie['genres']) > 0)
                            @foreach($movie['genres'] as $genre)
                                @if ($genre != '')
                                    <a href="#" class="hover:text-orange-500">{{ $genre }}</a><span>,&nbsp;</span>
                                @endif
                            @endforeach
                        @endif
                    </p>
                    <p class="text-gray-300 mt-4">
                        Đạo diễn: <a href="#" class="hover:text-orange-500">{{ $movie['director'] }}</a>
                    </p>
                    <p class="text-gray-300 mt-4">
                        Diễn viên:
                        @if (count($movie['actor']) > 0)
                            @foreach($movie['actor'] as $name)
                                @if ($name != '')
                                    <a href="#" class="hover:text-orange-500">{{ $name }}</a><span>,&nbsp;</span>
                                @endif
                            @endforeach
                        @endif
                    </p>
                    <p class="text-gray-300 mt-4">
                        Quốc gia:
                        @if (count($movie['area']) > 0)
                            @foreach($movie['area'] as $name)
                                @if ($name != '')
                                    <a href="#" class="hover:text-orange-500">{{ $name }}</a><span>,&nbsp;</span>
                                @endif
                            @endforeach
                        @endif
                    </p>
                    <p class="text-gray-300 mt-4">
                        Cập nhật: {{ $movie['update'] }}
                    </p>
                </div>
                <div class="mt-5">
                    {!! str_replace('"', '', $movie['overview']) !!}
                </div>
                <div class="mt-12 inline-grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-7" >
                    <button id="playBtn" class="inline-flex items-center text-white bg-indigo-500 rounded px-5 py-2 hover:bg-orange-600 transition ease-in-out duration-150">
                        <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                        <span class="ml-2">XEM PHIM</span>
                    </button>
                    <button id="downBtn" class="inline-flex items-center text-white bg-gray-700 rounded px-5 py-2 hover:bg-gray-500 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        <span class="ml-2">TẢI VỀ</span>
                    </button>
                    <button id="shareBtn" class="inline-flex items-center text-white bg-gray-700 rounded px-5 py-2 hover:bg-gray-500 transition ease-in-out duration-150">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        <span class="ml-2">CHIA SẺ</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- end movie-info -->

    <div class="related " >
        <div class="container mx-auto px-4 py-4">
            <h1>CÓ THỂ BẠN SẼ THÍCH</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach ($related as $m_r)
                <div class="mt-8 relative overflow-hidden rounded-md w-[215px] h-[300px]" title="{{ $m_r['title'] }}">
                    <a href="{{ route('movies.show', $m_r['id']) }}">
                        <img src="{{ $m_r['poster_path'] }}" alt="poster" class="object-cover w-full h-full">
                    </a>
                    <div class="absolute pt-2 bottom-0 inset-x-0 bg-gray-700 text-white leading-4">
                        <a href="{{ route('movies.show', $m_r['id']) }}" class="truncate hover:text-gray-300">{{ $m_r['title'] }}</a>
                        <div class="flex items-center text-gray-400 text-sm mt-1">
                            <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                            <span class="ml-1">{{ $m_r['remarks'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script type="text/javascript">
    document.getElementById("playBtn").onclick = function () {
        location.href = '{{ route("movies.play", $movie["id"]) }}';
    };
    document.getElementById("downBtn").onclick = function () {
        location.href = '{{ route("movies.index") }}';
    };
    document.getElementById("shareBtn").onclick = function () {
        location.href = '{{ route("movies.index") }}';
    };
</script>
@endsection