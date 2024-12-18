import { elements, parentElements } from '../utils/dom.js';

// with the help of chatgpt hahaha
const initCarousel = () => {
    const carousels = elements('.products__carousel');

    carousels.forEach((carousel) => {
        const prevButton = parentElements(carousel, '.products__carousel-control--prev');
        const nextButton = parentElements(carousel, '.products__carousel-control--next');
        const carouselItems = Array.from(carousel.children);
        const itemGap = 32;

        let itemWidth = 0;
        let currOffset = 0;
        let maxOffset = 0;

        const calculateCarouselLimits = () => {
            const containerWidth = carousel.parentElement.clientWidth;
            const totalItemWidth = itemWidth * carouselItems.length;
            const totalGapWidth = itemGap * (carouselItems.length - 1);
            maxOffset = -(totalItemWidth + totalGapWidth - containerWidth);
        };

        const updateCarouselPosition = () => {
            carousel.style.transform = `translateX(${currOffset}px)`;
        };

        const shiftCarousel = (direction) => {
            currOffset += direction * (itemWidth + itemGap);
            currOffset = Math.max(maxOffset, Math.min(currOffset, 0));
            updateCarouselPosition();
            updateCarouselControls();
        };

        const updateCarouselControls = () => {
            prevButton.forEach((b) => (b.disabled = currOffset === 0));
            nextButton.forEach((b) => (b.disabled = currOffset === maxOffset));
        };

        const handleResize = () => {
            itemWidth = carouselItems[0].clientWidth;
            currOffset = 0;
            calculateCarouselLimits();
            updateCarouselPosition();
            updateCarouselControls();
        };

        prevButton.forEach((button) => button.addEventListener('click', () => shiftCarousel(1)));
        nextButton.forEach((button) => button.addEventListener('click', () => shiftCarousel(-1)));
        window.addEventListener('resize', handleResize);

        itemWidth = carouselItems[0].clientWidth;
        calculateCarouselLimits();
        updateCarouselPosition();
        updateCarouselControls();
    });
};

export default initCarousel;
