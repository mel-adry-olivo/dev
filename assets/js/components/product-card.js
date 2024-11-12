const productFavoriteButton = document.querySelectorAll('.product__favorite-button');

const initProductCard = () => {
  productFavoriteButton.forEach((button) => {
    const productFavoriteIconUnchecked = button.querySelector('.product__favorite-icon--unchecked');
    const productFavoriteIconChecked = button.querySelector('.product__favorite-icon--checked');

    console.log(button);

    button.addEventListener('mouseenter', () => {
      productFavoriteIconUnchecked.style.display = 'none';
      productFavoriteIconChecked.style.display = 'inline-flex';
    });

    button.addEventListener('mouseleave', () => {
      productFavoriteIconUnchecked.style.display = 'inline-flex';
      productFavoriteIconChecked.style.display = 'none';
    });
  });
};

export default initProductCard;
