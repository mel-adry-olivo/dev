import initHeader from '../components/header.js';
import initCarousel from '../components/product-carousel.js';
import { initActionMenu } from '../components/action-menu.js';
import { initFavorites } from '../components/product.js';
import { initReview } from './review.js';
import { showSnackbar } from '../components/snackbar.js';
import * as fetch from '../services/fetch.js';

window.onload = () => {
    initHeader();
    initCarousel();
    initActionMenu();
    initFavorites();
    initReview();

    const productInfoForm = document.querySelector('.product__info-form');
    productInfoForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (!(await fetch.isUserLoggedIn())) {
            toggleActionMenu('user');
            showSnackbar('You need to be logged in to add to bag');
            return;
        }

        const message = 'Do you want to add this product to your bag?';
        showConfirmDialog(message, (confirmed) => {
            if (confirmed) {
                productInfoForm.submit();
            }
        });
    });
};
