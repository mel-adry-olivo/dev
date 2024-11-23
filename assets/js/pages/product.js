import initHeader from '../components/header.js';
import initCarousel from '../components/product-carousel.js';
import { initActionMenu } from '../components/action-menu.js';
import { initFavorites } from '../components/product.js';

window.onload = () => {
  initHeader();
  initCarousel();
  initActionMenu();
  initFavorites();

  const addToBagButton = document.querySelector('.product__add-button');
  addToBagButton.addEventListener('click', () => {
    addToBagButton.classList.toggle('active');
    setTimeout(() => {
      window.location.href = './summary.php';
    }, 1000);
  });
};
