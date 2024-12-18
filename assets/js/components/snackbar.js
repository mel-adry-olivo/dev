import { element, addClass, removeClass } from '../utils/dom.js';

export const showSnackbar = (message) => {
    const snackbar = element('.snackbar');

    snackbar.textContent = message;
    addClass(snackbar, 'show');

    setTimeout(() => {
        removeClass(snackbar, 'show');
    }, 2500);
};
