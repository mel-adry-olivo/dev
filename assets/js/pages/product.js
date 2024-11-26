import initHeader from '../components/header.js';
import initCarousel from '../components/product-carousel.js';
import { initActionMenu } from '../components/action-menu.js';
import { initFavorites, initBag } from '../components/product.js';
import { initReview } from './review.js';

window.onload = () => {
  initHeader();
  initCarousel();
  initActionMenu();
  initFavorites();
  initBag();
  initReview();
};
