<style>
    .owl-prev,
    .owl-next {
        width: 15px;
        height: 100px;
        position: absolute;
        top: 40%;
        transform: translateY(-50%);
        display: block !important;
        border: 0px solid black;
    }

    .owl-prev {
        float: left;
        left: 5px;
    }

    .owl-carousel .owl-nav button.owl-next,
    .owl-carousel .owl-nav button.owl-prev,
    .owl-carousel button.owl-dot {
        width: auto;
        height: auto;
    }

    .owl-next {
        float: right;
        right: 10px;
    }

    .owl-carousel .item {
        height: 20rem;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" />

<div class="container mx-auto px-4 pt-16">
    <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">PHIM ĐỀ CỬ
    </h2>
    <div class="owl-carousel owl-theme mt-5">
        @foreach ($movies as $movie)
        <a href="{{ route('movies.show', $movie['id']) }}">
            <div class="item" style="background-image: url({{$movie['poster_path']}})">
                <script>
                    jQuery(document).ready(function($) {
                        $('.owl-carousel').owlCarousel({
                            loop: true,
                            margin: 10,
                            nav: true,
                            navText: ['<i class="fa fa-step-backward"></i>', '<i class="fa fa-step-forward" aria-hidden="true"></i>'],
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 3
                                },
                                1000: {
                                    items: 5
                                }
                            }
                        })
                    })
                </script>
            </div>
            <span>{{ $movie['title'] }}</span>
        </a>
        @endforeach
    </div>
</div>