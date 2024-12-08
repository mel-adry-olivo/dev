import initHeader from '../components/header.js';
import { initActionMenu } from '../components/action-menu.js';
import { showSnackbar } from '../components/snackbar.js';
import { showConfirmDialog, hideConfirmDialog } from '../components/confirm-dialog.js';

const productAddForm = document.querySelector('.product__add-form');
const contentAddButton = document.querySelector('.content__add-button');
const pageOverlay = document.querySelector('.add-product-overlay');
const productAddFormCancel = document.querySelector('.add__cancel');
const formSubmitButton = document.querySelector('.add__submit');
const productEdit = document.querySelectorAll('.product__edit');
const productDelete = document.querySelectorAll('.product__delete');

const productNameInput = document.querySelector('input[name="product-name"]');
const productPriceInput = document.querySelector('input[name="product-price"]');
const productStockQuantityInput = document.querySelector('input[name="product-stock-quantity"]');
const productLensWidth = document.querySelector('input[name="product-lens-width"]');
const productBridgeWidth = document.querySelector('input[name="product-bridge-width"]');
const productTempleLength = document.querySelector('input[name="product-temple-length"]');
const productType = document.querySelector('select[name="product-type"]');

const productFrameTypePA = document.querySelector('input[name="product-frame-type-pa"]');
const productFrameType = document.querySelector('select[name="product-frame-type"]');

const productGenderPA = document.querySelector('input[name="product-gender-pa"]');
const productGender = document.querySelector('select[name="product-gender"]');

const productBrand = document.querySelector('select[name="product-brand"]');
const productBrandInput = document.querySelector('input[name="product-brand-input"]');

const productColorPA = document.querySelector('input[name="product-color-pa"]');
const productColor = document.querySelector('select[name="product-color"]');
const productColorInput = document.querySelector('input[name="product-color-input"]');

const productMaterialPA = document.querySelector('input[name="product-material-pa"]');
const productMaterial = document.querySelector('select[name="product-material"]');
const productMaterialInput = document.querySelector('input[name="product-material-input"]');

