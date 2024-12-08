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
    ('John', 'Doe', 'john.doe@example.com', '81dc9bdb52d04dc20036dbd8313ed055'),  -- password: 1234
    ('Jane', 'Smith', 'jane.smith@example.com', '202cb962ac59075b964b07152d234b70'),  -- password: 123
    ('Alex', 'Johnson', 'alex.johnson@example.com', '098f6bcd4621d373cade4e832627b4f6'),  -- password: test
    ('Emily', 'Davis', 'emily.davis@example.com', 'f4b4cb1322cba580b2c21fcd491b3459'),  -- password: password
    ('David', 'Martinez', 'david.martinez@example.com', '25d55ad283aa400af464c76d713c07ad'),  -- password: hello
    ('Sophia', 'Williams', 'sophia.williams@example.com', 'c81e728d9d4c2f636f067f89cc14862c'),  -- password: password1
    ('Michael', 'Brown', 'michael.brown@example.com', 'd8578edf8458ce06fbc5bb2b8a1e4a9e8');  -- password: qwerty

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
    (10, 3, 'Plastic'),
    (11, 4, 'Full-rim'),
    (12, 4, 'Semi-rim'),
    (13, 4, 'Rimless'),
    (14, 5, 'Men'),
    (15, 5, 'Women'),
    (16, 5, 'Unisex');

INSERT INTO products (product_id, brand_id, name, type, price, reserve_count, stock_quantity, lens_width, bridge_width, temple_length, image_main, image_alternate)
VALUES
    (1, 1, 'CD Link A1U', 'Sunglasses', 37000, 12, 45, 61, 13, 145, './assets/images/products/dior-cd-link-a1u-0.png', './assets/images/products/dior-cd-link-a1u-1.png'),
    (2, 2, 'GG1509O', 'Eyeglasses', 21000, 8, 20, 54, 20, 145, './assets/images/products/gucci-gg1509o-0.png', './assets/images/products/gucci-gg1509o-1.png'),
    (3, 3, 'CT03710 - Panthère De Cartier', 'Eyeglasses', 75000, 14, 35, 56, 18, 140, './assets/images/products/cartier-ct0371o-0.png', './assets/images/products/cartier-ct0371o-1.png'),
    (4, 4, 'GU7538', 'Sunglasses', 3500, 32, 60, 54, 16, 140, './assets/images/products/guess-gu7538-0.png', './assets/images/products/guess-gu7538-1.png'),
    (5, 3, 'CT0058O - Panthère De Cartier', 'Eyeglasses', 70000, 8, 15, 52, 18, 130, './assets/images/products/cartier-ct0058o-0.png', './assets/images/products/cartier-ct0058o-1.png');

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
    (18, 4, 10),
    (19, 4, 11),
    (20, 4, 15),
    (21, 5, 3),
    (22, 5, 6),
    (23, 5, 8),
    (24, 5, 13),
    (25, 5, 16);


