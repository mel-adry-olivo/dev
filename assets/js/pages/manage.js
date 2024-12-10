import initHeader from '../components/header.js';
import { initActionMenu } from '../components/action-menu.js';
import { showSnackbar } from '../components/snackbar.js';
import {
    showConfirmDialog,
    hideConfirmDialog,
} from '../components/confirm-dialog.js';
import * as validate from '../utils/validate.js';
import * as fetch from '../services/fetch.js';
import {
    element,
    setSelectedOption,
    showForm,
    hideForm,
} from '../utils/dom.js';

const pageOverlay = element('.add-product-overlay');
const productForm = element('.product__add-form');
const productFormCancel = element('.add__cancel');
const productFormSubmit = element('.add__submit');
const productAddButton = element('.content__add-button');
const productDeleteForm = element('.product__delete-form');
const productEditButtons = element('.product__edit');

const productNameInput = element('[name="product-name"]');
const productPriceInput = element('[name="product-price"]');
const productStockQuantityInput = element('[name="product-stock-quantity"]');
const productLensWidth = element('[name="product-lens-width"]');
const productBridgeWidth = element('[name="product-bridge-width"]');
const productTempleLength = element('[name="product-temple-length"]');
const productType = element('select[name="product-type"]');

const productFrameTypePA = element('[name="product-frame-type-pa"]');
const productFrameType = element('select[name="product-frame-type"]');

const productGenderPA = element('[name="product-gender-pa"]');
const productGender = element('select[name="product-gender"]');

const productBrand = element('[name="product-brand"]');
const productBrandInput = element('[name="product-brand-input"]');

const productColorPA = element('[name="product-color-pa"]');
const productColor = element('[name="product-color"]');
const productColorInput = element('[name="product-color-input"]');

const productMaterialPA = element('[name="product-material-pa"]');
const productMaterial = element('[name="product-material"]');
const productMaterialInput = element('[name="product-material-input"]');

const productShapePA = element('[name="product-shape-pa"]');
const productShape = element('[name="product-shape"]');
const productShapeInput = element('[name="product-shape-input"]');

const productSelect = element('.product-select');
const imageChooser1 = element('#product-image');
const imageChooser2 = element('#product-image2');
const imageContainer1 = element('.image-main-container');
const imageContainer2 = element('.image-secondary-container');
const body = document.body;

const numberInputs = [
    productPriceInput,
    productStockQuantityInput,
    productLensWidth,
    productBridgeWidth,
    productTempleLength,
];
const conditionalInputs = [
    { select: productBrand, input: productBrandInput },
    { select: productColor, input: productColorInput },
    { select: productMaterial, input: productMaterialInput },
    { select: productShape, input: productShapeInput },
];

window.onload = () => {
    initHeader();
    initActionMenu();

    productForm.addEventListener('submit', handleSubmit);

    productEditButtons.forEach((edit) => {
        edit.addEventListener('click', () => {
            const productId = edit.dataset.id;
            showEditForm(productId);
        });
    });

    productSelect.forEach((select) => {
        select.addEventListener('change', () => {
            const input = select.dataset.input;
            const newInput = element(`.${input}`);

            if (select.value === 'new') {
                newInput.classList.add('show');
            } else {
                newInput.classList.remove('show');
            }
        });
    });

    productDeleteForm.forEach((form) => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            showConfirmDialog(
                'Are you sure to delete this product?',
                (confirmed) => {
                    if (confirmed) {
                        form.submit();
                        showSnackbar('Product deleted successfully');
                    } else {
                        hideConfirmDialog();
                    }
                },
            );
        });
    });

    productAddButton.addEventListener('click', () => showAddForm());

    productFormCancel.addEventListener('click', () => {
        hideForm(productForm, pageOverlay);
        resetForm();
    });

    pageOverlay.addEventListener('click', (e) => {
        if (
            e.target === pageOverlay &&
            productForm.classList.contains('show')
        ) {
            hideForm(productForm, pageOverlay);
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

function handleSubmit() {
    const isEditMode = productForm.action.includes('edit.php');
    if (!validateForm(isEditMode)) return;
    isEditMode ? handleAddSubmit() : handleEditSubmit();
}

function handleEditSubmit() {
    hideForm(productForm, pageOverlay);
    const message = 'Do you want to save this product?';
    showConfirmDialog(message, (confirmed) => {
        if (confirmed) {
            productForm.submit();
        } else {
            hideConfirmDialog();
            showAddForm();
        }
    });
}

function handleAddSubmit() {
    hideForm(productForm, pageOverlay);
    const message = 'Do you want to add this product?';
    showConfirmDialog(message, (confirmed) => {
        if (confirmed) {
            productForm.submit();
        } else {
            hideConfirmDialog();
            showAddForm();
        }
    });
}

function showAddForm(action = 'add', productId = null) {
    setFormMode('add');
    showForm(productForm, pageOverlay);
}

async function showEditForm(productId) {
    const product = await fetch.product(productId);
    setFormMode('edit', productId);
    populateForm(product);
    showForm(productForm, pageOverlay);
}

function setFormMode(mode, productId = null) {
    if (mode === 'edit') {
        productForm.action = `./handlers/products/edit.php?id=${productId}`;
        productFormSubmit.textContent = 'Save Product';
    }

    if (mode === 'add') {
        productForm.action = './handlers/products/add.php';
        productFormSubmit.textContent = 'Add Product';
    }
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
    setSelectedOption(productGender, product.Gender.name);
    setSelectedOption(productColor, product.Color.name);
    setSelectedOption(productMaterial, product.Material.name);
    setSelectedOption(productShape, product.Shape.name);
    setSelectedOption(productFrameType, product['Frame Type'].name);

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

function validateForm(isEditMode) {
    if (!isEditMode) {
        if (!validate.fileInput(imageChooser1)) return false;
        if (!validate.fileInput(imageChooser2)) return false;
    }

    if (!validate.conditionalInputs(conditionalInputs)) return false;
    if (!validate.textInput(productNameInput)) return false;
    if (!validate.numberInputs(numberInputs)) return false;

    return true;
}

function resetForm() {
    productForm.reset();
    imageContainer1.innerHTML = '';
    imageContainer2.innerHTML = '';
    imageChooser1.value = '';
    imageChooser2.value = '';
    productFormSubmit.textContent = 'Add Product';
    productForm.action = './handlers/products/add.php';
    productGenderPA.value = '';
    productColorPA.value = '';
    productMaterialPA.value = '';
    productShapePA.value = '';
    productFrameTypePA.value = '';
}
