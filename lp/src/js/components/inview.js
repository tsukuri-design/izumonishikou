

// loading
document.addEventListener('DOMContentLoaded', function (ev) {
    window.addEventListener('load', finishLoad);
    setTimeout(finishLoad(), 3000);
    function finishLoad() {
        let contentCov = document.querySelector('.body_inner');
        contentCov.classList.add('is-show');
    }

    // firstin
    setTimeout(function () {
        var elementFirstin = document.getElementsByClassName('firstin');
        for (var i = 0; i < elementFirstin.length; i++) {
            elementFirstin[i].classList.add('show');
        }
        // body 
        document.getElementsByTagName('body')[0].classList.add('loading-delay');
    }, 500);

}, false);

// --------------------------------------------------------------
// inview
// --------------------------------------------------------------

function showElementAnimation() {
    let element = document.getElementsByClassName('inaction');
    if (!element) return;
    let sp_switch_width = window.innerWidth > 768 ? 100 : 30; // pc:sp
    let showTiming = sp_switch_width;
    let scrollY = window.pageYOffset;
    let windowH = window.innerHeight;
    for (let i = 0; i < element.length; i++) {
        let elemClientRect = element[i].getBoundingClientRect();
        let elemY = scrollY + elemClientRect.top;
        if (scrollY + windowH - showTiming > elemY) {
            element[i].classList.add('show');
        }
    }
}
showElementAnimation();
window.addEventListener('scroll', showElementAnimation);
// Smooth Scroll
var scroll = new SmoothScroll('a[href*="#"]', {
    speed: 1200,
    speedAsDuration: true,
    easing: 'easeInOutQuint',
    offset: 50,
});