const pageOverlay = document.querySelector('.confirm__overlay');
const confirmDialog = document.querySelector('.confirm__dialog');
const confirmDialogMessage = document.querySelector('.confirm__message');
const confirmDialogButtonCancel = document.querySelector('.confirm__cancel');
const confirmDialogButtonOk = document.querySelector('.confirm__ok');

export const showConfirmDialog = (message, callback) => {
  pageOverlay.classList.add('show');
  confirmDialog.classList.add('show');
  confirmDialogMessage.textContent = message;

  confirmDialogButtonOk.addEventListener('click', () => {
    hideConfirmDialog();
    callback(true);
  });

  confirmDialogButtonCancel.addEventListener('click', () => {
    hideConfirmDialog();
    callback(false);
  });
};

export const hideConfirmDialog = () => {
  pageOverlay.classList.remove('show');
  confirmDialog.classList.remove('show');
};
