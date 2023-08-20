-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 03:45 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artharsh`
--

-- --------------------------------------------------------

--
-- Table structure for table `artist_payment`
--

CREATE TABLE `artist_payment` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `final_price` int(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `placed_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artist_payment`
--

INSERT INTO `artist_payment` (`id`, `user_id`, `name`, `final_price`, `status`, `placed_on`) VALUES
(1, 7, 'blossom', 1200, 'â‚¹1200 is credited', '2022-05-10'),
(3, 7, 'florescence', 1300, 'â‚¹1300 is credited', '2022-05-10'),
(4, 7, 'glam berlin ', 2100, 'â‚¹2100 is credited', '2022-05-10'),
(5, 7, 'infrared', 3000, 'pending', '2022-05-10'),
(6, 7, 'night street', 2905, '', '2022-05-10'),
(11, 6, 'harbour', 1400, 'â‚¹1400 is credited', '2022-05-10'),
(12, 6, 'elephant', 1250, 'pending', '2022-05-10'),
(13, 6, 'gioja', 2000, 'â‚¹2000 is credited', '2022-05-10'),
(14, 6, 'lion', 850, '', '2022-05-10'),
(15, 6, 'paris', 1650, 'â‚¹1650 is credited', '2022-05-10'),
(16, 5, 'dahlia', 2200, '', '2022-05-10'),
(17, 5, 'night city', 1630, 'pending', '2022-05-10'),
(18, 5, 'beach', 1850, 'â‚¹1850 is credited', '2022-05-10'),
(19, 5, 'burano island', 1660, 'â‚¹1660 is credited', '2022-05-10'),
(20, 5, 'europe street', 3000, 'pending', '2022-05-10'),
(21, 5, 'new york', 3300, '', '2022-05-10'),
(22, 9, 'aurum', 1400, 'â‚¹1400 is credited', '2022-05-10'),
(23, 9, 'rose', 1500, 'pending', '2022-05-10'),
(27, 9, 'giraffe', 1450, 'â‚¹1450 is credited', '2022-05-10'),
(28, 9, 'xiuyi bridge', 2570, 'pending', '2022-05-10'),
(29, 9, 'vizag harbour', 1460, 'â‚¹1460 is credited', '2022-05-10'),
(30, 9, 'manhattan bridge', 2000, 'â‚¹2000 is credited', '2022-05-10'),
(33, 9, 'varanasi', 1670, '', '2022-05-10'),
(34, 7, 'gorilla', 1200, '', '2022-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `a_bankaccount`
--

CREATE TABLE `a_bankaccount` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `a_no` bigint(100) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `ifsc` bigint(100) NOT NULL,
  `a_name` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_bankaccount`
--

INSERT INTO `a_bankaccount` (`id`, `user_id`, `a_no`, `b_name`, `ifsc`, `a_name`, `date`) VALUES
(2, 7, 1234567897, 'SBI', 12345678909, 'naveen', '2022-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `c_id` int(100) NOT NULL,
  `p_id` int(30) NOT NULL,
  `user_id` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`c_id`, `p_id`, `user_id`, `price`, `quantity`, `image`) VALUES
