import { element, toggleClass } from '../utils/dom.js';

const pageOverlay = element('.page-overlay-nav');
const nav = element('.header__nav-list');
const header = element('.header__wrapper');

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
}

function handleResize() {
    if (pageOverlay.classList.contains('show')) {
        toggleNav();
    }
}

function toggleNav() {
    toggleClass(nav, 'show');
    toggleClass(pageOverlay, 'show');
}

export default initHeader;
