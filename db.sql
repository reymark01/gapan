-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2019 at 06:52 AM
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
(1, 'Event 1', '<p>event 1 qweqwe asd asd e qwe qw&nbsp; d asdasdsad asd&nbsp; we qw e asd asd&nbsp;&nbsp;</p>\r\n', '0OC6bWlAPLx5JMaQjYndiuz2FsqoyT', '2018-12-16 08:14:00'),
(2, 'Event 2', '<p>qwewqewqewqewqe qwe qw q qeqweqewqwe qwe qwe&nbsp;qewwe</p>\r\n', 'EpvmYLgSeUajiyFM7rbqVAQkRoBO9W', '2018-12-16 10:51:38'),
(3, 'Event 3', '<p>qw q qwe qwewqe qwewqe&nbsp;qew&nbsp;qqqwewe qweqwe qwewqe qw q qeww qwe qweqwe qwe qv qqwqe</p>\r\n', 'VrkzStOpc014gJwdeLa7UT3PBW9y5X', '2018-12-16 10:52:31'),
(4, 'Event 4', '<p>weqewqew qwe qwe q&nbsp; qe qe qw e we qew qeqw ewq e weq we&nbsp;</p>\r\n', 'default', '2018-12-16 10:57:27'),
(6, 'qwerty', '<p>dsasdasd</p>\r\n', 'iCxKNJ3LWVcZ2u714ltYP50ya9n8QR', '2018-12-29 07:07:07'),
(7, 'asdf', '<p>qweqwqwdasdasd asdasd&nbsp;</p>\r\n', '1JZMT237GuV5HDkrtFNnd0IQohOgiP', '2018-12-29 10:11:31'),
(8, 'qeqwe', '<p>weqweqweqeewqw qewqwe</p>\r\n', 'default', '2018-12-30 07:49:38'),
(9, 'new post', '<p>asdadsasd adsads adsasd</p>\r\n', 'default', '2018-12-30 08:38:35'),
(10, 'qweweasd', '<p>asdasdasd asdasd</p>\r\n', 'default', '2018-12-31 03:21:05'),
(11, 'asdasd', '<p>asdasdads aasdasd</p>\r\n', 'default', '2018-12-31 03:33:52'),
(12, 'zxczxc', '<p>asdasdads aasdasd</p>\r\n', 'default', '2018-12-31 03:35:25'),
(13, 'qweqwe', '<p>asdadasd</p>\r\n', 'default', '2018-12-31 03:36:10'),
(14, 'asdad', '<p>asdasd</p>\r\n', 'default', '2018-12-31 03:36:34'),
(15, 'asdads', '<p>asdasdasdd</p>\r\n', 'default', '2018-12-31 03:38:12'),
(16, 'asdads', '<p>adadasdasd</p>\r\n', 'default', '2018-12-31 03:39:03'),
(17, 'sadcxzcxc', '<p>zxczxzx&nbsp;</p>\r\n', 'default', '2018-12-31 03:39:46'),
(18, 'czxczxczx', '<p>asdadads</p>\r\n', 'default', '2018-12-31 03:41:12'),
(19, 'xzczxz', '<p>zzxasd asdasd</p>\r\n', 'default', '2018-12-31 03:42:26'),
(20, 'adsadasd', '<p>adasdsad</p>\r\n', 'default', '2018-12-31 03:44:26'),
(21, 'adsasd', '<p>asdasdsadds</p>\r\n', 'default', '2018-12-31 03:44:53'),
(22, 'asdads', '<p>adasdasdsad</p>\r\n', 'default', '2018-12-31 03:47:22'),
(23, 'bbzxcbzcxb', '<p>adad asdads aasdad ads</p>\r\n', 'default', '2018-12-31 08:32:11'),
(24, 'asdsd', '<p>asdasdasd sdasd</p>\r\n', '0CODekfoNdLEyrXnc7HqZP8VGj6UmF', '2018-12-31 08:32:51'),
(25, 'qewwqe', '<p>qwewqewqe qwe qwe we qwe</p>\r\n', 'default', '2018-12-31 09:09:51'),
(26, 'qwewqe', '<p>qweqewqweeasd adasd</p>\r\n', 'default', '2018-12-31 09:25:56'),
(27, 'qwewe', '<p>qeqwe qweqwe</p>\r\n', 'default', '2018-12-31 09:57:25');

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
(1, 'adasdasd', '', '2019-01-01 07:29:04'),
(2, '', 'Wu6CTaIAxlcBMRigftwyoje2QJUNnd', '2019-01-01 07:29:20'),
(3, 'qweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqweweweqwewewe', '', '2019-01-01 07:54:56'),
(4, 'qewwe qwe eqe qwe   \r\nadasdasd\r\n\r\nasdsd', '3Z2dLYf0obKRBTiUM6q49kvOWzmQJ1', '2019-01-01 08:32:25'),
(5, '', '9N2VJYIZq0MckyHLSdTfmjC56uFslg', '2019-01-01 08:34:26'),
(6, 'qweweqew', '', '2019-01-01 08:57:36'),
(7, 'qweqeqwe', '', '2019-01-01 09:02:03'),
(8, 'asdaxc', '', '2019-01-01 09:03:25'),
(9, 'new post', 'YG3JkCUxpOm2Fgu8SqPh4RyoVcvBHb', '2019-01-01 09:27:21'),
(10, 'post postpost post', 'xgGuRhH3rJ6BAVt1eLEXykW9YPUzsT', '2019-01-01 09:28:32'),
(11, 'wqewqe wqeqwe', 'L4bcBfGYZoAeWU7jq5h1yd0VvwKCrP', '2019-01-01 09:31:18'),
(12, '123', 'JuYjxPN7ZFV0TXOfwkDC2yoWgqUa1E', '2019-01-01 09:39:06'),
(13, '1', '', '2019-01-01 09:40:03'),
(14, '2', '', '2019-01-01 09:40:39'),
(15, '3', '', '2019-01-01 09:40:48'),
(16, 'post1', '', '2019-01-07 03:12:08'),
(17, 'asasasasasasa', '', '2019-01-07 03:12:42'),
(18, 'post 2232323', '', '2019-01-07 03:13:20'),
(19, '1', '', '2019-01-17 06:11:11'),
(20, '2', '', '2019-01-17 06:11:21'),
(21, '3', '', '2019-01-17 06:51:21'),
(22, '4', '', '2019-01-17 06:51:29');

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
(1, 'News 1', '<p><strong>News </strong><em>asdsd</em></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>\r\n', 'Wwcz2ACHtNBgMRTsZkqdGFSKplyojU', '2018-12-15 08:11:49'),
(2, 'News 2', '<p>qweqwesasd ads a ad asd asd qwe d a dqw e qwe qw wqeqwe</p>\r\n', 'default', '2018-12-15 09:44:26'),
(3, 'News 3', '<p>qweqasdasasd qew qwe qwe wqe we&nbsp;</p>\r\n', 'GEACvKm7I3bkzRwQec2T0juL86Whrn', '2018-12-15 10:02:31'),
(4, 'News 4', '<p>weadnasd&nbsp; asd asd asd s d asd sd ds asd adasdaasdd</p>\r\n', '6IufyiQEtwd0CkD45Wz7bH3ZqR2hrv', '2018-12-15 10:02:48'),
(5, 'News 5', '<p>qwe asd asd qw e s asd 2e qwe&nbsp;</p>\r\n', 'default', '2018-12-15 10:04:09'),
(6, 'New 6', '<p>adads fasd&nbsp; sd as d s dsddasdsdasdd asdasdbas d djbqwe dnasdhjq nqdw</p>\r\n', 'default', '2018-12-15 10:04:35'),
(7, 'News 7', '<p>sadbjasdjd adsujbwen asduqgwdgbdbasjbj buiavyyucyua usac&nbsp;</p>\r\n', 'Ri3nQtjuCJwzLfP0ag4S7l9dW68sTH', '2018-12-15 10:04:58'),
(8, 'News 8', '<p>asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;asdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsdasdasdsd&nbsp;</p>\r\n', 'Yo5qwkEGF2S4ZuvO7srdWIBHtafhy3', '2018-12-16 09:59:57'),
(9, 'news', '<p>asdad adasd</p>\r\n', 'default', '2018-12-31 08:37:21'),
(10, 'adasd', '<p>adadsdsa adsads</p>\r\n', 'default', '2018-12-31 09:24:44'),
(11, 'qeqwedads asd ', '<p>adsavasa ada a&nbsp;</p>\r\n', 'default', '2018-12-31 10:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `b_username` varchar(50) NOT NULL,
  `b_password` varchar(100) NOT NULL,
  `b_type` varchar(100) NOT NULL,
  `b_profile` varchar(100) NOT NULL,
  `b_address` varchar(100) NOT NULL,
  `b_contact` bigint(20) NOT NULL,
  `b_email` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `b_account_verified` int(5) NOT NULL DEFAULT '0',
  `b_report` int(11) NOT NULL DEFAULT '0',
  `b_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `b_name`, `b_username`, `b_password`, `b_type`, `b_profile`, `b_address`, `b_contact`, `b_email`, `user_id`, `b_account_verified`, `b_report`, `b_created_at`) VALUES
(1, 'QWE', 'asdasd', '$2y$10$xf7I.5LmsiL5MqEy.TSWfeQYD/0pceP/2cUuH8YP5OhHT3pMUIBFW', 'Food Stall/Food Stand/Food Booth', 'qCFJveVUoSux7205TdIX6HDZYyR8WN', 'asdasd,asdads, San Nicolas', 123123123, '', 8, 1, 2, '2018-12-06 11:16:52'),
(5, 'Store2', 'store2', '$2y$10$znaW7eMp7RVqcvwH3pa.heF//VZMjRbX9J.IeuOPYrBtmw8URjH62', 'Clinic', 'default', '321, eqw, San Vicente', 123123123, '', 8, 1, 3, '2018-12-09 09:15:59');

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
(43, 2, 'store', 5, 1, 'comment', 'post', 37, '2019-01-04 09:41:51'),
(44, 0, 'user', 17, 0, 'comment', 'post', 41, '2019-01-04 10:08:20'),
(45, 0, '', 17, 0, 'comment', 'post', 41, '2019-01-04 10:10:29'),
(46, 5, 'user', 17, 1, 'comment', 'post', 41, '2019-01-04 10:12:08'),
(47, 2, 'user', 17, 1, 'comment', 'post', 37, '2019-01-04 10:13:54'),
(48, 2, 'user', 17, 1, 'comment', 'post', 37, '2019-01-04 10:14:13'),
(49, 2, 'store', 5, 1, 'comment', 'post', 37, '2019-01-04 10:14:40'),
(50, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 09:37:16'),
(51, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 09:37:28'),
(52, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 09:39:28'),
(53, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 09:41:12'),
(54, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 09:42:05'),
(55, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 09:42:20'),
(56, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 10:49:54'),
(57, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 10:50:01'),
(58, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 10:50:15'),
(59, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 10:50:21'),
(60, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 10:50:32'),
(61, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-05 10:50:40'),
(62, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-07 03:15:47'),
(63, 5, 'user', 17, 1, 'comment', 'post', 50, '2019-01-07 03:16:04'),
(64, 5, 'user', 17, 1, 'comment', 'post', 51, '2019-01-07 03:17:29'),
(65, 5, 'user', 17, 1, 'comment', 'post', 51, '2019-01-10 08:03:44'),
(66, 5, 'user', 17, 1, 'comment', 'post', 51, '2019-01-10 08:03:55'),
(67, 5, 'user', 18, 1, 'comment', 'post', 51, '2019-01-12 08:29:39'),
(68, 5, 'user', 18, 0, 'comment', 'post', 51, '2019-01-12 08:30:30'),
(69, 5, 'user', 18, 0, 'comment', 'post', 51, '2019-01-12 08:30:43'),
(70, 5, 'user', 18, 0, 'comment', 'post', 6, '2019-01-12 10:46:33'),
(71, 5, 'user', 18, 0, 'comment', 'post', 6, '2019-01-12 10:47:12'),
(72, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:00:06'),
(73, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:00:27'),
(74, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:00:42'),
(75, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:00:47'),
(76, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:01:53'),
(77, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:01:54'),
(78, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:02:46'),
(79, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:02:49'),
(80, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:02:56'),
(81, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:24:37'),
(82, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:26:19'),
(83, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:26:26'),
(84, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:26:27'),
(85, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:27:12'),
(86, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:27:13'),
(87, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:27:20'),
(88, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:27:22'),
(89, 5, 'user', 17, 0, 'comment', 'post', 51, '2019-01-18 04:27:24'),
(90, 5, 'user', 17, 0, 'comment', 'post', 52, '2019-01-20 10:28:21'),
(91, 5, 'user', 17, 0, 'comment', 'post', NULL, '2019-01-20 11:42:27'),
(92, 5, 'user', 17, 0, 'comment', 'post', NULL, '2019-01-20 11:42:32'),
(93, 5, 'user', 17, 0, 'comment', 'post', NULL, '2019-01-20 11:42:38'),
(94, 5, 'store', 1, 0, 'reply', 'post', NULL, '2019-01-20 11:45:08'),
(95, 5, 'store', 1, 0, 'reply', 'post', NULL, '2019-01-20 11:45:13'),
(96, 5, 'store', 1, 0, 'reply', 'post', NULL, '2019-01-20 11:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `store_post`
--

CREATE TABLE `store_post` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `b_post` text NOT NULL,
  `b_postphoto` varchar(256) NOT NULL,
  `b_postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_post`
--

INSERT INTO `store_post` (`id`, `store_id`, `b_post`, `b_postphoto`, `b_postdate`) VALUES
(6, 5, 'Store 2 New post', 'i192vPJZzdEWD6mwjr0MnYApTxh5OR', '2018-12-12 10:25:36'),
(7, 5, 'Store 2 second post', '', '2018-12-12 10:37:13'),
(22, 5, '          qweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqewqweqweqweqweqewqewqew', '', '2018-12-24 07:48:09'),
(23, 5, 'qweqwe', '', '2018-12-28 08:26:26'),
(24, 5, '123', '', '2018-12-28 08:53:36'),
(25, 5, '321', '', '2018-12-28 08:54:13'),
(26, 5, '111', '', '2018-12-28 09:00:56'),
(27, 5, '222', '', '2018-12-28 09:04:09'),
(28, 5, '333', '', '2018-12-28 09:04:20'),
(29, 5, '444', '', '2018-12-28 09:04:28'),
(30, 5, 'z', '', '2018-12-28 09:05:38'),
(31, 5, 'p', '', '2018-12-28 09:05:55'),
(32, 5, 'zxc', '', '2018-12-28 09:09:58'),
(33, 5, 'qweqwe', '', '2018-12-28 09:10:24'),
(34, 2, 'asdasd', '', '2018-12-28 09:10:24'),
(35, 5, 'qq', '', '2018-12-28 09:12:41'),
(36, 5, 'qwe', '', '2018-12-28 09:23:22'),
(37, 2, '1', '', '2018-12-28 09:24:43'),
(38, 5, '123', '', '2018-12-28 09:25:03'),
(39, 5, 'a', '', '2018-12-28 10:55:14'),
(40, 5, 'b', '', '2018-12-28 10:55:25'),
(41, 5, 'c', '', '2018-12-28 10:55:34'),
(42, 5, 'd', '', '2019-01-05 08:46:03'),
(43, 5, 'e', '', '2019-01-05 08:48:53'),
(44, 5, 'f', '', '2019-01-05 08:55:05'),
(45, 5, 'g', '', '2019-01-05 08:57:06'),
(46, 5, 'h', '', '2019-01-05 08:59:11'),
(47, 5, 'i', '', '2019-01-05 08:59:34'),
(48, 5, 'j', '', '2019-01-05 08:59:41'),
(49, 5, 'k', '', '2019-01-05 09:01:28'),
(50, 5, 'l', '', '2019-01-05 09:02:30'),
(51, 5, 'post2', '', '2019-01-07 03:16:58'),
(52, 5, '1', '', '2019-01-20 07:05:21');

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

--
-- Dumping data for table `store_post_comments`
--

INSERT INTO `store_post_comments` (`id`, `store_post_id`, `user_id`, `store_id`, `b_comment`, `b_commentphoto`, `b_commentdate`) VALUES
(5, 7, 17, NULL, 'Comment 1', NULL, '2018-12-24 06:48:04'),
(6, 7, 17, NULL, 'Comment 2', NULL, '2018-12-24 06:48:20'),
(7, 7, 17, NULL, 'Comment 3', NULL, '2018-12-24 07:53:34'),
(8, 7, 17, NULL, 'Comment 4', NULL, '2018-12-24 07:53:41'),
(9, 7, 17, NULL, 'Comment 5', NULL, '2018-12-24 07:53:48'),
(20, 22, 17, NULL, 'qwerty', NULL, '2018-12-27 09:16:53'),
(21, 7, 17, NULL, '1', NULL, '2018-12-27 09:17:22'),
(22, 22, 17, NULL, '1', NULL, '2018-12-27 09:38:01'),
(23, 22, NULL, 5, '1', NULL, '2018-12-27 09:39:01'),
(24, 7, NULL, 5, 'q', NULL, '2018-12-27 11:20:37'),
(25, 38, 17, NULL, '2', NULL, '2018-12-28 09:52:37'),
(26, 38, 17, NULL, '123', NULL, '2018-12-28 10:11:26'),
(27, 38, 17, NULL, '321', NULL, '2018-12-28 10:14:15'),
(28, 38, 17, NULL, 'asd', NULL, '2018-12-28 10:15:53'),
(29, 38, 17, NULL, 'qwer', NULL, '2018-12-28 10:16:21'),
(30, 38, 17, NULL, '4', NULL, '2018-12-28 10:18:09'),
(31, 38, 17, NULL, '5', NULL, '2018-12-28 10:43:43'),
(32, 38, 17, NULL, '6', NULL, '2018-12-28 10:45:30'),
(33, 38, 17, NULL, 't', NULL, '2018-12-28 10:47:16'),
(34, 38, 17, NULL, 'a', NULL, '2018-12-28 10:48:06'),
(35, 38, 17, NULL, 'ww', NULL, '2018-12-28 10:49:00'),
(36, 38, 17, NULL, 'zxc', NULL, '2018-12-28 10:49:58'),
(37, 38, 17, NULL, '1234', NULL, '2018-12-28 10:50:53'),
(38, 38, 17, NULL, 'as', NULL, '2018-12-28 10:53:40'),
(39, 38, NULL, 5, 'qw', NULL, '2018-12-28 10:53:48'),
(40, 41, 17, NULL, 'qwe', NULL, '2018-12-28 10:56:40'),
(41, 41, 17, NULL, '1', NULL, '2018-12-28 10:57:43'),
(42, 41, 17, NULL, '2', NULL, '2018-12-28 10:57:50'),
(43, 41, 17, NULL, '3', NULL, '2018-12-28 10:59:05'),
(44, 41, 17, NULL, 'qwe', NULL, '2018-12-28 11:07:13'),
(45, 41, 17, NULL, '2', NULL, '2018-12-28 11:09:11'),
(46, 41, 17, NULL, 'r', NULL, '2018-12-28 11:10:22'),
(47, 41, 17, NULL, 't', NULL, '2018-12-28 11:11:35'),
(48, 41, 17, NULL, 'y', NULL, '2018-12-28 11:12:35'),
(49, 41, 17, NULL, 'm', NULL, '2018-12-28 11:13:41'),
(50, 41, 17, NULL, '1', NULL, '2018-12-28 11:16:01'),
(51, 41, 17, NULL, '2', NULL, '2018-12-28 11:22:04'),
(52, 41, 17, NULL, 'z', NULL, '2018-12-29 02:07:16'),
(53, 41, 17, NULL, 'x', NULL, '2018-12-29 02:07:21'),
(54, 41, 17, NULL, 'c', NULL, '2018-12-29 02:07:26'),
(55, 41, 17, NULL, 'q', NULL, '2018-12-29 02:42:20'),
(56, 41, 17, NULL, 'e', NULL, '2018-12-29 02:43:17'),
(57, 41, 17, NULL, '1', NULL, '2018-12-29 02:45:22'),
(58, 41, 17, NULL, 'a', NULL, '2018-12-29 04:55:59'),
(59, 41, 17, NULL, 'b', NULL, '2018-12-29 04:56:04'),
(60, 41, 17, NULL, '', NULL, '2018-12-29 04:56:26'),
(61, 41, 17, NULL, 'a', NULL, '2018-12-29 05:05:02'),
(62, 41, 17, NULL, '123', NULL, '2019-01-01 11:00:07'),
(63, 41, 17, NULL, 'qqqqq', NULL, '2019-01-01 11:06:34'),
(64, 41, 17, NULL, 'rrrrr', NULL, '2019-01-01 11:12:16'),
(65, 41, 17, NULL, '11111', NULL, '2019-01-01 11:19:48'),
(66, 41, 17, NULL, 'a', NULL, '2019-01-01 11:22:09'),
(67, 41, NULL, 5, 'a', NULL, '2019-01-01 11:27:07'),
(68, 41, 17, NULL, '2', NULL, '2019-01-01 11:55:55'),
(69, 41, 17, NULL, 'a', NULL, '2019-01-01 11:56:32'),
(70, 41, 17, NULL, 'zzz', NULL, '2019-01-01 12:04:50'),
(71, 41, NULL, 5, 'aaa', NULL, '2019-01-01 12:05:53'),
(72, 41, 18, NULL, 'qqq', NULL, '2019-01-01 12:06:45'),
(73, 41, 17, NULL, 'www', NULL, '2019-01-01 12:10:40'),
(74, 41, 17, NULL, 'c', NULL, '2019-01-02 07:25:49'),
(75, 41, 17, NULL, 'd', NULL, '2019-01-02 07:25:59'),
(76, 41, 17, NULL, 'e', NULL, '2019-01-02 07:26:06'),
(77, 41, 17, NULL, 'f', NULL, '2019-01-02 07:29:34'),
(78, 41, 17, NULL, 'g', NULL, '2019-01-02 08:12:53'),
(79, 41, 17, NULL, 'h', NULL, '2019-01-02 08:16:47'),
(80, 41, 17, NULL, 'i', NULL, '2019-01-02 08:18:31'),
(81, 41, 17, NULL, 'j', NULL, '2019-01-02 08:20:00'),
(82, 41, 17, NULL, 'k', NULL, '2019-01-02 08:20:36'),
(83, 41, 17, NULL, 'l', NULL, '2019-01-02 08:21:35'),
(84, 41, 17, NULL, 'm', NULL, '2019-01-02 08:22:49'),
(85, 41, 17, NULL, 'n', NULL, '2019-01-02 08:24:15'),
(86, 41, 17, NULL, 'o', NULL, '2019-01-02 08:24:49'),
(87, 41, 17, NULL, 'p', NULL, '2019-01-02 08:26:08'),
(88, 41, 17, NULL, 'p', NULL, '2019-01-02 08:26:12'),
(89, 41, 17, NULL, 'q', NULL, '2019-01-02 08:26:18'),
(90, 41, NULL, 2, '1', NULL, '2019-01-02 08:31:15'),
(91, 41, NULL, 2, '2', NULL, '2019-01-02 08:38:48'),
(92, 41, NULL, 2, 'z', NULL, '2019-01-02 08:53:47'),
(93, 41, NULL, 2, 'x', NULL, '2019-01-02 08:56:01'),
(94, 41, 17, NULL, '1', NULL, '2019-01-02 08:58:23'),
(95, 41, NULL, 2, '2', NULL, '2019-01-02 08:59:06'),
(96, 41, 17, NULL, '3', NULL, '2019-01-02 08:59:35'),
(97, 41, 17, NULL, '4', NULL, '2019-01-02 09:00:51'),
(98, 41, 17, NULL, '5', NULL, '2019-01-02 09:02:39'),
(99, 41, NULL, 5, 'q', NULL, '2019-01-02 09:04:10'),
(100, 41, 17, NULL, 'w', NULL, '2019-01-02 09:04:20'),
(101, 41, 17, NULL, 'e', NULL, '2019-01-02 09:10:22'),
(102, 41, 17, NULL, 'f', NULL, '2019-01-02 09:10:46'),
(103, 41, 17, NULL, 'g', NULL, '2019-01-02 09:10:54'),
(104, 41, 17, NULL, 'h', NULL, '2019-01-02 09:11:00'),
(105, 41, 17, NULL, 'i', NULL, '2019-01-02 09:11:07'),
(106, 41, NULL, 2, 'j', NULL, '2019-01-02 09:11:28'),
(107, 41, 17, NULL, 'q', NULL, '2019-01-02 09:25:52'),
(108, 41, NULL, 2, 'w', NULL, '2019-01-02 09:26:54'),
(109, 41, NULL, 2, 'e', NULL, '2019-01-02 09:28:58'),
(110, 41, NULL, 2, 'r', NULL, '2019-01-02 09:31:07'),
(111, 41, NULL, 2, 't', NULL, '2019-01-02 09:32:20'),
(112, 41, NULL, 2, 'y', NULL, '2019-01-02 09:38:13'),
(113, 41, NULL, 2, 'u', NULL, '2019-01-02 09:38:35'),
(114, 41, NULL, 5, 'a', NULL, '2019-01-02 09:41:46'),
(115, 41, NULL, 2, 'b', NULL, '2019-01-02 09:41:54'),
(116, 41, NULL, 2, 'c', NULL, '2019-01-02 09:42:00'),
(117, 41, 17, NULL, 'd', NULL, '2019-01-02 09:42:20'),
(118, 41, NULL, 5, 'e', NULL, '2019-01-02 09:42:26'),
(119, 37, NULL, 2, '1', NULL, '2019-01-04 08:59:11'),
(120, 37, NULL, 2, '2', NULL, '2019-01-04 09:00:17'),
(121, 37, 17, NULL, '3', NULL, '2019-01-04 09:00:49'),
(122, 37, NULL, 2, '4', NULL, '2019-01-04 09:01:25'),
(123, 37, 17, NULL, '5', NULL, '2019-01-04 09:15:40'),
(124, 37, NULL, 2, '6', NULL, '2019-01-04 09:15:59'),
(125, 37, NULL, 2, '7', NULL, '2019-01-04 09:19:31'),
(126, 37, 17, NULL, '8', NULL, '2019-01-04 09:21:34'),
(127, 37, NULL, 2, '9', NULL, '2019-01-04 09:21:41'),
(128, 37, NULL, 2, '10', NULL, '2019-01-04 09:22:58'),
(129, 37, 17, NULL, '11', NULL, '2019-01-04 09:35:11'),
(130, 37, NULL, 5, '12', NULL, '2019-01-04 09:37:23'),
(131, 41, NULL, 2, '1', NULL, '2019-01-04 09:37:49'),
(132, 37, NULL, 5, '13', NULL, '2019-01-04 09:39:19'),
(133, 37, NULL, 5, '14', NULL, '2019-01-04 09:44:50'),
(134, 37, NULL, 5, '15', NULL, '2019-01-04 09:48:13'),
(135, 37, NULL, 5, '16', NULL, '2019-01-04 09:48:53'),
(136, 37, NULL, 5, '17', NULL, '2019-01-04 09:49:35'),
(137, 37, NULL, 5, '18', NULL, '2019-01-04 09:56:42'),
(138, 37, NULL, 5, '19', NULL, '2019-01-04 09:59:07'),
(139, 37, NULL, 5, '20', NULL, '2019-01-04 10:01:58'),
(140, 37, NULL, 5, '21', NULL, '2019-01-04 10:04:19'),
(141, 37, NULL, 5, '22', NULL, '2019-01-04 10:06:03'),
(142, 41, 17, NULL, '2', NULL, '2019-01-04 10:07:10'),
(143, 41, 17, NULL, '3', NULL, '2019-01-04 10:08:16'),
(144, 41, 17, NULL, '4', NULL, '2019-01-04 10:10:25'),
(145, 41, 17, NULL, '5', NULL, '2019-01-04 10:12:04'),
(146, 41, NULL, 5, '6', NULL, '2019-01-04 10:12:59'),
(147, 41, NULL, 5, '7', NULL, '2019-01-04 10:13:14'),
(148, 37, 17, NULL, '23', NULL, '2019-01-04 10:13:53'),
(149, 37, NULL, 2, '24', NULL, '2019-01-04 10:14:05'),
(150, 37, 17, NULL, '25', NULL, '2019-01-04 10:14:12'),
(151, 37, NULL, 5, '26', NULL, '2019-01-04 10:14:36'),
(152, 50, 17, NULL, '1', NULL, '2019-01-05 09:37:12'),
(153, 50, 17, NULL, '2', NULL, '2019-01-05 09:37:24'),
(154, 50, 17, NULL, '3', NULL, '2019-01-05 09:39:25'),
(155, 50, 17, NULL, '4', NULL, '2019-01-05 09:41:08'),
(156, 50, 17, NULL, '5', NULL, '2019-01-05 09:42:04'),
(157, 50, 17, NULL, '6', NULL, '2019-01-05 09:42:17'),
(158, 50, 17, NULL, '7', NULL, '2019-01-05 10:49:50'),
(159, 50, 17, NULL, '8', NULL, '2019-01-05 10:49:59'),
(160, 50, 17, NULL, '9', NULL, '2019-01-05 10:50:14'),
(161, 50, 17, NULL, '10', NULL, '2019-01-05 10:50:20'),
(162, 50, 17, NULL, '11', NULL, '2019-01-05 10:50:31'),
(163, 50, 17, NULL, '12', NULL, '2019-01-05 10:50:39'),
(164, 50, NULL, 5, '13', NULL, '2019-01-07 03:15:34'),
(165, 50, 17, NULL, '14', NULL, '2019-01-07 03:15:46'),
(166, 50, 17, NULL, '15', NULL, '2019-01-07 03:16:03'),
(167, 51, 17, NULL, 'comment1', NULL, '2019-01-07 03:17:26'),
(168, 51, 17, NULL, '1', NULL, '2019-01-10 08:03:40'),
(169, 51, NULL, 5, '2', NULL, '2019-01-10 08:03:48'),
(170, 51, 17, NULL, '3', NULL, '2019-01-10 08:03:54'),
(171, 51, NULL, 5, '4', NULL, '2019-01-10 08:03:59'),
(172, 51, 18, NULL, '5', NULL, '2019-01-12 08:29:35'),
(173, 51, 18, NULL, '6', NULL, '2019-01-12 08:30:29'),
(174, 51, NULL, 5, '7', NULL, '2019-01-12 08:30:36'),
(175, 51, 18, NULL, '8', NULL, '2019-01-12 08:30:41'),
(176, 6, 18, NULL, '1', NULL, '2019-01-12 10:44:13'),
(177, 6, 18, NULL, '2', NULL, '2019-01-12 10:46:30'),
(178, 6, NULL, 5, '3', NULL, '2019-01-12 10:46:58'),
(179, 6, NULL, 5, '4', NULL, '2019-01-12 10:47:05'),
(180, 6, 18, NULL, '5', NULL, '2019-01-12 10:47:11'),
(181, 51, 17, NULL, '9', NULL, '2019-01-18 04:00:01'),
(182, 51, 17, NULL, '10', NULL, '2019-01-18 04:00:41'),
(183, 51, 17, NULL, '11', NULL, '2019-01-18 04:01:49'),
(184, 51, 17, NULL, '12', NULL, '2019-01-18 04:02:44'),
(185, 51, 17, NULL, '13', NULL, '2019-01-18 04:02:47'),
(186, 51, 17, NULL, '14', NULL, '2019-01-18 04:02:51'),
(187, 51, 17, NULL, '15', NULL, '2019-01-18 04:26:16'),
(188, 51, 17, NULL, '16', NULL, '2019-01-18 04:26:21'),
(189, 51, 17, NULL, '17', NULL, '2019-01-18 04:26:26'),
(190, 51, 17, NULL, '18', NULL, '2019-01-18 04:27:08'),
(191, 51, 17, NULL, '19', NULL, '2019-01-18 04:27:12'),
(192, 51, 17, NULL, '20', NULL, '2019-01-18 04:27:18'),
(193, 51, 17, NULL, '21', NULL, '2019-01-18 04:27:21'),
(194, 51, 17, NULL, '22', NULL, '2019-01-18 04:27:23'),
(195, 52, 17, NULL, '1', NULL, '2019-01-20 10:28:18');

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

--
-- Dumping data for table `store_reply`
--

INSERT INTO `store_reply` (`id`, `store_comment_id`, `user_id`, `store_id`, `b_reply`, `b_replyphoto`, `b_replydate`) VALUES
(1, 195, 17, NULL, '1', NULL, '2019-01-20 10:48:49'),
(2, 195, 17, NULL, '2', NULL, '2019-01-20 10:49:13'),
(3, 195, 17, NULL, '3', NULL, '2019-01-20 10:49:18'),
(4, 195, 17, NULL, '4', NULL, '2019-01-20 10:49:24'),
(5, 195, 17, NULL, '5', NULL, '2019-01-20 10:49:29'),
(6, 195, 17, NULL, '6', NULL, '2019-01-20 11:10:21'),
(7, 195, 17, NULL, '7', NULL, '2019-01-20 11:11:00'),
(8, 195, 17, NULL, '8', NULL, '2019-01-20 11:13:38'),
(9, 195, 17, NULL, '9', NULL, '2019-01-20 11:13:41'),
(10, 195, NULL, 5, '10', NULL, '2019-01-20 11:16:57'),
(11, 195, NULL, 5, '11', NULL, '2019-01-20 11:17:18'),
(12, 195, NULL, 5, '12', NULL, '2019-01-20 11:17:21'),
(13, 195, 17, NULL, '13', NULL, '2019-01-20 11:25:22'),
(14, 195, 17, NULL, '14', NULL, '2019-01-20 11:27:52'),
(15, 195, 17, NULL, '15', NULL, '2019-01-20 11:28:00'),
(16, 195, 17, NULL, '16', NULL, '2019-01-20 11:28:40'),
(17, 195, 17, NULL, '17', NULL, '2019-01-20 11:28:46'),
(18, 195, 17, NULL, '18', NULL, '2019-01-20 11:28:58'),
(19, 195, NULL, 5, '19', NULL, '2019-01-20 11:32:31'),
(20, 195, NULL, 5, '20', NULL, '2019-01-20 11:35:56'),
(21, 195, NULL, 5, '21', NULL, '2019-01-20 11:36:34'),
(22, 195, NULL, 5, '22', NULL, '2019-01-20 11:36:38'),
(23, 195, NULL, 5, '23', NULL, '2019-01-20 11:36:46'),
(24, 195, 17, NULL, '24', NULL, '2019-01-20 11:42:23'),
(25, 195, 17, NULL, '25', NULL, '2019-01-20 11:42:31'),
(26, 195, 17, NULL, '26', NULL, '2019-01-20 11:42:37'),
(27, 195, NULL, 1, '27', NULL, '2019-01-20 11:45:04'),
(28, 195, NULL, 1, '28', NULL, '2019-01-20 11:45:12'),
(29, 195, NULL, 1, '29', NULL, '2019-01-20 11:45:19');

-- --------------------------------------------------------

--
-- Table structure for table `store_report`
--

CREATE TABLE `store_report` (
  `id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_report`
--

INSERT INTO `store_report` (`id`, `store_id`, `user_id`) VALUES
(13, 5, 17);

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
(47, 17, 'admin', NULL, 1, 'post', 'news', 11, '2018-12-31 10:00:14'),
(48, 18, 'admin', NULL, 1, 'post', 'news', 11, '2018-12-31 10:00:14'),
(51, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:02:04'),
(52, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:02:04'),
(53, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:03:25'),
(54, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:03:25'),
(55, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:27:22'),
(56, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:27:22'),
(57, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:28:33'),
(58, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:28:33'),
(59, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:31:18'),
(60, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:31:18'),
(61, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:39:07'),
(62, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:39:07'),
(63, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:40:03'),
(64, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:40:03'),
(65, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:40:39'),
(66, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:40:39'),
(67, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:40:48'),
(68, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-01 09:40:48'),
(70, 17, 'store', 5, 1, 'comment', 'post', 5, '2019-01-05 09:22:36'),
(71, 17, 'store', 5, 1, 'comment', 'post', 5, '2019-01-05 10:39:14'),
(72, 17, 'store', 5, 1, 'comment', 'post', 5, '2019-01-05 10:48:31'),
(73, 17, 'store', 5, 1, 'comment', 'post', 5, '2019-01-05 10:48:48'),
(74, 17, 'store', 5, 1, 'comment', 'post', 5, '2019-01-05 10:48:56'),
(75, 17, 'store', 5, 1, 'comment', 'post', 5, '2019-01-05 10:49:13'),
(76, 17, 'store', 5, 1, 'comment', 'post', 5, '2019-01-05 10:49:20'),
(77, 17, 'store', 5, 1, 'comment', 'post', 5, '2019-01-05 10:54:06'),
(78, 17, 'store', 5, 1, 'comment', 'post', 5, '2019-01-05 10:57:59'),
(79, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-07 03:12:08'),
(80, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-07 03:12:08'),
(81, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-07 03:12:43'),
(82, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-07 03:12:43'),
(83, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-07 03:13:20'),
(84, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-07 03:13:20'),
(85, 17, 'store', 5, 1, 'comment', 'post', 6, '2019-01-10 07:53:14'),
(86, 17, 'store', 5, 1, 'comment', 'post', 6, '2019-01-10 07:53:29'),
(87, 17, 'user', 17, 1, 'comment', 'post', 6, '2019-01-10 07:53:49'),
(88, 17, 'store', 5, 1, 'comment', 'post', 6, '2019-01-10 08:00:58'),
(89, 17, 'store', 5, 1, 'comment', 'post', 6, '2019-01-10 08:01:27'),
(90, 17, 'store', 5, 1, 'comment', 'post', 6, '2019-01-10 08:01:46'),
(91, 17, 'store', 5, 1, 'comment', 'post', 6, '2019-01-10 08:02:03'),
(92, 17, 'store', 5, 1, 'comment', 'post', 6, '2019-01-10 08:02:29'),
(93, 17, 'store', 5, 1, 'comment', 'post', 6, '2019-01-10 08:02:40'),
(94, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:17:33'),
(95, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:17:53'),
(96, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:18:15'),
(97, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:25:55'),
(98, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:26:25'),
(99, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:32:50'),
(100, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:34:29'),
(101, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:36:05'),
(102, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:38:08'),
(103, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:39:30'),
(104, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:41:17'),
(105, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:43:05'),
(106, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:44:28'),
(107, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:45:25'),
(108, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:47:13'),
(109, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-11 10:50:03'),
(110, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-12 08:20:30'),
(111, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-12 08:21:01'),
(112, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-12 08:22:12'),
(113, 17, 'user', 18, 1, 'comment', 'post', 6, '2019-01-12 08:58:24'),
(114, 17, 'store', 5, 1, 'comment', 'post', 6, '2019-01-12 08:58:28'),
(115, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-17 06:11:11'),
(116, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-17 06:11:11'),
(117, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-17 06:11:21'),
(118, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-17 06:11:21'),
(119, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-17 06:51:21'),
(120, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-17 06:51:21'),
(121, 17, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-17 06:51:29'),
(122, 18, 'admin', NULL, 1, 'post', 'GapanCity', NULL, '2019-01-17 06:51:29'),
(123, 17, 'user', 18, 1, 'reply', 'post', NULL, '2019-01-20 10:18:00'),
(124, 17, 'user', 18, 0, 'reply', 'post', NULL, '2019-01-20 10:18:24'),
(125, 17, 'store', 5, 0, 'reply', 'post', NULL, '2019-01-20 10:20:36'),
(126, 17, 'store', 5, 0, 'reply', 'post', NULL, '2019-01-20 10:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE `user_post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `u_post` text NOT NULL,
  `u_postphoto` varchar(256) NOT NULL,
  `u_postverified` int(5) NOT NULL DEFAULT '0',
  `u_postdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`id`, `user_id`, `u_post`, `u_postphoto`, `u_postverified`, `u_postdate`) VALUES
(8, 17, '1', '', 1, '2019-01-19 10:07:23'),
(9, 17, '2', '', 1, '2019-01-19 10:07:25'),
(11, 17, '3', '', 1, '2019-01-19 10:14:37'),
(12, 17, '4', '', 1, '2019-01-19 10:14:38'),
(13, 17, '5', '', 1, '2019-01-19 10:14:39'),
(17, 17, '6', 'ESX17Ma45jtnio8BUVdpIWHeDzfhLQ', 1, '2019-01-19 10:16:52'),
(18, 17, '7', '', 0, '2019-01-19 10:19:11'),
(19, 17, '7', 'eaLJtKy8hpWT5dINDECogFPGif7bYs', 0, '2019-01-19 10:26:19');

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
(1, 5, NULL, 5, 'store2 comment', NULL, '2019-01-03 08:21:27'),
(2, 5, 17, NULL, 'user comment', NULL, '2019-01-03 08:21:28'),
(3, 5, NULL, 5, 'store2 2nd comment', NULL, '2019-01-03 08:31:04'),
(4, 5, 17, NULL, 'user 2nd comment', NULL, '2019-01-03 08:31:04'),
(5, 5, 17, NULL, '1', NULL, '2019-01-03 09:05:21'),
(6, 5, 17, NULL, '2', NULL, '2019-01-03 09:07:34'),
(7, 5, 17, NULL, '3', NULL, '2019-01-03 09:27:07'),
(8, 5, 17, NULL, '4', NULL, '2019-01-03 09:29:16'),
(9, 5, 17, NULL, '5', NULL, '2019-01-03 09:29:28'),
(10, 5, 17, NULL, '6', NULL, '2019-01-03 09:29:33'),
(11, 5, 17, NULL, '7', NULL, '2019-01-03 09:31:03'),
(12, 5, 17, NULL, '8', NULL, '2019-01-03 09:42:02'),
(13, 5, 17, NULL, '9', NULL, '2019-01-03 09:43:03'),
(14, 5, 17, NULL, '10', NULL, '2019-01-03 09:43:32'),
(15, 5, 18, NULL, '11', NULL, '2019-01-03 09:43:40'),
(16, 5, 18, NULL, '12', NULL, '2019-01-03 09:43:45'),
(17, 5, 18, NULL, '13', NULL, '2019-01-03 09:46:39'),
(18, 5, 18, NULL, '14', NULL, '2019-01-03 09:51:42'),
(19, 5, 18, NULL, '15', NULL, '2019-01-03 09:54:07'),
(20, 5, 17, NULL, '16', NULL, '2019-01-03 09:57:01'),
(21, 5, 17, NULL, '17', NULL, '2019-01-04 06:37:57'),
(22, 5, 17, NULL, '18', NULL, '2019-01-04 06:39:30'),
(23, 5, 17, NULL, '19', NULL, '2019-01-04 06:40:13'),
(24, 5, 17, NULL, '20', NULL, '2019-01-04 06:40:34'),
(25, 5, 17, NULL, '21', NULL, '2019-01-04 07:03:35'),
(26, 5, 17, NULL, '22', NULL, '2019-01-04 07:08:30'),
(27, 5, 17, NULL, '23', NULL, '2019-01-04 07:25:17'),
(28, 5, 17, NULL, '24', NULL, '2019-01-04 07:27:06'),
(29, 5, 17, NULL, '25', NULL, '2019-01-04 07:28:07'),
(30, 5, 17, NULL, '26', NULL, '2019-01-04 07:28:41'),
(31, 5, 17, NULL, '27', NULL, '2019-01-04 07:30:41'),
(32, 5, 17, NULL, '28', NULL, '2019-01-04 07:38:13'),
(33, 5, 17, NULL, '29', NULL, '2019-01-04 07:38:38'),
(34, 5, NULL, 2, '30', NULL, '2019-01-04 08:23:00'),
(35, 5, NULL, 2, '31', NULL, '2019-01-04 08:23:15'),
(36, 5, NULL, 5, '32', NULL, '2019-01-05 09:15:03'),
(37, 5, NULL, 5, '33', NULL, '2019-01-05 09:17:20'),
(38, 5, NULL, 5, '34', NULL, '2019-01-05 09:21:09'),
(39, 5, NULL, 5, '35', NULL, '2019-01-05 09:22:35'),
(40, 5, NULL, 5, '36', NULL, '2019-01-05 10:39:09'),
(41, 5, NULL, 5, '37', NULL, '2019-01-05 10:48:26'),
(42, 5, NULL, 5, '38', NULL, '2019-01-05 10:48:47'),
(43, 5, NULL, 5, '39', NULL, '2019-01-05 10:48:55'),
(44, 5, NULL, 5, '40', NULL, '2019-01-05 10:49:11'),
(45, 5, NULL, 5, '41', NULL, '2019-01-05 10:49:19'),
(46, 5, NULL, 5, '42', NULL, '2019-01-05 10:54:02'),
(47, 5, NULL, 5, '43', NULL, '2019-01-05 10:57:56'),
(48, 6, NULL, 5, '1', NULL, '2019-01-10 07:53:07'),
(49, 6, NULL, 5, '2', NULL, '2019-01-10 07:53:26'),
(50, 6, 17, NULL, '3', NULL, '2019-01-10 07:53:34'),
(51, 6, NULL, 5, '4', NULL, '2019-01-10 08:00:53'),
(52, 6, NULL, 5, '5', NULL, '2019-01-10 08:01:04'),
(53, 6, NULL, 5, '6', NULL, '2019-01-10 08:01:45'),
(54, 6, NULL, 5, '7', NULL, '2019-01-10 08:01:59'),
(55, 6, 17, NULL, '8', NULL, '2019-01-10 08:02:12'),
(56, 6, NULL, 5, '9', NULL, '2019-01-10 08:02:28'),
(57, 6, 17, NULL, '10', NULL, '2019-01-10 08:02:33'),
(58, 6, NULL, 5, '11', NULL, '2019-01-10 08:02:39'),
(59, 6, 18, NULL, '12', NULL, '2019-01-11 10:17:28'),
(60, 6, 18, NULL, '13', NULL, '2019-01-11 10:17:52'),
(61, 6, 18, NULL, '14', NULL, '2019-01-11 10:18:14'),
(62, 6, 18, NULL, '15', NULL, '2019-01-11 10:25:51'),
(63, 6, 18, NULL, '16', NULL, '2019-01-11 10:26:24'),
(64, 6, 18, NULL, '17', NULL, '2019-01-11 10:32:47'),
(65, 6, 18, NULL, '18', NULL, '2019-01-11 10:34:25'),
(66, 6, 18, NULL, '19', NULL, '2019-01-11 10:36:01'),
(67, 6, 18, NULL, '20', NULL, '2019-01-11 10:38:04'),
(68, 6, 18, NULL, '21', NULL, '2019-01-11 10:39:26'),
(69, 6, 18, NULL, '22', NULL, '2019-01-11 10:41:14'),
(70, 6, 18, NULL, '23', NULL, '2019-01-11 10:43:01'),
(71, 6, 18, NULL, '24', NULL, '2019-01-11 10:44:24'),
(72, 6, 18, NULL, '25', NULL, '2019-01-11 10:45:24'),
(73, 6, 18, NULL, '26', NULL, '2019-01-11 10:47:09'),
(74, 6, 18, NULL, '27', NULL, '2019-01-11 10:49:59'),
(75, 6, 18, NULL, '28', NULL, '2019-01-12 08:20:22'),
(76, 6, 18, NULL, '29', NULL, '2019-01-12 08:20:59'),
(77, 6, 18, NULL, '30', NULL, '2019-01-12 08:22:08'),
(78, 6, 18, NULL, '31', NULL, '2019-01-12 08:58:20'),
(79, 6, NULL, 5, '32', NULL, '2019-01-12 08:58:27'),
(80, 17, 17, NULL, '1', NULL, '2019-01-20 07:22:34'),
(81, 17, 17, NULL, '2', NULL, '2019-01-20 07:22:45'),
(82, 17, 17, NULL, '3', NULL, '2019-01-20 07:22:47');

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

--
-- Dumping data for table `user_reply`
--

INSERT INTO `user_reply` (`id`, `user_comment_id`, `user_id`, `store_id`, `u_reply`, `u_replyphoto`, `u_replydate`) VALUES
(1, 82, 17, NULL, '1st reply', NULL, '2019-01-20 08:24:46'),
(2, 82, 17, NULL, '2nd reply', NULL, '2019-01-20 08:24:53'),
(3, 82, 17, NULL, '3rd reply', NULL, '2019-01-20 08:25:02'),
(4, 82, 17, NULL, '4th reply', NULL, '2019-01-20 08:25:10'),
(5, 82, 17, NULL, '5th reply', NULL, '2019-01-20 08:25:17'),
(6, 82, 17, NULL, '6th reply', NULL, '2019-01-20 09:18:03'),
(7, 82, 17, NULL, '7th reply', NULL, '2019-01-20 09:18:37'),
(8, 82, 17, NULL, '8th reply', NULL, '2019-01-20 09:21:03'),
(9, 82, 17, NULL, '9th reply', NULL, '2019-01-20 09:24:18'),
(10, 82, 17, NULL, '10th reply', NULL, '2019-01-20 09:24:31'),
(11, 82, NULL, 5, '11th reply', NULL, '2019-01-20 09:27:55'),
(12, 82, NULL, 5, '12th reply', NULL, '2019-01-20 09:28:34'),
(13, 82, NULL, 5, '13th reply', NULL, '2019-01-20 09:28:43'),
(14, 82, 18, NULL, '14th reply', NULL, '2019-01-20 09:40:12'),
(15, 82, 18, NULL, '15th reply', NULL, '2019-01-20 09:42:11'),
(16, 82, 18, NULL, '16th reply', NULL, '2019-01-20 09:42:23'),
(17, 82, 18, NULL, '17th reply', NULL, '2019-01-20 09:42:58'),
(18, 82, 18, NULL, '18th reply', NULL, '2019-01-20 09:43:06'),
(19, 82, NULL, 5, '19th reply', NULL, '2019-01-20 10:08:49'),
(20, 82, NULL, 5, '20th reply', NULL, '2019-01-20 10:11:12'),
(21, 82, NULL, 5, '21st reply', NULL, '2019-01-20 10:11:51'),
(22, 82, NULL, 5, '22nd reply', NULL, '2019-01-20 10:12:01'),
(23, 82, NULL, 5, '23rd reply', NULL, '2019-01-20 10:15:43'),
(24, 82, 18, NULL, '24th reply', NULL, '2019-01-20 10:17:59'),
(25, 82, 18, NULL, '25th reply', NULL, '2019-01-20 10:18:22'),
(26, 82, NULL, 5, '26th reply', NULL, '2019-01-20 10:20:32'),
(27, 82, 17, NULL, '27th reply', NULL, '2019-01-20 10:20:47'),
(28, 82, NULL, 5, '28th reply', NULL, '2019-01-20 10:20:54');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `gapan_post`
--
ALTER TABLE `gapan_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `store_follow`
--
ALTER TABLE `store_follow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_notification`
--
ALTER TABLE `store_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `store_post`
--
ALTER TABLE `store_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `store_post_comments`
--
ALTER TABLE `store_post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196;

--
-- AUTO_INCREMENT for table `store_reply`
--
ALTER TABLE `store_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `store_report`
--
ALTER TABLE `store_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `user_post`
--
ALTER TABLE `user_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_post_comments`
--
ALTER TABLE `user_post_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `user_reply`
--
ALTER TABLE `user_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_report`
--
ALTER TABLE `user_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
