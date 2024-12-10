import initHeader from '../components/header.js';
import { initActionMenu, toggleActionMenu } from '../components/action-menu.js';
import { showConfirmDialog } from '../components/confirm-dialog.js';
import { showSnackbar } from '../components/snackbar.js';
import * as fetch from '../services/fetch.js';
import { showForm, hideForm } from '../utils/dom.js';
import { element } from '../utils/dom.js';

const reviewForm = element('.review__form');
const pageOverlay = element('.review-overlay');
const writeReviewButton = element('.product__write-review');
const cancelButton = element('.review__cancel');

window.onload = () => {
    initHeader();
    initActionMenu();
    initReview();
};

export function initReview() {
    document.addEventListener('submit', (e) => {
        if (e.target.matches('.product__review-close-form')) {
            e.preventDefault();
            handleReviewClose(e.target);
        }
    });

    writeReviewButton.addEventListener('click', handleWriteReviewClick);
    cancelButton.addEventListener('click', () => {
        hideForm(reviewForm, pageOverlay);
    });
}

function handleReviewClose(form) {
    const message = 'Do you want to remove this review?';
    showConfirmDialog(message, (confirmed) => {
        if (confirmed) {
            form.submit();
        }
    });
}

async function handleWriteReviewClick() {
    const isUserLoggedIn = await fetch.isUserLoggedIn();
    if (!isUserLoggedIn) {
        toggleActionMenu('user');
        showSnackbar('You need to be logged in to write a review');
        return;
    }
    showForm(reviewForm, pageOverlay);
}
