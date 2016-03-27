-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2016 at 03:56 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_webboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `post_id` int(5) UNSIGNED NOT NULL DEFAULT '0',
  `comment_id` int(5) UNSIGNED NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `num_reply` int(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`post_id`, `comment_id`, `details`, `datetime`, `num_reply`) VALUES
(14, 1, '23456', '2016-03-27 20:47:23', 3),
(14, 2, '12', '2016-03-27 20:49:29', 0),
(2, 3, 'sdfsdfsd fsdf 555555555555555', '2016-03-27 19:50:18', 4),
(2, 6, 'sdfsd', '2016-03-27 20:28:20', 6),
(3, 6, 'test comments', '2016-03-25 15:10:55', 0),
(3, 7, 'test comments', '2016-03-25 15:10:55', 0),
(2, 8, '1234567i', '2016-03-27 20:32:04', 2),
(3, 8, 'test comments', '2016-03-25 15:10:55', 0),
(2, 9, '45454545', '2016-03-27 20:34:45', 1),
(3, 9, 'test comments', '2016-03-25 15:10:55', 0),
(2, 10, 'sdfsdf sdfsdfsdf fsd', '2016-03-27 20:35:11', 3),
(3, 10, 'test comments', '2016-03-25 15:10:55', 0),
(4, 11, 'test comments', '2016-03-25 15:10:55', 0),
(4, 12, 'test comments', '2016-03-25 15:10:55', 0),
(5, 13, 'test comments', '2016-03-25 15:10:55', 0),
(5, 14, 'test comments', '2016-03-25 15:10:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(5) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `num_comment` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `title`, `details`, `picture`, `datetime`, `num_comment`) VALUES
(2, 'name 2', 'title 2', '<p>details 2</p>\r\n', '20160327-153621-2.jpg', '2016-03-27 20:36:22', 10),
(3, 'name 3', 'title 3', 'details 3', 'picture 3', '2016-03-25 15:05:58', 0),
(4, 'name 4', 'title 4', 'details 4', 'picture 4', '2016-03-25 15:05:58', 0),
(5, 'name 5', 'title 5', 'details 5', 'picture 5', '2016-03-25 15:05:58', 0),
(9, 'ชื่อผู้ตั้งกระทู้', 'หัวกระทู้', '<p>1234567890-</p>\r\n', '20160326-213404-.jpg', '2016-03-27 03:34:04', 0),
(10, 'ชื่อผู้ตั้งกระทู้', 'หัวกระทู้', '<p>1234567890-</p>\r\n', '20160326-213519-product_orders.png', '2016-03-27 03:35:19', 0),
(11, 'ชื่อผู้ตั้งกระทู้', 'หัวกระทู้', '<p>1234567890-</p>\r\n', '20160326-221755-11.jpg', '2016-03-27 04:17:55', 0),
(14, 'ชื่อผู้ตั้งกระทู้', 'หัวกระทู้', '<p>1234567890-</p>\r\n', '20160326-221720-14.jpg', '2016-03-27 04:17:20', 2);

-- --------------------------------------------------------

--
-- Table structure for table `replys`
--

CREATE TABLE `replys` (
  `comment_id` int(5) UNSIGNED NOT NULL,
  `reply_id` int(3) UNSIGNED NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `replys`
--

INSERT INTO `replys` (`comment_id`, `reply_id`, `details`, `datetime`) VALUES
(1, 1, '34343434343434', '2016-03-27 20:37:43'),
(3, 1, 'werwer', '2016-03-27 19:49:43'),
(8, 1, '', '2016-03-27 20:32:39'),
(9, 1, 'dsfsdfsdf', '2016-03-27 20:34:54'),
(10, 1, '', '2016-03-27 20:35:14'),
(1, 2, '', '2016-03-27 20:37:46'),
(3, 2, 'wrwerwerewr', '2016-03-27 19:49:48'),
(8, 2, '', '2016-03-27 20:32:45'),
(10, 2, '', '2016-03-27 20:35:16'),
(1, 3, '4', '2016-03-27 20:45:05'),
(3, 3, 'sdfsdfsdf', '2016-03-27 19:49:53'),
(10, 3, '', '2016-03-27 20:35:18'),
(3, 4, '4564678i87oiuoij', '2016-03-27 20:31:54'),
(6, 6, '', '2016-03-27 20:32:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`,`post_id`),
  ADD KEY `comments_ibfk_1` (`post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replys`
--
ALTER TABLE `replys`
  ADD PRIMARY KEY (`reply_id`,`comment_id`),
  ADD KEY `replys_ibfk_1` (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replys`
--
ALTER TABLE `replys`
  ADD CONSTRAINT `replys_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
