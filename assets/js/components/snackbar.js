export const showSnackbar = (message) => {
  const snackbar = document.querySelector('.snackbar');

  snackbar.textContent = message;
  snackbar.classList.add('show');

  setTimeout(() => {
    snackbar.classList.remove('show');
  }, 2500);
};
