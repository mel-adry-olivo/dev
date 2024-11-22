CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255) NOT NULL,
    lname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    UNIQUE (email)
);

CREATE TABLE brands (
    brand_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE attributes (
    attribute_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

CREATE TABLE products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    brand_id INT,
    name VARCHAR(255) NOT NULL,
    type ENUM('Sunglasses', 'Eyeglasses') NOT NULL,
    price INT NOT NULL,
    gender ENUM('Men', 'Women', 'Unisex') NOT NULL,
    reserve_count INT NOT NULL,
    stock_quantity INT NOT NULL,
    lens_width INT NOT NULL,
    bridge_width INT NOT NULL,
    temple_length INT NOT NULL,
    image_main VARCHAR(255) NOT NULL,
    image_alternate VARCHAR(255) NOT NULL,
    FOREIGN KEY (brand_id) REFERENCES brands(brand_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE product_attributes (
    product_attribute_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    attribute_id INT,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (attribute_id) REFERENCES attributes(attribute_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE favorites (
    favorite_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    added_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE bag (
    bag_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    added_on TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    quantity INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE reserved (
    reserved_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    reserved_on TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT,
    user_id INT,
    rating TINYINT NOT NULL,
    review_text TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO users (fname, lname, email, password)
VALUES
    ('Mel Adry', 'Olivo', 'mel@adry.com', '81dc9bdb52d04dc20036dbd8313ed055');

INSERT INTO brands (brand_id, name)
VALUES
    (1, 'Dior'),
    (2, 'Gucci'),
    (3, 'Cartier'),
    (4, 'Guess');

INSERT INTO categories (category_id, name)
VALUES
    (1, 'Shape'),
    (2, 'Color'),
    (3, 'Material'),
    (4, 'Frame Type'),
    (5, 'Gender');


INSERT INTO attributes (attribute_id, category_id, name)
VALUES
    (1, 1, 'Round'),
    (2, 1, 'Square'),
    (3, 1, 'Rectangle'),
    (4, 2, 'Gold'),
    (5, 2, 'Shiny Black'),
    (6, 2, 'Silver'),
    (7, 2, 'Black'),
    (8, 3, 'Metal'),
    (9, 3, 'Acetate'),
    (10, 4, 'Plastic'),
    (11, 4, 'Full-rim'),
    (12, 4, 'Semi-rim'),
    (13, 4, 'Rimless'),
    (14, 5, 'Men'),
    (15, 5, 'Women'),
    (16, 5, 'Unisex');

INSERT INTO products (product_id, brand_id, name, type, price, gender, reserve_count, stock_quantity, lens_width, bridge_width, temple_length, image_main, image_alternate)
VALUES
    (1, 1, 'CD Link A1U', 'Sunglasses', 37000, 'Men', 12, 45, 61, 13, 145, './assets/images/products/dior-cd-link-a1u-0.png', './assets/images/products/dior-cd-link-a1u-1.png'),
    (2, 2, 'GG1509O', 'Eyeglasses', 21000, 'Men', 8, 20, 54, 20, 145, './assets/images/products/gucci-gg1509o-0.png', './assets/images/products/gucci-gg1509o-1.png'),
    (3, 3, 'CT03710 - Panthère De Cartier', 'Eyeglasses', 75000, 'Women', 14, 35, 56, 18, 140, './assets/images/products/cartier-ct0371o-0.png', './assets/images/products/cartier-ct0371o-1.png'),
    (4, 4, 'GU7538', 'Sunglasses', 3500, 'Women', 32, 60, 54, 16, 140, './assets/images/products/guess-gu7538-0.png', './assets/images/products/guess-gu7538-1.png'),
    (5, 3, 'CT0058O - Panthère De Cartier', 'Eyeglasses', 70000, 'Unisex', 8, 15, 52, 18, 130, './assets/images/products/cartier-ct0058o-0.png', './assets/images/products/cartier-ct0058o-1.png');

INSERT INTO product_attributes (product_attribute_id, product_id, attribute_id)
VALUES
  (1, 1, 1),
  (2, 1, 6),
  (3, 1, 8),
  (4, 1, 11),
  (5, 1, 14),
  (6, 2, 2),
  (7, 2, 7),
  (8, 2, 9),
  (9, 2, 11),
  (10, 2, 14),
  (11, 3, 2),
  (12, 3, 4),
  (13, 3, 8),
  (14, 3, 11),
  (15, 3, 15),
  (16, 4, 3),
  (17, 4, 5),
  (18, 4, 6),
  (19, 4, 11),
  (20, 4, 15),
  (21, 5, 3),
  (22, 5, 6),
  (23, 5, 8),
  (24, 5, 13),
  (25, 5, 16);