<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.green.min.css" />

<div class="container mx-auto px-4 pt-8">
    <div class="owl-carousel owl-theme mt-5">
        @foreach ($movies as $movie)
        <a href="{{ route('movies.show', $movie['id'] )}}">
            <div style="background-image: url({{$movie['poster_path']}}); height: 20rem;">
                <script>
                    jQuery(document).ready(function($) {
                        $('.owl-carousel').owlCarousel({
                            loop: true,
                            margin: 10,
                            autoplay: true,
                            autoplaySpeed: 500,
                            autoplayHoverPause:true,
                            autoplayTimeout: 1000,
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
            </div>
            <span>{{ $movie['title'] }}</span>
        </a>
        @endforeach
    </div>
</div>