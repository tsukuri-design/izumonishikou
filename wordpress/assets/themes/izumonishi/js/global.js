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



//new
document.addEventListener('DOMContentLoaded', function () {
    // ===== Mobile "opened_menu" (keep your phone markup as-is) =====
    const menuButton = document.querySelector('.menu_button');
    const closeButton = document.querySelector('.opened_menu .close, .close_button'); // support both
    const openedMenu = document.querySelector('.opened_menu');
    const itemLinks = document.querySelectorAll('.opened_menu .item a');

    if (menuButton && openedMenu) {
        const toggleMobileMenu = (force) => {
            const willShow = (typeof force === 'boolean') ? force : !openedMenu.classList.contains('is_show');
            openedMenu.classList.toggle('is_show', willShow);
            menuButton.classList.toggle('is_show', willShow);
            menuButton.classList.toggle('is_open', willShow);
            document.documentElement.classList.toggle('no-scroll', willShow);
        };

        menuButton.addEventListener('click', () => toggleMobileMenu());
        if (closeButton) closeButton.addEventListener('click', () => toggleMobileMenu(false));
        itemLinks.forEach(a => a.addEventListener('click', () => toggleMobileMenu(false)));
    }

    // ===== PC dropdowns (hover/focus) =====
    // Only enable for fine pointers (avoid fighting with touch)
    const prefersHover = window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    const modalButtons = document.querySelectorAll('.open_menu_modal');
    const modals = document.querySelectorAll('.modal_menu_links');

    // helper: close all dropdowns
    const closeAllDropdowns = () => {
        modals.forEach(m => m.classList.remove('is_show'));
        modalButtons.forEach(b => b.classList.remove('is_active'));
    };

    if (prefersHover && modalButtons.length && modals.length) {
        modalButtons.forEach(button => {
            const id = button.dataset.target;
            const modal = id ? document.getElementById(id) : null;
            if (!modal) return;

            // Hover open
            let hoverTimer;
            const open = () => {
                closeAllDropdowns();
                modal.classList.add('is_show');
                button.classList.add('is_active');
            };
            const scheduleCloseIfOutside = () => {
                clearTimeout(hoverTimer);
                hoverTimer = setTimeout(() => {
                    if (!button.matches(':hover') && !modal.matches(':hover')) {
                        modal.classList.remove('is_show');
                        button.classList.remove('is_active');
                    }
                }, 100);
            };

            button.addEventListener('mouseenter', open);
            modal.addEventListener('mouseenter', open);
            button.addEventListener('mouseleave', scheduleCloseIfOutside);
            modal.addEventListener('mouseleave', scheduleCloseIfOutside);

            // Keyboard focus support
            button.addEventListener('focus', open);
            modal.addEventListener('focusin', open);
        });

        // Click anywhere else closes
        document.addEventListener('click', (e) => {
            const inButton = e.target.closest('.open_menu_modal');
            const inModal = e.target.closest('.modal_menu_links');
            if (!inButton && !inModal) closeAllDropdowns();
        });

        // ESC closes
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeAllDropdowns();
        });
    }

    // ===== Quick Actions popup (PC) =====
    const quickBtn = document.querySelector('.quick_button');
    const quickPopup = document.getElementById('quick_actions_popup');
    const quickClose = quickPopup ? quickPopup.querySelector('.quick_close') : null;

    const setQuick = (show) => {
        if (!quickPopup || !quickBtn) return;
        quickPopup.classList.toggle('is_show', show);
        quickPopup.setAttribute('aria-hidden', show ? 'false' : 'true');
        quickBtn.setAttribute('aria-expanded', show ? 'true' : 'false');
        if (show) {
            // close dropdowns when quick opens
            closeAllDropdowns();
        }
    };

    if (quickBtn && quickPopup) {
        quickBtn.addEventListener('click', () => {
            setQuick(!quickPopup.classList.contains('is_show'));
        });
        if (quickClose) quickClose.addEventListener('click', () => setQuick(false));
        document.addEventListener('click', (e) => {
            if (!quickPopup.classList.contains('is_show')) return;
            const inPopup = e.target.closest('#quick_actions_popup');
            const inBtn = e.target.closest('.quick_button');
            if (!inPopup && !inBtn) setQuick(false);
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') setQuick(false);
        });
    }

    // ===== Minimize header on scroll (apply to .menu_top) =====
    const menuTop = document.querySelector('.menu_top');
    if (menuTop) {
        const onScroll = () => {
            if (window.scrollY > 50) menuTop.classList.add('is_minimized');
            else menuTop.classList.remove('is_minimized');
        };
        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll(); // initialize
    }

    // ===== Mobile sections accordion inside opened_menu =====
    const titleButtons = document.querySelectorAll('.menu_section .title .title_button');
    titleButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const title = btn.parentElement;
            const list = title ? title.nextElementSibling : null;
            title.classList.toggle('is_show');
            if (list && list.classList.contains('link_list')) {
                list.classList.toggle('is_show');
            }
        });
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const menuBtn = document.querySelector('.menu__button');
    const menuDesktop = document.querySelector('.opened_menu_desktop');
    if (!menuBtn || !menuDesktop) return;

    const toggleMenu = (open) => {
        const willOpen = (typeof open === 'boolean')
            ? open
            : !menuDesktop.classList.contains('is_show');

        menuDesktop.classList.toggle('is_show', willOpen);
        menuBtn.classList.toggle('is_open', willOpen);
        document.body.classList.toggle('menu_open', willOpen);
    };

    // Click / keyboard toggle
    menuBtn.addEventListener('click', () => toggleMenu());
    menuBtn.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            toggleMenu();
        }
    });

    // Close when clicking outside
    document.addEventListener('click', (e) => {
        if (
            menuDesktop.classList.contains('is_show') &&
            !menuDesktop.contains(e.target) &&
            !menuBtn.contains(e.target)
        ) {
            toggleMenu(false);
        }
    });

    // ESC key closes
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') toggleMenu(false);
    });
});
