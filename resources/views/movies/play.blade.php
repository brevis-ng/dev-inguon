@extends('layouts.main')

@section('content')
<div class="play-movie">
    <div class="container mx-auto flex flex-col sm:flex-row md:flex-row justify-center px-4 py-6">
        <div class="relative container justify-center object-cover">
            <div class="mx-auto" id="videoBox">
                <video
                    class="absolute vjs-big-play-centered video-js vjs-fluid vjs-fill vjs-paused vjs-controls-enabled vjs-workinghover vjs-v7 vjs-user-active vjs_video_3-dimensions"
                    id="playVideo"
                    preload="auto"
                    controls
                    data-setup="{}"
                >
                    <source
                        id="playVideoSource"
                        src="{{ $movie['videos'][0] }}"
                        type="application/x-mpegURL"
                    />
                </video>
                <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
            </div>
        </div>
        <div class="text-center justify-center bg-gray-800">
            <h1 class="text-lg my-4 md:mt-1 hover:text-orange-500 font-semibold max-w-xs">{{ $movie['title'] }}</h1>
            @if (count($movie['videos']) > 0)
                @if (count($movie['videos']) == 1)
                    <ul id="episodeBox" class="px-4 content-start overflow-y-scroll text-justify scrollbar-thin scrollbar-thumb-slate-400">
                        @foreach ($related as $m_r)
                        <li class="py-2 relative flex hover:bg-gray-700 cursor-pointer">
                            <div class="w-32 h-16 my-auto relative inline-block">
                                <div class="w-full h-full">
                                    <a href="{{ route('movies.show', $m_r['id']) }}"><img class="w-full h-full object-cover rounded-xl" src="{{ $m_r['poster_path'] }}" alt="{{ $m_r['title'] }}"></a>
                                </div>
                            </div>
                            <div class="inline-block px-4 w-40 inset-x-0 text-justify my-auto">
                                <a class="hover:text-orange-500" href="{{ route('movies.show', $m_r['id']) }}">{{ $m_r['title'] }}</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <div id="episodeBox" class="px-4 content-start overflow-y-scroll scrollbar-thin scrollbar-thumb-slate-400 inline-grid grid-cols-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-3 gap-y-2 text-center">
                        @foreach ($movie['videos'] as $video)
                            <div id="episode_{{ $loop->index + 1 }}" class="w-11 h-11 mt-3 bg-slate-700 rounded relative overflow-hidden">
                                <button class="btnPlayVideo" data-videoLink="{{ $video }}" data-episode="Tập {{ $loop->index + 1 }}">
                                    <span class="object-cover hover:text-orange-500">{{ $loop->index + 1 }}</span>
                                </button>
                                <span class="absolute bottom-0 inset-x-0 bg-orange-900 opacity-75 text-orange-400 text-xs">{{$movie['remarks']}}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </div>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-xl my-4 md:mt-0">CÓ THỂ BẠN SẼ THÍCH</h1>
        <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($related as $m_r)
            <div class="my-2 mx-2 relative overflow-hidden rounded-md h-80" title="{{ $m_r['title'] }}">
                <div class="poster group relative flex-none inline-block object-cover w-full h-full">
                    <div class="absolute bg-gray-400 opacity-50 rounded-lg blur object-cover w-full h-full"></div>
                    <div class="grid place-items-center">
                        <a href="{{ route('movies.show', $m_r['id']) }}" class="items-center mx-auto relative grid place-items-center">
                            <img src="{{ $m_r['poster_path'] }}" alt="{{ $m_r['title'] }}" class="lazyload w-full h-full object-cover overflow-hidden group-hover:opacity-80 group-hover:scale-125 transition duration-300 ease-in-out">
                            <i class="place-items-center group-hover:opacity-80 group-hover:scale-100 absolute h-14 w-14 bg-yellow-500 rounded-full opacity-0 transition duration-300 ease-in-out scale-150">
                                <div class="w-5 overflow-hidden inline-block mx-6 my-3">
                                    <div class="h-10 bg-white rotate-45 transform origin-top-left"></div>
                                </div>
                            </i>
                        </a>
                    </div>
                </div>
                <div class="absolute py-2 bottom-0 inset-x-0 bg-gray-900 text-white leading-4 opacity-90">
                    <a href="{{ route('movies.show', $m_r['id']) }}" class="truncate mt-2 hover:text-gray-300">{{ $m_r['title'] }}</a>
                    <div class="flex items-center text-sm mt-1">
                        <svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
                        <span class="ml-1">{{ $m_r['remarks'] }}</span>
                        <span class="mx-2">|</span>
                        <span class="text-gray-200 text-sm">{{ $m_r['type'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!-- area comment -->
    @include('movies.comment')
    <!-- end comment are -->
</div>
<!-- end movie-play -->

@endsection

@section('scripts')

<script type="text/javascript">

    $(document).ready(function() {

        $("#episodeBox").css({'height':($("#videoBox").height()*0.7+'px')});
        $("#episodeBox").css({'width':($("#videoBox").width()/5+'px')});

        function genVideoTitle(title) {
            var Component = videojs.getComponent('Component');
            var TitleBar = videojs.extend(Component, {
                constructor: function(player, options) {
                Component.apply(this, arguments);
                    if (options.text) {
                        this.updateTextContent(options.text);
                    }
                },
                createEl: function() {
                    return videojs.dom.createEl('div', {
                        className: 'vjs-title-bar'
                    });
                },
                updateTextContent: function(text) {
                if (typeof text !== 'string') {
                    text = 'Title Unknown';
                }
                videojs.dom.emptyEl(this.el());
                videojs.dom.appendContent(this.el(), text);
                }
            });
            videojs.registerComponent('TitleBar', TitleBar);
            var player = videojs('playVideo');
            player.addChild('TitleBar', {text: title});
        }
        genVideoTitle("{{ $movie['title'] }}");
        $('#episode_1').css('background-color', 'rgb(45 212 191)');

        $(".btnPlayVideo").bind('click', function(e) {

            $('.vjs-title-bar').remove();
            let episode = $(this).attr('data-episode');
            let nextVideo = $(this).attr('data-videoLink');
            $(this).closest('div').parent().children('div').css('background-color', 'rgb(51 65 85)');
            $(this).closest('div').css('background-color', 'rgb(45 212 191)');
            videojs('playVideo').pause();
            videojs('playVideo').dispose();
            var videoElement = `
                <video
                    id="playVideo"
                    class="absolute vjs-big-play-centered video-js vjs-16-9 vjs-paused vjs-controls-enabled vjs-workinghover vjs-v7 vjs-user-active vjs_video_3-dimensions"
                    controls
                    preload="auto"
                    data-setup="{}"
                >
                    <source id="playVideoSource" src="${ nextVideo }" type="application/x-mpegURL">
                </video>`;
            $('#videoBox').html(videoElement);

            videojs('playVideo', {
                bigPlayButton: true,
                textTrackDisplay: false,
                errorDisplay: false
            }, function () {
                this.play();
            });
            let title = "{{ $movie['title'] }} - " + episode
            genVideoTitle(title);

            e.preventDefault();
        })
    });

</script>

@endsection