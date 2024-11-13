const initCarousel = () => {
  const carousel = document.querySelector('.products__carousel');
  const prevButton = document.querySelector('.products__carousel-control--prev');
  const nextButton = document.querySelector('.products__carousel-control--next');
  const carouselItems = Array.from(carousel.children);
  const ITEM_GAP = 32;
  let itemWidth = getElementWidth(carouselItems[0]);
  let currentOffset = 0;
  let maxOffset = 0;

  const updateCarouselLimits = () => {
    const containerWidth = getElementWidth(carousel.parentElement);
    const totalItemWidth = itemWidth * carouselItems.length;
    const totalGapWidth = ITEM_GAP * (carouselItems.length - 1);
    const totalWidth = totalItemWidth + totalGapWidth;
    maxOffset = -(totalWidth - containerWidth);
  };

  const updateCarouselPosition = () => {
    carousel.style.transform = `translateX(${currentOffset}px)`;
  };

  const shiftCarousel = (direction) => {
    currentOffset += direction * (itemWidth + ITEM_GAP);
    currentOffset = Math.max(maxOffset, Math.min(currentOffset, 0));
    updateCarouselPosition();
    updateCarouselControls();
  };

  const updateCarouselControls = () => {
    if (currentOffset === 0) {
      prevButton.classList.add('disabled');
    } else {
      prevButton.classList.remove('disabled');
    }

    if (currentOffset === maxOffset) {
      nextButton.classList.add('disabled');
    } else {
      nextButton.classList.remove('disabled');
    }
  };

  prevButton.addEventListener('click', () => shiftCarousel(1));
  nextButton.addEventListener('click', () => shiftCarousel(-1));

  window.addEventListener('resize', () => {
    itemWidth = getElementWidth(carouselItems[0]);
    currentOffset = 0;
    updateCarouselLimits();
    updateCarouselPosition();
    updateCarouselControls();
  });

  updateCarouselLimits();
  updateCarouselPosition();
  updateCarouselControls();
};

const getElementWidth = (element) => parseFloat(globalThis.getComputedStyle(element).width);

export default initCarousel;
