@extends('layouts.main')

@section('content')
    <div class="movie-info ">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row">
            <div class="relative flex-none inline-block w-[272px] h-96">
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
                <div class="entry-data inline-grid grid-cols-2 w-full">
                    <p class="text-gray-300 mt-4">
                        Ngôn ngữ: {{ $movie['lang'] }}
                    </p>
                    <p class="text-gray-300 mt-4">
                        Trạng thái: {{ $movie['remarks'] }}
                    </p>
                    <p class="text-gray-300 mt-4">
                        Năm phát hành: <a href="#" class="hover:text-orange-500">{{ $movie['release_date'] }}</a>
                    </p>
                    <p class="text-gray-300 mt-4">
                        Thể loại: <a href="#" class="hover:text-orange-500">{{ $movie['genres'] }}</a>
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
                        Quốc gia: <a href="#" class="hover:text-orange-500">{{ $movie['area'] }}</a>
                    </p>
                    <p class="text-gray-300 mt-4">
                        Cập nhật: {{ $movie['update'] }}
                    </p>
                </div>
                <div class="mt-5">
                    {!! str_replace('"', '', $movie['overview']) !!}
                </div>
                <div x-data="{ isOpen: false }">
                    @if (count($movie['videos']) > 0)
                        <div class="mt-12">
                            @if (count($movie['videos']) == 1)
                                @php
                                    $link = $movie['videos'][0]
                                @endphp
                                <button
                                    onclick="playVideo('{{ $link }}','')"
                                    class="inline-flex items-center text-white bg-gray-800 rounded px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150"
                                >
                                    <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                    <span class="ml-2">XEM PHIM</span>
                                </button>
                            @else
                                @foreach ($movie['videos'] as $link)
                                    <button
                                        onclick="playVideo('{{ $link }}', 'Tập {{ $loop->index + 1 }}')"
                                        class="inline-flex items-center text-white bg-gray-800 rounded px-3 py-1 mt-3 ml-1 hover:bg-orange-600 transition ease-in-out duration-150"
                                    >
                                        <svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                                        <span class="ml-2">Tập {{ $loop->index + 1 }}</span>
                                    </button>
                                @endforeach
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> <!-- end movie-info -->

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

    <div
        id="div-videocontainer" 
        class="movie-play border-b border-gray-800" hidden>
        <div class="container mx-auto px-3 py-1 flex md:flex-row items-center">
            <div class="bg-gray-900 rounded">
                <div
                    id="video-box" 
                    class="responsive-container overflow-auto relative">
                    <video
                        id="my-video"
                        class="video-js"
                        preload="auto"
                        poster="{{ $movie['poster_path'] }}"
                        controls
                        data-setup="{}"
                    >
                        <source
                            id="my-source"
                            src="{{ $movie['videos'][0] }}"
                            type="application/x-mpegURL"
                        />
                    </video>
                    <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
                </div>
            </div>
        </div>
        <div class="container mx-auto px-3 py-1 flex md:flex-row items-center">
            <span id="episode-video" class="ml-2 text-3xl"></span>
        </div>
    </div>
@endsection

@section('scripts')
<script type="text/javascript">
    var videoContainer = document.getElementById('div-videocontainer');
    videoContainer.setAttribute("hidden","");

    function playVideo(link, episode) {
        videoContainer.removeAttribute('hidden','');
        document.querySelector('#div-videocontainer').scrollIntoView({ behavior: 'smooth', block: 'end'});
        document.getElementById('episode-video').innerHTML = episode;
        console.log(link);
        videojs('my-video').pause();
        videojs('my-video').dispose();
        document.getElementById('video-box').innerHTML = '';
        var str2 = `
            <video id="my-video"  class="video-js"
                poster="{{ $movie['poster_path'] }}"
                controls
                preload="auto"
                data-setup="{}"
            >
                <source id="source" src="${link}" type="application/x-mpegURL">
            </video>`;
        document.getElementById('video-box').innerHTML = str2;
        videojs('my-video', {
            bigPlayButton: true,
            textTrackDisplay: false,
            posterImage: true,
            errorDisplay: false
        }, function () {
            // this.play();
        });
    }

</script>
@endsection