-- Sample data (thanks chatgpt)
INSERT INTO reviews (product_id, user_id, rating, review_text)
VALUES
    (1, 1, 5, 'These sunglasses are perfect! They fit well and the design is top-notch. Highly recommend for anyone looking for a stylish accessory.'),
    (2, 1, 4, 'Great glasses, but the frame is a little wider than expected. Still, a good choice for everyday use.'),
    (3, 1, 5, 'Absolutely love these eyeglasses! The quality and design are amazing. Worth every penny.'),
    (4, 1, 3, 'These sunglasses are decent, but not as durable as I expected. The look is good though, so I still like them.'),
    (5, 1, 4, 'Elegant eyeglasses, perfect for a professional look. They are a bit pricey, but the quality is great!'),

    (1, 2, 4, 'Stylish sunglasses with a great fit. They feel a bit fragile, but they look amazing on.'),
    (2, 2, 3, 'The eyeglasses are okay. They don’t fit my face well, but the style is nice if they suit your face shape.'),
    (3, 2, 4, 'Good quality glasses with a sleek look. I love the gold accents and the fit is perfect for my face.'),
    (4, 2, 2, 'Not a fan of these sunglasses. They feel cheap and uncomfortable after wearing them for a while.'),
    (5, 2, 5, 'These eyeglasses are fantastic! Light yet durable, and they go well with both casual and formal outfits.'),

    (1, 3, 4, 'Nice sunglasses, very stylish. The frame is comfortable, but the lenses could be a bit larger.'),
    (2, 3, 5, 'I love these eyeglasses! The fit is perfect, and the color is exactly what I was looking for.'),
    (3, 3, 4, 'Great eyeglasses, very comfortable. However, the design is a little plain compared to others I’ve tried.'),
    (4, 3, 3, 'These sunglasses are alright. They look decent, but I expected better quality for the price.'),
    (5, 3, 5, 'Amazing eyeglasses! They fit so well, and the material feels premium. Highly recommended.'),

    (1, 4, 3, 'The sunglasses are fine, but they feel a bit flimsy. The design is good though, so I still like them.'),
    (2, 4, 4, 'The glasses look great, but they’re a bit too big for my face. Would have preferred a smaller size option.'),
    (3, 4, 5, 'These eyeglasses are perfect! The design is luxurious and fits perfectly. Definitely worth the investment.'),
    (4, 4, 4, 'Good sunglasses, comfortable and stylish. The only downside is that the lenses could be clearer.'),
    (5, 4, 2, 'Not impressed with these eyeglasses. The frames are heavy and not comfortable for long use.'),

    (1, 5, 4, 'Nice sunglasses. The look is cool, and the fit is good, though I wish the frame were a bit sturdier.'),
    (2, 5, 5, 'These eyeglasses are exactly what I was looking for! Stylish and practical, they fit perfectly and feel light.'),
    (3, 5, 5, 'I’m in love with these eyeglasses. They’re elegant, comfortable, and the quality is top-notch. Worth every penny.'),
    (4, 5, 3, 'The sunglasses are fine, but I feel they lack the quality expected for the price. They look good, though.'),
    (5, 5, 4, 'Great eyeglasses! They fit well, and the design is very fashionable. The only downside is the price.'),
    
    (1, 6, 4, 'Stylish sunglasses, but they feel a bit fragile. The lenses are great, though, and they look good on.'),
    (2, 6, 3, 'The glasses are okay, but the frames are too wide for my face. They could be more comfortable.'),
    (3, 6, 4, 'Great eyeglasses with a modern design. The fit is good, but I would have liked more color options.'),
    (4, 6, 5, 'I love these sunglasses! They’re very comfortable, stylish, and lightweight. Definitely recommend them.'),
    (5, 6, 3, 'Decent eyeglasses, but they don’t feel as durable as other options I’ve tried. Still, they look nice and fit well.'),

    (1, 7, 5, 'Perfect sunglasses. They fit well, and the design is sophisticated. Exactly what I was looking for.'),
    (2, 7, 4, 'These eyeglasses are nice, but the frame is a little wide. They’re stylish, though, and the lenses are high quality.'),
    (3, 7, 4, 'Good eyeglasses. They are comfortable and lightweight. The only issue is the color options available.'),
    (4, 7, 5, 'Fantastic sunglasses! They’re very stylish, fit perfectly, and feel great to wear. Highly recommend them.'),
    (5, 7, 3, 'These eyeglasses are alright. The frame feels a bit heavy, and the design could be more modern.');

    (1, 4, 5, 'Incredible sunglasses. I love the design and the fit is perfect! I wear them every day now.'),
    (2, 6, 2, 'I didn’t like these eyeglasses. The style wasn’t for me and they didn’t sit well on my face.'),
    (3, 5, 3, 'The eyeglasses are okay but they didn’t really suit me. I expected a better fit for my face.'),
    (1, 7, 4, 'Stylish sunglasses, but a little heavy for long wear. They do look great though.'),
    (5, 3, 5, 'These eyeglasses are amazing! Perfect fit, comfortable, and the material feels high-end.'),
    (4, 2, 4, 'Great pair of sunglasses! The look is stylish, but I had to get used to the feel on my nose after a few hours.'),
    (2, 5, 5, 'I’m absolutely loving these glasses. Comfortable, lightweight, and great for everyday wear.'),
    (3, 6, 2, 'The eyeglasses didn’t work for me. They felt cheap and uncomfortable to wear for long periods.'),
    (4, 7, 4, 'Great sunglasses! They’re comfortable and look awesome. The only downside is that the frame feels a bit delicate.'),
    (5, 4, 5, 'I love these eyeglasses! They fit well, and the design is so elegant. I get compliments every time I wear them!');