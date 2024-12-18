import { toggleActionMenu } from './action-menu.js';
import { showSnackbar } from './snackbar.js';
import { showConfirmDialog } from './confirm-dialog.js';
import * as fetch from '../services/fetch.js';
import { element, elements, toggleClass } from '../utils/dom.js';

const productFavoriteButtons = elements('.product__favorite-button');
const favoriteContainer = element('.favorites__content');

const initFavorites = () => {
    productFavoriteButtons.forEach((button) =>
        button.addEventListener('click', (e) => {
            e.preventDefault();
            handleFavoriteClick(button);
        }),
    );

    document.addEventListener('click', (e) => {
        if (e.target.matches('.product__favorite-card .product__card-close')) {
            e.preventDefault();
            handleRemoveFavorite(e.target);
        }

        if (e.target.matches('.product__favorite-form .product__favorite-action')) {
            e.preventDefault();
            handleAddToBagFromFavorite(e.target);
        }
    });
};

function handleAddToBagFromFavorite(btn) {
    toggleActionMenu();

    const message = 'Do you want to add this product to your bag?';
    showConfirmDialog(message, (confirmed) => {
        if (confirmed) {
            const productCard = btn.closest('.product__favorite-card');
            const form = btn.closest('form');
            removeProductFromFavorite(productCard.dataset.id);
            updateFavoriteButton(productCard.dataset.id);
            form.submit();
        } else {
            toggleActionMenu('favorites');
        }
    });
}

async function handleFavoriteClick(button) {
    const productId = button.dataset.id;
    const isFavorite = button.classList.contains('active');
    const isUserLoggedIn = await fetch.isUserLoggedIn();

    if (!isUserLoggedIn) {
        toggleActionMenu('user');
        showSnackbar('You need to be logged in to add favorites');
        return;
    }

    const isReserved = await fetch.isProductReserved(productId);

    if (isReserved) {
        showSnackbar('Product is already reserved');
        return;
    }

    const inBag = await fetch.isProductInBag(productId);

    if (inBag) {
        showSnackbar('Product already in bag');
        return;
    }

    updateFavoriteButton(productId);

    if (isFavorite) {
        removeProductFromFavorite(productId);
    } else {
        addToFavorite(productId);
    }
}

function handleRemoveFavorite(button) {
    const productId = button.dataset.id;
    updateFavoriteButton(productId);
    removeProductFromFavorite(productId);
    showSnackbar('Product removed from favorites');
}

async function addToFavorite(productId) {
    if (await fetch.addFavorite(productId)) {
        const product = await fetch.favoriteProductCard(productId);
        addFavoriteCardToUI(product);
        toggleActionMenu('favorites');
    }
}
async function removeProductFromFavorite(productId) {
    if (await fetch.removeFavorite(productId)) {
        removeProductCardFromUI(productId);
    }
}

function addFavoriteCardToUI(product) {
    const emptyContent = favoriteContainer.querySelector('.favorites__empty-content');
    if (emptyContent) {
        emptyContent.remove();
    }
    favoriteContainer.innerHTML += product;
}

function removeProductCardFromUI(productId) {
    const productCard = favoriteContainer.querySelector(`.product__favorite-card[data-id="${productId}"]`);
    if (productCard) productCard.remove();
    if (!favoriteContainer.children.length) {
        favoriteContainer.innerHTML += createEmptyContent();
    }
}

function updateFavoriteButton(productId) {
    const button = element(`.product__favorite-button[data-id="${productId}"]`);
    if (!button) return; // could be in pages where favorite button is not displayed

    const isFavorite = button.classList.contains('active');
    button.setAttribute('data-tooltip', isFavorite ? 'Add to favorites' : 'Remove from favorites');
    toggleClass(button, 'active');
}

const createEmptyContent = () => {
    return `
  <div class="favorites__empty-content">
        <span class="favorites__empty-text">Your favorites is empty</span>
        <a href="./shop.php" class="button-link favorites__explore">Explore</a>
    </div>
  `;
};

export { initFavorites, handleAddToBagFromFavorite };
