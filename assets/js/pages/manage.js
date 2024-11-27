import initHeader from '../components/header.js';
import { initActionMenu } from '../components/action-menu.js';

const searchbarContainer = document.querySelector('.content__searchbar');
const searchbar = document.querySelector('.content__searchbar input');
const productAddForm = document.querySelector('.product__add-form');
const contentAddButton = document.querySelector('.content__add-button');
const pageOverlay = document.querySelector('.add-product-overlay');
const productAddFormCancel = document.querySelector('.add__cancel');

window.onload = () => {
  initHeader();
  initActionMenu();
  initSearchbar();

  contentAddButton.addEventListener('click', () => {
    productAddForm.classList.add('show');
    pageOverlay.classList.add('show');
  });

  productAddFormCancel.addEventListener('click', () => {
    productAddForm.classList.remove('show');
    pageOverlay.classList.remove('show');
  });

  pageOverlay.addEventListener('click', (e) => {
    if (e.target === pageOverlay && productAddForm.classList.contains('show')) {
      productAddForm.classList.remove('show');
      pageOverlay.classList.remove('show');
    }
  });
};

function initSearchbar() {
  searchbarContainer.addEventListener('click', () => {
    searchbar.focus();
  });

  searchbar.addEventListener('input', () => {
    if (searchbar.value.trim() === '') {
      searchbarContainer.classList.remove('active');
    } else {
      searchbarContainer.classList.add('active');
    }
  });
}
