import initHeader from '../components/header.js';
import { initActionMenu } from '../components/action-menu.js';

window.onload = () => {
  initHeader();
  initActionMenu();

  const searchbarContainer = document.querySelector('.content__searchbar');
  const searchbar = document.querySelector('.content__searchbar input');

  searchbarContainer.addEventListener('click', () => {
    searchbar.focus();
  });

  searchbar.addEventListener('input', () => {
    if (searchbar.value.trim() === '') {
      searchbarContainer.classList.remove('active');
    } else {
      searchbarContainer.classList.add('active');
    }
  });
};
