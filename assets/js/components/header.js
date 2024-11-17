const initHeader = () => {
  const navButton = document.querySelector('.header__nav-button');
  const navCloseButton = document.querySelector('.header__nav-close-button');
  const pageOverlay = document.querySelector('.page-overlay-nav');
  const nav = document.querySelector('.header__nav-list');
  let lastScrollY = 0;
  const header = document.querySelector('.header__wrapper');

  navButton.addEventListener('click', () => {
    toggleNav();
  });

  navCloseButton.addEventListener('click', () => {
    toggleNav();
  });

  pageOverlay.addEventListener('click', () => {
    toggleNav();
  });

  window.addEventListener('scroll', () => {
    const currentScroll = window.scrollY;
    if (currentScroll > lastScrollY) {
      header.classList.add('hidden');
    } else {
      header.classList.remove('hidden');
    }

    lastScrollY = currentScroll;
  });

  const toggleNav = () => {
    nav.classList.toggle('show');
    pageOverlay.classList.toggle('show');
  };
};

export default initHeader;
