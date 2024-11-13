// TO REFACTOR

const filterButtons = document.querySelectorAll('.shop__dropdown-button');
const filterItems = document.querySelectorAll('.shop__filter-category');
const filterButtonMobile = document.querySelector('.shop__filter-button-mobile');
const filterContainer = document.querySelector('.shop__filter-container');
const filterCloseButton = document.querySelector('.shop__filter-close-button');
const pageOverlay = document.querySelector('.page-overlay');
const body = document.body;

const initFilter = () => {
  filterButtons.forEach((button) => {
    button.addEventListener('click', () => openFilterDropdown(button));
  });

  document.addEventListener('click', (e) => {
    if (!e.target.closest('.shop__toolbar')) closeDropdown();
  });

  filterButtonMobile.addEventListener('click', () => {
    toggleFilterMenu();
  });

  filterCloseButton.addEventListener('click', toggleFilterMenu);

  pageOverlay.addEventListener('click', (e) => {
    if (e.target === pageOverlay && filterContainer.classList.contains('show')) {
      toggleFilterMenu();
    }
  });
};

const toggleFilterMenu = () => {
  pageOverlay.classList.toggle('show');
  filterContainer.classList.toggle('show');
  body.classList.toggle('no-scroll');
};

const openFilterDropdown = (button) => {
  button.classList.toggle('active');
  filterButtons.forEach((btn) => {
    if (btn !== button) btn.classList.remove('active');
  });
};

const closeDropdown = () => {
  filterItems.forEach((item) => {
    const dropdown = item.querySelector('.shop__dropdown-container');
    dropdown.classList.remove('active');
  });
  filterButtons.forEach((button) => button.classList.remove('active'));
};

export default initFilter;
