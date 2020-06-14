-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2020 at 12:59 PM
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
-- Database: `celendly`
--

-- --------------------------------------------------------

--
-- Table structure for table `avialable_day`
--

CREATE TABLE `avialable_day` (
  `av_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avialable_day`
--

INSERT INTO `avialable_day` (`av_id`, `user_id`, `day`) VALUES
(1, 2, 'Monday'),
(2, 2, 'Tuesday'),
(3, 2, 'Wednessday'),
(4, 2, 'Thursday'),
(5, 2, 'Friday'),
(6, 2, 'Staturday'),
(7, 2, 'Sunday'),
(8, 3, 'Tuesday'),
(9, 3, 'Wednessday'),
(10, 4, 'Monday'),
(11, 4, 'Tuesday'),
(12, 5, 'Monday'),
(13, 5, 'Tuesday'),
(14, 6, 'Monday'),
(16, 7, 'Monday'),
(17, 7, 'Tuesday'),
(18, 7, 'Wednessday'),
(19, 7, 'Thursday'),
(21, 8, 'Monday'),
(22, 9, 'Monday'),
(23, 9, 'Tuesday'),
(24, 9, 'Wednessday'),
(25, 9, 'Thursday'),
(26, 9, 'Friday'),
(27, 10, 'Monday'),
(28, 10, 'Tuesday'),
(29, 10, 'Wednessday'),
(30, 10, 'Thursday'),
(31, 10, 'Friday'),
(32, 11, 'Monday'),
(33, 11, 'Tuesday'),
(34, 11, 'Wednessday'),
(35, 11, 'Thursday'),
(36, 11, 'Friday'),
(37, 11, 'Saturday'),
(38, 11, 'Sunday'),
(39, 12, 'Tuesday'),
(40, 12, 'Wednessday'),
(41, 12, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `meeting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meeting_date` date NOT NULL,
  `meeting_time` time NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meeting_id`, `user_id`, `meeting_date`, `meeting_time`, `client_name`, `client_email`, `description`) VALUES
(4, 7, '2020-06-13', '09:00:00', 'Rajesh', 'rajesh@gamil.com', 'come on time'),
(12, 7, '2020-06-24', '09:00:00', 'dwqd', 'wdwq@ade.hg', 'wdwqed'),
(13, 7, '2020-06-22', '09:00:00', 'Adarsh', 'b@gmail.com', 'dewded'),
(14, 7, '2020-06-23', '09:00:00', 'ewef', 'dfew@fdf', 'wewed'),
(15, 7, '2020-06-24', '15:00:00', 'ef@afewdummy', 'dummy@dbjbj.com', 'wefwe'),
(16, 10, '2020-06-22', '09:00:00', 'Rakesh', 'sharma@gmail.com', 'gjghkjefkwkfkfnknfkrfl wkefwkfkwhdf ffewkhfkew hkwdnkw weknfweknf'),
(17, 10, '2020-06-23', '09:00:00', 'Ramu', 'ramu@gmail.com', 'qewdwed dewd'),
(18, 10, '2020-06-22', '10:00:00', 'Rinky', 'rinky@gbj', 'jkshfjkf'),
(19, 10, '2020-06-25', '09:00:00', 'Afzal', 'afzal@gmail.com', 'qqwdedd'),
(20, 11, '2020-06-20', '13:00:00', 'Ramu', 'ramu@gmail.com', 'ewhwehwefwfwef'),
(21, 10, '2020-06-23', '11:00:00', 'Rimu', 'rimu@rimu.com', 'come fats'),
(22, 11, '2020-06-24', '12:00:00', 'ded', 'ed@adfe', 'dedew'),
(23, 12, '2020-06-28', '15:00:00', 'ishu', 'afjkaajsfna@dafas', 'happy');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `user_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_password`, `start_time`, `end_time`, `user_name`) VALUES
(1, 'some@gmail.com', 'pass', '02:22:00', '14:03:00', 'adarsh'),
(2, 'homesalon@gmail.com', '1234', '02:22:00', '14:03:00', 'adarsh'),
(3, 'some@gmail.com', '1234', '00:00:00', '15:03:00', 'adarsh'),
(4, 'dwd@gmail.com', '1234', '00:00:00', '00:00:00', 'adarsh'),
(5, 'dede@fdf.com', '123', '00:00:00', '00:00:00', 'adarsh'),
(6, 'a@gmail.com', '123', '00:00:00', '00:00:00', 'adarsh'),
(7, 'b@gmail.com', '123', '08:00:00', '16:00:00', 'adarsh'),
(9, 'd@gmail.com', 'wdwdwed', '09:00:00', '18:00:00', 'Ramu'),
(10, 'test@test.com', 'test', '09:00:00', '17:00:00', 'Test  master'),
(11, 'f@gmail.com', '123', '09:00:00', '22:00:00', 'f F'),
(12, 'iamafjalkhan@gmail.com', 'Bc15/18081', '15:00:00', '17:00:00', 'Afjal khan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avialable_day`
--
ALTER TABLE `avialable_day`
  ADD PRIMARY KEY (`av_id`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meeting_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avialable_day`
--
ALTER TABLE `avialable_day`
  MODIFY `av_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `meetings`
--
ALTER TABLE `meetings`
  MODIFY `meeting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
