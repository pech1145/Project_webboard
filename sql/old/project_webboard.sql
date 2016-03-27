-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2016 at 11:34 AM
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
  `id` int(5) UNSIGNED NOT NULL,
  `post_id` int(5) NOT NULL DEFAULT '0',
  `comment_id` int(5) NOT NULL DEFAULT '0',
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `comply` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `comment_id`, `details`, `comply`, `time`) VALUES
(1, 1, 0, 'test comments', 'ความคิดเห็นที่ 1', '2016-03-25 15:10:55'),
(2, 1, 0, 'test comments', 'ความคิดเห็นที่ 2', '2016-03-25 15:10:55'),
(3, 1, 0, 'test comments', 'ความคิดเห็นที่ 3', '2016-03-25 15:10:55'),
(4, 2, 0, 'test comments', 'ความคิดเห็นที่ 1', '2016-03-25 15:10:55'),
(5, 2, 0, 'test comments', 'ความคิดเห็นที่ 2', '2016-03-25 15:10:55'),
(6, 3, 0, 'test comments', 'ความคิดเห็นที่ 1', '2016-03-25 15:10:55'),
(7, 3, 0, 'test comments', 'ความคิดเห็นที่ 2', '2016-03-25 15:10:55'),
(8, 3, 0, 'test comments', 'ความคิดเห็นที่ 3', '2016-03-25 15:10:55'),
(9, 3, 0, 'test comments', 'ความคิดเห็นที่ 4', '2016-03-25 15:10:55'),
(10, 3, 0, 'test comments', 'ความคิดเห็นที่ 5', '2016-03-25 15:10:55'),
(11, 4, 0, 'test comments', 'ความคิดเห็นที่ 1', '2016-03-25 15:10:55'),
(12, 4, 0, 'test comments', 'ความคิดเห็นที่ 2', '2016-03-25 15:10:55'),
(13, 5, 0, 'test comments', 'ความคิดเห็นที่ 1', '2016-03-25 15:10:55'),
(14, 5, 0, 'test comments', 'ความคิดเห็นที่ 2', '2016-03-25 15:10:55'),
(15, 1, 1, 'test reply 1', 'ตอบกลับ 1', '2016-03-25 15:21:50'),
(16, 1, 1, 'test reply 1', 'ตอบกลับ 2', '2016-03-25 15:22:23'),
(17, 1, 1, 'test reply 1', 'ตอบกลับ 3', '2016-03-25 15:22:23'),
(18, 1, 2, 'test reply 2', 'ตอบกลับ 1', '2016-03-25 15:23:03'),
(19, 1, 2, 'test reply 2', 'ตอบกลับ 2', '2016-03-25 15:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `comment_reply`
--

CREATE TABLE `comment_reply` (
  `comment_id` int(5) UNSIGNED NOT NULL,
  `reply_num` int(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment_reply`
--

INSERT INTO `comment_reply` (`comment_id`, `reply_num`) VALUES
(1, 3),
(2, 2),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 0),
(12, 0),
(13, 0),
(14, 0);

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_reply`
--
ALTER TABLE `comment_reply`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
