const filterCategoryButtons = document.querySelectorAll('.shop__dropdown-button');
const filterButtonMobile = document.querySelector('.shop__filter-button-mobile');
const filterContainer = document.querySelector('.shop__filter-container');
const filterItems = document.querySelectorAll('.shop__dropdown-item');
const filterCloseButton = document.querySelector('.shop__filter-close-button');
const filterResetButtonMobile = document.querySelector('.shop__filter-reset-mobile');
const filterResetButton = document.querySelector('.shop__filter-reset-desktop');
const sortItems = document.querySelectorAll('.shop__sort-item');
const pageOverlay = document.querySelector('.page-overlay');
const body = document.body;

export default function initFilter() {
  filterCategoryButtons.forEach((category) => {
    category.addEventListener('click', () => toggleFilterDropdown(category));
  });

  filterItems.forEach((item) => {
    item.addEventListener('click', () => handleFilterItemClick(item));
  });

  sortItems.forEach((item) => {
    item.addEventListener('click', () => handleSortItemClick(item));
  });

  filterButtonMobile.addEventListener('click', toggleMobileFilters);
  filterCloseButton.addEventListener('click', toggleMobileFilters);
  filterResetButton.addEventListener('click', handleResetFilterClick);
  filterResetButtonMobile.addEventListener('click', () => {
    handleResetFilterClick();
    toggleMobileFilters();
  });
  pageOverlay.addEventListener('click', handlePageOverlayClick);

  document.addEventListener('click', handleOutsideClick);
  window.addEventListener('resize', () => handleResize());
}

const toggleFilterDropdown = (filterButton) => {
  toggleClass(filterButton, 'active');
  // If screen is larger than 900px, do not auto close other dropdowns
  if (window.innerWidth > 900) {
    filterCategoryButtons.forEach((btn) => {
      if (btn !== filterButton) {
        btn.classList.remove('active');
      }
    });
  }
};

const handleFilterItemClick = (item) => {
  toggleClass(item, 'active');

  const container = item.closest('.shop__dropdown-container');
  const categoryText = container.previousElementSibling.querySelector(
    '.shop__dropdown-button-text',
  );

  if (categoryText.hasAttribute('filter')) {
    const baseText = categoryText.dataset.baseText || categoryText.textContent.split(' ')[0];
    const activeCount = container.querySelectorAll('.shop__dropdown-item.active').length;
    categoryText.textContent = activeCount > 0 ? `${baseText} (${activeCount})` : baseText;
    categoryText.dataset.baseText = baseText;
    checkResetFilter();
  }
};

const handleSortItemClick = (item) => {
  item.addEventListener('click', () => {
    sortButtons.forEach((it) => {
      it.classList.remove('active');
    });
    item.classList.add('active');
  });
};

const closeAllDropdowns = () => {
  filterCategoryButtons.forEach((category) => {
    const dropdown = category.querySelector('.shop__dropdown-container');
    if (dropdown) dropdown.classList.remove('active');
  });
};

const handleResize = () => {
  if (pageOverlay.classList.contains('show')) {
    toggleMobileFilters();
  }
};

const handleOutsideClick = (event) => {
  if (!event.target.closest('.shop__toolbar')) {
    closeAllDropdowns();
  }
};

const checkResetFilter = () => {
  const activeCount = document.querySelectorAll('.shop__dropdown-item.active[filter]').length;
  if (activeCount > 0) {
    filterResetButtonMobile.classList.add('show');
    filterResetButton.classList.add('show');
  } else {
    filterResetButtonMobile.classList.remove('show');
    filterResetButton.classList.remove('show');
  }
};

const resetCategoryButtonTexts = () => {
  filterCategoryButtons.forEach((btn) => {
    const categoryText = btn.querySelector('.shop__dropdown-button-text');
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
  closeAllDropdowns();
};

const handlePageOverlayClick = (event) => {
  if (event.target === pageOverlay && filterContainer.classList.contains('show')) {
    toggleMobileFilters();
  }
};
const toggleMobileFilters = () => {
  toggleClass(pageOverlay, 'show');
  toggleClass(filterContainer, 'show');
  toggleClass(body, 'no-scroll');
};

const toggleClass = (element, className) => {
  element.classList.toggle(className);
};
