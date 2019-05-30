-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2019 at 04:08 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sociallogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` enum('facebook','google','twitter','manual') NOT NULL DEFAULT 'manual',
  `oauth_uid` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `locale` varchar(10) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `created_at` bigint(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `password`, `gender`, `locale`, `picture`, `link`, `created_at`, `updated_at`, `last_login`) VALUES
(4, 'facebook', '2391347947553959', 'Manojit', 'Nandi', 'manojit87@yahoo.com', NULL, NULL, NULL, 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2391347947553959&height=50&width=50&ext=1559212432&hash=AeSXKU5J-JyOpM8j', NULL, 1555842210, '2019-04-30 10:33:53', '2019-04-30 16:03:53'),
(5, 'google', '108115231920627576739', 'Manojit', 'Nandi', 'manojit87@gmail.com', NULL, '', 'en-GB', 'https://lh4.googleusercontent.com/-MTc85yeeRI0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcc9V3NiZRJG1WhfB122UwBBEnGsg/mo/photo.jpg', 'https://plus.google.com/108115231920627576739', 1556012936, '2019-04-30 12:19:16', '2019-04-30 17:49:16'),
(6, 'google', '116041678788512165689', 'Manojit', 'Nandi', 'mnbl87@gmail.com', NULL, '', 'en', 'https://lh4.googleusercontent.com/-FoCKVgMK_m0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rfxMHARjsmWkk9C1m5sEqr3cV7TbA/mo/photo.jpg', '', 1556014791, '2019-05-26 12:29:12', '2019-05-26 17:59:12'),
(7, 'google', '113136432246250973046', 'Manojit', 'Nandi', 'developer.manojit@gmail.com', NULL, '', 'en', 'https://lh4.googleusercontent.com/-DrUzogf-vY0/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rf4WXCS9_papt_Pcmw0nPDpSg1YCw/mo/photo.jpg', '', 1556014952, '2019-04-30 10:23:53', '2019-04-30 15:53:53'),
(8, 'google', '112590954471928395526', 'Manojit', 'Nandi', 'manojit.it2010@gmail.com', NULL, '', 'en', 'https://lh6.googleusercontent.com/-rvCrnR4X0n4/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3reTH1llKtM647zPthmQGMfOYGiUYg/mo/photo.jpg', '', 1556015047, '2019-04-30 12:19:55', '2019-04-30 17:49:55'),
(9, 'google', '108781838679057584625', 'Manojit', 'Nandi', 'manojit.smartwork@gmail.com', NULL, '', 'en', 'https://lh6.googleusercontent.com/-8Cim5VKTsNg/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rcKNA6aWpIl39r2A7g5xq6FmKkw_g/mo/photo.jpg', '', 1556015195, '2019-04-30 10:49:16', '2019-04-30 16:19:16'),
(10, 'google', '105665868989968995265', 'Asha', 'Kumari', 'asha.kumari.smartwork@gmail.com', NULL, '', 'en', 'https://lh6.googleusercontent.com/-UHpEwXsDaqs/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rdoUSYD5x1gXGCV3GCf4uqS1WkQhQ/mo/photo.jpg', '', 1556015279, '2019-04-30 10:33:01', '2019-04-30 16:03:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
