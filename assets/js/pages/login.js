import initHeader from '../components/header.js';
import { initActionMenu } from '../components/action-menu.js';

window.onload = () => {
  initHeader();
  initActionMenu();

  const registerButton = document.querySelector('.auth__cta-button-register');
  const loginButton = document.querySelector('.auth__cta-button-login');
  const registerForm = document.querySelector('.login .auth-register');
  const loginForm = document.querySelector('.login .auth-login');

  registerButton.addEventListener('click', () => {
    registerForm.style.display = 'block';
    loginForm.style.display = 'none';
  });

  loginButton.addEventListener('click', () => {
    registerForm.style.display = 'none';
    loginForm.style.display = 'block';
  });
};
