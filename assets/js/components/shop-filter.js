const filterButton = document.querySelectorAll('.shop__filter-button');
const filterItems = document.querySelectorAll('.shop__filter-category');

const initFilter = () => {
  filterButton.forEach((button) =>
    button.addEventListener('click', () => {
      filterButton.forEach((btn) => btn.classList.remove('active'));
      button.classList.add('active');
    }),
  );

  filterItems.forEach((item) =>
    item.addEventListener('click', (e) => {
      filterItems.forEach((i) =>
        i.querySelector('.shop__filter-dropdown').classList.remove('active'),
      );
      item.querySelector('.shop__filter-dropdown').classList.add('active');
    }),
  );

  document.addEventListener('click', (e) => {
    if (!e.target.closest('.shop__filter')) {
      filterItems.forEach((i) =>
        i.querySelector('.shop__filter-dropdown').classList.remove('active'),
      );
    }
  });
};

export default initFilter;
