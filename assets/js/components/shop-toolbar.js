import productCard from './product-card.js';

const filterCategoryButtons = document.querySelectorAll('.shop__dropdown-button');
const filterButtonMobile = document.querySelector('.shop__filter-button-mobile');
const filterContainer = document.querySelector('.shop__filter-container');
const filterItems = document.querySelectorAll('.shop__dropdown-item[filter]');
const filterCloseButton = document.querySelector('.shop__filter-close-button');
const filterResetButtonMobile = document.querySelector('.shop__filter-reset-mobile');
const filterResetButton = document.querySelector('.shop__filter-reset-desktop');
const sortItems = document.querySelectorAll('.shop__dropdown-item[sort-order]');
const pageOverlay = document.querySelector('.page-overlay');
const body = document.body;
const CURRENT_URL = window.location.href;

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

const handleFilterItemClick = (item) => {
  toggleClass(item, 'active');
  updateCategoryText(item);
  checkResetFilter();
  applyFilters();
};

const applyFilters = () => {
  const activeFilterItems = document.querySelectorAll('.shop__dropdown-item.active[filter]');
  const filteredItems = {};

  // create object [category][array of items]
  // ex. { Shape: [Square, Rectangle] }
  activeFilterItems.forEach((item) => {
    const itemCategory = item.getAttribute('filter');
    const itemName = item.getAttribute('data-value');

    if (!filteredItems[itemCategory]) {
      filteredItems[itemCategory] = [];
    }
    filteredItems[itemCategory].push(itemName);
  });

  requestFilteredProducts(filteredItems).then(updateProductUI);
};

const handleSortItemClick = (item) => {
  if (!item.hasAttribute('sort-order')) return;
  if (item.classList.contains('active')) return;

  sortItems.forEach((it) => it.classList.toggle('active', it === item));
  const sortOrder = item.getAttribute('sort-order');
  requestSortedProducts(sortOrder).then(updateProductUI);
};

const handleResetFilterClick = () => {
  filterItems.forEach((item) => item.classList.remove('active'));
  resetCategoryButtonTexts();
  checkResetFilter();
  closeAllDropdowns();
  requestFilteredProducts({});
};

const requestFilteredProducts = async (items) => {
  try {
    const response = await fetch(CURRENT_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(items),
    });

    return await response.json();
  } catch (error) {
    console.error(error);
  }
};

const requestSortedProducts = async (direction) => {
  try {
    const response = await fetch(CURRENT_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: direction,
    });

    return await response.json();
  } catch (error) {
    console.error(error);
  }
};

const updateProductUI = (data) => {
  const productCount = document.querySelector('.shop__toolbar-count');
  const productContainer = document.querySelector('.product-catalog');

  let productHTML = '';
  data.forEach((product) => (productHTML += productCard.createProductCard(product)));
  productContainer.innerHTML = productHTML;

  productCount.textContent = data.length > 1 ? `${data.length} Products` : `${data.length} Product`;
};

// adding '(a number)' to the category text if there are active items
const updateCategoryText = (item) => {
  const itemsContainer = item.closest('.shop__dropdown-container');
  const categoryButton = itemsContainer.parentElement.querySelector('.shop__dropdown-button-text');
  const categoryName = item.getAttribute('filter');
  const activeItems = itemsContainer.querySelectorAll('.shop__dropdown-item.active');
  const activeCount = activeItems.length;
  categoryButton.textContent = activeCount > 0 ? `${categoryName} (${activeCount})` : categoryName;
};

// if filter container is open while resizing, close it
const handleResize = () => {
  if (pageOverlay.classList.contains('show')) {
    toggleMobileFilters();
  }
};

// if click outside filter container, close it
const handleOutsideClick = (event) => {
  if (!event.target.closest('.shop__toolbar')) {
    closeAllDropdowns();
  }
};

const closeAllDropdowns = () => {
  filterCategoryButtons.forEach((button) => {
    if (button) button.classList.remove('active');
  });
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
    categoryText.textContent = btn.getAttribute('filter') || baseText;
  });
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

const toggleFilterDropdown = (filterButton) => {
  toggleClass(filterButton, 'active');

  if (window.innerWidth > 900) {
    const isActive = filterButton.classList.contains('active');
    filterCategoryButtons.forEach((btn) =>
      btn.classList.toggle('active', btn === filterButton && isActive),
    );
  }
};

const toggleClass = (element, className) => {
  element.classList.toggle(className);
};
