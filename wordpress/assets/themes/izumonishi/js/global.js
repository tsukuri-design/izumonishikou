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


//menu
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.menu_section .title .title_button').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();

            const section = btn.closest('.menu_section');

            // Find a direct child `.link_list` OR a `.link_list` inside a direct child <li>
            const list = section.querySelector(':scope > .link_list, :scope > li > .link_list');

            section.classList.toggle('is_show');
            if (list) list.classList.toggle('is_show');
        });
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const menuButton = document.querySelector('.menu_button');
    const openedMenu = document.querySelector('.opened_menu');
    const closeButton = document.querySelector('.opened_menu .close, .opened_menu .close_button');

    if (menuButton && openedMenu) {
        menuButton.addEventListener('click', (e) => {
            e.preventDefault();
            openedMenu.classList.add('is-show');
        });
    }

    if (closeButton && openedMenu) {
        closeButton.addEventListener('click', (e) => {
            e.preventDefault();
            openedMenu.classList.remove('is-show');
        });
    }
});
