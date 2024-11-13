CREATE DATABASE eyewear;

CREATE TABLE `user` (
    `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `fname` VARCHAR(255) NOT NULL,
    `lname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    UNIQUE `user_email_unique` (`email`)
);

CREATE TABLE `brand` (
    `brand_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE `frame_type` (
    `frame_type_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE `color` (
    `color_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE `material` (
    `material_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE `item` (
    `item_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `price` INT NOT NULL,
    `stocks` INT NOT NULL,
    `brand_id` INT UNSIGNED NOT NULL,
    `shape_id` INT UNSIGNED NOT NULL,
    `color_id` INT UNSIGNED NOT NULL,
    `material_id` INT UNSIGNED NOT NULL,
    `frame_type_id` INT UNSIGNED NOT NULL,
    `lens_width` INT NOT NULL,
    `bridge_width` INT NOT NULL,
    `temple_length` INT NOT NULL,
    FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (`shape_id`) REFERENCES `shape` (`shape_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (`color_id`) REFERENCES `color` (`color_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (`material_id`) REFERENCES `material` (`material_id`) ON UPDATE CASCADE ON DELETE RESTRICT
    FOREIGN KEY (`frame_type_id`) REFERENCES `frame_type` (`frame_type_id`) ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE `reserved_item` (
    `reserved_item_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `item_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    UNIQUE KEY `unique_reserved_user_item` (`user_id`, `item_id`)
);

CREATE TABLE `cart_item` (
    `cart_item_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NULL,
    `item_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    UNIQUE KEY `unique_cart_user_item` (`user_id`, `item_id`)
);

CREATE TABLE `favorite_item` (
    `favorite_item_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id` INT UNSIGNED NOT NULL,
    `item_id` INT UNSIGNED NOT NULL,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    UNIQUE KEY `unique_favorite_user_item` (`user_id`, `item_id`)
);

CREATE TABLE `review` (
    `review_id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `item_id` INT UNSIGNED NOT NULL,
    `user_id` INT UNSIGNED NOT NULL,
    `rating` TINYINT NOT NULL CHECK (rating BETWEEN 1 AND 5),
    `review_text` TEXT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON UPDATE CASCADE ON DELETE RESTRICT
);


-- Test Data
INSERT INTO `shape` (`name`, `image`) 
VALUES 
    ('Rectangle', 'assets/images/shapes/rectangle.png'),
    ('Square', 'assets/images/shapes/square.png'),
    ('Round', 'assets/images/shapes/round.png');

INSERT INTO `frame_type` (`name`)
VALUES
    ('Full-rim'),
    ('Semi-rim'),
    ('Rimless');

INSERT INTO `brand` (`name`)
VALUES
    ('Dior'),
    ('Gucci');



