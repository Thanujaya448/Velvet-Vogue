-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2024 at 01:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `velvet_vogue`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartitems`
--

CREATE TABLE `cartitems` (
  `oid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cartitems`
--

INSERT INTO `cartitems` (`oid`, `uid`, `pid`, `quantity`, `image`) VALUES
(5, 1, 11, 50, 'uploads/1733213069_6 (2).jpg'),
(6, 1, 19, 50, 'uploads/1733219511_22.png');

-- --------------------------------------------------------

--
-- Table structure for table `carttotal`
--

CREATE TABLE `carttotal` (
  `uid` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  `tax` float NOT NULL,
  `shipping` float NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carttotal`
--

INSERT INTO `carttotal` (`uid`, `subtotal`, `tax`, `shipping`, `total`) VALUES
(1, 369.87, 66.5766, 18.4935, 454.94);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` enum('Pending','Delivered','Canceled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `card_name` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `image`, `category`, `description`, `price`) VALUES
(1, 'Sun-Kissed Midi Dress', 'Images/5.PNG', 'Casual Wear', 'Add a playful yet elegant touch to your wardrobe with this vintage-inspired citrus print midi dress. Perfect for casual days or semi-formal gatherings, this dress features a flattering square neckline, ruched cap sleeves, and a cinched waist that flows into a flared skirt. The bold orange and green fruit pattern adds a vibrant pop, making it an eye-catching addition to any outfit.', 39.99),
(2, 'Keyhole Sweater', 'Images/2.PNG', 'Sweater', 'Add a classic to your wardrobe with this exquisite keyhole sweater. Its delicate collar and playful keyhole detail offer a glimpse of whimsy, while the soft fabric provides cozy warmth. This sweater is a dreamy blend of fun and functionality, ideal for adding a bright touch to dreary days or for cozy evenings spent indoors. Its charming and unique design make it a versatile piece, easily paired with jeans for a casual look or a skirt for a more elevated ensemble.50% Cotton, 50% ModalMachine wash cold, line dryImported', 9.99),
(3, 'Sheath Dress', 'Images/3.PNG', 'Party Wear', 'This black lace sheath dress is the epitome of timeless elegance. With its delicate lace overlay, pearl-embellished Peter Pan collar, and button-down front, this dress combines sophistication with a hint of vintage charm. The fitted silhouette flatters the body, while the scalloped hem adds a touch of femininity. Perfect for formal gatherings, evening events, or classy daytime outings.', 29.99),
(11, 'Black Floral Satin Dress', 'uploads/1733213069_6 (2).jpg', 'Dress', 'Turn heads with this chic black satin mini dress, featuring an elegant white floral print. The V-neckline and three-quarter sleeves add a sophisticated touch, while the gathered empire waist creates a flattering silhouette. Perfect for a casual day out or a semi-formal event, this dress is versatile and effortlessly stylish.', 19.99),
(12, 'Gingerbread Print Dress', 'uploads/1733213222_16.png', 'Dress', 'Celebrate the holiday spirit with this adorable green mini dress adorned with cheerful gingerbread men and candy cane prints. Featuring a classic shirt collar, short sleeves, and a button-front detail, this dress exudes charm and comfort. The elasticated waist enhances the fit, making it perfect for holiday gatherings, casual outings, or festive parties. Pair it with stockings and heels for a retro-inspired holiday look!', 24.99),
(13, 'Black Tulle Evening Dress', 'uploads/1733213278_4.PNG', 'Party Dress', 'Turn heads with this chic and timeless black tulle evening dress. Featuring a plunging V-neckline and a cinched waist, this sleeveless design flows effortlessly into a layered, knee-length skirt adorned with delicate polka dot accents on the outer tulle layer. Perfect for formal dinners, cocktail parties, or romantic evenings, this dress combines sophistication with playful charm.', 29.99),
(14, 'Sleeveless Mini Dress', 'uploads/1733219100_6.PNG', 'Dress', '.', 29.99),
(15, 'Bold Notion Long Dress', 'uploads/1733219180_9.PNG', 'Dress', '.', 19.99),
(16, 'Flare Dress', 'uploads/1733219207_26.png', 'Dress', '.', 26.99),
(17, 'Satin Halter Dress', 'uploads/1733219273_61.png', 'Party Dress', '.', 39.99),
(18, 'Tansy LS Mini Dress', 'uploads/1733219482_122.png', 'Casual Dress', '.', 29.99),
(19, 'All Around Me Circle Skirt', 'uploads/1733219511_22.png', 'Party Dress', '.', 49.99),
(20, 'A-Line Dress', 'uploads/1733219549_2.jpg', 'Party Dress', '.', 39.99),
(21, 'Fireside Pencil Skirt', 'uploads/1733219589_6.webp', 'Skirt', '.', 9.99),
(22, 'Susan Floral Mini Dress', 'uploads/1733219625_10.png', 'Casual Dress', '.', 19.99),
(23, 'Boho Paisley Midi Dress', 'uploads/1733219649_111.png', 'Casual Dress', '.', 29.99),
(24, 'V Neck Dress', 'uploads/1733219697_6 (4).jpg', 'Long Dress', '.', 29.99),
(25, 'Black Mini Dress', 'uploads/1733219755_WFor.jfif', 'Office Wear', '.', 39.99),
(26, 'Olive Dress', 'uploads/1733219787_112-612x875.jpg', 'Casual Dress', '.', 19.99),
(27, 'Plain Trouser Pant', 'uploads/1733220089_7.PNG', 'Office Wear', '.', 19.99);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE `purchase_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT 'default_avatar.png',
  `full_name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `newsletter` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`, `email`, `profile_picture`, `full_name`, `phone`, `address`, `newsletter`) VALUES
(1, 'joe', '$2y$10$6ydtZToESzlxHqmbpGXXZ.CtmRUM/lw91T.TupBCI/qW1FikPclpa', 'user', '2024-12-04 09:22:50', 'joe@gmail.com', 'uploads/1733116333_112-612x875.jpg', 'Desh', '1231', '12312313131', 0),
(2, 'joe', '$2y$10$Es.2QnkpwdVW2dbLMKEuAuy4sS.ID7GJ8Y4dCoO9IfBx9gvz3KRGS', 'user', '2024-12-06 08:38:25', 'joe@gmail.com', 'default_avatar.png', '', '', '', 0),
(3, 'joe', '$2y$10$gur4H7AQGdYBP1UwGPmg0uuhS4iixATBBGM97ubmTNnQfs1A41Hcq', 'user', '2024-12-06 09:03:10', 'joe@gmail.com', 'default_avatar.png', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `full_name`, `phone`, `address`) VALUES
(2, 1, 'mechail joe mark', '0755556665', 'sadasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartitems`
--
ALTER TABLE `cartitems`
  ADD PRIMARY KEY (`oid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartitems`
--
ALTER TABLE `cartitems`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `purchase_history`
--
ALTER TABLE `purchase_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD CONSTRAINT `payment_methods_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD CONSTRAINT `purchase_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `purchase_history_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
