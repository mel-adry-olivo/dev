export const checkUserLogin = async () => {
  try {
    const response = await fetch('./handlers/auth/check-login.php', {
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

export const checkProductInBag = async (productId) => {
  try {
    const response = await fetch(`./handlers/products/check-bag.php?id=${productId}`, {
      method: 'GET',
      headers: { 'Content-Type': 'application/json' },
    });

    const data = await response.json();
    return data.inBag || false;
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

export const requestHtml = async (url) => {
  try {
    const response = await fetch(url);
    const data = await response.text();
    return data;
  } catch (error) {
    console.error(error);
  }
};
