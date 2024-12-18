import { addClass, removeClass } from '../utils/dom.js';

const pageOverlay = document.querySelector('.page-overlay-nav');
const nav = document.querySelector('.header__nav-list');
const header = document.querySelector('.header__wrapper');

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
    nav.classList.toggle('show');
    pageOverlay.classList.toggle('show');
}

export default initHeader;
