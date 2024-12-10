import * as fetch from '../services/fetch.js';
import { toggleClass } from '../utils/dom.js';
import { element, elements } from '../utils/dom.js';

const filterCategoryButtons = element('.shop__dropdown-button');
const filterItems = element('.shop__dropdown-item[filter]');
const sortItems = element('.shop__dropdown-item[sort-order]');

const filterButtonMobile = element('.shop__filter-button-mobile');
const filterContainer = element('.shop__filter-container');
const filterCloseButton = element('.shop__filter-close-button');
const filterResetButtonMobile = element('.shop__filter-reset-mobile');
const filterResetButton = element('.shop__filter-reset-desktop');
const pageOverlay = element('.page-overlay-filter');
const body = document.body;
const productType = new URLSearchParams(window.location.search).get('type');

const container = element('.shop__toolbar');

export default function initFilter() {
    window.addEventListener('resize', () => handleResize());

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.shop__toolbar')) {
            closeAllDropdowns();
        }

        if (e.target.matches('.page-overlay-filter')) {
            handlePageOverlayClick(e);
        }
    });

    container.addEventListener('click', (e) => {
        if (e.target.matches('.shop__dropdown-button')) {
            toggleFilterDropdown(e.target);
        }

        if (e.target.matches('.shop__dropdown-item[filter]')) {
            handleFilterItemClick(e.target);
        }

        if (e.target.matches('.shop__dropdown-item[sort-order]')) {
            handleSortItemClick(e.target);
        }

        if (e.target.matches('.shop__filter-button-mobile')) {
            toggleMobileFilters();
        }

        if (e.target.matches('.shop__filter-close-button')) {
            toggleMobileFilters();
        }

        if (e.target.matches('.shop__filter-reset-desktop')) {
            handleResetFilterClick();
        }

        if (e.target.matches('.shop__filter-reset-mobile')) {
            handleResetFilterClick();
            toggleMobileFilters();
        }
    });

    const params = new URLSearchParams(window.location.search);
    if (params.has('shape')) {
        setSelectedFilter('Shape', params.get('shape'));
    }

    pageOverlay.addEventListener('click', handlePageOverlayClick);

    sortProducts('DESC');
}

export function setSelectedFilter(filter, item) {
    const dropdownItem = element(
        `.shop__dropdown-item[filter="${filter}"][data-value="${item}"]`,
    );

    if (dropdownItem) {
        handleFilterItemClick(dropdownItem);
    }
}

function handleFilterItemClick(item) {
    toggleClass(item, 'active');
    updateCategoryText(item);
    checkResetFilter();
    applyFilters();
}

async function handleSortItemClick(item) {
    if (!item.hasAttribute('sort-order')) return;
    if (item.classList.contains('active')) return;

    sortItems.forEach((it) => it.classList.toggle('active', it === item));
    const sortOrder = item.getAttribute('sort-order');

    sortProducts(sortOrder);
}

async function applyFilters() {
    const activeFilterItems = elements('.shop__dropdown-item.active[filter]');
    const filters = {};

    // create object [category][array of items]
    // ex. { Shape: [Square, Rectangle], Color: [Black] }
    activeFilterItems.forEach((item) => {
        const itemCategory = item.getAttribute('filter');
        const itemName = item.getAttribute('data-value');

        if (!filters[itemCategory]) {
            filters[itemCategory] = [];
        }
        filters[itemCategory].push(itemName);
    });

    const filteredProducts = await fetch.filteredItems(filters, productType);
    updateProductUI(filteredProducts);
}

function sortProducts(sortOrder) {
    const currentProducts = element('.product__card');
    const sortedProducts = [...currentProducts].sort((a, b) => {
        function getPrice(product) {
            const price = product.querySelector('.product__price').textContent;
            return parseFloat(price.replace('₱', '').trim());
        }
        return getPrice(a) - getPrice(b);
    });

    if (sortOrder === 'DESC') sortedProducts.reverse();

    updateProductUI(sortedProducts);
}

async function handleResetFilterClick() {
    filterItems.forEach((item) => item.classList.remove('active'));
    checkResetFilter();

    const products = await fetch.productsWithType(productType);
    updateProductUI(products);
    resetCategoryButtonTexts();
}

function updateProductUI(data) {
    const productCount = element('.shop__toolbar-count');
    const productContainer = element('.product-catalog');

    productContainer.innerHTML = '';

    if (typeof data === 'string') {
        productContainer.innerHTML = data;
        const length = productContainer.children.length;
        productCount.textContent =
            data.length > 1 ? `${length} Products` : `${length} Product`;
    } else {
        // elements from sorting
        data.forEach((product) => {
            productContainer.appendChild(product);
        });
    }
}

// adding '(n)' to the category text if there are active items
function updateCategoryText(item) {
    const itemsContainer = item.closest('.shop__dropdown-container');
    const categoryButton = itemsContainer.parentElement.querySelector(
        '.shop__dropdown-button-text',
    );
    const categoryName = item.getAttribute('filter');
    const activeItems = itemsContainer.querySelectorAll(
        '.shop__dropdown-item.active',
    );
    const activeCount = activeItems.length;
    categoryButton.textContent =
        activeCount > 0 ? `${categoryName} (${activeCount})` : categoryName;
}

// if filter container is open while resizing, close it
function handleResize() {
    if (pageOverlay.classList.contains('show')) {
        toggleMobileFilters();
    }
}

// if click outside filter container, close it

function closeAllDropdowns() {
    filterCategoryButtons.forEach((button) => {
        if (button) button.classList.remove('active');
    });
}

function checkResetFilter() {
    const activeCount = elements('.shop__dropdown-item.active[filter]').length;
    if (activeCount > 0) {
        filterResetButtonMobile.classList.add('show');
        filterResetButton.classList.add('show');
    } else {
        filterResetButtonMobile.classList.remove('show');
        filterResetButton.classList.remove('show');
    }
}

function resetCategoryButtonTexts() {
    filterCategoryButtons.forEach((btn) => {
        const categoryText = btn.querySelector('.shop__dropdown-button-text');
        const baseText = categoryText.dataset.text || categoryText.textContent;
        categoryText.textContent = btn.getAttribute('filter') || baseText;
    });
}

function handlePageOverlayClick(e) {
    if (
        e.target === pageOverlay &&
        filterContainer.classList.contains('show')
    ) {
        toggleMobileFilters();
    }
}
function toggleMobileFilters() {
    toggleClass(pageOverlay, 'show');
    toggleClass(filterContainer, 'show');
    toggleClass(body, 'no-scroll');
}

function toggleFilterDropdown(filterButton) {
    toggleClass(filterButton, 'active');

    if (window.innerWidth > 900) {
        const isActive = filterButton.classList.contains('active');
        filterCategoryButtons.forEach((btn) =>
            btn.classList.toggle('active', btn === filterButton && isActive),
        );
    }
}
