-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 06:54 AM
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
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `id` int(11) NOT NULL,
  `information` varchar(50) DEFAULT NULL,
  `recordDate` varchar(50) DEFAULT NULL,
  `cashIn` int(11) DEFAULT NULL,
  `cashOut` int(11) DEFAULT NULL,
  `createdDate` timestamp NULL DEFAULT NULL,
  `updatedDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`id`, `information`, `recordDate`, `cashIn`, `cashOut`, `createdDate`, `updatedDate`) VALUES
(2, 'Piutang dari PT Global Sukses Solusi Tbk', '2023-11-19', 35000000, NULL, '2023-11-19 04:42:39', '2023-11-19 05:18:23'),
(4, 'Pembayarn Utang PT SAMI', '2023-11-19', NULL, 12500000, '2023-11-19 06:11:37', NULL),
(5, 'Cicilan piutang dari PT Global Sukses Solusi', '2023-11-27', 13000000, NULL, '2023-11-27 13:48:45', NULL),
(6, 'Cicilan piutang dari PT Global Sukses Solusi', '2023-10-27', 25000000, NULL, '2023-11-27 13:49:51', NULL),
(7, 'Cicilan piutang dari PT Global Sukses Solusi', '2023-12-27', 30000000, NULL, '2023-11-27 13:50:55', NULL),
(8, 'Cicilan piutang dari PT Global Sukses Solusi', '2024-01-27', 147000000, NULL, '2023-11-27 13:51:37', NULL),
(9, 'Cicilan piutang dari PT Global Sukses Solusi', '2024-02-27', 15000000, NULL, '2023-11-27 13:54:22', NULL),
(10, 'Pembayarn Utang PT SAMI', '2023-11-27', NULL, 23000000, '2023-11-27 14:10:00', NULL),
(11, 'Keuntungan pengantaran bualn Oktober', '2023-12-03', 38000000, NULL, '2023-12-03 05:52:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `piutang`
--

CREATE TABLE `piutang` (
  `id` int(11) NOT NULL,
  `referenceNumber` varchar(50) DEFAULT NULL,
  `debtorName` varchar(50) DEFAULT NULL,
  `recordDate` varchar(50) DEFAULT NULL,
  `dueDate` varchar(50) DEFAULT NULL,
  `totalReceivable` int(11) DEFAULT NULL,
  `lastPaymentDate` varchar(50) DEFAULT NULL,
  `currentReceivable` int(11) DEFAULT NULL,
  `initialReceivable` int(11) DEFAULT NULL,
  `createdDate` timestamp NULL DEFAULT NULL,
  `updatedDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `piutang`
--

