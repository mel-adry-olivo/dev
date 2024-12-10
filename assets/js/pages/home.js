import initHeader from '../components/header.js';
import initCarousel from '../components/product-carousel.js';
import { initActionMenu } from '../components/action-menu.js';
import { initFavorites } from '../components/product.js';
import { hideLoader } from '../components/loader.js';
import { setSelectedFilter } from '../components/shop-toolbar.js';

window.onload = () => {
    initHeader();
    initActionMenu();
    initCarousel();
    initFavorites();
    hideLoader();
};
