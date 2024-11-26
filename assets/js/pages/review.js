import initHeader from '../components/header.js';
import { initActionMenu, toggleActionMenu } from '../components/action-menu.js';
import { checkUserLogin } from '../utils.js';
import { showSnackbar } from '../components/snackbar.js';

const reviewForm = document.querySelector('.review__form');
const pageOverlay = document.querySelector('.review-overlay');

window.onload = () => {
  initHeader();
  initActionMenu();
  initReview();
};

export function initReview() {
  const writeReviewButton = document.querySelector('.product__write-review');
  const cancelButton = document.querySelector('.review__cancel');

  writeReviewButton.addEventListener('click', async () => {
    if (!(await checkUserLogin())) {
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
