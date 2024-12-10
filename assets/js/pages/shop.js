import initHeader from '../components/header.js';
import initFilter from '../components/shop-toolbar.js';
import { initActionMenu } from '../components/action-menu.js';
import { initFavorites } from '../components/product.js';

window.onload = () => {
    initHeader();
    initActionMenu();
    initFilter();
    initFavorites();
};