const productShapePA = document.querySelector('input[name="product-shape-pa"]');
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

  productAddForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const isEditMode = productAddForm.action.includes('edit.php');

    if (!isEditMode || imageChooser1.files.length > 0) {
      if (!validateInput(imageChooser1, 'Please upload the main image', () => imageChooser1.files.length > 0)) return;
    }

    if (!isEditMode || imageChooser2.files.length > 0) {
      if (!validateInput(imageChooser2, 'Please upload the secondary image', () => imageChooser2.files.length > 0)) return;
    }

    if (!validateInput(productStockQuantityInput, 'Please enter a valid stock quantity', (val) => val.trim() !== '' && val >= 0)) return;
    if (!validateInput(productNameInput, 'Please enter a product name', (val) => val.trim() !== '')) return;
    if (!validateInput(productPriceInput, 'Please enter a valid product price', (val) => val.trim() !== '' && val >= 0)) return;
    if (!validateInput(productLensWidth, 'Please enter a valid lens width', (val) => val.trim() !== '' && val >= 0)) return;
    if (!validateInput(productBridgeWidth, 'Please enter a valid bridge width', (val) => val.trim() !== '' && val >= 0)) return;
    if (!validateInput(productTempleLength, 'Please enter a valid temple length', (val) => val.trim() !== '' && val >= 0)) return;

    if (productBrand.value === 'new' && !validateInput(productBrandInput, 'Please enter a brand', (val) => val.trim() !== '')) return;
    if (productColor.value === 'new' && !validateInput(productColorInput, 'Please enter a color', (val) => val.trim() !== '')) return;
    if (productMaterial.value === 'new' && !validateInput(productMaterialInput, 'Please enter a material', (val) => val.trim() !== ''))
      return;
    if (productShape.value === 'new' && !validateInput(productShapeInput, 'Please enter a shape', (val) => val.trim() !== '')) return;

    hideAddForm();
    if (!isEditMode) {
      showConfirmDialog('Are you sure to add this product?', (confirmed) => {
        if (confirmed) {
          productAddForm.submit();
        } else {
          hideConfirmDialog();
          showAddForm();
        }
      });
    } else {
      showConfirmDialog('Are you sure to save this product?', (confirmed) => {
        if (confirmed) {
          productAddForm.submit();
        } else {
          hideConfirmDialog();
          showAddForm();
        }
      });
    }
  });

  productEdit.forEach((edit) => {
    edit.addEventListener('click', () => {
      const productId = edit.dataset.id;
      showEditForm(productId);
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

  productDelete.forEach((deleteButton) => {
    deleteButton.addEventListener('click', () => {
      const productId = deleteButton.dataset.id;
      showConfirmDialog('Are you sure to delete this product?', (confirmed) => {
        if (confirmed) {
          deleteProduct(productId);
          showSnackbar('Product deleted successfully');
        } else {
          hideConfirmDialog();
        }
      });
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

async function showEditForm(productId) {
  const response = await fetch(`./handlers/products/product.php?id=${productId}`);
  const product = await response.json();
  console.log(product);
  populateForm(product);
  showAddForm('edit', productId);
}

async function deleteProduct(productId) {
  window.location.href = `./handlers/products/delete.php?id=${productId}  `;
}

function populateForm(product) {
  productNameInput.value = product.name;
  productPriceInput.value = product.price;
  productStockQuantityInput.value = product.stock_quantity;
  productLensWidth.value = product.lens_width;
  productBridgeWidth.value = product.bridge_width;
  productTempleLength.value = product.temple_length;

  productGenderPA.value = product.Gender.pa_id;
  productColorPA.value = product.Color.pa_id;
  productMaterialPA.value = product.Material.pa_id;
  productShapePA.value = product.Shape.pa_id;
  productFrameTypePA.value = product['Frame Type'].pa_id;

  setSelectedOption(productType, product.type);
  setSelectedOption(productBrand, product.brand);
  setSelectedOption(productGender, product.Gender);
  setSelectedOption(productColor, product.Color);
  setSelectedOption(productMaterial, product.Material);
  setSelectedOption(productShape, product.Shape);
  setSelectedOption(productFrameType, product['Frame Type']);

  if (product.image_main) {
    const mainImage = new Image();
    mainImage.src = product.image_main;
    imageContainer1.innerHTML = '';
    imageContainer1.appendChild(mainImage);
  }

  if (product.image_alternate) {
    const alternateImage = new Image();
    alternateImage.src = product.image_alternate;
    imageContainer2.innerHTML = '';
    imageContainer2.appendChild(alternateImage);
  }
}

function setSelectedOption(select, value) {
  const options = Array.from(select.options);
  options.forEach((option) => {
    if (option.textContent.toLowerCase() === (value.name || value).toLowerCase()) {
      select.selectedIndex = options.indexOf(option);
    }
  });
}

function showAddForm(op = 'add', productId = null) {
  productAddForm.classList.add('show');
  pageOverlay.classList.add('show');
  body.classList.add('no-scroll');
  if (op === 'add') {
    productAddForm.action = './handlers/products/add.php';
    formSubmitButton.textContent = 'Add Product';
  } else if (op === 'edit') {
    productAddForm.action = `./handlers/products/edit.php?id=${productId}`;
    formSubmitButton.textContent = 'Save Product';
  }
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
  formSubmitButton.textContent = 'Add Product';
  productAddForm.action = './handlers/products/add.php';
  productGenderPA.value = '';
  productColorPA.value = '';
  productMaterialPA.value = '';
  productShapePA.value = '';
  productFrameTypePA.value = '';
}

function validateInput(input, message, condition) {
  if (!condition(input.value)) {
    showSnackbar(message);
    return false;
  }
  return true;
}
