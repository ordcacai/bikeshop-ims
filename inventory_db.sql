-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 05:07 PM
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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(10,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_name` varchar(250) NOT NULL,
  `user_email` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_phone` bigint(20) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` text NOT NULL,
  `user_landmark` text NOT NULL,
  `location_link` text NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `shipping_method` varchar(250) NOT NULL,
  `payment_image` varchar(250) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `shipping_fee` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_name`, `user_email`, `user_id`, `user_phone`, `user_city`, `user_address`, `user_landmark`, `location_link`, `payment_method`, `shipping_method`, `payment_image`, `order_date`, `shipping_fee`) VALUES
(1, 100.00, 'paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '0', '', '', '', '2023-03-30', 0.00),
(3, 200.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '0', '', '', '', '2023-03-31', 0.00),
(4, 300.00, 'delivered', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '0', '', '', '', '2023-03-31', 0.00),
(9, 400.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '0', '', '', '', '2023-04-01', 0.00),
(10, 100.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '0', '', '', '', '2023-04-04', 0.00),
(11, 100.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '0', '', '', '', '2023-04-05', 0.00),
(12, 100.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '0', '', '', '', '2023-04-24', 0.00),
(13, 100.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '0', '', '', '', '2023-04-24', 0.00),
(14, 100.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City, San Antonio', '', '0', '', '', '', '2023-04-24', 0.00),
(16, 100.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', '', '0', 'E-Wallet', '', '', '2023-05-06', 0.00),
(19, 100.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', '', '0', 'E-Wallet', '', 'C:\\xampp\\tmp\\php1D7B.tmp', '2023-05-06', 0.00),
(20, 100.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', '', '0', 'E-Wallet', '', 'C:\\xampp\\tmp\\php410.tmp', '2023-05-06', 0.00),
(21, 100.00, 'not paid', '', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', '', '0', 'E-Wallet', '', 'C:\\xampp\\tmp\\php8732.tmp', '2023-05-06', 0.00),
(22, 1000.00, 'not paid', 'Charles Zedrick De Vera', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', '', '0', 'E-Wallet', '', '', '2023-05-06', 0.00),
(23, 1000.00, 'not paid', 'Charles Zedrick De Vera', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', '', '', 'E-Wallet', '', '', '2023-05-07', 0.00),
(24, 1000.00, 'not paid', 'Charles Zedrick De Vera', '', 1, 2147483647, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', 'rob', 'https://www.google.com/maps/place/Corinthian+Executive+Regency,+Ortigas+Ave,+San+Antonio,+Pasig,+Metro+Manila/data=!4m2!3m1!1s0x3397c8198c943bdb:0xf92bf96244ed9ae8?sa=X&ved=2ahUKEwiAhu2w1OL-AhUppVYBHeelAKQQ8gF6BAgNEAI', 'E-Wallet', 'LBC', '', '2023-05-07', 0.00),
(25, 100.00, 'not paid', 'Charles Zedrick De Vera', '', 1, 9684491551, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', 'corinthian', 'https://www.google.com/maps/place/Corinthian+Executive+Regency,+Ortigas+Ave,+San+Antonio,+Pasig,+Metro+Manila/data=!4m2!3m1!1s0x3397c8198c943bdb:0xf92bf96244ed9ae8?sa=X&ved=2ahUKEwiAhu2w1OL-AhUppVYBHeelAKQQ8gF6BAgNEAI', 'COD', 'J&T', '', '2023-05-07', 0.00),
(28, 9999.99, 'not paid', 'Charles Zedrick De Vera', '', 1, 9684491551, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', 'corinthian', 'https://www.google.com/maps/place/Corinthian+Executive+Regency,+Ortigas+Ave,+San+Antonio,+Pasig,+Metro+Manila/data=!4m2!3m1!1s0x3397c8198c943bdb:0xf92bf96244ed9ae8?sa=X&ved=2ahUKEwiAhu2w1OL-AhUppVYBHeelAKQQ8gF6BAgNEAI', 'E-Wallet', 'Lalamove', '', '2023-05-15', 0.00),
(32, 500300.00, 'not paid', 'Merylle Antoinette Fernandez', 'meryllefernandez11@gmail.com', 1, 9551500074, 'Manila', '1864 Int. 20 Dapo Street, Pandacan Manila, Metro Manila', 'Near Jollibee', 'https://www.google.com/maps/place/Dapo,+Pandacan,+Manila,+1011+Metro+Manila/@14.5850114,121.0003481,19z/data=!3m1!4b1!4m6!3m5!1s0x3397c992f2110d39:0x4c930884d45d455a!8m2!3d14.5850114!4d121.0009918!16s%2Fg%2F11c2v0js4b?entry=ttu', 'COD', 'Lalamove', '', '2023-05-25', 100.00),
(33, 500300.00, 'not paid', 'Sofia Anne De Vera', 'sofiaanne030@gmail.com', 1, 9212503098, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', 'Near Robinson\'s Galleria', 'https://www.google.com/maps/place/Corinthian+Executive+Regency,+Ortigas+Ave,+San+Antonio,+Pasig,+Metro+Manila/data=!4m2!3m1!1s0x3397c8198c943bdb:0xf92bf96244ed9ae8?sa=X&ved=2ahUKEwiAhu2w1OL-AhUppVYBHeelAKQQ8gF6BAgNEAI', 'COD', 'Grab', '', '2023-05-25', 100.00),
(36, 700800.00, 'not paid', 'Mary Anne De Vera', 'maryanne.devera@yahoo.com', 1, 9457794646, 'Pasig City', '3106 Corinthian Executive Regency Ortigas Avenue Pasig City', 'Near Robinson\'s Galleria', 'https://www.google.com/maps/place/Corinthian+Executive+Regency,+Ortigas+Ave,+San+Antonio,+Pasig,+Metro+Manila/data=!4m2!3m1!1s0x3397c8198c943bdb:0xf92bf96244ed9ae8?sa=X&ved=2ahUKEwiAhu2w1OL-AhUppVYBHeelAKQQ8gF6BAgNEAI', 'E-Wallet', 'Grab', '', '2023-05-26', 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_color` varchar(250) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_color`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 1, '1', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-03-30 22:59:40'),
(3, 3, '5', 'Shimano Ultegra Groupset', '', 'parts1.png', 200.00, 1, 1, '2023-03-31 16:09:52'),
(4, 4, '5', 'Shimano Ultegra Groupset', '', 'parts1.png', 200.00, 1, 1, '2023-03-31 16:11:36'),
(5, 4, '1', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-03-31 16:11:36'),
(12, 9, '1', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-04-01 17:21:43'),
(13, 9, '3', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-04-01 17:21:43'),
(14, 9, '8', 'Shimano Ultegra Groupset', '', 'parts1.png', 200.00, 1, 1, '2023-04-01 17:21:43'),
(15, 10, '1', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-04-04 16:09:39'),
(16, 11, '2', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-04-05 14:27:41'),
(17, 12, '1', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-04-24 16:17:29'),
(18, 13, '1', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-04-24 16:36:54'),
(19, 14, '1', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-04-24 16:43:09'),
(21, 16, '2', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-05-06 06:09:54'),
(24, 19, '2', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-05-06 08:21:28'),
(25, 20, '2', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-05-06 08:31:11'),
(26, 21, '2', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-05-06 08:33:56'),
(27, 22, '1', 'Bike', '', 'featured1.png', 1000.00, 1, 1, '2023-05-06 15:31:11'),
(28, 23, '1', 'Bike', '', 'featured1.png', 1000.00, 1, 1, '2023-05-07 09:06:41'),
(29, 24, '1', 'Bike', '', 'featured1.png', 1000.00, 1, 1, '2023-05-07 09:15:18'),
(30, 25, '2', 'Mountain Bike', '', 'featured1.png', 100.00, 1, 1, '2023-05-07 17:38:13'),
(32, 28, '14', 'test', 'red', 'test1.jpeg', 9999.99, 1, 1, '2023-05-15 17:49:06'),
(38, 32, '14', 'test', 'red', 'test1.jpeg', 100000.00, 5, 1, '2023-05-25 18:32:11'),
(39, 32, '3', 'Mountain Bike', 'silver', 'featured1.png', 100.00, 3, 1, '2023-05-25 18:32:11'),
(40, 33, '14', 'test', 'red', 'test1.jpeg', 100000.00, 5, 1, '2023-05-25 18:35:35'),
(41, 33, '3', 'Mountain Bike', 'silver', 'featured1.png', 100.00, 3, 1, '2023-05-25 18:35:35'),
(44, 36, '14', 'test', 'red', 'test1.jpeg', 100000.00, 7, 1, '2023-05-26 09:27:16'),
(45, 36, '3', 'Mountain Bike', 'silver', 'featured1.png', 100.00, 1, 1, '2023-05-26 09:27:16'),
(46, 36, '4', 'Mountain Bike', 'silver', 'featured1.png', 100.00, 1, 1, '2023-05-26 09:27:16'),
(47, 36, '5', 'Shimano Ultegra Groupset', 'classic', 'parts1.png', 200.00, 3, 1, '2023-05-26 09:27:16');

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
  `product_color` text NOT NULL,
  `product_size` varchar(250) NOT NULL,
  `product_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_special_offer`, `product_color`, `product_size`, `product_quantity`) VALUES
(2, 'Mountain Bike', 'Bike', 'Silver Mountain Bike', 'featured1.png', 'featured1.png', 'featured1.png', 'featured1.png', 100.00, 0, 'silver', '', 0),
(3, 'Mountain Bike', 'Bike', 'Silver Mountain Bike', 'featured1.png', 'featured1.png', 'featured1.png', 'featured1.png', 100.00, 0, 'silver', '', 0),
(4, 'Mountain Bike', 'Bike', 'Silver Mountain Bike', 'featured1.png', 'featured1.png', 'featured1.png', 'featured1.png', 100.00, 0, 'silver', '', 0),
(5, 'Shimano Ultegra Groupset', 'parts', 'Groupset for Road bike', 'parts1.png', 'parts1.png', 'parts1.png', 'parts1.png', 200.00, 0, 'classic', '', 0),
(6, 'Shimano Ultegra Groupset', 'parts', 'Groupset for Road bike', 'parts1.png', 'parts1.png', 'parts1.png', 'parts1.png', 200.00, 0, 'classic', '', 0),
(7, 'Shimano Ultegra Groupset', 'parts', 'Groupset for Road bike', 'parts1.png', 'parts1.png', 'parts1.png', 'parts1.png', 200.00, 0, 'classic', '', 0),
(8, 'Shimano Ultegra Groupset', 'parts', 'Groupset for Road bike', 'parts1.png', 'parts1.png', 'parts1.png', 'parts1.png', 200.00, 0, 'classic', '', 0),
(9, 'Mountain Bike', 'Bike', 'Silver Mountain Bike', '1.jpeg', '2.jpeg', '3.jpeg', '4.jpeg', 100.00, 0, 'silver', '', 0),
(14, 'test', 'Bike', 'test', 'test1.jpeg', 'test2.jpeg', 'test3.jpeg', 'test4.jpeg', 100000.00, 1, 'red', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_type` varchar(250) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_type`) VALUES
(1, 'Charles Zedrick De Vera', 'zedrickdevera@gmail.com', '618b939d41cc2970e6735a62611cd731', 'user'),
(6, 'Charles Zedrick De Vera', 'admin@email.com', '62cc2d8b4bf2d8728120d052163a77df', 'admin'),
(7, 'Charles Zedrick D. De Vera', 'charleszedrick.devera@tup.edu.ph', 'bed3482f502c7bbfb6f9fa54f36e77d7', 'employee'),
(8, 'Charles Zedrick', 'charleszedrick021@gmail.com', '618b939d41cc2970e6735a62611cd731', 'user');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
