export const checkUserLogin = async () => {
  try {
    const response = await fetch('./routes/auth/check-login.php', {
      method: 'GET',
      headers: { 'Content-Type': 'application/json' },
    });

    const data = await response.json();
    return data.logged || false;
  } catch (error) {
    console.error(error);
    return false;
  }
};

export const toggleClass = (element, className) => {
  element.classList.toggle(className);
};

export const request = async (url, method = 'GET', body = null) => {
  try {
    const response = await fetch(url, {
      method,
      headers: { 'Content-Type': 'application/json' },
      body: body,
    });

    return await response.json();
  } catch (error) {
    console.error(error);
  }
};
