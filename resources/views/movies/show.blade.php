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
    </div>

    <div id="shareBox" aria-hidden="true" class="hidden absolute bg-black bg-opacity-70 overflow-y-auto overflow-x-hidden top-0 left-0 h-full w-full">
        <div class="table-cell align-middle md:h-auto mx-auto">
            <!-- Modal content -->
            <div class="mx-auto max-w-2xl bg-gray-800 rounded-lg shadow dark:bg-gray-700 opacity-100">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-5 rounded-t border-b border-gray-700">
                    <h3 class="text-xl font-semibold lg:text-2xl mx-auto">
                        Chia sẻ cho chúng mình nhé
                    </h3>
                    <button id="closeBtn" type="button" class="text-gray-400 bg-transparent hover:text-white rounded-lg text-sm inline-flex items-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <div class="justify-center flex">
                        <input id="shareUrl" readonly type="text" class="min-w-[80%] text-center rounded-2xl focus:outline-none border-none bg-gray-600 text-gray-100" value="link chia se">
                        <button id="copyBtn" class="py-2 pl-4" title="Sao chép">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" style="stroke-width: 1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" /></svg>
                        </button>
                    </div>
                    <div class="justify-center mx-auto flex flex-row">
                        <a id="shareWithFb" title="Chia sẻ lên Facebook" class="px-5 cursor-pointer">
                            <svg class="w-9 h-9 text-blue-600 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a id="shareWithTele" title="Chia sẻ lên Telegram" class="px-5 cursor-pointer">
                            <svg class="w-9 h-9 text-blue-400 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M248,8C111.033,8,0,119.033,0,256S111.033,504,248,504,496,392.967,496,256,384.967,8,248,8ZM362.952,176.66c-3.732,39.215-19.881,134.378-28.1,178.3-3.476,18.584-10.322,24.816-16.948,25.425-14.4,1.326-25.338-9.517-39.287-18.661-21.827-14.308-34.158-23.215-55.346-37.177-24.485-16.135-8.612-25,5.342-39.5,3.652-3.793,67.107-61.51,68.335-66.746.153-.655.3-3.1-1.154-4.384s-3.59-.849-5.135-.5q-3.283.746-104.608,69.142-14.845,10.194-26.894,9.934c-8.855-.191-25.888-5.006-38.551-9.123-15.531-5.048-27.875-7.717-26.8-16.291q.84-6.7,18.45-13.7,108.446-47.248,144.628-62.3c68.872-28.647,83.183-33.623,92.511-33.789,2.052-.034,6.639.474,9.61,2.885a10.452,10.452,0,0,1,3.53,6.716A43.765,43.765,0,0,1,362.952,176.66Z"></path></svg>
                        </a>
                        <a id="shareWithTwitter" title="Chia sẻ lên Twitter" class="px-5 cursor-pointer">
                            <svg class="w-9 h-9 text-blue-300 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="downBox" aria-hidden="true" class="hidden absolute bg-black bg-opacity-70 overflow-y-auto overflow-x-hidden top-0 left-0 h-full w-full">
        <div class="table-cell align-middle md:h-auto mx-auto">
            <!-- Modal content -->
            <div class="mx-auto max-w-2xl bg-gray-800 rounded-lg shadow dark:bg-gray-700 opacity-100">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-5 rounded-t border-b border-gray-700">
                    <h3 class="text-xl font-semibold lg:text-2xl mx-auto">
                        Danh sách tải phim
                    </h3>
                    <button id="closeDownBox" type="button" class="text-gray-400 bg-transparent hover:text-white rounded-lg text-sm inline-flex items-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    @if (count($movie['downloads']) > 0)
                        <ul class="max-h-80 px-4 content-start overflow-y-scroll text-justify scrollbar-thin scrollbar-thumb-slate-400">
                            @foreach ($movie['downloads'] as $download)
                            <li class="py-2 flex justify-center hover:bg-gray-700 text-center">
                                <span class="my-auto">{{ $movie['title'] }}-{{ $loop->index + 1 }}</span>
                                <button class="downloadBtn ml-6 hover:text-green-600" type="button" data-downLink="{{ $download }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" style="stroke-width: 1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                </button>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

<script type="text/javascript">
    document.getElementById("playBtn").onclick = function () {
        location.href = '{{ route("movies.play", $movie["id"]) }}';
    };
    let copiedLink = '';
    $(document).ready(function(){

        copiedLink = '{{ route("movies.show", $movie["id"]) }}';
        $('#shareUrl').val(copiedLink);

        function copyToClipboard(element, btnElem) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).val()).select();
            document.execCommand("copy");
            $temp.remove();
            $(btnElem).html(`<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>`);
            setTimeout(() => {
                $(btnElem).html(`<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" style="stroke-width: 1;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" /></svg>`);
            }, 2000);
        }

        $('#shareBtn').bind('click', function(e) {
            $('#shareBox').show();
            e.preventDefault();
        });

        $('#closeBtn').bind('click', function(e) {
            $('#shareBox').hide();
            e.preventDefault();
        });

        $('#shareWithFb').click(function () {
            window.open("https://www.facebook.com/sharer/sharer.php?u=" + copiedLink, 'facebook-share-dialog', "width=626, height=436");
        });

        $('#shareWithTele').click(function () {
            window.open("https://telegram.me/share/url?url" + copiedLink);
        });

        $('#shareWithTwitter').click(function () {
            window.open("https://twitter.com/intent/tweet?url=" + copiedLink);
        });

        $('#copyBtn').bind('click', function(e) {
            copyToClipboard($(this).parent().find('input'), $(this));
            e.preventDefault();
        });

        $('#downBtn').bind('click', function(e) {
            $('#downBox').show();
            $('#downBox').css('display', 'table');
            e.preventDefault();
        });
        $('#closeDownBox').bind('click', function(e) {
            $('#downBox').hide();
            e.preventDefault();
        });

        $('.downloadBtn').bind('click', function(e) {
            let link = $(this).attr('data-downLink');
            location.href = link;
            e.preventDefault();
        })
    });
</script>
@endsection