import initHeader from '../components/header.js';
import { initActionMenu } from '../components/action-menu.js';
import { element } from '../utils/dom.js';

const registerButton = element('.auth__cta-button-register');
const loginButton = element('.auth__cta-button-login');
const registerForm = element('.login .auth-register');
const loginForm = element('.login .auth-login');

window.onload = () => {
    initHeader();
    initActionMenu();

    registerButton.addEventListener('click', () => {
        registerForm.style.display = 'block';
        loginForm.style.display = 'none';
    });

    loginButton.addEventListener('click', () => {
        registerForm.style.display = 'none';
        loginForm.style.display = 'block';
    });
};
