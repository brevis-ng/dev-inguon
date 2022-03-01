
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<div class="container mx-auto px-4">
    <div class="owl-carousel owl-theme mt-5 text-center">
        @foreach ($hightlightMovies as $movie)
        <a href="{{ route('movies.show', $movie['id'] )}}" class="text-center justify-center">
            <img class="px-2 bg-loacal h-[300px]" src="{{$movie['poster_path']}}">
            <script>
                jQuery(document).ready(function($) {
                    $('.owl-carousel').owlCarousel({
                        loop: true,
                        autoplay: true,
                        autoplaySpeed: 200,
                        autoplayHoverPause: true,
                        autoplayTimeout: 1500,
                        slideTransition: 'linear',
                        dots: false,
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
            </img>
            <span class="mx-auto">{{ $movie['title'] }}</span>
        </a>
        @endforeach
    </div>
</div>