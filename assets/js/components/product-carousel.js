const initCarousel = () => {
    const carousels = document.querySelectorAll('.products__carousel');

    carousels.forEach((carousel) => {
        const prevButton = carousel.parentElement.querySelectorAll(
            '.products__carousel-control--prev',
        );
        const nextButton = carousel.parentElement.querySelectorAll(
            '.products__carousel-control--next',
        );
        const carouselItems = Array.from(carousel.children);
        const itemGap = 32;

        let itemWidth = 0;
        let currentOffset = 0;
        let maxOffset = 0;

        const calculateCarouselLimits = () => {
            const containerWidth = carousel.parentElement.clientWidth;
            const totalItemWidth = itemWidth * carouselItems.length;
            const totalGapWidth = itemGap * (carouselItems.length - 1);
            maxOffset = -(totalItemWidth + totalGapWidth - containerWidth);
        };

        const updateCarouselPosition = () => {
            carousel.style.transform = `translateX(${currentOffset}px)`;
        };

        const shiftCarousel = (direction) => {
            currentOffset += direction * (itemWidth + itemGap);
            currentOffset = Math.max(maxOffset, Math.min(currentOffset, 0));
            updateCarouselPosition();
            updateCarouselControls();
        };

        const updateCarouselControls = () => {
            prevButton.disabled = currentOffset === 0;
            nextButton.disabled = currentOffset === maxOffset;
        };

        const handleResize = () => {
            itemWidth = carouselItems[0].clientWidth;
            currentOffset = 0;
            calculateCarouselLimits();
            updateCarouselPosition();
            updateCarouselControls();
        };

        prevButton.forEach((button) =>
            button.addEventListener('click', () => shiftCarousel(1)),
        );
        nextButton.forEach((button) =>
            button.addEventListener('click', () => shiftCarousel(-1)),
        );
        window.addEventListener('resize', handleResize);

        itemWidth = carouselItems[0].clientWidth;
        calculateCarouselLimits();
        updateCarouselPosition();
        updateCarouselControls();
    });
};

export default initCarousel;
