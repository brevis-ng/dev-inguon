@extends('layouts.main')

@section('content')
<div>
    <div class="container mx-auto flex flex-col md:flex-row text-center">
        <div class="relative container aspect-w-16 aspect-h-9 max-h-[80%]">
            <div class="bg-gray-900 py-4 px-2">
                <video
                    class="w-full video-js min-h-[80%] top-0 left-0"
                    id="my-video"
                    preload="auto"
                    controls
                    data-setup="{}"
                >
                    <source
                        id="my-source"
                        src="http://play.choiinguon.com/20220228/208_36027023/index.m3u8"
                        type="application/x-mpegURL"
                    />
                </video>
                <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
            </div>
        </div>
        <div class="w-[365px]">
            <h1>XEM PHIM</h1>
            <div class="inline-grid grid-cols-6 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6">
                @if (count($movie['videos']) > 0)
                        @if (count($movie['videos']) == 1)
                            @php
                                $link = $movie['videos'][0]
                            @endphp
                            <span class="ml-2">XEM PHIM</span>
                        @else
                            @foreach ($movie['videos'] as $link)
                                <span class="ml-2">Tập {{ $loop->index + 1 }}</span>
                            @endforeach
                        @endif
                @endif
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