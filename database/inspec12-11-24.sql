

--
-- Database: `inspec`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `attribute_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`attribute_id`, `category_id`, `name`) VALUES
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
(16, 5, 'Unisex'),
(30, 1, 'Butterfly'),
(31, 2, 'Shiny Palladium'),
(32, 1, 'Cat Eye'),
(33, 2, 'Gray'),
(34, 2, 'Gunmetal');

-- --------------------------------------------------------

--
-- Table structure for table `bag`
--

CREATE TABLE `bag` (
  `bag_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `name`) VALUES
(1, 'Dior'),
(2, 'Gucci'),
(3, 'Cartier'),
(4, 'Guess'),
(5, 'Celine'),
(6, 'Prada'),
(7, 'Ray-Ban');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Shape'),
(2, 'Color'),
(3, 'Material'),
(4, 'Frame Type'),
(5, 'Gender');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favorite_id`, `user_id`, `product_id`, `added_at`) VALUES
(217, 2, 5, '2024-11-26 10:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Sunglasses','Eyeglasses') NOT NULL,
  `price` int(11) NOT NULL,
  `gender` enum('Men','Women','Unisex') NOT NULL,
  `lens_width` int(11) NOT NULL,
  `bridge_width` int(11) NOT NULL,
  `temple_length` int(11) NOT NULL,
  `image_main` varchar(255) NOT NULL,
  `image_alternate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `brand_id`, `name`, `type`, `price`, `gender`, `lens_width`, `bridge_width`, `temple_length`, `image_main`, `image_alternate`) VALUES
