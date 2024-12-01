-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 08:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amar_bazaar`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Garments', 'All you can wear', '0000-00-00 00:00:00'),
(2, 'Sanitation supplies', 'For your health', '0000-00-00 00:00:00'),
(3, 'Home Accessories', 'Make your dream home', '0000-00-00 00:00:00'),
(4, 'Electronics', 'Get your gadgets', '0000-00-00 00:00:00'),
(5, 'Skincare & Makeup', 'Everything your skin needs\r\n', '0000-00-00 00:00:00'),
(6, 'Pet Foods', 'Foods for your pet', '0000-00-00 00:00:00'),
(7, 'Stationery and Toys', 'Get stationery items', '0000-00-00 00:00:00'),
(8, 'Ladies\' Accessories', 'Accessories for ladies', '0000-00-00 00:00:00'),
(9, 'Travel Essentials', 'Everything you need for travelling', '0000-00-00 00:00:00'),
(10, 'Get Your Games', 'Shop for gaming', '0000-00-00 00:00:00'),
(11, 'Kitchen Deals', 'For your kitchen', '0000-00-00 00:00:00'),
(12, 'Medicines', 'Get your medicines', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_address` text NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
  `mail` varchar(50) NOT NULL,
  `phone` int(15) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`user_id`, `total_amount`, `shipping_address`, `order_date`, `status`, `mail`, `phone`, `order_id`) VALUES
