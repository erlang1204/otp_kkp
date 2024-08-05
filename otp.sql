-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2024 at 06:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `otp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jawaban`
--

CREATE TABLE `tbl_jawaban` (
  `id` int(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `soal_id` varchar(255) NOT NULL,
  `jawaban` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jawaban`
--

INSERT INTO `tbl_jawaban` (`id`, `user_id`, `soal_id`, `jawaban`, `value`) VALUES
(126, '27', '1', 'b', ''),
(127, '27', '2', 'c', ''),
(128, '27', '3', 'b', ''),
(129, '27', '4', 'd', ''),
(130, '27', '5', 'e', ''),
(131, '27', '6', 'd', ''),
(132, '27', '7', 'a', ''),
(133, '27', '8', 'b', ''),
(134, '27', '9', 'e', ''),
(135, '27', '10', 'c', ''),
(136, '27', '11', 'e', ''),
(137, '27', '12', 'f', ''),
(150, '29', '1', 'a', ''),
(151, '29', '2', 'b', ''),
(152, '29', '3', 'b', ''),
(153, '29', '6', 'b', ''),
(154, '29', '9', 'c', ''),
(155, '29', '12', 'f', ''),
(156, '32', '1', 'a', ''),
(157, '32', '2', 'a', ''),
(158, '32', '3', 'a', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_soal`
--

CREATE TABLE `tbl_soal` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `jawaban` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_soal`
--

INSERT INTO `tbl_soal` (`id`, `gambar`, `jawaban`) VALUES
(1, 'asset/no1.png', 'B'),
(2, 'asset/no2.png', 'C'),
(3, 'asset/no3.png', 'B'),
(4, 'asset/no4.png', 'D'),
(5, 'asset/no5.png', 'E'),
(6, 'asset/no6.png', 'D'),
(7, 'asset/no7.png', 'A'),
(8, 'asset/no8.png', 'B'),
(9, 'asset/no9.png', 'C'),
(10, 'asset/no10.png', 'D'),
(11, 'asset/no11.png', 'B'),
(12, 'asset/no12.png', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `tbl_user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birth_place_date` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_code` int(6) NOT NULL,
  `role` varchar(255) NOT NULL,
  `waktu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`tbl_user_id`, `first_name`, `last_name`, `contact_number`, `email`, `birth_place_date`, `username`, `password`, `verification_code`, `role`, `waktu`) VALUES
(3, 'admin', 'admin', '838393', 'erlangbayu2@gmail.com', '', 'admin', '2f3031575ea493e10429e99c4edefaac', 554541, 'admin', ''),
(24, 'bayu', 'bayu', '828373828', 'erlangbayu2@gmail.com', '', 'bayu', '40d082270f90977bd17472aec54dfbee', 742306, '', ''),
(27, 'ibu', 'ibu', '9383748', 'erlangbayu2@gmail.com', '', 'ibu', 'a753f15ac0049d6a159e8de9e3402b3f', 795161, '', ''),
(29, 'test', 'tetst', '9484858758', 'erlangbayu2@gmail.com', '', 'test', '02240e833fddb3ac9742d9127de1d8d9', 362907, '', ''),
(32, 'test1', 'test1', '84849', 'erlangbayu2@gmail.com', '', 'test1', '5d182daf6b569921eaaef13d1b148821', 644229, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jawaban`
--
ALTER TABLE `tbl_jawaban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`tbl_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jawaban`
--
ALTER TABLE `tbl_jawaban`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `tbl_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
