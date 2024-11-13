const filterButtons = document.querySelectorAll('.shop__filter-button');
const filterItems = document.querySelectorAll('.shop__filter-category');

const initFilter = () => {
  filterButtons.forEach((button) => {
    button.addEventListener('click', () => openFilterDropdown(button));
  });
  document.addEventListener('click', (e) => {
    if (!e.target.closest('.shop__filter')) closeDropdown();
  });
};

const openFilterDropdown = (button) => {
  button.classList.toggle('active');
  filterButtons.forEach((btn) => {
    if (btn !== button) btn.classList.remove('active');
  });
};

const closeDropdown = () => {
  filterItems.forEach((item) => {
    const dropdown = item.querySelector('.shop__filter-dropdown');
    dropdown.classList.remove('active');
  });
  filterButtons.forEach((button) => button.classList.remove('active'));
};

export default initFilter;
