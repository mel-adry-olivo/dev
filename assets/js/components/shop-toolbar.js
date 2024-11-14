// Utility function to toggle a CSS class

// Get all the required elements
const filterButtons = document.querySelectorAll('.shop__dropdown-button');
const filterCategories = document.querySelectorAll('.shop__filter-category');
const filterButtonMobile = document.querySelector('.shop__filter-button-mobile');
const filterContainer = document.querySelector('.shop__filter-container');
const filterItems = document.querySelectorAll('.shop__dropdown-item');
const filterCloseButton = document.querySelector('.shop__filter-close-button');
const filterResetButtonMobile = document.querySelector('.shop__filter-reset-mobile');
const filterResetButton = document.querySelector('.shop__filter-reset-desktop');
const pageOverlay = document.querySelector('.page-overlay');
const body = document.body;

function initFilter() {
  addFunctionToItems(filterButtons, handleFilterButtonClick);
  addFunctionToItems(filterItems, handleFilterItemClick);
  document.addEventListener('click', handleOutsideClick);
  filterButtonMobile.addEventListener('click', handleToggleDropdown);
  filterCloseButton.addEventListener('click', handleToggleDropdown);
  filterResetButton.addEventListener('click', handleResetFilterClick);
  filterResetButtonMobile.addEventListener('click', handleResetFilterClick);
  pageOverlay.addEventListener('click', handlePageOverlayClick);
  window.addEventListener('resize', () => {
    if (pageOverlay.classList.contains('show')) {
      handleToggleDropdown();
    }
  });
}

const toggleClass = (element, className) => {
  element.classList.toggle(className);
};

const addFunctionToItems = (items, handler) => {
  items.forEach((item) => {
    item.addEventListener('click', handler);
  });
};

const handleFilterButtonClick = (event) => {
  const filterButton = event.target.closest('.shop__dropdown-button');
  toggleFilterDropdown(filterButton);
};

const toggleFilterDropdown = (filterButton) => {
  toggleClass(filterButton, 'active');

  // If screen is larger than 900px, close other dropdowns
  if (window.innerWidth > 900) {
    filterButtons.forEach((btn) => {
      if (btn !== filterButton) {
        btn.classList.remove('active');
      }
    });
  }
};

const closeFilterDropdowns = () => {
  filterCategories.forEach((category) => {
    const dropdown = category.querySelector('.shop__dropdown-container');
    dropdown.classList.remove('active');
  });

  filterButtons.forEach((button) => {
    button.classList.remove('active');
  });
};

const handleOutsideClick = (event) => {
  if (!event.target.closest('.shop__toolbar')) {
    closeFilterDropdowns();
  }
};

const handleToggleDropdown = () => {
  toggleClass(pageOverlay, 'show');
  toggleClass(filterContainer, 'show');
  toggleClass(body, 'no-scroll');
};

const handleFilterItemClick = (event) => {
  const item = event.target.closest('.shop__dropdown-item');
  toggleClass(item, 'active');

  const container = item.closest('.shop__dropdown-container');
  const categoryText = container.previousElementSibling.querySelector(
    '.shop__dropdown-button-text',
  );

  const baseText = categoryText.dataset.baseText || categoryText.textContent.split(' ')[0];
  const activeCount = container.querySelectorAll('.shop__dropdown-item.active').length;
  categoryText.textContent = activeCount > 0 ? `${baseText} (${activeCount})` : baseText;
  categoryText.dataset.baseText = baseText;

  checkResetFilter();
};

const checkResetFilter = () => {
  const activeCount = document.querySelectorAll('.shop__dropdown-item.active').length;
  if (activeCount > 0) {
    filterResetButtonMobile.classList.add('show');
    filterResetButton.classList.add('show');
  } else {
    filterResetButtonMobile.classList.remove('show');
    filterResetButton.classList.remove('show');
  }
};

const resetCategoryButtonTexts = () => {
  filterCategories.forEach((category) => {
    const categoryText = category.querySelector('.shop__dropdown-button-text');
    const baseText = categoryText.dataset.baseText || categoryText.textContent;
    categoryText.textContent = baseText;
    categoryText.dataset.baseText = baseText;
  });
};

const handleResetFilterClick = () => {
  filterItems.forEach((item) => {
    item.classList.remove('active');
  });
  resetCategoryButtonTexts();
  checkResetFilter();
  closeFilterDropdowns();
};

const handlePageOverlayClick = (event) => {
  if (event.target === pageOverlay && filterContainer.classList.contains('show')) {
    handleToggleDropdown();
  }
};

export default initFilter;
