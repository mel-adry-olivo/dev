import initHeader from '../components/header.js';
import { initActionMenu } from '../components/action-menu.js';
import { showSnackbar } from '../components/snackbar.js';
import { showConfirmDialog, hideConfirmDialog } from '../components/confirm-dialog.js';

const searchbarContainer = document.querySelector('.content__searchbar');
const searchbar = document.querySelector('.content__searchbar input');
const productAddForm = document.querySelector('.product__add-form');
const contentAddButton = document.querySelector('.content__add-button');
const pageOverlay = document.querySelector('.add-product-overlay');
const productAddFormCancel = document.querySelector('.add__cancel');
const productSubmit = document.querySelector('.add__submit');

const productNameInput = document.querySelector('input[name="product-name"]');
const productPriceInput = document.querySelector('input[name="product-price"]');
const productLensWidth = document.querySelector('input[name="product-lens-width"]');
const productBridgeWidth = document.querySelector('input[name="product-bridge-width"]');
const productTempleLength = document.querySelector('input[name="product-temple-length"]');

const productColor = document.querySelector('select[name="product-color"]');
const productColorInput = document.querySelector('input[name="product-color-input"]');

const productMaterial = document.querySelector('select[name="product-material"]');
const productMaterialInput = document.querySelector('input[name="product-material-input"]');

const productShape = document.querySelector('select[name="product-shape"]');
const productShapeInput = document.querySelector('input[name="product-shape-input"]');

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

  productAddForm.addEventListener('submit', (e) => {
    e.preventDefault();
    console.log('Form submission prevented');

    if (!validateInput(imageChooser1, 'Please upload the main image', () => imageChooser1.files.length > 0)) return;
    if (!validateInput(imageChooser2, 'Please upload the secondary image', () => imageChooser2.files.length > 0)) return;
    if (!validateInput(productNameInput, 'Please enter a product name', (val) => val.trim() !== '')) return;
    if (!validateInput(productPriceInput, 'Please enter a valid product price', (val) => val.trim() !== '' && val >= 0)) return;
    if (!validateInput(productLensWidth, 'Please enter a valid lens width', (val) => val.trim() !== '' && val >= 0)) return;
    if (!validateInput(productBridgeWidth, 'Please enter a valid bridge width', (val) => val.trim() !== '' && val >= 0)) return;
    if (!validateInput(productTempleLength, 'Please enter a valid temple length', (val) => val.trim() !== '' && val >= 0)) return;

    if (productColor.value === 'new' && !validateInput(productColorInput, 'Please enter a color', (val) => val.trim() !== '')) return;
    if (productMaterial.value === 'new' && !validateInput(productMaterialInput, 'Please enter a material', (val) => val.trim() !== ''))
      return;
    if (productShape.value === 'new' && !validateInput(productShapeInput, 'Please enter a shape', (val) => val.trim() !== '')) return;

    hideAddForm();
    showConfirmDialog('Are you sure to add this product?', (confirmed) => {
      console.log('User confirmed:', confirmed);
      if (confirmed) {
        console.log('Submitting form...');
        productAddForm.submit();
      } else {
        console.log('Form submission canceled by user.');
        hideConfirmDialog();
        showAddForm();
      }
    });
  });

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

  contentAddButton.addEventListener('click', () => showAddForm());

  productAddFormCancel.addEventListener('click', () => {
    hideAddForm();
    resetForm();
  });

  pageOverlay.addEventListener('click', (e) => {
    if (e.target === pageOverlay && productAddForm.classList.contains('show')) {
      hideAddForm();
      resetForm();
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

function showAddForm() {
  productAddForm.classList.add('show');
  pageOverlay.classList.add('show');
  body.classList.add('no-scroll');
}

function hideAddForm() {
  productAddForm.classList.remove('show');
  pageOverlay.classList.remove('show');
  body.classList.remove('no-scroll');
}

function resetForm() {
  productAddForm.reset();
  imageContainer1.innerHTML = '';
  imageContainer2.innerHTML = '';
  imageChooser1.value = '';
  imageChooser2.value = '';
}

function validateInput(input, message, condition) {
  if (!condition(input.value)) {
    showSnackbar(message);
    return false;
  }
  return true;
}
