import initHeader from '../components/header.js';
import initCarousel from '../components/product-carousel.js';
import { initActionMenu } from '../components/action-menu.js';
import { initFavorites } from '../components/product.js';
import { showSnackbar } from '../components/snackbar.js';

window.onload = () => {
  initHeader();
  initActionMenu();
  initCarousel();
  initFavorites();

  const loaderContainer = document.querySelector('.loader-container');
  loaderContainer.classList.add('hidden');
};
