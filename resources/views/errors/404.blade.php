@extends('layouts.main')

@section('content')

    <div class="container mx-auto relative h-full text-center">
        <div class="inset-x-2/4 w-full text-center px-0 py-4">
            <div class="h-56">
                <h1 style="font-size: 168px; color: #ff508e; font-family: 'Fredoka One', cursive;">404</h1>
            </div>
            <h2 style="font-family: 'Raleway', sans-serif;font-size: 22px;font-weight: 400;margin: 0;text-transform: uppercase;">Oops, Trang bạn đang tìm hiện không có!</h2>
            <br>
            <a href="{{ route('movies.index') }}" class="inline-block font-thin rounded-lg"
                style="font-family: 'Raleway', sans-serif;font-weight: 700;color: #39b1cb;">Trở Về Trang Chủ</a>
        </div>
    </div>

@endsection