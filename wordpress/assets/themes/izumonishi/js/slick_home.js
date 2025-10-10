jQuery(function ($) {
    $('.firstview').each(function () {
        const $wrap = $(this);
        const $slider = $wrap.find('.firstview__slider');

        // find/create the dots container inside the same .firstview
        let $dots = $wrap.find('.slick_dots');
        if (!$dots.length) {
            $dots = $('<div class="slick_dots"></div>').appendTo($wrap);
        }

        // bind once before init
        $slider.on('init', function () {
            $wrap.addClass('is-show');
        });

        $slider.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            fade: true,
            arrows: false,
            dots: false,
            appendDots: $dots.get(0),
            autoplay: true,
            autoplaySpeed: 5000,
            speed: 2000,
            cssEase: 'ease',
            pauseOnHover: false,
        });

        // fallback: force class after 2s in case init didn’t fire
        setTimeout(() => {
            $wrap.addClass('is-show');
        }, 2000);
    });
});

// $('.banner_slide').slick({
//     autoplay: false,
//     arrows: true,
//     dots: false,
//     infinite: false,
//     // speed: 1000,
//     autoplaySpeed: 0,
//     centerMode: true,
//     fade: false,
//     lazyLoad: 'progressive',
//     pauseOnHover: false,
//     variableWidth: true,
//     touchThreshold: 15,
//     prevArrow: $('.banner_arrow_left'),
//     nextArrow: $('.banner_arrow_right'),
//     // responsive: [
//     //     {
//     //         breakpoint: 768, // Disable on smartphones
//     //         settings: "unslick"
//     //     }
//     // ]
// });

$('.topics__posts').slick({
    autoplay: false,
    arrows: true,
    dots: true,
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    // speed: 1000,
    autoplaySpeed: 0,
    fade: false,
    lazyLoad: 'progressive',
    pauseOnHover: false,
    appendDots: $('.topics__dots'),
    variableWidth: true,
    touchThreshold: 15,
    prevArrow: $('.topics__arrow--left'),
    nextArrow: $('.topics__arrow--right'),
    responsive: [
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

document.addEventListener("DOMContentLoaded", () => {
    const textItems = document.querySelectorAll('.section__what .section__what-text_wrap .section__what-text_item');
    const images = document.querySelectorAll('.section__what .section__what-image_wrap .section__what-image');

    // Optional: ensure first image is active at load
    images.forEach(img => img.classList.remove('active'));
    if (images[0]) images[0].classList.add('active');

    // Helper to get the image corresponding to a text item index
    function setActiveImage(idx) {
        images.forEach(img => img.classList.remove('active'));
        if (images[idx]) images[idx].classList.add('active');
    }

    // Use IntersectionObserver to trigger when text item is near center
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const idx = Array.from(textItems).indexOf(entry.target);
                if (idx > 0) { // Only start changing from the second item
                    setActiveImage(idx);
                } else {
                    setActiveImage(0);
                }
            }
        });
    }, {
        root: null, // viewport
        threshold: 0.5, // 50% visible (tweak as needed)
        rootMargin: "-30% 0px -30% 0px" // triggers closer to center
    });

    textItems.forEach(item => observer.observe(item));
});
