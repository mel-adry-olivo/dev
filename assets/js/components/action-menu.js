import { showSnackbar } from './snackbar.js';
import { handleAddToBagFromFavorite } from './product.js';
import * as fetch from '../services/fetch.js';

const pageOverlay = document.querySelector('.page-overlay-action-menu');
const actionMenu = document.querySelector('.action-menu');
const actionMenuCloseButton = document.querySelector('.action-menu__close-button');
const headerActionButtons = document.querySelectorAll('.header__action-button');
const actionMenuButtons = document.querySelectorAll('.action-menu__button');
const actionMenuContent = document.querySelector('.action-menu__content');
const authForm = document.querySelector('.auth');
const authCtaButtons = document.querySelectorAll('.auth__cta-button');
const body = document.body;

const initActionMenu = () => {
    setActionEvent(headerActionButtons, toggleActionMenu);
    setActionEvent(actionMenuButtons, updateActionMenuContent);

    actionMenuCloseButton.addEventListener('click', toggleActionMenu);

    authCtaButtons.forEach((btn) =>
        btn.addEventListener('click', () => {
            const isLogin = authForm.getAttribute('data-state') === 'login';
            authForm.setAttribute('data-state', isLogin ? 'register' : 'login');
        }),
    );
    pageOverlay.addEventListener('click', (e) => {
        if (e.target === pageOverlay && actionMenu.classList.contains('show')) {
            toggleActionMenu();
        }
    });
};

const setActionEvent = (buttons, callback) => {
    buttons.forEach((btn) =>
        btn.addEventListener('click', () => {
            const action = btn.getAttribute('data-action');
            callback(action);
        }),
    );
};

const toggleActionMenu = (action = null) => {
    if (action === 'bag') {
        handleBagClick(toggleActionMenu);
        return;
    }
    updateActionMenuContent(action);
    pageOverlay.classList.toggle('show');
    actionMenu.classList.toggle('show');
    body.classList.toggle('no-scroll');
};

const updateActionMenuContent = (action) => {
    if (action === 'bag') {
        handleBagClick(updateActionMenuContent);
        return;
    }

    const contentItems = actionMenuContent.querySelectorAll('.action-menu__content-item');
    contentItems.forEach((content) => content.classList.toggle('active', content.classList.contains(action)));

    actionMenuButtons.forEach((btn) => btn.classList.toggle('active', btn.getAttribute('data-action') === action));
};

const handleBagClick = async (callback) => {
    if (!fetch.isUserLoggedIn()) {
        callback('user');
        showSnackbar('You need to be logged in to view your bag');
    } else {
        window.location.href = './summary.php';
    }
};

export { initActionMenu, toggleActionMenu };
