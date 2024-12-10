import { element } from '../utils/dom.js';

export function showLoader() {
    const loader = element('.loader-container');
    const loaderText = element('.loader-container span');

    loader.classList.remove('hidden');
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
        loader.classList.add('hidden');
        callback();
    }, duration);
}
