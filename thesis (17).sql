-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2019 at 08:43 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thesis`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `a_username` varchar(100) NOT NULL,
  `a_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `a_username`, `a_password`) VALUES
(1, 'admin1', '$2y$10$wjd9h1zSW/W9ogYmMPtw7OjysFRNYH1j6RCdfTZdtwvYiVp1e.3PK');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `events_title` text NOT NULL,
  `events_post` text,
  `events_thumbnail` varchar(100) NOT NULL,
  `events_postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `events_title`, `events_post`, `events_thumbnail`, `events_postdate`) VALUES
(6, '123', '<p>123</p>\r\n', 'ElY9BGka2yhAn3O7tKCcNr8RedVMzi', '2019-02-09 10:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `gapan_post`
--

CREATE TABLE `gapan_post` (
  `id` int(11) NOT NULL,
  `post` text,
  `post_photo` varchar(256) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gapan_post`
--

INSERT INTO `gapan_post` (`id`, `post`, `post_photo`, `post_date`) VALUES
(1, '12345', 'HBwzXq57rJOSu6aQ0PsDxck4Efe3AM', '2019-02-09 10:40:26'),
(2, 'q', '', '2019-02-10 05:54:19'),
(3, 'qw', '', '2019-02-10 05:54:26'),
(4, 'qwe', '', '2019-02-10 05:54:30'),
(5, 'qwerty', '', '2019-02-10 05:54:37'),
(6, 'q werty', '', '2019-02-10 05:54:49'),
(7, 'qwe qwe ', '', '2019-02-10 05:55:06'),
(8, 'qweasdxzc', '', '2019-02-10 05:56:09'),
(9, 'qwe', '', '2019-02-10 05:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `news_title` text NOT NULL,
  `news_post` text,
  `news_thumbnail` varchar(100) NOT NULL,
  `news_postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_title`, `news_post`, `news_thumbnail`, `news_postdate`) VALUES
