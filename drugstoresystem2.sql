-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 07:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drugstoresystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `paymentdetails`
--

CREATE TABLE `paymentdetails` (
  `paymentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `refId` varchar(300) NOT NULL,
  `checkoutId` varchar(300) NOT NULL,
  `name` varchar(255) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `paymentStatus` varchar(200) NOT NULL,
  `createdAt` varchar(255) NOT NULL,
  `paymentType` varchar(255) NOT NULL,
  `address` varchar(300) NOT NULL,
  `brgy` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paymentdetails`
--

INSERT INTO `paymentdetails` (`paymentId`, `userId`, `refId`, `checkoutId`, `name`, `productName`, `amount`, `paymentStatus`, `createdAt`, `paymentType`, `address`, `brgy`) VALUES
(25, 13, '64f2f47775057', 'cs_rhSna4iNBNA6wwPDfHn3KA54', 'john doe', 'JsbabyOil', '306', 'paid', '02-09-2023', 'paymaya', '742 gagalangin tondo manila', '123 zone 16'),
(26, 14, '64f2fc8138cc4', 'cs_SDQCrwk3rzFueC5C8VSAyAcm', 'jane doe', 'tempra', '123', 'paid', '02-09-2023', 'gcash', '742 gagalangin tondo manila', ''),
(27, 13, '64f735813250c', 'cs_yr6HebLFnSi7vzqxqofjcDiq', 'john doe', 'maxipeel3', '134', 'paid', '05-09-2023', 'gcash', '742 gagalangin tondo manila', '123 zone 16'),
(28, 13, '64fdbbbb46dc1', 'cs_HGRikVu5ZK8d7iG2EmZejuP7', 'john doe', 'tempra', '246', 'paid', '10-09-2023', 'gcash', '742 gagalangin tondo manila', '123 zone 16');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `productExpired` varchar(100) NOT NULL,
  `productQty` int(11) NOT NULL,
  `productType` enum('m','p') NOT NULL,
  `productImg` varchar(255) NOT NULL,
  `productPrice` float(10,2) NOT NULL,
  `productDescription` text NOT NULL,
  `stockType` enum('n','o','d','e') NOT NULL,
  `productSold` int(11) NOT NULL,
  `notificationType` enum('r','nr') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `productName`, `productExpired`, `productQty`, `productType`, `productImg`, `productPrice`, `productDescription`, `stockType`, `productSold`, `notificationType`) VALUES
