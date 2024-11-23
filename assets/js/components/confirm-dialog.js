const pageOverlay = document.querySelector('.confirm-overlay');
const confirmDialog = document.querySelector('.confirm-dialog');
const confirmDialogMessage = document.querySelector('.confirm-message');
const confirmDialogButtonCancel = document.querySelector('.confirm-cancel');
const confirmDialogButtonOk = document.querySelector('.confirm-ok');

export const showConfirmDialog = (message, callback) => {
  pageOverlay.classList.add('show');
  confirmDialog.classList.add('show');
  confirmDialogMessage.textContent = message;

  confirmDialogButtonOk.addEventListener('click', () => {
    pageOverlay.classList.remove('show');
    confirmDialog.classList.remove('show');
    callback(true);
  });

  confirmDialogButtonCancel.addEventListener('click', () => {
    pageOverlay.classList.remove('show');
    confirmDialog.classList.remove('show');
    callback(false);
  });
};
