-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2016 at 08:49 PM
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
  `comply` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `num_reply` int(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`post_id`, `comment_id`, `details`, `comply`, `datetime`, `num_reply`) VALUES
(1, 1, 'test comments', 'ความคิดเห็นที่ 1', '2016-03-25 15:10:55', 0),
(1, 2, 'test comments', 'ความคิดเห็นที่ 2', '2016-03-25 15:10:55', 0),
(1, 3, 'test comments', 'ความคิดเห็นที่ 3', '2016-03-25 15:10:55', 0),
(2, 4, 'test comments', 'ความคิดเห็นที่ 1', '2016-03-25 15:10:55', 0),
(2, 5, 'test comments', 'ความคิดเห็นที่ 2', '2016-03-25 15:10:55', 0),
(3, 6, 'test comments', 'ความคิดเห็นที่ 1', '2016-03-25 15:10:55', 0),
(3, 7, 'test comments', 'ความคิดเห็นที่ 2', '2016-03-25 15:10:55', 0),
(3, 8, 'test comments', 'ความคิดเห็นที่ 3', '2016-03-25 15:10:55', 0),
(3, 9, 'test comments', 'ความคิดเห็นที่ 4', '2016-03-25 15:10:55', 0),
(3, 10, 'test comments', 'ความคิดเห็นที่ 5', '2016-03-25 15:10:55', 0),
(4, 11, 'test comments', 'ความคิดเห็นที่ 1', '2016-03-25 15:10:55', 0),
(4, 12, 'test comments', 'ความคิดเห็นที่ 2', '2016-03-25 15:10:55', 0),
(5, 13, 'test comments', 'ความคิดเห็นที่ 1', '2016-03-25 15:10:55', 0),
(5, 14, 'test comments', 'ความคิดเห็นที่ 2', '2016-03-25 15:10:55', 0),
(1, 16, 'test reply 1', 'ตอบกลับ 2', '2016-03-25 15:22:23', 0),
(1, 17, 'test reply 1', 'ตอบกลับ 3', '2016-03-25 15:22:23', 0),
(1, 18, 'test reply 2', 'ตอบกลับ 1', '2016-03-25 15:23:03', 0),
(1, 19, 'test reply 2', 'ตอบกลับ 2', '2016-03-25 15:23:03', 0);

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
  `time` datetime NOT NULL,
  `comment` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `title`, `details`, `picture`, `time`, `comment`) VALUES
(1, 'name 1', 'title 1', 'details 1', 'picture 1', '2016-03-25 15:05:58', 3),
(2, 'name 2', 'title 2', 'details 2', 'picture 2', '2016-03-25 15:05:58', 2),
(3, 'name 3', 'title 3', 'details 3', 'picture 3', '2016-03-25 15:05:58', 5),
(4, 'name 4', 'title 4', 'details 4', 'picture 4', '2016-03-25 15:05:58', 2),
(5, 'name 5', 'title 5', 'details 5', 'picture 5', '2016-03-25 15:05:58', 2);

-- --------------------------------------------------------

--
-- Table structure for table `replys`
--

CREATE TABLE `replys` (
  `comment_id` int(5) UNSIGNED NOT NULL,
  `reply_id` int(3) UNSIGNED NOT NULL,
  `reply` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  MODIFY `comment_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `replys`
--
ALTER TABLE `replys`
  MODIFY `reply_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
