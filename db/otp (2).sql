-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2024 at 12:29 PM
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
(159, '33', '1', 'b', ''),
(160, '33', '2', 'c', ''),
(161, '33', '3', 'b', ''),
(162, '33', '4', 'd', ''),
(163, '33', '5', 'e', ''),
(164, '33', '6', 'd', ''),
(165, '33', '7', 'a', ''),
(166, '33', '8', 'b', ''),
(167, '33', '9', 'e', ''),
(168, '33', '10', 'c', ''),
(169, '33', '11', 'e', ''),
(170, '33', '12', 'f', '');

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
(33, 'juan', 'veron', '8215544648', 'juanveron490@gmail.com', '', 'juan', 'd39eeaf2407ca460ea64098ae11409c2', 541785, '', ''),
(34, 'rijal', 'ijal', '9838339', 'erlangbayu2@gmail.com', '', 'ijal', '180d470387f8847ec545e93a69f04a9b', 758654, '', '');

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT for table `tbl_soal`
--
ALTER TABLE `tbl_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `tbl_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
