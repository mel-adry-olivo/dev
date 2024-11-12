const initHeader = () => {
  let lastScrollY = 0;
  const header = document.querySelector('.header__wrapper');

  window.addEventListener('scroll', () => {
    const currentScroll = window.scrollY;
    if (currentScroll > lastScrollY) {
      header.classList.add('hidden');
    } else {
      header.classList.remove('hidden');
    }

    lastScrollY = currentScroll;
  });
};

export default initHeader;