(18, '5', '<p>5</p>\r\n', 'neQJr5boZGgqLmpT9MtiI43APFSucE', '2019-02-09 10:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `b_username` varchar(50) NOT NULL,
  `b_type` varchar(100) NOT NULL,
  `b_profile` varchar(100) NOT NULL,
  `b_address` varchar(100) NOT NULL,
  `b_contact` bigint(20) NOT NULL,
  `b_email` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `b_account_verified` int(5) NOT NULL DEFAULT '0',
  `b_report` int(11) NOT NULL DEFAULT '0',
  `b_rating` int(11) NOT NULL DEFAULT '0',
  `b_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `b_name`, `b_username`, `b_type`, `b_profile`, `b_address`, `b_contact`, `b_email`, `user_id`, `b_account_verified`, `b_report`, `b_rating`, `b_created_at`) VALUES
(1, 'QWE', 'asdasd', 'Food Stall/Food Stand/Food Booth', 'qCFJveVUoSux7205TdIX6HDZYyR8WN', 'asdasd,asdads, San Nicolas', 123123123, '', 8, 1, 2, 0, '2018-12-06 11:16:52'),
(5, 'Store2', 'store2', 'Clinic', 'default', '321, eqw, San Vicente', 123123123, '', 8, 1, 3, 0, '2018-12-09 09:15:59'),
(11, 'qwe', 'zxczxc', 'Grocery Store', 'default', '123, asdasd, San Roque', 123123123, '', 17, 1, 0, 0, '2019-01-21 10:12:23'),
(12, 'Asdf', 'asd123', 'Hardware Store', 'default', '132, sadasd', 123123123132, '', 17, 1, 0, 0, '2019-02-06 10:01:07');

-- --------------------------------------------------------

--
-- Table structure for table `store_follow`
--

CREATE TABLE `store_follow` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `follow_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_notification`
--

CREATE TABLE `store_notification` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `b_notif_from` varchar(50) NOT NULL DEFAULT 'admin',
  `b_from_id` int(11) DEFAULT NULL,
  `b_stat` int(5) NOT NULL DEFAULT '0',
  `b_notif_type` varchar(100) NOT NULL DEFAULT 'post',
  `b_link` varchar(100) DEFAULT NULL,
  `b_link_id` int(11) DEFAULT NULL,
  `b_notif_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_notification`
--

INSERT INTO `store_notification` (`id`, `store_id`, `b_notif_from`, `b_from_id`, `b_stat`, `b_notif_type`, `b_link`, `b_link_id`, `b_notif_date`) VALUES
(5, 11, 'user', 17, 1, 'comment', 'post', 1, '2019-02-08 09:22:41'),
(6, 11, 'user', 17, 1, 'comment', 'post', 1, '2019-02-08 09:24:46'),
(7, 11, 'user', 17, 1, 'comment', 'post', 0, '2019-02-08 09:24:58');

-- --------------------------------------------------------

--
-- Table structure for table `store_post`
--

CREATE TABLE `store_post` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `b_post` text NOT NULL,
  `b_postprice` int(11) NOT NULL,
  `b_postverified` int(5) NOT NULL DEFAULT '0',
  `b_postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_post`
--

INSERT INTO `store_post` (`id`, `store_id`, `b_post`, `b_postprice`, `b_postverified`, `b_postdate`) VALUES
(13, 11, '1', 123, 1, '2019-02-11 07:28:43'),
(15, 11, 'qqqq', 1111, 1, '2019-02-11 07:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `store_post_comments`
--

CREATE TABLE `store_post_comments` (
  `id` int(11) NOT NULL,
  `store_post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `b_comment` text,
  `b_commentphoto` varchar(100) DEFAULT NULL,
  `b_commentdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_post_photos`
--

CREATE TABLE `store_post_photos` (
  `id` int(11) NOT NULL,
  `store_post_id` int(11) NOT NULL,
  `b_postphoto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_post_photos`
--

INSERT INTO `store_post_photos` (`id`, `store_post_id`, `b_postphoto`) VALUES
(19, 14, 'bZeQRANthUqcXd7g9JHYmj1sfCBGxa');

-- --------------------------------------------------------

--
-- Table structure for table `store_products`
--

CREATE TABLE `store_products` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_name` varchar(256) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_photo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_products`
--

INSERT INTO `store_products` (`id`, `store_id`, `product_name`, `product_price`, `product_qty`, `product_photo`) VALUES
(23, 11, 'product 1', 1132, 123, '3iPqnzA2mfkwNYGEIy4DRMjprtWUKQ'),
(24, 11, 'Product 2', 123, 123, 'fCoru3hswQSj69MLU1VEKAkambxpGP');

-- --------------------------------------------------------

--
-- Table structure for table `store_product_rate`
--

CREATE TABLE `store_product_rate` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_product_rate`
--

INSERT INTO `store_product_rate` (`id`, `product_id`, `user_id`, `product_rate`) VALUES
(5, 23, 17, 3),
(7, 24, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_rate`
--

CREATE TABLE `store_rate` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `b_rate` int(5) NOT NULL,
  `b_review` text,
  `b_ratedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_rate`
--

INSERT INTO `store_rate` (`id`, `store_id`, `user_id`, `b_rate`, `b_review`, `b_ratedate`) VALUES
(2, 5, 18, 5, 'new review', '2019-02-01 03:35:15'),
(3, 5, 17, 4, 'zxc', '2019-02-01 04:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `store_reply`
--

CREATE TABLE `store_reply` (
  `id` int(11) NOT NULL,
  `store_comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `b_reply` text,
  `b_replyphoto` varchar(256) DEFAULT NULL,
  `b_replydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_report`
--

CREATE TABLE `store_report` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `token` varchar(100) DEFAULT NULL,
  `email_verified` int(5) NOT NULL DEFAULT '0',
  `account_verified` int(5) NOT NULL DEFAULT '0',
  `report` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `joined_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `username`, `password`, `email`, `contact`, `gender`, `profile`, `token`, `email_verified`, `account_verified`, `report`, `created_at`, `joined_at`) VALUES
(17, 'Reymark', 'Cuevo', 'reymark', '$2y$10$yVTiZB5NFK/pO9QKYsDig./MRzngWt4SNWZYDLVmzW8z3IdN8mB.C', 'reymarkcuevo1@gmail.com', 123123123, 'male', 'GXoYPMbuzeBrFVjfCEc1A24ag0wlOs', 'B3jAv7fdPRiNX4MGogrxynEkSZc1CI', 1, 1, 0, '2018-12-15 07:18:37', '2019-01-18 10:16:36'),
(18, 'Qwe', 'Qwe', 'qweqwe', '$2y$10$hnJpUtq0S9DvvYmBmBu4EuyjtkGi20CEMMgYGH41o2yfTFxeoDlsW', 'reymarkcuevo1@gmail.com', 123123123, 'male', 'fnPyQwCiqsYS3eL0UNvMgXBDOldxFE', 'IW5negmp18VtaEqMijBlRACvb3JHdF', 1, 1, 0, '2018-12-30 07:41:37', '2018-12-30 07:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_notification`
--

CREATE TABLE `user_notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notif_from` varchar(50) NOT NULL DEFAULT 'admin',
  `from_id` int(11) DEFAULT NULL,
  `stat` int(5) NOT NULL DEFAULT '0',
  `notif_type` varchar(100) NOT NULL DEFAULT 'post',
  `link` varchar(256) DEFAULT NULL,
  `link_id` int(11) DEFAULT NULL,
  `notif_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_notification`
--

INSERT INTO `user_notification` (`id`, `user_id`, `notif_from`, `from_id`, `stat`, `notif_type`, `link`, `link_id`, `notif_date`) VALUES
(1, 17, 'admin', NULL, 1, 'post', 'news', 4, '2019-02-08 07:01:31'),
(2, 18, 'admin', NULL, 1, 'post', 'news', 4, '2019-02-08 07:01:31'),
(3, 17, 'admin', NULL, 1, 'post', 'news', 5, '2019-02-08 07:11:10'),
(4, 18, 'admin', NULL, 0, 'post', 'news', 5, '2019-02-08 07:11:10'),
(5, 17, 'admin', NULL, 1, 'post', 'news', 6, '2019-02-08 07:21:40'),
(6, 18, 'admin', NULL, 0, 'post', 'news', 6, '2019-02-08 07:21:40'),
(7, 17, 'admin', NULL, 1, 'post', 'news', 7, '2019-02-08 07:26:21'),
(8, 18, 'admin', NULL, 0, 'post', 'news', 7, '2019-02-08 07:26:21'),
(9, 17, 'admin', NULL, 1, 'post', 'event', 4, '2019-02-08 07:34:26'),
(10, 18, 'admin', NULL, 0, 'post', 'event', 4, '2019-02-08 07:34:26'),
(11, 17, 'admin', NULL, 1, 'post', 'news', 8, '2019-02-08 08:04:27'),
(12, 18, 'admin', NULL, 0, 'post', 'news', 8, '2019-02-08 08:04:27'),
(13, 17, 'store', 11, 1, 'comment', 'post', 1, '2019-02-08 09:29:40'),
(14, 17, 'admin', NULL, 1, 'post', 'news', 9, '2019-02-08 11:50:28'),
(15, 18, 'admin', NULL, 0, 'post', 'news', 9, '2019-02-08 11:50:28'),
(16, 17, 'admin', NULL, 1, 'post', 'event', 5, '2019-02-08 11:52:35'),
(17, 18, 'admin', NULL, 0, 'post', 'event', 5, '2019-02-08 11:52:35'),
(18, 17, 'admin', NULL, 1, 'post', 'news', 10, '2019-02-09 06:29:33'),
(19, 18, 'admin', NULL, 0, 'post', 'news', 10, '2019-02-09 06:29:33'),
(20, 17, 'admin', NULL, 1, 'post', 'news', 11, '2019-02-09 06:30:55'),
(21, 18, 'admin', NULL, 0, 'post', 'news', 11, '2019-02-09 06:30:55'),
(22, 17, 'admin', NULL, 1, 'post', 'news', 12, '2019-02-09 06:41:21'),
(23, 18, 'admin', NULL, 0, 'post', 'news', 12, '2019-02-09 06:41:22'),
(24, 17, 'admin', NULL, 1, 'post', 'news', 13, '2019-02-09 06:41:37'),
(25, 18, 'admin', NULL, 0, 'post', 'news', 13, '2019-02-09 06:41:37'),
(26, 17, 'admin', NULL, 1, 'post', 'news', 14, '2019-02-09 09:08:29'),
(27, 18, 'admin', NULL, 0, 'post', 'news', 14, '2019-02-09 09:08:29'),
(28, 17, 'admin', NULL, 1, 'post', 'news', 15, '2019-02-09 09:09:15'),
(29, 18, 'admin', NULL, 0, 'post', 'news', 15, '2019-02-09 09:09:15'),
(30, 17, 'admin', NULL, 1, 'post', 'news', 16, '2019-02-09 09:43:38'),
(31, 18, 'admin', NULL, 0, 'post', 'news', 16, '2019-02-09 09:43:39'),
(32, 17, 'admin', NULL, 1, 'post', 'news', 17, '2019-02-09 09:54:44'),
(33, 18, 'admin', NULL, 0, 'post', 'news', 17, '2019-02-09 09:54:44'),
(34, 17, 'admin', NULL, 1, 'post', 'news', 18, '2019-02-09 10:09:42'),
(35, 18, 'admin', NULL, 0, 'post', 'news', 18, '2019-02-09 10:09:42'),
(36, 17, 'admin', NULL, 1, 'post', 'event', 6, '2019-02-09 10:31:25'),
(37, 18, 'admin', NULL, 0, 'post', 'event', 6, '2019-02-09 10:31:25'),
(38, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-02-09 10:40:26'),
(39, 18, 'admin', NULL, 0, 'post', 'GapanCity', NULL, '2019-02-09 10:40:26'),
(40, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-02-10 05:54:20'),
(41, 18, 'admin', NULL, 0, 'post', 'GapanCity', NULL, '2019-02-10 05:54:21'),
(42, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-02-10 05:54:26'),
(43, 18, 'admin', NULL, 0, 'post', 'GapanCity', NULL, '2019-02-10 05:54:26'),
(44, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-02-10 05:54:30'),
(45, 18, 'admin', NULL, 0, 'post', 'GapanCity', NULL, '2019-02-10 05:54:30'),
(46, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-02-10 05:54:37'),
(47, 18, 'admin', NULL, 0, 'post', 'GapanCity', NULL, '2019-02-10 05:54:38'),
(48, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-02-10 05:54:49'),
(49, 18, 'admin', NULL, 0, 'post', 'GapanCity', NULL, '2019-02-10 05:54:50'),
(50, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-02-10 05:55:06'),
(51, 18, 'admin', NULL, 0, 'post', 'GapanCity', NULL, '2019-02-10 05:55:06'),
(52, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-02-10 05:56:09'),
(53, 18, 'admin', NULL, 0, 'post', 'GapanCity', NULL, '2019-02-10 05:56:09'),
(54, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-02-10 05:56:13'),
(55, 18, 'admin', NULL, 0, 'post', 'GapanCity', NULL, '2019-02-10 05:56:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE `user_post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `u_post` text NOT NULL,
  `u_postprice` int(11) NOT NULL,
  `u_postverified` int(5) NOT NULL DEFAULT '0',
  `u_postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`id`, `user_id`, `u_post`, `u_postprice`, `u_postverified`, `u_postdate`) VALUES
(4, 17, '1', 1, 1, '2019-02-10 11:13:31'),
(5, 17, '2', 2, 0, '2019-02-10 10:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_post_comments`
--

CREATE TABLE `user_post_comments` (
  `id` int(11) NOT NULL,
  `user_post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `u_comment` text,
  `u_commentphoto` varchar(100) DEFAULT NULL,
  `u_commentdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_post_comments`
--

INSERT INTO `user_post_comments` (`id`, `user_post_id`, `user_id`, `store_id`, `u_comment`, `u_commentphoto`, `u_commentdate`) VALUES
(1, 1, NULL, 11, '1', NULL, '2019-02-08 09:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_post_photos`
--

CREATE TABLE `user_post_photos` (
  `id` int(11) NOT NULL,
  `user_post_id` int(11) NOT NULL,
  `u_postphoto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_post_photos`
--

INSERT INTO `user_post_photos` (`id`, `user_post_id`, `u_postphoto`) VALUES
(1, 5, 'HTC7QAfknav3oVeFcu8YLy6tp1DzKx'),
(2, 5, 'mMJXO682zuqLiecIPng1YDrahjx3NR'),
(3, 5, 'WY4dUreOCsEXQgnjqD5THcl0Kmfb62'),
(4, 5, 'rvTQh7VyceubPYknM08opUjHJmBt9L'),
(5, 5, 'jhyAm0BsrHDMdWPt5n47Zfi9FbNlOT');

-- --------------------------------------------------------

--
-- Table structure for table `user_reply`
--

CREATE TABLE `user_reply` (
  `id` int(11) NOT NULL,
  `user_comment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `u_reply` text,
  `u_replyphoto` varchar(256) DEFAULT NULL,
  `u_replydate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_report`
--

CREATE TABLE `user_report` (
  `id` int(11) NOT NULL,
  `reported_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `events` ADD FULLTEXT KEY `events_title` (`events_title`,`events_post`);

--
-- Indexes for table `gapan_post`
--
ALTER TABLE `gapan_post`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `gapan_post` ADD FULLTEXT KEY `post` (`post`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `news` ADD FULLTEXT KEY `news_title` (`news_title`,`news_post`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `stores` ADD FULLTEXT KEY `b_name` (`b_name`,`b_username`);

--
-- Indexes for table `store_follow`
--
ALTER TABLE `store_follow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_notification`
--
ALTER TABLE `store_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_post`
--
ALTER TABLE `store_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_post_comments`
--
ALTER TABLE `store_post_comments`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `store_post_comments` ADD FULLTEXT KEY `b_comment` (`b_comment`);

--
-- Indexes for table `store_post_photos`
--
ALTER TABLE `store_post_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_products`
--
ALTER TABLE `store_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_product_rate`
--
ALTER TABLE `store_product_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_rate`
--
ALTER TABLE `store_rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_reply`
--
ALTER TABLE `store_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_report`
--
ALTER TABLE `store_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `users` ADD FULLTEXT KEY `fname` (`fname`,`lname`,`username`);

--
-- Indexes for table `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_post`
--
ALTER TABLE `user_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_post_comments`
--
ALTER TABLE `user_post_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_post_photos`
--
ALTER TABLE `user_post_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_reply`
--
ALTER TABLE `user_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_report`
--
ALTER TABLE `user_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gapan_post`
--
ALTER TABLE `gapan_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `store_follow`
--
ALTER TABLE `store_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_notification`
--
ALTER TABLE `store_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `store_post`
--
ALTER TABLE `store_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `store_post_comments`
--
ALTER TABLE `store_post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_post_photos`
--
ALTER TABLE `store_post_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `store_products`
--
ALTER TABLE `store_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `store_product_rate`
--
ALTER TABLE `store_product_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `store_rate`
--
ALTER TABLE `store_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_reply`
--
ALTER TABLE `store_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_report`
--
ALTER TABLE `store_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `user_post`
--
ALTER TABLE `user_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_post_comments`
--
ALTER TABLE `user_post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_post_photos`
--
ALTER TABLE `user_post_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_reply`
--
ALTER TABLE `user_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_report`
--
ALTER TABLE `user_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