INSERT INTO `piutang` (`id`, `referenceNumber`, `debtorName`, `recordDate`, `dueDate`, `totalReceivable`, `lastPaymentDate`, `currentReceivable`, `initialReceivable`, `createdDate`, `updatedDate`) VALUES
(22, '#PIU231111357', 'PT SIM', '2023-11-11', '2023-11-11', NULL, '2024-01-12', 0, 300000000, '2023-11-11 16:38:23', '2024-01-11 17:00:00'),
(23, '#PIU231111357', 'PT SIM', '2023-12-11', NULL, 15000000, NULL, NULL, NULL, '2023-11-11 16:41:51', NULL),
(24, '#PIU23111115', 'PT Global Sukses Solusi', '2023-11-11', '2024-11-11', NULL, '2024-02-27', 0, 250000000, '2023-11-11 16:59:47', '2024-02-26 17:00:00'),
(26, '#PIU231111357', 'PT SIM', '2024-01-12', NULL, 285000000, NULL, NULL, NULL, '2023-11-11 17:04:10', NULL),
(31, '#PIU23111115', 'PT Global Sukses Solusi', '2023-11-19', NULL, 20000000, NULL, NULL, NULL, '2023-11-19 04:26:56', NULL),
(32, '#PIU23111115', 'PT Global Sukses Solusi', '2023-11-27', NULL, 13000000, NULL, NULL, NULL, '2023-11-27 13:48:45', NULL),
(33, '#PIU23111115', 'PT Global Sukses Solusi', '2023-10-27', NULL, 25000000, NULL, NULL, NULL, '2023-11-27 13:49:51', NULL),
(34, '#PIU23111115', 'PT Global Sukses Solusi', '2023-12-27', NULL, 30000000, NULL, NULL, NULL, '2023-11-27 13:50:55', NULL),
(35, '#PIU23111115', 'PT Global Sukses Solusi', '2024-01-27', NULL, 147000000, NULL, NULL, NULL, '2023-11-27 13:51:37', NULL),
(36, '#PIU23111115', 'PT Global Sukses Solusi', '2024-02-27', NULL, 15000000, NULL, NULL, NULL, '2023-11-27 13:54:22', NULL);

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
(18, 'RoleUser', '02', 'Admin'),
(19, 'VehicleStatus', '01', 'Siap digunakan'),
(20, 'VehicleStatus', '02', 'Dalam perbaikan'),
(21, 'VehicleStatus', '03', 'Sedang digunakan'),
(22, 'PiutangStatus', '01', 'Jatuh tempo'),
(23, 'PiutangStatus', '02', 'Sudah terbayar'),
(24, 'PiutangStatus', '03', 'Terlambat'),
(25, 'PiutangStatus', '04', 'Dalam Proses');

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
(3, 'Annisa  Wahyu Hidayah', 'annisawahyu01', '$2y$10$oxHo9IdtKrqkp6CAGP/GnezevwfQZNEOHIABvHjLDUbsXD9xneA/6', '01', '02', '2023-10-12 14:22:43', '2023-12-03 05:48:44'),
(4, 'Ilham Dhiya Ulhaq', 'ilhamdhiya01', '$2y$10$Dod49gOwZ.byMj0NwCbN0eJs3eSy1jPSLD/pSRZtWruWRdLHQXShi', '01', '01', '2023-10-14 15:44:59', '2023-10-14 16:24:07'),
(5, 'Frido', 'frido01', '$2y$10$v1eqKLL8K6QBSohRHWFfleQmVmDkyC1UwXDsk8kAAzSiu2zU2BAyS', '01', '02', '2023-10-14 16:41:56', '2023-12-03 05:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `utang`
--

CREATE TABLE `utang` (
  `id` int(11) NOT NULL,
  `referenceNumber` varchar(50) DEFAULT NULL,
  `creditorName` varchar(50) DEFAULT NULL,
  `recordDate` varchar(50) DEFAULT NULL,
  `dueDate` varchar(50) DEFAULT NULL,
  `totalDebt` int(11) DEFAULT NULL,
  `lastPaymentDate` varchar(50) DEFAULT NULL,
  `currentDebt` int(11) DEFAULT NULL,
  `initialDebt` int(11) DEFAULT NULL,
  `createdDate` timestamp NULL DEFAULT NULL,
  `updatedDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utang`
--

INSERT INTO `utang` (`id`, `referenceNumber`, `creditorName`, `recordDate`, `dueDate`, `totalDebt`, `lastPaymentDate`, `currentDebt`, `initialDebt`, `createdDate`, `updatedDate`) VALUES
(1, '#UTG231112351', 'BRI', '2023-11-12', '2025-11-12', NULL, '2023-12-12', 500000000, 500000000, '2023-11-12 15:31:39', '2023-11-12 16:10:13');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT '0',
  `numberPlate` varchar(50) DEFAULT '0',
  `lastService` varchar(50) DEFAULT NULL,
  `serviceAgain` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `type`, `numberPlate`, `lastService`, `serviceAgain`, `status`) VALUES
(1, 'Sigra', 'H 6011 JW', '2023-10-20', '2023-12-20', '01'),
(3, 'Test', 'T 569 JY', '2023-12-03', '2024-01-01', '01');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `vendorStatus` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `phone`, `address`, `vendorStatus`) VALUES
(1, 'PT. Poliplas Tbk', '08123456789', 'Jl Kawasan Industri Candi No 502 C', '01'),
(5, 'PT. Global Sukses Solusi Tbk', '089765432173', 'Jl. Cokrodiningrat No 15 B', '02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piutang`
--
ALTER TABLE `piutang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbloption`
--
ALTER TABLE `tbloption`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`username`) USING BTREE;

--
-- Indexes for table `utang`
--
ALTER TABLE `utang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `piutang`
--
ALTER TABLE `piutang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbloption`
--
ALTER TABLE `tbloption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `utang`
--
ALTER TABLE `utang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
