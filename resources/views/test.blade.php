<!DOCTYPE html>
<html>
    <head>
        <link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
    
      <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
      <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
    </head>

    <style>
        .container {
            max-width: 1280px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            align-items: center;
        }
    </style>

    <body>
        <h1>{{ $url }}</h1>
        <div class="container">
            <div style="margin-left: auto; margin-right: auto;" >
                <video
                    id="my-video"
                    class="video-js"
                    controls
                    preload="auto"
                    poster="https://pic.qzbocheng.com/upload/vod/20220109-1/1856583b96f0a166b09771a5ee866783.jpg"
                    data-setup="{}"
                >
                    <source src="{{ $url }}" type="application/x-mpegURL"/>
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank">
                            supports HTML5 video
                        </a>
                    </p>
                </video>
                <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
            </div>
        </div>
    </body>
</html>