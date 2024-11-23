const snackbar = document.getElementById('snackbar');

export const showSnackbar = (message) => {
  snackbar.textContent = message;
  snackbar.classList.add('show');

  setTimeout(() => {
    snackbar.classList.remove('show');
  }, 2500);
};