(1, 1, 'CD Link A1U', 'Sunglasses', 37000, 'Men', 61, 13, 145, './assets/images/products/dior-cd-link-a1u-0.png', './assets/images/products/dior-cd-link-a1u-1.png'),
(2, 2, 'GG1509O', 'Eyeglasses', 21000, 'Men', 54, 20, 145, './assets/images/products/gucci-gg1509o-0.png', './assets/images/products/gucci-gg1509o-1.png'),
(3, 3, 'CT03710 - Panthère De Cartier', 'Eyeglasses', 75000, 'Women', 56, 18, 140, './assets/images/products/cartier-ct0371o-0.png', './assets/images/products/cartier-ct0371o-1.png'),
(4, 4, 'GU7538', 'Sunglasses', 3500, 'Women', 54, 16, 140, './assets/images/products/guess-gu7538-0.png', './assets/images/products/guess-gu7538-1.png'),
(5, 3, 'CT0058O - Panthère De Cartier', 'Eyeglasses', 70000, 'Unisex', 52, 18, 130, './assets/images/products/cartier-ct0058o-0.png', './assets/images/products/cartier-ct0058o-1.png'),
(17, 1, 'DiorBlackSuit R7U BioAcetate', 'Sunglasses', 18000, 'Men', 50, 23, 145, './assets/images/products/dior-diorblacksuit-r7u-bioacetate-0.png', './assets/images/products/dior-diorblacksuit-r7u-bioacetate-1.png'),
(20, 5, 'CL50036U', 'Eyeglasses', 21000, 'Men', 50, 19, 145, './assets/images/products/celine-cl50036u-0.png', './assets/images/products/celine-cl50036u-1.png'),
(24, 5, 'CL50152U', 'Eyeglasses', 26000, 'Men', 56, 17, 140, './assets/images/products/celine-cl50152u-0.png', './assets/images/products/celine-cl50152u-1.png'),
(25, 3, 'CT0399S', 'Sunglasses', 48000, 'Men', 62, 15, 140, './assets/images/products/cartier-ct0399s-0.png', './assets/images/products/cartier-ct0399s-1.png'),
(26, 6, 'SPR67X', 'Sunglasses', 12000, 'Men', 58, 19, 145, './assets/images/products/prada-spr67x-0.png', './assets/images/products/prada-spr67x-1.png'),
(27, 7, 'RB3857V', 'Eyeglasses', 3500, 'Men', 51, 20, 145, './assets/images/products/ray-ban-rb3857v-0.png', './assets/images/products/ray-ban-rb3857v-1.png'),
(28, 7, 'Jack RB3565', 'Sunglasses', 6000, 'Men', 51, 20, 145, './assets/images/products/ray-ban-jack-rb3565-0.png', './assets/images/products/ray-ban-jack-rb3565-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `product_attribute_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `attribute_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_attributes`
--

INSERT INTO `product_attributes` (`product_attribute_id`, `product_id`, `attribute_id`) VALUES
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
(25, 5, 16),
(68, 17, 11),
(69, 17, 1),
(70, 17, 7),
(71, 17, 9),
(72, 17, 14),
(83, 20, 11),
(84, 20, 1),
(85, 20, 4),
(86, 20, 8),
(87, 20, 15),
(93, 24, 11),
(94, 24, 30),
(95, 24, 31),
(96, 24, 8),
(97, 24, 15),
(98, 25, 13),
(99, 25, 32),
(100, 25, 4),
(101, 25, 8),
(102, 25, 15),
(103, 26, 11),
(104, 26, 2),
(105, 26, 33),
(106, 26, 8),
(107, 26, 16),
(108, 27, 12),
(109, 27, 2),
(110, 27, 34),
(111, 27, 8),
(112, 27, 14),
(113, 28, 11),
(114, 28, 3),
(115, 28, 6),
(116, 28, 8),
(117, 28, 14);

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

CREATE TABLE `reserved` (
  `reserved_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `reserved_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reserved`
--

INSERT INTO `reserved` (`reserved_id`, `user_id`, `product_id`, `reserved_on`) VALUES
(27, 1, 1, '2024-12-11 14:58:42');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` tinyint(4) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `user_id`, `rating`, `review_text`, `created_at`) VALUES
(5, 5, 1, 4, 'Elegant eyeglasses, perfect for a professional look. They are a bit pricey, but the quality is great!', '2024-11-26 09:54:45'),
(6, 1, 2, 4, 'Stylish sunglasses with a great fit. They feel a bit fragile, but they look amazing on.', '2024-11-26 09:54:45'),
(7, 2, 2, 3, 'The eyeglasses are okay. They don’t fit my face well, but the style is nice if they suit your face shape.', '2024-11-26 09:54:45'),
(8, 3, 2, 4, 'Good quality glasses with a sleek look. I love the gold accents and the fit is perfect for my face.', '2024-11-26 09:54:45'),
(9, 4, 2, 2, 'Not a fan of these sunglasses. They feel cheap and uncomfortable after wearing them for a while.', '2024-11-26 09:54:45'),
(10, 5, 2, 5, 'These eyeglasses are fantastic! Light yet durable, and they go well with both casual and formal outfits.', '2024-11-26 09:54:45'),
(11, 1, 3, 4, 'Nice sunglasses, very stylish. The frame is comfortable, but the lenses could be a bit larger.', '2024-11-26 09:54:45'),
(12, 2, 3, 5, 'I love these eyeglasses! The fit is perfect, and the color is exactly what I was looking for.', '2024-11-26 09:54:45'),
(13, 3, 3, 4, 'Great eyeglasses, very comfortable. However, the design is a little plain compared to others I’ve tried.', '2024-11-26 09:54:45'),
(14, 4, 3, 3, 'These sunglasses are alright. They look decent, but I expected better quality for the price.', '2024-11-26 09:54:45'),
(15, 5, 3, 5, 'Amazing eyeglasses! They fit so well, and the material feels premium. Highly recommended.', '2024-11-26 09:54:45'),
(16, 1, 4, 3, 'The sunglasses are fine, but they feel a bit flimsy. The design is good though, so I still like them.', '2024-11-26 09:54:45'),
(17, 2, 4, 4, 'The glasses look great, but they’re a bit too big for my face. Would have preferred a smaller size option.', '2024-11-26 09:54:45'),
(18, 3, 4, 5, 'These eyeglasses are perfect! The design is luxurious and fits perfectly. Definitely worth the investment.', '2024-11-26 09:54:45'),
(19, 4, 4, 4, 'Good sunglasses, comfortable and stylish. The only downside is that the lenses could be clearer.', '2024-11-26 09:54:45'),
(20, 5, 4, 2, 'Not impressed with these eyeglasses. The frames are heavy and not comfortable for long use.', '2024-11-26 09:54:45'),
(21, 1, 5, 4, 'Nice sunglasses. The look is cool, and the fit is good, though I wish the frame were a bit sturdier.', '2024-11-26 09:54:45'),
(22, 2, 5, 5, 'These eyeglasses are exactly what I was looking for! Stylish and practical, they fit perfectly and feel light.', '2024-11-26 09:54:45'),
(23, 3, 5, 5, 'I’m in love with these eyeglasses. They’re elegant, comfortable, and the quality is top-notch. Worth every penny.', '2024-11-26 09:54:45'),
(24, 4, 5, 3, 'The sunglasses are fine, but I feel they lack the quality expected for the price. They look good, though.', '2024-11-26 09:54:45'),
(25, 5, 5, 4, 'Great eyeglasses! They fit well, and the design is very fashionable. The only downside is the price.', '2024-11-26 09:54:45'),
(26, 1, 6, 4, 'Stylish sunglasses, but they feel a bit fragile. The lenses are great, though, and they look good on.', '2024-11-26 09:54:45'),
(27, 2, 6, 3, 'The glasses are okay, but the frames are too wide for my face. They could be more comfortable.', '2024-11-26 09:54:45'),
(28, 3, 6, 4, 'Great eyeglasses with a modern design. The fit is good, but I would have liked more color options.', '2024-11-26 09:54:45'),
(29, 4, 6, 5, 'I love these sunglasses! They’re very comfortable, stylish, and lightweight. Definitely recommend them.', '2024-11-26 09:54:45'),
(30, 5, 6, 3, 'Decent eyeglasses, but they don’t feel as durable as other options I’ve tried. Still, they look nice and fit well.', '2024-11-26 09:54:45'),
(31, 1, 7, 5, 'Perfect sunglasses. They fit well, and the design is sophisticated. Exactly what I was looking for.', '2024-11-26 09:54:45'),
(32, 2, 7, 4, 'These eyeglasses are nice, but the frame is a little wide. They’re stylish, though, and the lenses are high quality.', '2024-11-26 09:54:45'),
(33, 3, 7, 4, 'Good eyeglasses. They are comfortable and lightweight. The only issue is the color options available.', '2024-11-26 09:54:45'),
(34, 4, 7, 5, 'Fantastic sunglasses! They’re very stylish, fit perfectly, and feel great to wear. Highly recommend them.', '2024-11-26 09:54:45'),
(35, 5, 7, 3, 'These eyeglasses are alright. The frame feels a bit heavy, and the design could be more modern.', '2024-11-26 09:54:45'),
(36, 1, 4, 5, 'Incredible sunglasses. I love the design and the fit is perfect! I wear them every day now.', '2024-11-26 10:29:21'),
(37, 2, 6, 2, 'I didn’t like these eyeglasses. The style wasn’t for me and they didn’t sit well on my face.', '2024-11-26 10:29:21'),
(38, 3, 5, 3, 'The eyeglasses are okay but they didn’t really suit me. I expected a better fit for my face.', '2024-11-26 10:29:21'),
(39, 1, 7, 4, 'Stylish sunglasses, but a little heavy for long wear. They do look great though.', '2024-11-26 10:29:21'),
(41, 4, 2, 4, 'Great pair of sunglasses! The look is stylish, but I had to get used to the feel on my nose after a few hours.', '2024-11-26 10:29:21'),
(42, 2, 5, 5, 'I’m absolutely loving these glasses. Comfortable, lightweight, and great for everyday wear.', '2024-11-26 10:29:21'),
(43, 3, 6, 2, 'The eyeglasses didn’t work for me. They felt cheap and uncomfortable to wear for long periods.', '2024-11-26 10:29:21'),
(44, 4, 7, 4, 'Great sunglasses! They’re comfortable and look awesome. The only downside is that the frame feels a bit delicate.', '2024-11-26 10:29:21'),
(45, 5, 4, 5, 'I love these eyeglasses! They fit well, and the design is so elegant. I get compliments every time I wear them!', '2024-11-26 10:29:21'),
(51, 4, 1, 3, 'gregaerg', '2024-11-27 13:00:31'),
(54, 1, 1, 1, 'hahaha', '2024-12-10 11:19:10'),
(57, 1, 14, 4, 'Test Review', '2024-12-11 14:36:22'),
(59, 20, 8, 3, 'I reviewed.', '2024-12-11 17:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `email`, `password`) VALUES
(1, 'Admin', '', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(2, 'John', 'Doe', 'john.doe@example.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'Jane', 'Smith', 'jane.smith@example.com', '202cb962ac59075b964b07152d234b70'),
(4, 'Alex', 'Johnson', 'alex.johnson@example.com', '098f6bcd4621d373cade4e832627b4f6'),
(5, 'Emily', 'Davis', 'emily.davis@example.com', 'f4b4cb1322cba580b2c21fcd491b3459'),
(6, 'David', 'Martinez', 'david.martinez@example.com', '25d55ad283aa400af464c76d713c07ad'),
(7, 'Sophia', 'Williams', 'sophia.williams@example.com', 'c81e728d9d4c2f636f067f89cc14862c'),
(8, 'Michael', 'Brown', 'michael.brown@example.com', 'd8578edf8458ce06fbc5bb2b8a1e4a9e8'),
(11, '2', '2', '2@3.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(12, 'Test', 'TestName', 'test@test.com', '098f6bcd4621d373cade4e832627b4f6'),
(14, 'Mel', 'Adry', 'meladryyy@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`attribute_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `bag`
--
ALTER TABLE `bag`
  ADD PRIMARY KEY (`bag_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`product_attribute_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Indexes for table `reserved`
--
ALTER TABLE `reserved`
  ADD PRIMARY KEY (`reserved_id`),
  ADD UNIQUE KEY `unique_user_prod` (`user_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `bag`
--
ALTER TABLE `bag`
  MODIFY `bag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=275;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `product_attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `reserved`
--
ALTER TABLE `reserved`
  MODIFY `reserved_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `attributes_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `bag`
--
ALTER TABLE `bag`
  ADD CONSTRAINT `bag_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bag_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`) ON UPDATE CASCADE;

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_attributes_ibfk_2` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`attribute_id`) ON UPDATE CASCADE;

--
-- Constraints for table `reserved`
--
ALTER TABLE `reserved`
  ADD CONSTRAINT `reserved_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reserved_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
