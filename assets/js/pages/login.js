import initHeader from '../components/header.js';
import { initActionMenu } from '../components/action-menu.js';
import * as validate from '../utils/validate.js';
import { element, elements } from '../utils/dom.js';

const registerButton = element('.auth__cta-button-register');
const loginButton = element('.auth__cta-button-login');
const registerForm = element('.login .auth-register');
const loginForm = element('.login .auth-login');

const registerFName = elements('[name="register-fname"]');
const registerLName = elements('[name="register-lname"]');
const registerEmail = elements('[name="register-email"]');
const registerPassword = elements('[name="register-password"]');

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
