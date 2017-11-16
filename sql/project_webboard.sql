-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2017 at 06:24 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
(27, 'tis', 'hahaha', '<p>1234567890aslfgh</p>\r\n', '20171116-160017-Lighthouse.jpg', '2017-11-16 22:00:17', 0),
(28, 'MMMMM', 'ABCDEFGH', '<p><em>123456789</em></p>\r\n', '20171116-165507-Jellyfish.jpg', '2017-11-16 22:55:07', 0),
(29, 'sdfdsfdsf', '12345ifdgtsdgfdfgadsf', '<p>hay&nbsp;</p>\r\n', '20171116-165818-Jellyfish.jpg', '2017-11-16 22:58:18', 0),
(31, 'hay', 'haha', '<p>123</p>\r\n', '20171116-172037-Chrysanthemum.jpg', '2017-11-16 23:20:37', 0),
(32, '456456456', '456456456', '<p>456</p>\r\n', '20171116-172238-Jellyfish.jpg', '2017-11-16 23:22:38', 0),
(33, '456456456', '456456456', '<p>456</p>\r\n', '20171116-172539-Jellyfish.jpg', '2017-11-16 23:25:39', 0),
(34, '456456456', '456456456', '<p>456</p>\r\n', '20171116-172611-Jellyfish.jpg', '2017-11-16 23:26:11', 0),
(35, '456456456', '456456456', '<p>456</p>\r\n', '20171116-172656-Jellyfish.jpg', '2017-11-16 23:26:56', 0),
(36, '456456456', '456456456', '<p>456</p>\r\n', '20171116-172735-Jellyfish.jpg', '2017-11-16 23:27:35', 0),
(37, '456456456', '456456456', '<p>456</p>\r\n', '20171116-172804-Jellyfish.jpg', '2017-11-16 23:28:04', 0),
(38, 'aaaaaaaa', 'bbbbbbbbbbbbbbbbbb', '<p>abababababa</p>\r\n', '20171116-180651-38.jpg', '2017-11-17 00:06:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `id` int(5) UNSIGNED NOT NULL,
  `post_id` int(5) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`id`, `post_id`, `image`) VALUES
(2, 36, '20171116-172735-Penguins.jpg'),
(3, 37, '20171116-172804-Penguins.jpg'),
(4, 38, '20171116-180625-Chrysanthemum.jpg'),
(5, 38, '20171116-180625-Desert.jpg'),
(6, 38, '20171116-180625-Hydrangeas.jpg'),
(7, 38, '20171116-180625-Jellyfish.jpg'),
(8, 38, '20171116-180625-Koala.jpg'),
(9, 38, '20171116-180625-Lighthouse.jpg'),
(10, 38, '20171116-180625-Penguins.jpg'),
(11, 38, '20171116-180625-Tulips.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `post_id` int(3) UNSIGNED NOT NULL,
  `comment_id` int(5) UNSIGNED NOT NULL,
  `reply_id` int(5) UNSIGNED NOT NULL,
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
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`reply_id`,`comment_id`,`post_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `reply_ibfk_2` (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `reply_id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
