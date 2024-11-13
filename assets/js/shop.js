import initHeader from './components/header.js';
import initActionMenu from './components/action-menu.js';
import initFilter from './components/shop-toolbar.js';
import initProductCard from './components/product-card.js';

window.onload = () => {
  initHeader();
  initActionMenu();
  initFilter();
  initProductCard();
};
