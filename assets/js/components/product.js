import { checkUserLogin, request } from '../utils.js';
import { toggleActionMenu } from './action-menu.js';
import { showSnackbar } from './snackbar.js';

const productFavoriteButtons = document.querySelectorAll('.product__favorite-button');
const favoriteContainer = document.querySelector('.favorites__content');

const initFavorites = () => {
  productFavoriteButtons.forEach((button) =>
    button.addEventListener('click', (e) => {
      e.preventDefault();
      handleFavoriteClick(button);
    }),
  );

  favoriteContainer.addEventListener('click', (e) => {
    const button = e.target.closest('.product__card-close');
    if (button) {
      handleRemoveFavorite(button);
    }
  });
};

const handleFavoriteClick = async (button) => {
  if (!(await checkUserLogin())) {
    toggleActionMenu('user');
    showSnackbar('You need to be logged in to add favorites');
    return;
  }

  const productId = button.dataset.id;
  const isFavorite = button.classList.contains('active');
  updateFavoriteButton(productId);
  isFavorite ? removeProductFromFavorite(productId) : addToFavorite(productId);
};

const handleRemoveFavorite = (button) => {
  const productId = button.dataset.id;
  updateFavoriteButton(productId);
  removeProductFromFavorite(productId);
};

const addToFavorite = async (productId) => {
  // insert product into favorites table
  const response = await request(
    './routes/products/favorite.php',
    'POST',
    JSON.stringify({ productId, action: 'add' }),
  );

  // add product card element to UI
  if (response.success) {
    const product = await request(`./routes/products/product.php?id=${productId}`, 'GET');
    addFavoriteCardToUI(product);
    toggleActionMenu('favorites');
  }
};

const addFavoriteCardToUI = (product) => {
  // if empty message exists, remove it
  const emptyContent = favoriteContainer.querySelector('.favorites__empty-content');
  if (emptyContent) {
    emptyContent.remove();
  }

  const productCard = createFavoriteProductCard(product);
  favoriteContainer.innerHTML += productCard;
};

const removeProductFromFavorite = async (productId) => {
  // delete product from database
  const response = await request(
    './routes/products/favorite.php',
    'POST',
    JSON.stringify({ productId, action: 'remove' }),
  );

  // remove product card element from UI
  if (response.success) {
    const productCard = favoriteContainer.querySelector(
      `.product__favorite-card[data-id="${productId}"]`,
    );
    if (productCard) productCard.remove();

    // if favorite container is empty, show empty message
    if (!favoriteContainer.children.length) {
      favoriteContainer.innerHTML += createEmptyContent();
    }

    showSnackbar('Product removed from favorites');
  }
};

const updateFavoriteButton = (productId) => {
  const button = document.querySelector(`.product__favorite-button[data-id="${productId}"]`);
  if (!button) return; // some favorite buttons may not exist on the current page

  const isFavorite = button.classList.contains('active');

  button.setAttribute('data-tooltip', isFavorite ? 'Add to favorites' : 'Remove from favorites');
  button.classList.toggle('active');
};

const handleQuantityChange = (button, change) => {
  const productCard = button.closest('.product__bag-card');
  const productId = productCard.dataset.id;

  const priceElement = productCard.querySelector('.product__bag-price');
  const quantityElement = productCard.querySelector('.product__quantity');

  const currentPrice = parseInt(priceElement.textContent.replace('₱', ''));
  const currentQuantity = parseInt(quantityElement.textContent);

  const newQuantity = Math.max(1, currentQuantity + change);
  const unitPrice = currentPrice / currentQuantity;

  const totalPrice = unitPrice * newQuantity;

  priceElement.textContent = `₱${totalPrice}`;
  quantityElement.textContent = newQuantity;

  // updateProductQuantity(productId, newQuantity);
};

const updateProductQuantity = async (productId, quantity) => {
  // To implement later
};

const createProductCard = (product) => {
  const { product_id, image_main, brand, name, price } = product;
  const favoriteUnchecked =
    '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5C22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1l-.1-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05z"></path></svg>';
  const favoriteChecked =
    '<svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="currentColor"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z"/></svg>';

  return `
        <a href="./product.php?id=${product_id}" class="product__card" data-id="${product_id}">  
            <div class="product__image-container">
                <img src="${image_main}" alt="" class="product__image" width="316" height="">
                <button class="product__favorite-button" data-tooltip="Add to favorites" data-id="${product_id}">
                    <span class="product__favorite-icon product__favorite-icon--unchecked">${favoriteUnchecked}</span>
                    <span class="product__favorite-icon product__favorite-icon--checked" data-tooltip="Remove from favorites">${favoriteChecked}</span>
                </button>
            </div>
            <div class="product__text-wrapper">
                <span class="product__brand">${brand}</span>
                <span class="product__name">${name}</span>
                <span class="product__price">${price}</span>
            </div>
        </a>
    `;
};

const createFavoriteProductCard = (product) => {
  const { product_id, image_main, brand, name, price } = product;
  const closeIcon =
    '<svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>';

  return `
    <div class="product__favorite-card" data-id="${product_id}">  
        <button class="icon-container product__card-close" data-id="${product_id}">${closeIcon}</button>
        <div class="product__image-container">
            <img src="${image_main}" alt="" class="product__image" width="316" height="">
        </div>
        <div class="product__favorite-info">
            <div class="product__favorite-text-wrapper">
                <span class="product__favorite-brand">${brand}</span>
                <a  href="./product.php?id=${product_id}" class="product__favorite-name">${name}</a>
            </div>
            <button class="button-link product__favorite-action">Add to bag</button>
        </div>
        <span class="product__favorite-price">₱${price}</span>
    </div>
  `;
};

const createEmptyContent = () => {
  return `
  <div class="favorites__empty-content">
        <span class="favorites__empty-text">Your favorites is empty</span>
        <a href="./shop.php" class="button-link favorites__explore">Explore</a>
    </div>
  `;
};

export { initFavorites, createProductCard };
