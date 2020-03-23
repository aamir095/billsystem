-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2020 at 04:14 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capitaly`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_report`
--

CREATE TABLE `delivery_report` (
  `id` int(100) NOT NULL,
  `invoice` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `code` varchar(100) NOT NULL,
  `delivery_qty` int(100) NOT NULL,
  `qty_to_deliver` int(100) NOT NULL,
  `remaining_qty` int(100) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `date_to_delivery` date NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_report`
--

INSERT INTO `delivery_report` (`id`, `invoice`, `product`, `code`, `delivery_qty`, `qty_to_deliver`, `remaining_qty`, `customer_name`, `order_date`, `date_to_delivery`, `address`) VALUES
(6, 1, '1,MOP 40X40', '12', 1212, 1212, 1212, 'GULF TILES FACTORY', '2020-01-20', '1212-12-12', 'ST. 15'),
(7, 1, '2,BFC 40X40', '1212', 1212, 1212, 1212, 'GULF TILES FACTORY', '2020-01-21', '1212-12-12', 'ST. 15'),
(9, 1, '1,MOP 40X40', 'ew', 0, 0, 0, 'bn', '0000-00-00', '2020-03-18', 'drc'),
(10, 1, '1,MOP 40X40', '10', 10, 100, 10, 'abc', '0000-00-00', '1010-10-10', 'ktm'),
(11, 2, '0', '10', 10, 10, 1, 'CAPITAL FACTORIES', '2020-01-20', '0111-11-25', 'ST. 28'),
(12, 1, '1,MOP 40X40', '112', 10, 100, 90, 'GULF TILES FACTORY', '2020-01-20', '2020-10-22', 'ST. 15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_report`
--
ALTER TABLE `delivery_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice` (`invoice`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery_report`
--
ALTER TABLE `delivery_report`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_report`
--
ALTER TABLE `delivery_report`
  ADD CONSTRAINT `delivery_report_ibfk_1` FOREIGN KEY (`invoice`) REFERENCES `salesbill` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
