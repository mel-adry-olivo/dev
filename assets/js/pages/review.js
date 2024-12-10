import initHeader from '../components/header.js';
import { initActionMenu, toggleActionMenu } from '../components/action-menu.js';
import { showConfirmDialog, hideConfirmDialog } from '../components/confirm-dialog.js';
import { showSnackbar } from '../components/snackbar.js';
import * as fetch from '../services/fetch.js';

const reviewForm = document.querySelector('.review__form');
const pageOverlay = document.querySelector('.review-overlay');
const writeReviewButton = document.querySelector('.product__write-review');
const cancelButton = document.querySelector('.review__cancel');
const closeForm = document.querySelectorAll('.product__review-close-form');

window.onload = () => {
    initHeader();
    initActionMenu();
    initReview();
};

export function initReview() {
    closeForm.forEach((form) => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            showConfirmDialog('Do you want to remove this review?', (confirmed) => {
                if (confirmed) {
                    form.submit();
                }
            });
        });
    });

    writeReviewButton.addEventListener('click', async () => {
        const isUserLoggedIn = await fetch.isUserLoggedIn();
        if (!isUserLoggedIn) {
            toggleActionMenu('user');
            showSnackbar('You need to be logged in to write a review');
            return;
        }
        toggleReviewForm(true);
    });

    cancelButton.addEventListener('click', () => {
        toggleReviewForm(false);
    });

    pageOverlay.addEventListener('click', (e) => {
        if (e.target === pageOverlay && reviewForm.classList.contains('show')) {
            toggleReviewForm(false);
        }
    });
}

function toggleReviewForm(toggle) {
    reviewForm.classList.toggle('show', toggle);
    pageOverlay.classList.toggle('show', toggle);
}
