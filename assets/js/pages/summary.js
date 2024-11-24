import { showConfirmDialog, hideConfirmDialog } from '../components/confirm-dialog.js';

window.onload = () => {
  const productBagCloseForm = document.querySelectorAll('.product__bag-close-form');
  const pageOverlay = document.querySelector('.confirm__overlay');
  const reserveForm = document.querySelector('.bag__reserve-form');
  const loader = document.querySelector('.loader-container');
  const loaderText = document.querySelector('.loader-container span');

  productBagCloseForm.forEach((form) => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      showConfirmDialog('Do you want remove this from your bag?', (confirmed) => {
        if (confirmed) {
          form.submit();
        }
      });
    });
  });

  reserveForm.addEventListener('submit', (e) => {
    e.preventDefault();
    loader.classList.remove('hidden');

    setTimeout(() => {
      loaderText.textContent = 'Successfully Reserved';
    }, 1500);

    setTimeout(() => {
      loader.classList.add('hidden');
      reserveForm.submit();
    }, 2000);
  });

  pageOverlay.addEventListener('click', (e) => {
    if (e.target === pageOverlay) {
      hideConfirmDialog();
    }
  });
};
