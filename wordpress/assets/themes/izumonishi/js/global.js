// SmoothScroll初期化
document.addEventListener('DOMContentLoaded', function () {
    if (typeof SmoothScroll !== 'undefined') {
        var scroll = new SmoothScroll('a[href*="#"]', {
            speed: 800,
            speedAsDuration: true,
            easing: 'easeInOutCubic',
            offset: 80
        });
    }
});
