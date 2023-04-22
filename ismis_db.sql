-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Generation Time: Mar 23, 2020 at 08:26 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10
=======
-- Generation Time: Mar 23, 2020 at 09:41 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2
>>>>>>> e727b01c4a81fcd9cb05dfece108f72575dd3152

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ismis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrollees`
--

CREATE TABLE `enrollees` (
  `id` int(11) NOT NULL,
  `stud_id` int(5) NOT NULL,
  `sched_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollees`
--

INSERT INTO `enrollees` (`id`, `stud_id`, `sched_id`) VALUES
<<<<<<< HEAD
(28, 123, 52),
(29, 18101346, 52),
(30, 123, 62);
=======
(80, 18101346, 94),
(84, 18101346, 97),
(120, 123, 83),
(158, 123, 94),
(159, 123, 97),
(160, 123, 93);
>>>>>>> e727b01c4a81fcd9cb05dfece108f72575dd3152

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `enrollees` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `day`, `time_start`, `time_end`, `faculty_id`, `course_id`, `enrollees`) VALUES
<<<<<<< HEAD
(52, 'Monday', '07:30:00', '09:00:00', 8, 19, 2),
(59, 'Monday', '10:30:00', '12:00:00', 8, 19, 0),
(60, 'Monday', '13:30:00', '15:00:00', 8, 19, 0),
(62, 'Tuesday', '07:30:00', '10:30:00', 8, 20, 2);
=======
(83, 'Monday', '07:30:00', '09:00:00', 8, 29, 1),
(93, 'Tuesday', '07:03:00', '17:00:00', 8, 38, 1),
(94, 'Monday', '15:00:00', '17:00:00', 8, 39, 2),
(97, 'Monday', '10:30:00', '12:00:00', 8, 41, 2),
(98, 'Monday', '07:30:00', '09:00:00', 12, 38, 0),
(101, 'Monday', '10:30:00', '12:00:00', 12, 44, 1);
>>>>>>> e727b01c4a81fcd9cb05dfece108f72575dd3152

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `units` int(11) NOT NULL,
  `max` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `course_code`, `course_name`, `units`, `max`) VALUES
<<<<<<< HEAD
(19, 'CIS 11012', 'An Introduction to Computing', 3, 40),
(20, 'CIS 1204', 'Information Management', 3, 5);
=======
(29, 'CIS 11012', 'An Introduction to Computing', 3, 2),
(38, 'CIS 1101', 'Web Development 1', 2, 2),
(39, 'CIS 2202', 'Digital Logistics in the Modern World', 3, 2),
(41, 'CIS 2102', 'Web Development 2', 3, 2),
(44, 'ds', 'ds', 2, 1);
>>>>>>> e727b01c4a81fcd9cb05dfece108f72575dd3152

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_num` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_num`, `name`, `type`, `password`) VALUES
(8, 18102933, 'Monica Claire Apor', 'Faculty', '21d740e6dba076b41e0b467dd6f6b639'),
(9, 123, 'Beauty Van Blouse', 'Student', '202cb962ac59075b964b07152d234b70'),
(10, 1234, 'Floral Dress', 'Student', '81dc9bdb52d04dc20036dbd8313ed055'),
(11, 18101346, 'Amber Mariscal', 'Student', '7a9c617764043be823db765654c1cf0a'),
(12, 101, 'Jet Gm', 'Faculty', '564f60a2dd82ea24bfa3f2f615348f7c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrollees`
--
ALTER TABLE `enrollees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrollees`
--
ALTER TABLE `enrollees`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
>>>>>>> e727b01c4a81fcd9cb05dfece108f72575dd3152

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
>>>>>>> e727b01c4a81fcd9cb05dfece108f72575dd3152

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
>>>>>>> e727b01c4a81fcd9cb05dfece108f72575dd3152

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
