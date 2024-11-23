import { checkUserLogin } from '../utils.js';
import { showSnackbar } from './snackbar.js';

const pageOverlay = document.querySelector('.page-overlay-action-menu');
const actionMenu = document.querySelector('.action-menu');
const actionMenuCloseButton = document.querySelector('.action-menu__close-button');
const headerActionButtons = document.querySelectorAll('.header__action-button');
const actionMenuButtons = document.querySelectorAll('.action-menu__button');
const actionMenuContent = document.querySelector('.action-menu__content');
const authForm = document.querySelector('.auth');
const authCtaButtons = document.querySelectorAll('.auth__cta-button');
const searchForm = document.querySelector('.search__form');
const searchIcon = document.querySelector('.search__icon');
const searchSubmitButton = document.querySelector('.search__submit');
const searchInput = document.getElementById('search__input');
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

  document.querySelectorAll('.favorites__content, .bag__content').forEach((container) => {
    container.addEventListener('scroll', handleScrollMask);
  });

  initSearch();

  handleScrollMask();
};

const setActionEvent = (buttons, callback) => {
  buttons.forEach((btn) =>
    btn.addEventListener('click', async () => {
      const action = btn.getAttribute('data-action');
      callback(action);
    }),
  );
};

const toggleActionMenu = async (action = null) => {
  if (action == 'bag') {
    if (!(await checkUserLogin())) {
      toggleActionMenu('user');
      showSnackbar('You need to be logged in to view your bag');
    } else {
      window.location.href = './summary.php';
    }
    return;
  }
  updateActionMenuContent(action);
  pageOverlay.classList.toggle('show');
  actionMenu.classList.toggle('show');
  body.classList.toggle('no-scroll');
};

const updateActionMenuContent = async (action) => {
  if (action == 'bag') {
    if (!(await checkUserLogin())) {
      updateActionMenuContent('user');
      showSnackbar('You need to be logged in to view your bag');
    } else {
      window.location.href = './summary.php';
    }
    return;
  }
  const contentItems = actionMenuContent.querySelectorAll('.action-menu__content-item');
  contentItems.forEach((content) =>
    content.classList.toggle('active', content.classList.contains(action)),
  );

  actionMenuButtons.forEach((btn) =>
    btn.classList.toggle('active', btn.getAttribute('data-action') === action),
  );
};

const initSearch = () => {
  const toggleFocusedState = (isFocused) => {
    searchIcon.classList.toggle('focused', isFocused);
    searchForm.classList.toggle('focused', isFocused);
  };

  const toggleButtonState = () => {
    const hasText = searchInput.value.length > 0;
    searchSubmitButton.disabled = !hasText;
    searchSubmitButton.classList.toggle('focused', hasText);
  };

  searchForm.addEventListener('click', () => searchInput.focus());
  searchInput.addEventListener('focus', () => toggleFocusedState(true));
  searchInput.addEventListener('blur', () => toggleFocusedState(false));
  searchInput.addEventListener('input', toggleButtonState);

  toggleButtonState();
};

function handleScrollMask() {
  const containers = document.querySelectorAll('.favorites__content, .bag__content');

  containers.forEach((container) => {
    const scrollHeight = container.scrollHeight;
    const scrollTop = container.scrollTop;
    const clientHeight = container.clientHeight;

    if (scrollTop + clientHeight < scrollHeight) {
      container.style.maskImage = 'linear-gradient(to top, transparent, black 25%)';
      container.style.webkitMaskImage = 'linear-gradient(to top, transparent, black 25%)';
    } else {
      container.style.maskImage = 'none';
      container.style.webkitMaskImage = 'none';
    }
  });
}

export { initActionMenu, toggleActionMenu };
