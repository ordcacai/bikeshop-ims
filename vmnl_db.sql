-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2023 at 04:53 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vmnl_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_type` varchar(20) NOT NULL,
  `wsname` varchar(250) NOT NULL,
  `wsphone` bigint(20) NOT NULL,
  `wsaddress` text NOT NULL,
  `wscourier` text NOT NULL,
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
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `remarks` longtext NOT NULL,
  `shipping_fee` decimal(6,2) NOT NULL,
  `invoice_no` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_type`, `wsname`, `wsphone`, `wsaddress`, `wscourier`, `order_cost`, `order_status`, `user_name`, `user_email`, `user_id`, `user_phone`, `user_city`, `user_address`, `user_landmark`, `location_link`, `payment_method`, `shipping_method`, `order_date`, `remarks`, `shipping_fee`, `invoice_no`) VALUES
(1, 'retail', '', 0, '', '', '2990.00', 'delivered', 'Yuri Andrew Bayonito', 'yandrewab2000@gmail.com', 4, 9497317030, 'Muntinlupa City', '1 Maya Lane Liberty Homes, Cupang, Muntinlupa City', 'Uratex', 'https://ul.waze.com/ul?ll=14.58448679%2C120.98440647&navigate=yes&zoom=17&utm_campaign=default&utm_source=waze_website&utm_medium=lm_share_location', 'Cash', 'Seastar Cargo', '2023-06-08', '', '100.00', 202306081),
(2, 'retail', '', 0, '', '', '7200.00', 'Pending', 'asd', 'sds@sdfmd', 2, 0, 'dfs', 'sdfd', 'sdfsd', 'sdfd', 'GCash', 'Capex', '2023-06-08', '', '0.00', 202306082),
(3, 'retail', '', 0, '', '', '9000.00', 'Pending', 'cust_demo', 'demo@vykesmnl.com', 2, 9999999, 'dfs', 'asd', 'asdas', 'asd', 'GCash', 'Capex', '2023-06-08', '', '0.00', 202306083);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_color`, `product_image`, `product_price`, `product_quantity`, `user_id`, `order_date`) VALUES
(1, 1, '1', 'Shimano Deore CS-M5100 Sprocket', 'Silver', 'Shimano Deore CS-M5100 Sprocket1.jpeg', '2990.00', 1, 4, '2023-06-08 09:54:38'),
(2, 2, '2', 'Shimano MT201 Hydraulic Brakeset', 'Black', 'Shimano MT201 Hydraulic Brakeset1.jpeg', '1800.00', 4, 2, '2023-06-08 14:14:57'),
(3, 3, '2', 'Shimano MT201 Hydraulic Brakeset', 'Black', 'Shimano MT201 Hydraulic Brakeset1.jpeg', '1800.00', 5, 2, '2023-06-08 14:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `cust_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `payment_date` varchar(100) NOT NULL,
  `ref_num` int(50) NOT NULL,
  `mop` varchar(50) CHARACTER SET latin1 NOT NULL,
  `notes` text CHARACTER SET latin1 NOT NULL,
  `image` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `product_bp` decimal(8,2) NOT NULL,
  `product_wsp` decimal(8,2) NOT NULL,
  `product_special_offer` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image`, `product_image2`, `product_image3`, `product_image4`, `product_price`, `product_bp`, `product_wsp`, `product_special_offer`) VALUES
(1, 'Shimano Deore CS-M5100 Sprocket', 'parts', 'Shimano Deore CS-M5100 11spd 11-51T Sprocket \r\n\r\n- Model: M5100 \r\n- 11spd \r\n- 11-51T ', 'Shimano Deore CS-M5100 Sprocket1.jpeg', 'Shimano Deore CS-M5100 Sprocket2.jpeg', 'Shimano Deore CS-M5100 Sprocket3.jpeg', 'Shimano Deore CS-M5100 Sprocket4.jpeg', '2990.00', '2424.00', '2750.00', '2800.00'),
(2, 'Shimano MT201 Hydraulic Brakeset', 'parts', 'Shimano MT201 Hydrualic Brakeset\r\n\r\n- hydraulic \r\n- alloy levers \r\n- model: MT201', 'Shimano MT201 Hydraulic Brakeset1.jpeg', 'Shimano MT201 Hydraulic Brakeset2.jpeg', 'Shimano MT201 Hydraulic Brakeset3.jpeg', 'Shimano MT201 Hydraulic Brakeset4.jpeg', '1800.00', '1450.00', '1550.00', '1700.00'),
(3, 'Shimano Deore M4100 Shifters', 'parts', 'Shimano Deore M4100 Shifters\r\n\r\n- model: M4100 \r\n- 10spd ', 'Shimano Deore M4100 Shifters1.jpeg', 'Shimano Deore M4100 Shifters2.jpeg', 'Shimano Deore M4100 Shifters3.jpeg', 'Shimano Deore M4100 Shifters4.jpeg', '1300.00', '936.00', '1100.00', '1200.00'),
(4, 'Shimano Sora FC-R3000 Crankset', 'parts', 'Shimano Sora FC-R3000 Crankset\r\n\r\n- Model: FC-R3000 \r\n- 50x34x170mm \r\n- 9-Spd \r\n- without bottom bracket', 'Shimano Sora FC-R3000 Crankset1.jpeg', 'Shimano Sora FC-R3000 Crankset2.jpeg', 'Shimano Sora FC-R3000 Crankset3.jpeg', 'Shimano Sora FC-R3000 Crankset4.jpeg', '3690.00', '2876.00', '3280.00', '3400.00'),
(5, 'Ebike Code 117', 'Ebike', 'Ebike Code 117\r\n\r\nSpecifications:\r\n•Controller: 1 Tube\r\n•Range: 45-60km\r\n•Capacity: 350kg load weight\r\n•Battery: 60v 20ah - 800watts\r\n•Front: Disc brake\r\n•Rear: Drum brake\r\n•With Storage box and Side Mirrors\r\n•Alloy Braket for Storage box', 'Ebike Code 1171.jpeg', 'Ebike Code 1172.jpeg', 'Ebike Code 1173.jpeg', 'Ebike Code 1174.jpeg', '30000.00', '22500.00', '24500.00', '26800.00'),
(6, 'Tirich Rainer MTB 27.5', 'Bike', 'Specifications:\r\n• Tirich Alloy Frame Internal Cabling\r\n• Tirich Suspension Fork with Lock out\r\n• Logan Hydraulic Brakeset\r\n• 10 Speed\r\n• RD: Smach RX10 10s Shifters and Rear Derailleur\r\n• Tirich Chainwheel 1x34T\r\n• Tirich Cockpit Alloy\r\n• Moser Quick Rel', 'Tirich Rainer MTB 27.51.jpeg', 'Tirich Rainer MTB 27.52.jpeg', 'Tirich Rainer MTB 27.53.jpeg', 'Tirich Rainer MTB 27.54.jpeg', '9990.00', '8000.00', '8500.00', '8790.00'),
(7, 'Ebike Code 113', 'Ebike', 'Specifications:\r\n•Brake: Drum Brake\r\n•Range: 40-50km\r\n•Tire: 14x2.5 Tubeless\r\n•Capacity: 150kg load weight\r\n•Battery: 48v 20ah - 500watts\r\n•Charging Time: 7-8hrs\r\n•Digital Panel\r\n•With front basket\r\n•With center and side stand\r\n•With head light\r\n•With fro', 'Ebike Code 1131.jpeg', 'Ebike Code 1132.jpeg', 'Ebike Code 1133.jpeg', 'Ebike Code 1134.jpeg', '16200.00', '12000.00', '13900.00', '14500.00'),
(8, 'Ebike Code 205', 'Ebike', 'Specifications:\r\n•Seat: 2-seater\r\n•Brake: Drum Brake\r\n•Range: 35-45km\r\n•Tire: 14x2.5 Tubeless\r\n•Capacity: 200kg load weight\r\n•Battery: 48v 20ah - 600watts\r\n•Charging Time: 7-8hrs\r\n•With side mirror\r\n•With storage box', 'Ebike Code 2051.jpeg', 'Ebike Code 2052.jpeg', 'Ebike Code 2053.jpeg', 'Ebike Code 2054.jpeg', '34000.00', '26000.00', '30000.00', '31500.00'),
(9, 'Mountainpeak Striker Road Bike (Sora)', 'Bike', 'Specifications:\r\n• Alloy Aero Frame\r\n• 2x9 Speed\r\n• Mountainpeak Alloy Fork\r\n• STI Shimano Sora Shifters\r\n• RD: Shimano Sora\r\n• FD: Shimano Sora\r\n• Mechanical Disc Brakes\r\n• Branta Strive Dropbar\r\n• Branta Alloy Rims\r\n• Prowheel Ounce Crankset\r\n• Quick Re', 'Mountainpeak Striker Road Bike (Sora)1.jpeg', 'Mountainpeak Striker Road Bike (Sora)2.jpeg', 'Mountainpeak Striker Road Bike (Sora)3.jpeg', 'Mountainpeak Striker Road Bike (Sora)4.jpeg', '24000.00', '20250.00', '21250.00', '22000.00'),
(10, 'Mountainpeak Falcon Gravel Bike', 'Bike', 'Specifications:\r\n• Mountainpeak Carbon T700 Frame\r\n• Mountainpeak Carbon T700 Fork\r\n• 2x9 Speed\r\n• Shimano Sora STI Shifters\r\n• FD: Shimano Sora\r\n• RD: Shimano Sora\r\n• Prowheel Ounce Hollowtech Crankset\r\n• Actuated Hydraulic Funone Disc brakes\r\n• Mountain', 'Mountainpeak Falcon Gravel Bike1.jpeg', 'Mountainpeak Falcon Gravel Bike2.jpeg', 'Mountainpeak Falcon Gravel Bike3.jpeg', 'Mountainpeak Falcon Gravel Bike4.jpeg', '41000.00', '36500.00', '37500.00', '38000.00'),
(11, 'Mountainpeak Titans 27.5 ', 'Bike', 'Specifications:\r\n• Alloy Frame Internal Cabling\r\n• MTP XS1 Airfork with Lock out\r\n• 12 Speed\r\n• RD: Shimano Deore M6100\r\n• Shimano Deore M6100 Shifters\r\n• Nutt Hydraulic Brakes\r\n• Charm Hollowtech Crankset\r\n• Brenta Stem\r\n• Mountainpeak Velo Saddle\r\n• Mou', 'Mountainpeak Titans 27.5 1.jpeg', 'Mountainpeak Titans 27.5 2.jpeg', 'Mountainpeak Titans 27.5 3.jpeg', 'Mountainpeak Titans 27.5 4.jpeg', '26000.00', '20000.00', '21000.00', '22000.00'),
(12, 'Foxter Lincoln 27.5', 'Bike', 'Specifications:\r\n• Alloy Foxter Frame\r\n• Foxter Suspension Fork with Lock Out\r\n• 2x8 Speed\r\n• Shimano Shifters\r\n• Smach Hydraulic Brakeset\r\n• FD: Shimano Altus\r\n• RD: Shimano Tourney\r\n• Prowheel Crankset\r\n• Kenda Tires 27.5/29x2.10\r\n• Quick Release Foxter', 'Foxter Lincoln 27.51.jpeg', 'Foxter Lincoln 27.52.jpeg', 'Foxter Lincoln 27.53.jpeg', 'Foxter Lincoln 27.54.jpeg', '13000.00', '9800.00', '10400.00', '11800.00'),
(13, 'Ebike Code 114', 'Ebike', 'Specifications:\r\n•Brake: Drum Brake\r\n•Range: 35-45km\r\n•Tire: 14x2.5 Tubeless\r\n•Capacity: 100kg load weight\r\n•Battery: 48v 12ah - 350watts\r\n•Charging Time: 7-8hrs\r\n•Digital Panel\r\n•With front basket\r\n•With center and side stand\r\n•With head light\r\n•With fro', 'Ebike Code 1141.jpeg', 'Ebike Code 1142.jpeg', 'Ebike Code 1143.jpeg', 'Ebike Code 1144.jpeg', '14200.00', '8500.00', '10500.00', '12500.00'),
(14, 'Ebike Code 008b', 'Ebike', 'Specifications:\r\n•Seat: 3-seater\r\n•Brake: Drum Brake\r\n•Range: 35-45km\r\n•Tire: 14x2.5 Tubeless\r\n•Capacity: 350kg load weight\r\n•Battery: 60v 20ah - 600watts\r\n•Charging Time: 7-8hrs', 'Ebike Code 008b1.jpeg', 'Ebike Code 008b2.jpeg', 'Ebike Code 008b3.jpeg', 'Ebike Code 008b4.jpeg', '47150.00', '34300.00', '38900.00', '42900.00');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL,
  `color_size` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `product_id`, `product_name`, `quantity`, `color_size`) VALUES
(1, 1, 'Shimano Deore CS-M5100 Sprocket', 5, 'Silver'),
(2, 2, 'Shimano MT201 Hydraulic Brakeset', 5, 'Black'),
(3, 3, 'Shimano Deore M4100 Shifters', 5, 'Black'),
(4, 4, 'Shimano Sora FC-R3000 Crankset', 6, 'Black'),
(5, 5, 'Ebike Code 117', 2, 'White '),
(6, 5, 'Ebike Code 117', 2, 'Black'),
(7, 6, 'Tirich Rainer MTB 27.5', 2, 'Black '),
(8, 6, 'Tirich Rainer MTB 27.5', 2, 'Red'),
(9, 7, 'Ebike Code 113', 1, 'Yellow'),
(10, 7, 'Ebike Code 113', 2, 'Black'),
(11, 8, 'Ebike Code 205', 2, 'Purple'),
(12, 8, 'Ebike Code 205', 1, 'Pink'),
(13, 9, 'Mountainpeak Striker Road Bike (Sora)', 2, 'Black/Gray'),
(14, 9, 'Mountainpeak Striker Road Bike (Sora)', 2, 'Red/Black'),
(15, 10, 'Mountainpeak Falcon Gravel Bike', 1, 'Glossy Gray 51'),
(16, 10, 'Mountainpeak Falcon Gravel Bike', 1, 'Glossy Gray 47'),
(17, 11, 'Mountainpeak Titans 27.5 ', 1, 'Black/Red 16'),
(18, 11, 'Mountainpeak Titans 27.5 ', 1, 'Black/Red 17'),
(19, 12, 'Foxter Lincoln 27.5', 1, 'Grey 16'),
(20, 12, 'Foxter Lincoln 27.5', 1, 'Black 16'),
(21, 13, 'Ebike Code 114', 2, 'Black '),
(22, 13, 'Ebike Code 114', 2, 'Red/Gray'),
(23, 14, 'Ebike Code 008b', 1, 'Black');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transfer`
--

