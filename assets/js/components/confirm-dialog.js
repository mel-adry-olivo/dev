import { hideForm } from '../utils/dom.js';
import { element, addClass } from '../utils/dom.js';

const pageOverlay = element('.confirm__overlay');
const confirmDialog = element('.confirm__dialog');
const confirmDialogMessage = element('.confirm__message');
const confirmDialogButtonCancel = element('.confirm__cancel');
const confirmDialogButtonOk = element('.confirm__ok');

export const showConfirmDialog = (message, callback) => {
    addClass(confirmDialog, 'show');
    addClass(pageOverlay, 'show');
    confirmDialogMessage.textContent = message;

    confirmDialogButtonOk.addEventListener('click', () => {
        hideConfirmDialog();
        callback(true);
    });

    confirmDialogButtonCancel.addEventListener('click', () => {
        hideConfirmDialog();
        callback(false);
    });

    pageOverlay.addEventListener('click', (e) => {
        if (e.target === pageOverlay) {
            hideConfirmDialog();
        }
    });
};

export const hideConfirmDialog = () => {
    hideForm(confirmDialog, pageOverlay);
    removeEventListeners();
};

function removeEventListeners() {
    confirmDialogButtonCancel.removeEventListener('click', () => {});
    confirmDialogButtonOk.removeEventListener('click', () => {});
    pageOverlay.removeEventListener('click', () => {});
}
