-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 07:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'admin', 'admin@email.com', '62cc2d8b4bf2d8728120d052163a77df');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(6,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `payment_image` varchar(250) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `payment_method`, `payment_image`, `order_date`) VALUES
(1, 100.00, 'paid', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '', '2023-03-30'),
(2, 100.00, 'not paid', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '', '2023-03-31'),
(3, 200.00, 'not paid', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '', '2023-03-31'),
(4, 300.00, 'delivered', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '', '2023-03-31'),
(9, 400.00, 'not paid', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '', '2023-04-01'),
(10, 100.00, 'not paid', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '', '2023-04-04'),
(11, 100.00, 'not paid', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '', '2023-04-05'),
(12, 100.00, 'not paid', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '', '2023-04-24'),
(13, 100.00, 'not paid', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '', '2023-04-24'),
(14, 100.00, 'not paid', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '', '2023-04-24'),
(16, 100.00, 'not paid', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', 'E-Wallet', '', '2023-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 1, '1', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-03-30 22:59:40'),
(2, 2, '1', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-03-31 15:04:10'),
(3, 3, '5', 'Shimano Ultegra Groupset', 'parts1.png', 200.00, 1, 1, '2023-03-31 16:09:52'),
(4, 4, '5', 'Shimano Ultegra Groupset', 'parts1.png', 200.00, 1, 1, '2023-03-31 16:11:36'),
(5, 4, '1', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-03-31 16:11:36'),
(12, 9, '1', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-04-01 17:21:43'),
(13, 9, '3', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-04-01 17:21:43'),
(14, 9, '8', 'Shimano Ultegra Groupset', 'parts1.png', 200.00, 1, 1, '2023-04-01 17:21:43'),
(15, 10, '1', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-04-04 16:09:39'),
(16, 11, '2', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-04-05 14:27:41'),
(17, 12, '1', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-04-24 16:17:29'),
(18, 13, '1', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-04-24 16:36:54'),
(19, 14, '1', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-04-24 16:43:09'),
(20, 15, '2', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-05-06 06:08:26'),
(21, 16, '2', 'Mountain Bike', 'featured1.png', 100.00, 1, 1, '2023-05-06 06:09:54');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_image4` varchar(255) NOT NULL,
  `product_price` decimal(8,2) NOT NULL,
  `product_special_offer` int(2) NOT NULL,
  `product_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`) VALUES
(1, 'Bike', 'Bike', 'gold Mountain Bike', 'featured1.png', 'featured1.png', 'featured1.png', 'featured1.png', 1000.00, 1, 'gold'),
(2, 'Mountain Bike', 'Bike', 'Silver Mountain Bike', 'featured1.png', 'featured1.png', 'featured1.png', 'featured1.png', 100.00, 0, 'silver'),
(3, 'Mountain Bike', 'Bike', 'Silver Mountain Bike', 'featured1.png', 'featured1.png', 'featured1.png', 'featured1.png', 100.00, 0, 'silver'),
(4, 'Mountain Bike', 'Bike', 'Silver Mountain Bike', 'featured1.png', 'featured1.png', 'featured1.png', 'featured1.png', 100.00, 0, 'silver'),
(5, 'Shimano Ultegra Groupset', 'parts', 'Groupset for Road bike', 'parts1.png', 'parts1.png', 'parts1.png', 'parts1.png', 200.00, 0, 'classic'),
(6, 'Shimano Ultegra Groupset', 'parts', 'Groupset for Road bike', 'parts1.png', 'parts1.png', 'parts1.png', 'parts1.png', 200.00, 0, 'classic'),
(7, 'Shimano Ultegra Groupset', 'parts', 'Groupset for Road bike', 'parts1.png', 'parts1.png', 'parts1.png', 'parts1.png', 200.00, 0, 'classic'),
(8, 'Shimano Ultegra Groupset', 'parts', 'Groupset for Road bike', 'parts1.png', 'parts1.png', 'parts1.png', 'parts1.png', 200.00, 0, 'classic'),
(9, 'Mountain Bike', 'Bike', 'Silver Mountain Bike', '1.jpeg', '2.jpeg', '3.jpeg', '4.jpeg', 100.00, 0, 'silver');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'Charles Zedrick De Vera', 'zedrickdevera@gmail.com', '618b939d41cc2970e6735a62611cd731'),
(6, 'Charles Zedrick De Vera', 'admin@mail.com', '4297f44b13955235245b2497399d7a93'),
(7, 'cha', 'charleszedrick.devera@tup.edu.ph', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
