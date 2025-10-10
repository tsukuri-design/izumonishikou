// --------------------------------------------------------------
// Humberger and Opened Menu
// --------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function () {
    const menu_btn = document.querySelector('.menu_btn');
    const close_btn = document.querySelector('.close_btn');
    const opened_menu = document.querySelector('.opened_menu');
    const opened_nav_anchor = document.querySelectorAll('.opened_menu a');
    menu_btn.addEventListener('click', function () {
        opened_menu.classList.toggle('show');
        menu_btn.classList.toggle('hide');
    });
    close_btn.addEventListener('click', function () {
        opened_menu.classList.toggle('show');
        menu_btn.classList.toggle('hide');
    });

    for (let i = 0; i < opened_nav_anchor.length; i++) {
        opened_nav_anchor[i].addEventListener('click', function () {
            opened_menu.classList.toggle('show');
            menu_btn.classList.toggle('hide');
        });
    }

});

/**
 * Fixed menu
 * Fixed buttons (SP)
 **/
window.onscroll = function () {
    const fix_menu = document.querySelector('.fixed_menu');
    const fixed_buttons = document.querySelectorAll('.fixed_buttons');
    const menu_btn = document.querySelector('.menu_btn');
    var window_scroll = document.body.scrollTop || document.documentElement.scrollTop;
    if (window_scroll >= 1300) {
        fix_menu.classList.add('show');
    } else {
        fix_menu.classList.remove('show');
    }
    if (window_scroll >= 500) {
        menu_btn.classList.add('show');
    } else {
        menu_btn.classList.remove('show');
    }

    /** Fixed buttons **/
    for (i = 0; i < fixed_buttons.length; ++i) {
        if (window_scroll >= 1300) {
            fixed_buttons[i].classList.add('show');
        } if (window.scrollY > 211.5 && window.innerHeight + window.scrollY < document.body.clientHeight - 900) {
            fixed_buttons[i].classList.add('show');
        } else {
            fixed_buttons[i].classList.remove('show');
        }
    }
}