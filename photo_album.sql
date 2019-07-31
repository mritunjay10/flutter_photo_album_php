-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 31, 2019 at 10:26 PM
-- Server version: 5.7.26-0ubuntu0.18.10.1
-- PHP Version: 7.2.19-0ubuntu0.18.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo_album`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `status` enum('active','deleted') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_name`, `password`, `status`) VALUES
(1, 'admin', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `user_id` varchar(225) NOT NULL,
  `album_name` varchar(225) NOT NULL,
  `album_cover` varchar(255) NOT NULL,
  `status` enum('active','deleted') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `user_id`, `album_name`, `album_cover`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'Album-1', 'https://picsum.photos/250?image=9', 'active', '2019-04-09 05:54:23', '2019-04-24 15:07:06'),
(3, '2', 'Album-2', 'https://picsum.photos/250?image=9', 'active', '2019-04-09 05:54:23', '2019-04-24 15:07:10'),
(17, '1', 'TEST-Album', 'http://127.0.0.1/PhotoAlbum/photos/albums/1555734022.png', 'active', '2019-04-19 11:23:00', '2019-04-24 15:07:13'),
(18, '1', 'Album-now-2', 'http://127.0.0.1/PhotoAlbum/photos/albums/1555837526.jpeg', 'active', '2019-04-20 04:20:22', '2019-04-24 15:07:20'),
(19, 'Select User', 'Newest album', 'http://127.0.0.1/PhotoAlbum/photos/albums/1556342898.png', 'active', '2019-04-27 05:28:18', '2019-04-27 05:28:18'),
(20, '6', 'Newest album', 'http://127.0.0.1/PhotoAlbum/photos/albums/1556342914.png', 'active', '2019-04-27 05:28:34', '2019-04-27 05:28:34'),
(21, '6', 'Again-Test', 'http://127.0.0.1/PhotoAlbum/photos/albums/1556421730.png', 'active', '2019-04-28 03:22:10', '2019-04-28 03:22:10'),
(22, 'Select User', ' v', 'http://127.0.0.1/PhotoAlbum/photos/albums/1556423076.png', 'active', '2019-04-28 03:44:36', '2019-04-28 03:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `photo_path` varchar(225) NOT NULL,
  `album_id` varchar(225) NOT NULL,
  `status` enum('active','deleted') NOT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `photo_path`, `album_id`, `status`, `uploaded_at`, `updated_at`) VALUES
(1, 'https://picsum.photos/250?image=9', '1', 'active', '2019-04-10 04:25:04', '2019-04-10 04:25:04'),
(2, 'https://picsum.photos/250?image=19', '2', 'active', '2019-04-10 04:25:08', '2019-04-11 11:07:13'),
(3, '/var/www/html/PhotoAlbum/photos/albums/31556426572MCXbvzMaib.png', '41', 'active', '2019-04-28 04:42:52', '2019-07-19 07:16:49'),
(4, '/var/www/html/PhotoAlbum/photos/albums/31556426573eywwDxZNrv.png', '22', 'active', '2019-04-28 04:42:53', '2019-07-19 07:16:45'),
(5, '/var/www/html/PhotoAlbum/photos/albums/31556426573LHdjQnjVHm.png', '21', 'active', '2019-04-28 04:42:53', '2019-07-19 07:16:42'),
(6, 'http://127.0.0.1/PhotoAlbum/photos/19//var/www/html/PhotoAlbum/photos/19/15564300424MbWFlJqzV.png', '19', 'active', '2019-04-28 05:40:42', '2019-04-28 05:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `status` enum('active','deleted') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `phone_number`, `address`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'mjk', 'mj@gmail.com', '1234567890', 'asssv', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'active', '2019-04-07 15:02:28', '2019-06-13 13:09:10'),
(2, 'mj', 'user@gmail.com', '1234567891', 'shgjxg', 'ghsxgs', 'active', '2019-04-08 12:27:34', '2019-04-24 14:59:15'),
(6, 'admin', 'qwerty@sed.com', '8298810139', 'Sultanpur, Trimurtinagar', 'e10adc3949ba59abbe56e057f20f883e', 'active', '2019-04-18 02:58:04', '2019-04-24 14:59:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
