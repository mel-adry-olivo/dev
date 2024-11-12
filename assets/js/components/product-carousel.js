const initCarousel = () => {
  const carousel = document.querySelector('.products__carousel');
  const prevButton = document.querySelector('.products__carousel-control--prev');
  const nextButton = document.querySelector('.products__carousel-control--next');
  const carouselItems = Array.from(carousel.children);
  let itemWidth = carouselItems[0].getBoundingClientRect().width;
  let currentOffset = 0;
  let maxOffset = 0;

  const updateCarouselLimits = () => {
    const containerWidth = carousel.parentElement.getBoundingClientRect().width;
    const totalWidth = carouselItems.length * (itemWidth + 32);
    maxOffset = Math.min(0, containerWidth - totalWidth);
  };

  const updateCarouselPosition = () => {
    carousel.style.transform = `translateX(${currentOffset}px)`;
  };

  const shiftCarousel = (direction) => {
    currentOffset += direction * (itemWidth + 32);
    currentOffset = Math.max(maxOffset, Math.min(currentOffset, 0));
    updateCarouselPosition();
  };

  prevButton.addEventListener('click', () => shiftCarousel(1));
  nextButton.addEventListener('click', () => shiftCarousel(-1));

  window.addEventListener('resize', () => {
    itemWidth = carouselItems[0].getBoundingClientRect().width;
    currentOffset = 0;
    updateCarouselLimits();
    updateCarouselPosition();
  });

  updateCarouselLimits();
  updateCarouselPosition();
};

export default initCarousel;