CREATE TABLE `stock_transfer` (
  `transfer_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `product_name` text NOT NULL,
  `location_from` text NOT NULL,
  `location_to` text NOT NULL,
  `quantity` int(255) NOT NULL,
  `color_size` varchar(50) NOT NULL,
  `transfer_date` date NOT NULL,
  `transfer_type` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_transfer`
--

INSERT INTO `stock_transfer` (`transfer_id`, `product_id`, `product_name`, `location_from`, `location_to`, `quantity`, `color_size`, `transfer_date`, `transfer_type`) VALUES
(6, 1, 'Shimano Deore CS-M5100 Sprocket', 'supplier', 'VM Main', 6, 'Silver', '2023-06-18', 'Inbound'),
(7, 2, 'Shimano MT201 Hydraulic Brakeset', 'supplier', 'VM Main', 5, 'Black', '2023-06-18', 'Inbound'),
(8, 4, 'Shimano Sora FC-R3000 Crankset', 'supplier', 'VM Main', 3, 'Black', '2023-06-18', 'Inbound'),
(9, 1, 'Shimano Deore CS-M5100 Sprocket', 'vmtc', 'VM Main', 5, 'Silver', '2023-06-18', 'Inbound'),
(10, 2, 'Shimano MT201 Hydraulic Brakeset', 'vmtc', 'VM Main', 5, 'Black', '2023-06-18', 'Inbound'),
(11, 3, 'Shimano Deore M4100 Shifters', 'vmtc', 'VM Main', 3, 'Black', '2023-06-18', 'Inbound'),
(12, 1, 'Shimano Deore CS-M5100 Sprocket', 'VM Main', 'shopee', 5, 'Silver', '2023-06-18', 'Outbound'),
(13, 2, 'Shimano MT201 Hydraulic Brakeset', 'VM Main', 'shopee', 10, 'Black', '2023-06-18', 'Outbound'),
(14, 3, 'Shimano Deore M4100 Shifters', 'VM Main', 'shopee', 5, 'Black', '2023-06-18', 'Outbound'),
(15, 1, 'Shimano Deore CS-M5100 Sprocket', 'VM Main', 'vmtc', 1, 'Silver', '2023-06-18', 'Outbound'),
(16, 2, 'Shimano MT201 Hydraulic Brakeset', 'VM Main', 'vmtc', 1, 'Black', '2023-06-18', 'Outbound'),
(17, 1, 'Shimano Deore CS-M5100 Sprocket', 'VM Main', 'vmtc', 4, 'Silver', '2023-06-18', 'Outbound'),
(18, 2, 'Shimano MT201 Hydraulic Brakeset', 'VM Main', 'vmtc', 4, 'Black', '2023-06-18', 'Outbound');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_type`) VALUES
(1, 'admin_demo', 'admin@vykesmnl.com', 'c52f28cbb48f9a2fc30dc70b37e0968e', 'admin'),
(2, 'cust_demo', 'demo@vykesmnl.com', '12bfc5e4842f86d131ac1fdd8ce54a59', 'user'),
(3, 'emp_demo', 'employee@vykesmnl.com', '7344f2dd1863f439ae073adfa4180b55', 'employee'),
(4, 'Yuri Andrew Bayonito', 'shushubayonito@gmail.com', 'c514c91e4ed341f263e458d44b3bb0a7', 'user'),
(5, 'Samuel Los Banos', 'bobokakaka12@gmail.com', 'c2c0ad5d1f49109583db7aee81679722', 'user');

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
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  ADD PRIMARY KEY (`transfer_id`);

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `stock_transfer`
--
ALTER TABLE `stock_transfer`
  MODIFY `transfer_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
