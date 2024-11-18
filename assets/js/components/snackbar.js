const snackbar = document.getElementById('snackbar');

export const showSnackbar = (message, callback) => {
  snackbar.textContent = message;
  snackbar.classList.add('show');

  setTimeout(() => {
    snackbar.classList.remove('show');
    if (callback) {
      callback();
    }
  }, 2500);
};
