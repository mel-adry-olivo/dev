// all fetch calls here

export async function product(productId) {
    const url = `./handlers/products/product.php?id=${productId}`;

    try {
        const response = await fetch(url);
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}

export async function filteredItems(filters, productType) {
    const url = './handlers/products/filter.php?type=' + productType;

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: JSON.stringify(filters),
        });
        const filteredItemsHTML = await response.text();
        return filteredItemsHTML;
    } catch (error) {
        console.error(error);
    }
}

export async function productsWithType(productType) {
    const url = `./handlers'/products/products.php?type=${productType}`;

    try {
        const response = await fetch(url);
        const productsHTML = await response.text();
        return productsHTML;
    } catch (error) {
        console.error(error);
    }
}

export async function favoriteProductCard(productId) {
    const url = `./handlers/products/product.php?id=${productId}&type=favorite`;
    try {
        const response = await fetch(url);
        const productHTML = await response.text();
        return productHTML;
    } catch (error) {
        console.error(error);
    }
}
export async function isUserLoggedIn() {
    const url = './handlers/auth/check-login.php';

    try {
        const response = await fetch(url);
        const data = await response.json();
        return data.logged || false;
    } catch (error) {
        console.error(error);
        return false;
    }
}

export async function isProductInBag(productId) {
    const url = './handlers/products/check-bag.php?id=' + productId;

    try {
        const response = await fetch(url);
        const data = await response.json();
        return data.inBag || false;
    } catch (error) {
        console.error(error);
        return false;
    }
}

export async function addFavorite(productId) {
    const url = './handlers/products/favorite.php';
    const body = JSON.stringify({ productId, action: 'add' });

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: body,
        });
        const data = await response.json();
        return data.success;
    } catch (error) {
        console.error(error);
    }
}

export async function removeFavorite(productId) {
    const url = './handlers/products/favorite.php';
    const body = JSON.stringify({ productId, action: 'remove' });

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: body,
        });
        const data = await response.json();
        return data.success;
    } catch (error) {
        console.error(error);
    }
}
