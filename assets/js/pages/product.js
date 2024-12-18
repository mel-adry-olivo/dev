import initHeader from '../components/header.js';
import initCarousel from '../components/product-carousel.js';
import { initActionMenu, toggleActionMenu } from '../components/action-menu.js';
import { initFavorites } from '../components/product.js';
import { initReview } from './review.js';
import { showSnackbar } from '../components/snackbar.js';
import { showConfirmDialog } from '../components/confirm-dialog.js';
import * as fetch from '../services/fetch.js';
import { element } from '../utils/dom.js';

const productInfoForm = element('.product__info-form');

window.onload = () => {
    initHeader();
    initCarousel();
    initActionMenu();
    initFavorites();
    initReview();

    productInfoForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        handleAddToBag(productInfoForm);
    });
};

async function handleAddToBag(form) {
    const isUserLoggedIn = await fetch.isUserLoggedIn();

    if (!isUserLoggedIn) {
        toggleActionMenu('user');
        showSnackbar('You need to be logged in to add to bag');
        return;
    }

    const isReserved = await fetch.isProductReserved(form.dataset.id);

    if (isReserved) {
        showSnackbar('Product is already reserved');
        return;
    }

    const message = 'Do you want to add this product to your bag?';
    showConfirmDialog(message, (confirmed) => {
        if (confirmed) {
            productInfoForm.submit();
        }
    });
}