(4, 380.00, 'abc', '2024-11-29 22:48:41', NULL, '01910523879', 0, 1),
(20, 580.00, 'uttara,dhaka', '2024-11-30 15:19:51', 'Pending', 'payeldas@gmail.com', 1632932548, 2),
(20, 1080.00, 'uttara,dhaka', '2024-11-30 15:25:04', 'Pending', 'payeldas@gmail.com', 1632932548, 3),
(20, 2080.00, 'uttara,dhaka', '2024-11-30 15:41:29', 'Pending', 'payeldas@gmail.com', 1632932548, 4),
(20, 1580.00, 'uttara,dhaka', '2024-11-30 16:44:44', 'Pending', 'payeldas@gmail.com', 1632932548, 5),
(20, 2080.00, 'uttara,dhaka', '2024-11-30 16:45:55', 'Pending', 'payeldas@gmail.com', 1632932548, 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `stock_quantity`, `category_id`, `created_at`) VALUES
(1, 'Cardigan', 'Made with wool.Comfortable to wear.Available in size M', 500.00, 'cardigan.jpg', 100, 1, '0000-00-00 00:00:00'),
(2, 'Trench Coat', 'Made from hard-wearing and robust gabardine.Waterproof.Available in size XL', 1000.00, 'Trench_coat.jpg', 200, 1, '0000-00-00 00:00:00'),
(3, 'High Neck', 'Skinny fit high neck sweater.Available in size X', 400.00, 'High_neck.jpg', 300, 1, '0000-00-00 00:00:00'),
(4, 'Soap', 'Cruelty-free,Gentle.', 100.00, 'soap.jpg', 100, 2, '0000-00-00 00:00:00'),
(5, 'Toilet Cleaner', 'Kills all germs dead including bacteria, virus, and fungi.', 200.00, 'cleaner.jpg', 200, 2, '0000-00-00 00:00:00'),
(6, 'ToothPaste', 'Whitening.Fights cavities.Fresh Breath', 120.00, 'toothpaste.jpg', 200, 2, '0000-00-00 00:00:00'),
(7, 'Book Shelf', 'Wall hanging book shelf.24X24 inch.', 1200.00, 'wall-decor.png', 100, 3, '0000-00-00 00:00:00'),
(8, 'Wall Sticker', 'Tropical leaf wall sticker for home decor', 250.00, 'wall-sticker.png', 200, 3, '0000-00-00 00:00:00'),
(9, 'Artificial Plant', '3 Green Heads Artificial Bonsai Tree in Plastic Vases', 300.00, 'plant.png', 300, 3, '0000-00-00 00:00:00'),
(10, 'Electronic Kettle', 'VISION Electronic Kettle 1.8L VIS-EK-005', 1000.00, 'kettle.png', 100, 4, '0000-00-00 00:00:00'),
(11, 'Clock', '3D LED DIGITAL ELECTRONIC TABLE CLOCK WALL', 890.00, 'clock.png', 200, 4, '0000-00-00 00:00:00'),
(12, 'Transistor', 'BC547 Transistor 10 Piece For Electronics', 35.00, 'Transistor.png', 300, 4, '0000-00-00 00:00:00'),
(13, 'Sunblock', '3W Clinic Intensive Green Tea Sunblock Cream SPF 50+PA+++ 70ml', 800.00, 'sunblock.png', 100, 5, '0000-00-00 00:00:00'),
(14, 'Serum', 'I’m from Rice Serum 30ml', 2100.00, 'serum.jpg', 200, 5, '0000-00-00 00:00:00'),
(15, 'Lip Mask', 'Laneige Lip Sleeping Mask EX – Berry (20g)', 1500.00, 'lip_mask.jpg', 300, 5, '0000-00-00 00:00:00'),
(16, 'Dry Cat Food', 'Kat Club Cat Dry Food Ocean Fish Flavor 1kg', 500.00, 'Dry_Food.png', 100, 6, '0000-00-00 00:00:00'),
(17, 'Canned Cat Food', 'Pet Metro kitten Canned Food chicken Goat Milk 375gm', 220.00, 'Canned_Food.png', 200, 6, '0000-00-00 00:00:00'),
(18, 'Eraser', 'Mobile Phone Shape Creative Eraser Kids Stationery Toy', 100.00, 'eraser.png', 100, 7, '0000-00-00 00:00:00'),
(19, 'Pencil Bag', 'Plush Stuffed Animal Pencil Bag', 180.00, 'bag.png', 200, 7, '0000-00-00 00:00:00'),
(20, 'Stickers', '50 pcs Naruto Cartoon Stickers', 500.00, 'sticker.png', 300, 7, '0000-00-00 00:00:00'),
(21, 'Bracelet', '4 pcs Golden bracelet', 250.00, 'bracelet.png', 100, 8, '0000-00-00 00:00:00'),
(22, 'Ring', 'Ring set for women', 150.00, 'ring.png', 150, 8, '0000-00-00 00:00:00'),
(23, 'Pendant', 'Red Cherry Pendant Necklace', 250.00, 'pendant.png', 250, 8, '0000-00-00 00:00:00'),
(24, 'Neck Pillow', 'Premium U-Shaped Pikachu Neck Pillow-12X14', 350.00, 'pillow.png', 100, 9, '0000-00-00 00:00:00'),
(25, 'Luggage', '17 inch trolley luggage', 2500.00, 'luggage.png', 200, 9, '0000-00-00 00:00:00'),
(26, 'Board Game', 'Monopoly board game', 400.00, 'board.png', 100, 10, '0000-00-00 00:00:00'),
(27, 'Card Game', 'Uno Card Game', 300.00, 'card.png', 200, 10, '0000-00-00 00:00:00'),
(28, 'Apron', 'Waterproof Rubber Vinyl Apron Industrial PVC Aprons', 350.00, 'apron.png', 100, 11, '0000-00-00 00:00:00'),
(29, 'Spoon', 'Wooden Ladle Spoon Set', 800.00, 'spoon.png', 200, 11, '0000-00-00 00:00:00'),
(30, 'Tongs', 'Stainless Steel Turner Tongs', 250.00, 'tongs.png', 300, 11, '0000-00-00 00:00:00'),
(31, 'Moov', 'Rapid relief cream', 200.00, 'moov.png', 100, 12, '0000-00-00 00:00:00'),
(32, 'Paracetamol', 'Treats milds to moderate pain and fever', 200.00, 'paracetamol.jpg', 200, 12, '0000-00-00 00:00:00'),
(33, 'NAPA', 'Treated For Influenza', 199.99, 'napa.png', 200, 12, '2024-11-30 04:00:00'),
(34, 'FEXOFENADINE', 'Is an antihistamine medicine that helps with the symptoms of allergies', 249.99, 'fexo.png', 300, 12, '2024-11-30 04:20:00'),
(35, 'HISTACIN', 'Symptomatic treatment of allergic rhinitis, rash & urticaria.', 149.99, 'histacin.png', 200, 12, '2024-11-30 04:20:00'),
(36, 'DEATHPOOL', 'Deadpool is an action-adventure video game based on the Marvel Comics antihero of the same name.', 249.99, 'deathpool.jpg', 200, 10, '2024-11-30 04:20:00'),
(37, 'TENT', 'Tent For Adventure', 3199.99, 'tent.png', 100, 9, '2024-11-30 04:00:00'),
(38, 'FIFA', 'EA SPORTS FC™ 24 kicks off a new era of The Worlds Game.', 69.99, 'fifa.png', 200, 10, '2024-11-30 04:00:00'),
(39, 'WASHING MACHINE', ' Amar Bazaar offers all types of Washing Machine with variation of choices', 29999.99, 'washingmachine.png', 20, 4, '2024-11-30 04:00:00'),
(40, 'TELIVISION', 'Buy Television at the best price in Bangladesh', 69999.99, 'TV.png', 10, 4, '2024-11-30 04:00:00'),
(41, 'MICRO OVEN', 'Amar Bazaar is the best place to buy Ovens in Bangladesh.', 19999.99, 'oven.png', 20, 4, '2024-11-30 04:00:00'),
(42, 'Almirah', 'Almirah is a piece of very essential and common furniture for the home.', 59999.99, 'almirah.png', 10, 3, '2024-11-30 04:00:00'),
(43, 'Reading Table', 'Looking for a study table for students? Check out our collection.', 19999.99, 'RT.png', 30, 3, '2024-11-30 04:00:00'),
(44, 'Hand Wash', 'Hand wash is a liquid shop that kills all germs and is fresh and fragrant', 19.99, 'handwash.png', 100, 2, '2024-11-30 04:00:00'),
(45, 'Fountain Pen', 'Discover our collection of Luxury Fountain Pens', 199.99, 'fountainpen.png', 50, 7, '2024-11-30 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(1) NOT NULL,
  `review` text DEFAULT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`, `name`) VALUES
(1, '', 'afifaimran@gmail.com', '$2y$10$jQ95r6rVjo/U7sPLVIczAep3Toq.aWIbp.qBwJHKK9LWuvjS8.R16', 'customer', '2024-11-21 15:39:13', 'Afifa Imran'),
(3, 'Afifa', 'afifa@gmail.com', '$2y$10$vDVQ3iOjXBDbTJVa9jQ7D.Z4p/eXQ85AFHQKYy8xlHu47KSSMsBSa', 'customer', '2024-11-21 16:39:06', 'Afifa'),
(4, 'Payel03', 'payel.das@northsouth.edu', '$2y$10$c2YxiS3m6sT2hhTYk/6z4O1xAPy3q5PZuJvZp63ky34zQu4x3.KQO', 'customer', '2024-11-26 17:14:22', 'Payel Das'),
(6, 'payel', 'payeld296@gmail.com', '$2y$10$kaNsxSh913GUqAiZnnDQ0..hexk1NEoEolj1R4aUNkwxP0x8nSydS', 'customer', '2024-11-27 04:33:38', 'Payel Das'),
(7, 'abc', 'abcd@gmail.com', '$2y$10$rB5pA6lYjWVEA.QW8NkZA.4FEYPWBY3TWqrCbcpVwdzmW.dXBibnm', 'customer', '2024-11-27 05:26:46', 'abcd'),
(18, 'IhRakib', 'imam.rakib@northsouth.edu', '$2y$10$zevzRwMKL6U/0K8GGz7IlOV99rVj2OZ2dwdOxxOtEsrEchzQVLWi2', 'customer', '2024-11-29 23:46:46', 'Md. Imam Hossain Rakib'),
(20, 'pd', 'payeldas@gmail.com', '$2y$10$LmWEl3eBZsNboXF7/VeF8O5rumP1yhRnS4yslRRycdpr3GdVGQTNO', 'customer', '2024-11-30 10:40:47', 'payel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_ID` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