(6, 40, 2, 2300, 1, 'dahlia.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `number` bigint(10) NOT NULL,
  `message` mediumtext NOT NULL,
  `placed_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` varchar(40) NOT NULL,
  `number` bigint(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `total_products` varchar(100) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` date NOT NULL,
  `payment_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(3, 2, 'rathi', 9798901345, 'rathi@gmail.com', 'cash on delivery', 'flat no. 101, amman kovil, tuticorin, india - 628007', ', vizag harbour (1) ', 1560, '2022-05-16', 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `artist_name` varchar(100) NOT NULL,
  `art_type` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `length` int(100) NOT NULL,
  `breadth` int(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `placed_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `artist_name`, `art_type`, `price`, `image`, `theme`, `length`, `breadth`, `description`, `placed_on`) VALUES
(27, 6, 'harbour', 'nila', 'painting', '1500', 'harbour-4.jpg', 'sea', 500, 400, 'harbour art', '2022-03-24'),
(29, 7, 'blossom', 'naveen', 'painting', '1300', 'blossom.jpg', 'flower', 600, 500, 'blossom art', '2022-05-10'),
(30, 7, 'floresence', 'naveen', 'oilpainting', '1400', 'Florescence.jpg', 'flower', 500, 600, 'floresence art', '2022-05-10'),
(31, 7, 'glam berlin', 'naveen', 'watercoloring', '2200', 'glam berlin.jpg', 'city', 600, 700, 'glam berlin view', '2022-05-10'),
(32, 7, 'infrared', 'naveen', 'painting', '3100', 'infrared.jpg', 'city', 500, 555, 'infrared view', '2022-05-10'),
(33, 7, 'night street', 'naveen', 'oilpainting', '3005', 'city street night.jpg', 'city', 700, 800, 'night street view', '2022-05-10'),
(36, 6, 'elephant', 'nila', 'pencilsketching', '1350', 'elephant.jpg', 'animal', 600, 700, 'elephant art', '2022-05-10'),
(37, 6, 'gioja', 'nila', 'pencilsketching', '2100', 'gioja.jpg', 'animal', 600, 500, 'gioja', '2022-05-10'),
(38, 6, 'lion', 'nila', 'pencilsketching', '950', 'lion.jpg', 'animal', 400, 500, 'lion art', '2022-05-10'),
(39, 6, 'paris', 'nila', 'painting', '1750', 'paris.jpg', 'city', 800, 700, 'paris view', '2022-05-10'),
(40, 5, 'dahlia', 'rekha', 'oilpainting', '2300', 'dahlia.jpg', 'flower', 600, 750, 'dahlia art', '2022-05-10'),
(41, 5, 'night city', 'rekha', 'painting', '1730', 'beautiful-bright-city-and-rainy-season.jpg', 'city', 600, 730, 'night city view', '2022-05-10'),
(42, 5, 'beach', 'rekha', 'watercoloring', '1950', 'beach-view-4.jpg', 'city', 850, 950, 'beach view', '2022-05-10'),
(43, 5, 'burano island', 'rekha', 'watercoloring', '1760', 'burano island, vernice.jpg', 'city', 700, 600, 'burano island, vernice', '2022-05-10'),
(44, 5, 'europe street', 'rekha', 'oilpainting', '3100', 'europe.jpg', 'city', 800, 600, 'europe street art', '2022-05-10'),
(45, 5, 'new york', 'rekha', 'oilpainting', '3400', 'new york1.jpg', 'city', 1000, 1000, 'new york city', '2022-05-10'),
(47, 9, 'aurum', 'sanjay', 'oil painting', '1500', 'aurum.jpg', 'flower', 500, 600, 'aurum flower', '2022-05-10'),
(49, 9, 'giraffee', 'sanjay', 'pencilsketching', '1550', 'giraffe.jpg', 'animal', 650, 550, 'giraffee art', '2022-05-10'),
(51, 9, 'xiuyi bridge', 'sanjay', 'watercoloring', '2670', 'xiuyi bridge.jpg', 'city', 450, 650, 'xiuyi bridge art', '2022-05-10'),
(52, 9, 'vizag harbour', 'sanjay', 'watercoloring', '1560', 'vizag-harbour.jpg', 'city', 560, 650, 'vizag harbour ', '2022-05-10'),
(53, 9, 'manhattan bridge', 'sanjay', 'pencilsketching', '2100', 'manhattan bridge.jpg', 'city', 1500, 1600, 'manhattan bridge view', '2022-05-10'),
(57, 9, 'varanasi', 'sanjay', 'watercoloring', '1770', 'varanasi-26.jpg', 'city', 690, 770, 'varanasi art', '2022-05-10'),
(59, 7, 'gorilla', 'naveen', 'pencilsketching', '1300', 'showimg_hkl61_mobile.jpg', 'animal', 400, 500, 'gorilla art', '2022-05-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `placed_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `placed_on`) VALUES
(1, 'harshini', 'harsh@gmail.com', 'harsh', 'admin', '2021-08-01'),
(2, 'rathi', 'rathi@gmail.com', 'rathi', 'user', '2021-09-08'),
(5, 'rekha', 'rekha@gmail.com', 'rekha', 'artist', '2021-10-08'),
(6, 'nila', 'nila@gmail.com', 'nila', 'artist', '2021-11-08'),
(7, 'naveen', 'naveen@gmail.com', 'naveen', 'artist', '2021-11-06'),
(9, 'sanjay', 'sanjay@gmail.com', 'sanjay', 'artist', '2021-11-18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artist_payment`
--
ALTER TABLE `artist_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `a_bankaccount`
--
ALTER TABLE `a_bankaccount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_product` (`p_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_message` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_orders` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Fkuser` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artist_payment`
--
ALTER TABLE `artist_payment`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `a_bankaccount`
--
ALTER TABLE `a_bankaccount`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `c_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `artist_payment`
--
ALTER TABLE `artist_payment`
  ADD CONSTRAINT `artist_payment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `a_bankaccount`
--
ALTER TABLE `a_bankaccount`
  ADD CONSTRAINT `fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`p_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `fk_message` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `Fkuser` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
