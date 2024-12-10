import { showConfirmDialog } from '../components/confirm-dialog.js';
import { showLoader, setLoaderText, hideLoader } from '../components/loader.js';
import { element } from '../utils/dom.js';

window.onload = () => {
    const container = element('.bag__summary');

    container.addEventListener('submit', (e) => {
        e.preventDefault();
        if (e.target.matches('.product__bag-close-form')) {
            handleBagClose(e.target);
        }

        if (e.target.matches('.bag__reserve-form')) {
            handleReservation(e.target);
        }

        if (e.target.matches('.product__reserve-close-form')) {
            handleReservationClose(e.target);
        }
    });
};

function handleBagClose(form) {
    const message = 'Are you sure you want to remove this from your bag?';
    showConfirmDialog(message, (confirmed) => {
        if (confirmed) {
            form.submit();
        }
    });
}

function handleReservation(form) {
    showLoader();
    setLoaderText('Successfully reserved!', 500);
    hideLoader(() => {
        form.submit();
    }, 1000);
}

function handleReservationClose(form) {
    const message = 'Do you want to cancel this reservation?';
    showConfirmDialog(message, (confirmed) => {
        if (confirmed) {
            form.submit();
        }
    });
}
