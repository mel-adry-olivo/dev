import { showSnackbar } from './snackbar.js';
import * as fetch from '../services/fetch.js';
import { element, toggleClass } from '../utils/dom.js';

const pageOverlay = element('.page-overlay-action-menu');
const actionMenuButtons = element('.header__action-button');
const actionMenu = element('.action-menu');
const authForm = element('.auth');
const body = document.body;

export function initActionMenu() {
    document.addEventListener('click', (e) => {
        if (e.target.matches('.header__action-button')) {
            const action = e.target.getAttribute('data-action');
            toggleActionMenu(action, toggleActionMenu);
        }

        if (e.target.matches('.action-menu__button')) {
            const action = e.target.getAttribute('data-action');
            handleAction(action, updateActionMenuContent);
        }

        if (e.target.matches('.action-menu__close-button')) {
            toggleActionMenu();
        }

        if (e.target.matches('.auth__cta-button')) {
            const isLogin = authForm.getAttribute('data-state') === 'login';
            authForm.setAttribute('data-state', isLogin ? 'register' : 'login');
        }
    });

    pageOverlay.addEventListener('click', (e) => {
        if (e.target === pageOverlay && actionMenu.classList.contains('show')) {
            toggleActionMenu();
        }
    });
}

export function toggleActionMenu(action = null) {
    updateActionMenuContent(action);
    toggleClass(actionMenu, 'show');
    toggleClass(pageOverlay, 'show');
    toggleClass(body, 'no-scroll');
}

function updateActionMenuContent(action) {
    const contentItems = element('.action-menu__content-item');
    contentItems.forEach((content) =>
        content.classList.toggle('active', content.classList.contains(action)),
    );

    actionMenuButtons.forEach((btn) =>
        btn.classList.toggle(
            'active',
            btn.getAttribute('data-action') === action,
        ),
    );
}

function handleAction(action, callback) {
    if (action === 'bag') {
        handleBagClick(callback);
        return;
    } else {
        callback(action);
    }
}

async function handleBagClick(callback) {
    const isUserLoggedIn = await fetch.isUserLoggedIn();
    if (!isUserLoggedIn) {
        callback('user');
        showSnackbar('You need to be logged in to view your bag');
    } else {
        window.location.href = './summary.php';
    }
}
