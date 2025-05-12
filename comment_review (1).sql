-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 09:29 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comment_review`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `auto_id` int(11) NOT NULL,
  `comments` text DEFAULT NULL,
  `name_add` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `star_rating` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_bot` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`auto_id`, `comments`, `name_add`, `mobile_no`, `star_rating`, `created_at`, `is_bot`) VALUES
(1, 'Add comment', 'satyajit', '8999745565', 2, '2025-02-03 12:57:02', 0),
(2, 'The view here is absolutely breathtaking!\r\nCan’t wait to come back again soon.', 'Shubham Pawar', '8979898799', 3, '2025-02-03 12:58:29', 0),
(3, 'Nice Review', 'Aadesh Phand', '9876542122', 3, '2025-02-03 12:59:08', 0),
(5, 'Tried the spicy ramen and it blew my mind!\r\nDefinitely a must-try if you love heat.', 'Rushikesh Shinde', '7898586420', 2, '2025-02-04 04:56:30', 0),
(6, 'Best Place to Visit', 'Varun Sharma', '9865741230', 2, '2025-02-04 06:57:34', 0),
(7, 'Every bite was full of flavor and love.\r\nHighly recommend the chef’s special', 'Nitin Jadhavar', '7648951230', 1, '2025-02-04 06:59:40', 0),
(8, 'Fresh ingredients and bold flavors!\r\nIt’s food that makes you feel good.', 'Anisha Kulkarni', '7895862140', 2, '2025-03-08 06:10:52', 0),
(9, 'Good Quality Experience', 'Nitish Kumar', '8546983201', 1, '2025-03-10 03:39:14', 0),
(10, 'Intended for the public to visit surely!', 'Manish Khanna', '7456328910', 2, '2025-03-10 03:51:07', 0),
(11, 'Efficent quantity with best quality without  compromise', 'Ajay Devgan', '7598614236', 3, '2025-03-10 03:54:07', 0),
(12, 'The dessert was out of this world!\r\nI’d come back just for the cheesecake', 'Dinesh Mule', '8469712350', 2, '2025-03-10 03:57:18', 0),
(13, 'Best User Friendly Experience', 'Vijay Varma', '7845632582', 2, '2025-03-10 03:58:06', 0),
(14, 'Peaceful, quiet, and perfect for reflection.\r\nA place to disconnect and recharge', 'Vipul Wani', '7458689233', 3, '2025-03-10 04:00:23', 0),
(15, 'Great service and even better coffee.\r\nA solid 10/10 for brunch lovers.', 'Mithilesh Jedhe', '8446587334', 3, '2025-04-23 04:25:58', 0),
(16, 'Every bite was full of flavor and love.\r\nHighly recommend the chef’s special', 'Avinash Singh', '8446587334', 3, '2025-04-23 04:26:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_credentials`
--

CREATE TABLE `company_credentials` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `company_location` varchar(255) DEFAULT NULL,
  `company_url` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `google_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_credentials`
--

INSERT INTO `company_credentials` (`id`, `company_name`, `company_logo`, `company_location`, `company_url`, `user_id`, `google_url`) VALUES
(1, 'Cibbo', 'uploads/xyz8.jpg', 'Fergusson, Pune', 'https://cibbo.in/', 15, 'https://g.page/r/CRhP63_LKd7zEBM/review'),
(16, 'Yewale Amruttulya', 'uploads/xyz8.jpg', 'Baner, Pune', 'https://www.yewaleamruttulya.com/', 17, 'https://g.page/r/CRhP63_LKd7zEBM/review'),
(17, 'Spintech Info', 'uploads/Spintech4.jpg', 'Balewadi, Pune', 'https://www.spintech.info/', 19, 'https://g.page/r/CRhP63_LKd7zEBM/review'),
(18, 'Starbucks', 'uploads/xyz8.jpg', 'Koregaon Park, Pune', 'https://starbucks.in/', 18, 'https://g.page/r/CRhP63_LKd7zEBM/review'),
(19, 'Hitech Company', 'uploads/Spintech5.jpg', 'Magarpatta, Hadapsar, Pune.', 'https://www.hiteh.com', 16, 'https://www.hitech.com');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `category`, `keyword`, `is_active`, `created_at`) VALUES
(1, 'service_quality', 'professional', 1, '2025-05-08 09:41:17'),
(2, 'service_quality', 'efficient', 1, '2025-05-08 09:41:17'),
(3, 'service_quality', 'attentive', 1, '2025-05-08 09:41:17'),
(4, 'service_quality', 'knowledgeable', 1, '2025-05-08 09:41:17'),
(5, 'service_quality', 'friendly', 1, '2025-05-08 09:41:17'),
(6, 'service_quality', 'helpful', 1, '2025-05-08 09:41:17'),
(7, 'service_quality', 'courteous', 1, '2025-05-08 09:41:17'),
(8, 'service_quality', 'responsive', 1, '2025-05-08 09:41:17'),
(9, 'product_quality', 'high quality', 1, '2025-05-08 09:41:17'),
(10, 'product_quality', 'durable', 1, '2025-05-08 09:41:17'),
(11, 'product_quality', 'reliable', 1, '2025-05-08 09:41:17'),
(12, 'product_quality', 'excellent', 1, '2025-05-08 09:41:17'),
(13, 'product_quality', 'premium', 1, '2025-05-08 09:41:17'),
(14, 'product_quality', 'well-made', 1, '2025-05-08 09:41:17'),
(15, 'product_quality', 'superior', 1, '2025-05-08 09:41:17'),
(16, 'customer_experience', 'satisfied', 1, '2025-05-08 09:41:17'),
(17, 'customer_experience', 'pleased', 1, '2025-05-08 09:41:17'),
(18, 'customer_experience', 'happy', 1, '2025-05-08 09:41:17'),
(19, 'customer_experience', 'impressed', 1, '2025-05-08 09:41:17'),
(20, 'customer_experience', 'delighted', 1, '2025-05-08 09:41:17'),
(21, 'customer_experience', 'exceeded expectations', 1, '2025-05-08 09:41:17'),
(22, 'customer_experience', 'great experience', 1, '2025-05-08 09:41:17'),
(23, 'customer_experience', 'wonderful experience', 1, '2025-05-08 09:41:17'),
(24, 'business_specific', 'on-time', 1, '2025-05-08 09:41:17'),
(25, 'business_specific', 'clean', 1, '2025-05-08 09:41:17'),
(26, 'business_specific', 'organized', 1, '2025-05-08 09:41:17'),
(27, 'business_specific', 'affordable', 1, '2025-05-08 09:41:17'),
(28, 'business_specific', 'value for money', 1, '2025-05-08 09:41:17'),
(29, 'business_specific', 'recommend', 1, '2025-05-08 09:41:17'),
(30, 'business_specific', 'will return', 1, '2025-05-08 09:41:17'),
(31, 'business_specific', 'highly recommend', 1, '2025-05-08 09:41:17');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `timestam` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('super_admin','admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `username`, `password`, `timestam`, `role`) VALUES
(1, 'Super Admin', 'superadmin@admin.com', 'admin123', '2025-05-08 09:34:07', 'super_admin'),
(15, 'Rajaravi Varma', 'rajaravi@gmail.com', 'rajaravi', '2025-05-08 09:42:45', 'admin'),
(16, 'Ramesh Yadav', 'rameshyadav@gmail.com', 'ramesh', '2025-05-08 09:46:04', 'admin'),
(17, 'Vikas Sharma', 'vikas_sharma@gmail.com', 'vikas', '2025-05-08 11:29:33', 'admin'),
(18, 'Sachin Ubale', 'sachinubale@gmail.com', 'sachin', '2025-05-08 11:42:13', 'admin'),
(19, 'Rushikesh Jadhav', 'rushikeshjadhav@gmail.com', 'rushikesh', '2025-05-08 11:42:53', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_credentials`
--

CREATE TABLE `smtp_credentials` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_port` int(11) NOT NULL,
  `smtp_email` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `encryption` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `smtp_credentials`
--

INSERT INTO `smtp_credentials` (`id`, `user_id`, `smtp_host`, `smtp_port`, `smtp_email`, `smtp_password`, `encryption`) VALUES
(1, 1, 'smtp.gmail.com', 1111, 'superadmin@admin.com', 'admin123', 'ssl'),
(2, 15, 'smtp.gmail.com', 2222, 'rajaravi@gmail.com', 'rajaravi', 'ssl'),
(3, 16, 'ramesh.smtp.com', 3333, 'rameshyadav@gmail.com', 'ramesh', 'ssl'),
(4, 17, 'vikas.smtp.com', 4444, 'vikas_sharma@gmail.com', 'vikas', 'ssl'),
(5, 18, 'sachin.smtp.com', 5555, 'sachinubale@gmail.com', 'sachin', 'ssl'),
(6, 19, 'rushikesh.smtp.com', 6666, 'rushikeshjadhav@gmail.com', 'rushikesh', 'tls');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `company_credentials`
--
ALTER TABLE `company_credentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keywords`
--
ALTER TABLE `keywords`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_keyword` (`category`,`keyword`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp_credentials`
--
ALTER TABLE `smtp_credentials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `company_credentials`
--
ALTER TABLE `company_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `smtp_credentials`
--
ALTER TABLE `smtp_credentials`
  ADD CONSTRAINT `smtp_credentials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
