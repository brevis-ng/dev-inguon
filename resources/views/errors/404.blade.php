@extends('layouts.main')

<style>
    * {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
    }

    #notfound {
        position: relative;
        height: 100vh;
    }

    #notfound .notfound {
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }

    .notfound {
        max-width: 710px;
        width: 100%;
        text-align: center;
        padding: 0px 15px;
        line-height: 1.4;
    }

    .notfound .notfound-404 {
        height: 200px;
        line-height: 200px;
    }

    .notfound .notfound-404 h1 {
        font-family: 'Fredoka One', cursive;
        font-size: 168px;
        margin: 0px;
        color: #ff508e;
        text-transform: uppercase;
    }

    .notfound h2 {
        font-family: 'Raleway', sans-serif;
        font-size: 22px;
        font-weight: 400;
        text-transform: uppercase;
        color: #222;
        margin: 0;
    }

    .notfound a {
        font-family: 'Raleway', sans-serif;
        display: inline-block;
        font-weight: 700;
        border-radius: 15px;
        text-decoration: none;
        color: #39b1cb;
    }

    .notfound a>.arrow {
        position: relative;
        top: -2px;
        border: solid #39b1cb;
        border-width: 0 3px 3px 0;
        display: inline-block;
        padding: 3px;
        -webkit-transform: rotate(135deg);
        -ms-transform: rotate(135deg);
        transform: rotate(135deg);
    }

    @media only screen and (max-width: 767px) {
        .notfound .notfound-404 {
            height: 122px;
            line-height: 122px;
        }
        .notfound .notfound-404 h1 {
            font-size: 122px;
        }
    }

</style>

@section('content')

<div id="notfound" style="z-index: -1;">
    <div class="notfound">
        <div class="notfound-404">
            <h1>404</h1>
        </div>
        <h2>Oops, Trang bạn đang tìm hiện không có!</h2>
        <br>
        <a href="#"><span class="arrow"></span>Trở Về Trang Chủ</a>
    </div>
</div>

@endsection
