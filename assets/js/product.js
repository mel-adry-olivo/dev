import initHeader from './components/header.js';
import initActionMenu from './components/action-menu.js';
import initCarousel from './components/product-carousel.js';
import productCard from './components/product-card.js';

window.onload = () => {
  initHeader();
  initCarousel();
  initActionMenu();
  productCard.initProductCard();
};
