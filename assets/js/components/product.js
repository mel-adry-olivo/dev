import { checkUserLogin, request, toggleClass } from '../utils.js';
import { toggleActionMenu } from './action-menu.js';
import { showSnackbar } from './snackbar.js';

const productFavoriteButton = document.querySelectorAll('.product__favorite-button');
const favoriteContainer = document.querySelector('.favorites__content');

const initFavorites = () => {
  productFavoriteButton.forEach((button) => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      handleFavoriteClick(button);
    });
  });
};

const handleFavoriteClick = async (button) => {
  const isLogged = await checkUserLogin();
  if (!isLogged) {
    toggleActionMenu('user');
    showSnackbar('You need to be logged in to add favorites');
  } else {
    addProductToFavorite(button);
    toggleActionMenu('favorites');
  }
};

const addProductToFavorite = async (button) => {
  toggleClass(button, 'active');
  const productId = button.getAttribute('data-id');

  const url = './routes/products/favorite.php';
  const action = button.classList.contains('active') ? 'add' : 'remove';

  const response = await request(url, 'POST', JSON.stringify({ productId, action }));
  if (response.success) {
    const url = './routes/products/product.php?id=' + productId;
    const product = await request(url, 'GET');
    if (button.classList.contains('active')) {
      const productCard = createProductCard(product);
      favoriteContainer.innerHTML += productCard;
    } else {
      const productCard = favoriteContainer.querySelector(`.product__card[data-id="${productId}"]`);
      if (productCard) productCard.remove();
    }
  }
};

// for dynamic filtering
const createProductCard = (product) => {
  const { product_id, image_main, brand, name, price } = product;
  const favoriteUnchecked =
    '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3C4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5C22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1l-.1-.1C7.14 14.24 4 11.39 4 8.5C4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5c0 2.89-3.14 5.74-7.9 10.05z"></path></svg>';
  const favoriteChecked =
    '<svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 -960 960 960" width="20" fill="currentColor"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z"/></svg>';

  return `
        <a href="#" class="product__card" data-id="${product_id}">  
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

export { initFavorites, createProductCard };
