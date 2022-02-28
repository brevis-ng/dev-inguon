<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phim Hay | Phim HD Vietsub | Xem Phim Online | Xem Phim Nhanh | 3X Phim - 3X TV</title>

    <link rel="stylesheet" href="/css/main.css">
    <livewire:styles>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <!-- Google font for error page -->
    <link href="https://fonts.googleapis.com/css?family=Fredoka+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
</head>
<body class="font-sans bg-gray-900 text-white">
    @include('layouts.header')
    @yield('content')
    <footer class="border border-t border-gray-800">
        <div class="container mx-auto text-sm px-4 py-6">
            <span>Nguồn phim do <a href="http://inguon.com/" class="underline hover:text-gray-300">inguon</a> cung cấp.</span>
        </div>
        <div class="container mx-auto text-sm px-4 py-6">
            <span>Mọi chi tiết liên hệ </span>
            <a href="https://telegram.me/brevis_ng">Brevis</a>
        </div>
    </footer>
    <livewire:scripts>
    @yield('scripts')
</body>
</html>
