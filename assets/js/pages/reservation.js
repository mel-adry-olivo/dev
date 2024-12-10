import { showConfirmDialog, hideConfirmDialog } from '../components/confirm-dialog.js';

window.onload = () => {
    const productReserveCloseForm = document.querySelectorAll('.product__reserve-close-form');
    const pageOverlay = document.querySelector('.confirm__overlay');

    productReserveCloseForm.forEach((form) => {
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            showConfirmDialog('Do you want to cancel this reservation?', (confirmed) => {
                if (confirmed) {
                    form.submit();
                }
            });
        });
    });

    pageOverlay.addEventListener('click', (e) => {
        if (e.target === pageOverlay) {
            hideConfirmDialog();
        }
    });
};
