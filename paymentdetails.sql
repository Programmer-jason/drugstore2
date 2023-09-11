-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2023 at 04:50 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `paymentdetails`
--
ALTER TABLE `paymentdetails`
  ADD PRIMARY KEY (`paymentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `paymentdetails`
--
ALTER TABLE `paymentdetails`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
