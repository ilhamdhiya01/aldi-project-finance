-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2023 at 06:48 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finance`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbloption`
--

CREATE TABLE `tbloption` (
  `id` int(11) NOT NULL,
  `optDesc` char(50) DEFAULT NULL,
  `optCode` char(50) DEFAULT NULL,
  `optStatus` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbloption`
--

INSERT INTO `tbloption` (`id`, `optDesc`, `optCode`, `optStatus`) VALUES
(1, 'TransactionType', '01', 'Pemasukan'),
(2, 'TransactionType', '02', 'Pembelian'),
(3, 'TransactionType', '03', 'Penyewaan'),
(4, 'TransactionType', '04', 'Utang'),
(5, 'TransactionType', '05', 'Piutang'),
(6, 'TransactionType', '06', 'Pengiriman'),
(7, 'VerificationStatus', '01', 'Verified'),
(8, 'VerificationStatus', '02', 'Audit'),
(9, 'PaymentStatus', '01', 'Paid'),
(10, 'PaymentStatus', '02', 'Unpaid'),
(11, 'PaymentStatus', '03', 'Pending'),
(12, 'PaymentMethod', '01', 'Bank'),
(13, 'PaymentMethod', '02', 'Transfer'),
(14, 'PaymentMethod', '03', 'Cash'),
(15, 'UserStatus', '01', 'Active'),
(16, 'UserStatus', '02', 'Unactive'),
(17, 'RoleUser', '01', 'Super Admin'),
(18, 'RoleUser', '02', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `vendorId` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `typeId` char(50) DEFAULT NULL,
  `paymentMethodId` char(50) DEFAULT NULL,
  `paymentStatusId` char(50) DEFAULT NULL,
  `verificationStatusId` char(50) DEFAULT NULL,
  `createDt` timestamp NULL DEFAULT NULL,
  `updateDt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` char(50) DEFAULT NULL,
  `roleId` char(50) DEFAULT NULL,
  `createDt` timestamp NULL DEFAULT NULL,
  `updateDt` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `status`, `roleId`, `createDt`, `updateDt`) VALUES
(1, 'Ilham Dhiya Ulhaq', 'ilhamdhiya01', 'ilhamdhiya01', '01', '01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `vendorStatus` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbloption`
--
ALTER TABLE `tbloption`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`username`) USING BTREE;

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbloption`
--
ALTER TABLE `tbloption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
