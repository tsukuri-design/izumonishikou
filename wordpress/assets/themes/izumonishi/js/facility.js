jQuery(document).ready(function ($) {
    $('.facility-slide-wrap').each(function () {
        const $wrap = $(this);
        const $slider = $wrap.find('.facility-slide');
        const $nextArrow = $wrap.find('.arrow');

        $slider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            fade: true,              // fade between images
            speed: 800,              // fade duration
            autoplay: false,          // auto cycle
            autoplaySpeed: 4000,     // time each slide is shown
            arrows: true,
            prevArrow: null,         // disable prev
            nextArrow: $nextArrow    // use .arrow div as next
        });
    });
});
