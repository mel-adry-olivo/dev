import { element, addClass, removeClass } from '../utils/dom.js';

export function showLoader() {
    const loader = element('.loader-container');
    removeClass(loader, 'hidden');
}

export function setLoaderText(text, duration = 0) {
    setTimeout(() => {
        const loaderText = element('.loader-container span');
        loaderText.textContent = text;
    }, duration);
}

export function hideLoader(callback = () => {}, duration = 0) {
    setTimeout(() => {
        const loader = element('.loader-container');
        addClass(loader, 'hidden');
        callback();
    }, duration);
}
