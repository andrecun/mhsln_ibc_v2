-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 15, 2017 at 12:25 AM
-- Server version: 10.0.28-MariaDB
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ijin_belajar19oktober2016`
--

-- --------------------------------------------------------

--
-- Table structure for table `kode_wilayah`
--

CREATE TABLE `kode_wilayah` (
  `id_wilayah` int(11) NOT NULL,
  `kode_wilayah` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kode_wilayah`
--

INSERT INTO `kode_wilayah` (`id_wilayah`, `kode_wilayah`) VALUES
(1, '00'),
(2, '01'),
(3, '02'),
(4, '03'),
(5, '04'),
(6, '05'),
(7, '06'),
(8, '07'),
(9, '08'),
(10, '09'),
(11, '10'),
(12, '11'),
(13, '12'),
(14, '13'),
(15, '14'),
(16, '20'),
(17, '21'),
(18, '22'),
(19, '23'),
(20, '24'),
(21, '27'),
(22, '28'),
(23, '29'),
(24, '30'),
(25, '31'),
(26, '32'),
(27, '33'),
(28, '34'),
(29, '35'),
(30, '36'),
(31, '37'),
(32, '38'),
(33, '39'),
(34, '40'),
(35, '41'),
(36, '42'),
(37, '43'),
(38, '44'),
(39, '45'),
(40, '46'),
(41, '47'),
(42, '48'),
(43, '49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kode_wilayah`
--
ALTER TABLE `kode_wilayah`
  ADD PRIMARY KEY (`id_wilayah`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kode_wilayah`
--
ALTER TABLE `kode_wilayah`
  MODIFY `id_wilayah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
