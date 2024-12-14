import { addClass, removeClass } from '../utils/dom.js';

const pageOverlay = document.querySelector('.page-overlay-nav');
const nav = document.querySelector('.header__nav-list');
const header = document.querySelector('.header__wrapper');
let lastScrollY = 0;
let isScrolling = false;
const throttleDelay = 120; // ms

function initHeader() {
    window.addEventListener('resize', () => handleResize());

    header.addEventListener('click', (e) => {
        if (e.target.matches('.header__nav-button')) {
            toggleNav();
        }

        if (e.target.matches('.header__nav-close-button')) {
            toggleNav();
        }

        if (e.target.matches('.page-overlay-nav')) {
            toggleNav();
        }
    });

    window.addEventListener('scroll', () => {
        if (!isScrolling) {
            handleScroll();
            isScrolling = true;

            setTimeout(() => {
                isScrolling = false;
            }, throttleDelay);
        }
    });
}

function handleResize() {
    if (pageOverlay.classList.contains('show')) {
        toggleNav();
    }
}

function handleScroll() {
    const currentScroll = window.scrollY;

    currentScroll > lastScrollY
        ? addClass(header, 'hidden')
        : removeClass(header, 'hidden');

    lastScrollY = currentScroll;
}

function toggleNav() {
    nav.classList.toggle('show');
    pageOverlay.classList.toggle('show');
}

export default initHeader;