(1, 'Neozep', '2023-05-15', 44, 'm', 'bioflu.jpg', 23.00, '', 'n', 0, 'r'),
(5, 'Vitamins', '2023-05-15', 3, 'm', 'vitamins.jpg', 32.00, '', 'n', 0, 'r'),
(6, 'Johnson Shampoo', '2023-05-15', 23, 'p', 'jsbabybath.jpg', 45.00, '', 'n', 0, 'r'),
(9, 'jsshampoo', '2023-06-28', 34, 'p', 'jsshampoo.jpg', 65.00, '', 'n', 0, 'r'),
(10, 'maxipeel3', '2023-06-29', 4, 'p', 'maxipeel3.png', 134.00, '', 'n', 0, 'r'),
(11, 'Maxipeel2', '2023-06-29', 6, 'p', 'maxipeel2.png', 245.00, '', 'n', 0, 'r'),
(12, 'JsbabyOil', '2023-07-19', 87, 'p', 'jsbabyoil125ml.jpg', 153.00, '', 'n', 0, 'r'),
(13, 'Biogesic', '2023-07-25', 32, 'm', 'biogesic.jpg', 132.00, '', 'o', 0, 'r'),
(17, 'Off', '2028-07-20', 12, 'p', 'off.jpg', 34.00, '', 'n', 0, 'r'),
(20, 'StyleX125g', '2024-07-18', 1, 'p', 'styleX125g.jpg', 345.00, '', 'n', 0, 'r'),
(21, 'Olay', '2024-07-18', 12, 'p', 'olay.png', 43.00, '', 'n', 0, 'r'),
(23, 'ascorbic acid', '2025-07-29', 9, 'm', 'ascorbic.png', 34.00, '', 'd', 0, 'r'),
(53, 'catridge ascorbate', '2023-07-25', 18, 'm', 'catridgesodiumascorbate.png', 434.00, '', 'e', 0, 'r'),
(54, 'pondswhitebeuty', '2023-07-25', 52, 'p', 'pondswhitebeautiy.jpg', 341.00, '', 'e', 0, 'r'),
(55, '60-ml-Paracetamol', '2027-06-18', 5, 'm', '60-ml-Aceclofenac-Paracetamol-Oral-Suspension.jpg', 54.00, '', 'n', 0, 'r'),
(56, 'imodium-msr-24ct-n', '2026-02-25', 0, 'm', 'imodium-msr-24ct-n.jpg', 67.00, '', 'n', 0, 'r'),
(57, 'tempra', '2025-06-26', 31, 'm', 'tempra_photo_01.jpg', 123.00, '', 'n', 0, 'r'),
(63, 'Miracle Cream', '2023-08-12', 23, 'm', 'miraclecream.jpg', 12.00, '', 'e', 0, 'nr'),
(69, 'Cefurex', '2023-09-30', 12, 'm', 'Cefurex-500-mg-film-Coated-tablet-high-res-scaled.jpg', 79.00, '', 'n', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `salesId` int(11) NOT NULL,
  `mula` varchar(100) NOT NULL,
  `hanggang` varchar(100) NOT NULL,
  `totalSales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`salesId`, `mula`, `hanggang`, `totalSales`) VALUES
(1, '2010', '2011', 20343),
(2, '2012', '2013', 34123),
(4, '2008', '2009', 2147483647),
(5, '2013', '2014', 89000),
(6, '2014', '2015', 87341),
(7, '2015', '2016', 908231),
(8, '2016', '2017', 973434),
(9, '2017', '2018', 93423);

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `userId` int(11) NOT NULL,
  `userProfile` varchar(255) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('f','m','o') NOT NULL,
  `age` int(11) NOT NULL,
  `contact` bigint(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`userId`, `userProfile`, `firstName`, `lastName`, `email`, `password`, `gender`, `age`, `contact`, `role`, `address`, `brgy`) VALUES
(10, 'avarar-image.png', 'admin', 'ako', 'admin@gmail.com', '1234', 'm', 16, 9432343434, 'admin', '742 gagalangin tondo manila', '123 zone 24'),
(13, 'headache.png', 'john', 'doe', 'john@gmail.com', '1234', 'f', 45, 9214748364, 'customer', '742 gagalangin tondo manila', '123 zone 16'),
(14, 'heroacdemia.jpg', 'jane', 'doe', 'jane@gmail.com', '1234', 'f', 34, 9147483647, 'customer', '742 gagalangin tondo manila', ''),
(15, 'pngwing.com (2).png', 'ichiro', 'oda', 'oda@gmail.com', '1234', 'm', 78, 9147483647, 'employee', '742 gagalangin tondo manila', ''),
(16, '', 'nicola', 'tesla', 'nicola@gmail.com', '$2y$10$DASGmgWM95o8KuC.RandpOhee1MD2I5aza3mM0fZ3UEITXABUy1Ee', 'f', 34, 9147483647, 'customer', '742 gagalangin tondo manila', ''),
(17, '', 'thomas', 'edison', 'thomas@gmail.com', '$2y$10$ZX4fmbnv33HCp1jDLw1ODuA9M4IDUnGF1RvnNVYBL5ACRVi5fi2xW', 'm', 43, 9123434343, 'customer', '742 gagalangin tondo manila', ''),
(19, 'heroacdemia.jpg', 'gojo', 'satoru', 'gojo@gmail.com', '1234', 'm', 23, 9123456789, 'customer', '742 gagalangin tondo manila', '123 zone 23'),
(20, '', 'yuji', 'itadori', 'itadori@gmail.com', '1234', 'm', 16, 9243234242, 'customer', '123 asawa ni marie street Tondo Manila', '123 zone 23'),
(21, 'jasonFormalAttire.jpg', 'zoro', 'roronoa', 'roronoa@gmail.com', '1234', 'm', 23, 9434342343, 'employee', '123 kahit saan street Tondo Manila', '123 zone 2');

-- --------------------------------------------------------

--
-- Table structure for table `user_favorite`
--

CREATE TABLE `user_favorite` (
  `favorite_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_favorite` enum('t','f') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_favorite`
--

INSERT INTO `user_favorite` (`favorite_id`, `user_id`, `product_id`, `is_favorite`) VALUES
(134, 13, 9, 't'),
(186, 13, 20, 't'),
(189, 13, 13, 't'),
(192, 18, 11, 't'),
(194, 13, 5, 't'),
(195, 13, 11, 't'),
(198, 18, 17, 't'),
(203, 18, 55, 't'),
(204, 19, 10, 't'),
(205, 18, 13, 't');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paymentdetails`
--
ALTER TABLE `paymentdetails`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`salesId`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_favorite`
--
ALTER TABLE `user_favorite`
  ADD PRIMARY KEY (`favorite_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paymentdetails`
--
ALTER TABLE `paymentdetails`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `salesId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_favorite`
--
ALTER TABLE `user_favorite`
  MODIFY `favorite_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=207;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
