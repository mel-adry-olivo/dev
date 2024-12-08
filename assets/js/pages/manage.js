import initHeader from '../components/header.js';
import { initActionMenu } from '../components/action-menu.js';

const searchbarContainer = document.querySelector('.content__searchbar');
const searchbar = document.querySelector('.content__searchbar input');
const productAddForm = document.querySelector('.product__add-form');
const contentAddButton = document.querySelector('.content__add-button');
const pageOverlay = document.querySelector('.add-product-overlay');
const productAddFormCancel = document.querySelector('.add__cancel');
const productSelect = document.querySelectorAll('.product-select');
const imageChooser1 = document.querySelector('#product-image');
const imageChooser2 = document.querySelector('#product-image2');
const imageContainer1 = document.querySelector('.image-main-container');
const imageContainer2 = document.querySelector('.image-secondary-container');
const body = document.body;

window.onload = () => {
  initHeader();
  initActionMenu();
  initSearchbar();

  productSelect.forEach((select) => {
    select.addEventListener('change', () => {
      const input = select.dataset.input;
      const newInput = document.querySelector(`.${input}`);

      if (select.value === 'new') {
        newInput.classList.add('show');
      } else {
        newInput.classList.remove('show');
      }
    });
  });

  contentAddButton.addEventListener('click', () => {
    productAddForm.classList.add('show');
    pageOverlay.classList.add('show');
    body.classList.add('no-scroll');
  });

  productAddFormCancel.addEventListener('click', () => {
    productAddForm.classList.remove('show');
    pageOverlay.classList.remove('show');
    imageContainer1.innerHTML = '';
    imageContainer2.innerHTML = '';
    imageChooser1.value = '';
    imageChooser2.value = '';
    body.classList.remove('no-scroll');
  });

  pageOverlay.addEventListener('click', (e) => {
    if (e.target === pageOverlay && productAddForm.classList.contains('show')) {
      productAddForm.classList.remove('show');
      pageOverlay.classList.remove('show');
      imageContainer1.innerHTML = '';
      imageContainer2.innerHTML = '';
      imageChooser1.value = '';
      imageChooser2.value = '';
      body.classList.remove('no-scroll');
    }
  });

  imageChooser1.addEventListener('change', () => {
    const file = imageChooser1.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', () => {
      const image = new Image();
      image.src = reader.result;
      imageContainer1.innerHTML = '';
      imageContainer1.appendChild(image);
    });

    reader.readAsDataURL(file);
  });

  imageChooser2.addEventListener('change', () => {
    const file = imageChooser2.files[0];
    const reader = new FileReader();

    reader.addEventListener('load', () => {
      const image = new Image();
      image.src = reader.result;
      imageContainer2.innerHTML = '';
      imageContainer2.appendChild(image);
    });

    reader.readAsDataURL(file);
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
