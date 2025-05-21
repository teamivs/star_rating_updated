-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 09:12 AM
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
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
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

INSERT INTO `comments` (`auto_id`, `admin_id`, `comments`, `name_add`, `mobile_no`, `star_rating`, `created_at`, `is_bot`) VALUES
(1, 16, 'Great work environment with a solid team spirit. Leadership is supportive and encourages growth.', 'Satyajit Udgir', '8999745565', 2, '2025-05-03 12:57:02', 0),
(2, 16, 'The view here is absolutely breathtaking!\r\nCan’t wait to come back again soon.', 'Shubham Pawar', '8979898799', 3, '2025-02-03 12:58:29', 0),
(3, 15, 'Nice Review', 'Aadesh Phand', '9876542122', 3, '2025-02-03 12:59:08', 0),
(5, 17, 'Tried the spicy ramen and it blew my mind!\r\nDefinitely a must-try if you love heat.', 'Rushikesh Shinde', '7898586420', 2, '2025-02-04 04:56:30', 0),
(6, 18, 'Best Place to Visit', 'Varun Sharma', '9865741230', 2, '2025-02-04 06:57:34', 0),
(7, 19, 'Every bite was full of flavor and love.\r\nHighly recommend the chef’s special', 'Nitin Jadhavar', '7648951230', 1, '2025-02-04 06:59:40', 0),
(8, 19, 'Fresh ingredients and bold flavors!\r\nIt’s food that makes you feel good.', 'Anisha Kulkarni', '7895862140', 2, '2025-03-08 06:10:52', 0),
(9, 17, 'Good Quality Experience', 'Nitish Kumar', '8546983201', 1, '2025-03-10 03:39:14', 0),
(10, 18, 'Intended for the public to visit surely!', 'Manish Khanna', '7456328910', 2, '2025-03-10 03:51:07', 0),
(11, 19, 'Efficent quantity with best quality without  compromise', 'Ajay Devgan', '7598614236', 3, '2025-03-10 03:54:07', 0),
(12, 18, 'The dessert was out of this world!\r\nI’d come back just for the cheesecake', 'Dinesh Mule', '8469712350', 2, '2025-03-10 03:57:18', 0),
(13, 17, 'Best User Friendly Experience', 'Vijay Varma', '7845632582', 2, '2025-03-10 03:58:06', 0),
(14, 19, 'Peaceful, quiet, and perfect for reflection.\r\nA place to disconnect and recharge', 'Vipul Wani', '7458689233', 3, '2025-03-10 04:00:23', 0),
(15, 19, 'Great service and even better coffee.\r\nA solid 10/10 for brunch lovers.', 'Mithilesh Jedhe', '8446587334', 3, '2025-04-23 04:25:58', 0),
(16, 18, 'Every bite was full of flavor and love.\r\nHighly recommend the chef’s special', 'Avinash Singh', '8446587334', 3, '2025-04-23 04:26:09', 0),
(17, 15, 'Best company, good community, better service provided with good accomodation.', 'Ramesh Kashyap', '9865412374', 3, '2025-05-14 02:20:26', 0),
(18, 16, 'Nice service at the affordable cost with super performance of the products delivered.', 'Vishal Kulkarni', '7894587451', 2, '2025-05-14 02:23:09', 0),
(19, 16, 'Company was super awesome with satisfied service and good quality products.', 'Aniket Varma', '8745896312', 3, '2025-05-14 01:48:17', 0),
(20, 16, 'The company has a great culture, celebrating festivals with enthusiasm and offering a dedicated floor for recreational activities like a cafe.', 'Sarvesh Joshi', '8475958612', 1, '2025-05-12 02:11:50', 0),
(21, 16, 'HiTech’s AI-powered customer service tools are a game-changer! Their platform is intuitive, and the automated review responses saved us hours. Highly recommend their innovative solutions for any business looking to boost efficiency.', 'Siddhesh Wagh', '8795842310', 2, '2025-05-04 02:37:06', 0),
(22, 16, 'Disappointed with HiTech’s customer support. Their AI review tool kept crashing, and the response time for fixes was way too slow. Expected better from a tech-focused company.', 'Manish Motewar', '8756321490', 1, '2025-05-06 02:44:31', 0),
(23, 16, 'HiTech’s customer engagement tools are okay but not exceptional. The review analytics are helpful, but the interface feels dated. Could use a modern refresh to compete with newer platforms.', 'Sanjay Bhatt', '8759641230', 3, '2025-05-05 02:50:06', 0),
(24, 16, 'HiTech’s customer engagement tools are okay but not exceptional. The review analytics are helpful, but the interface feels dated. Could use a modern refresh to compete with newer platforms.', 'Richard Goel', '8457961850', 2, '2025-05-06 03:09:46', 0),
(25, 16, 'HiTech’s platform has potential, but the multilingual review support is buggy. Half the translations were off, which hurt our brand’s image. Hoping for updates soon.', 'Jitendra Kumar', '7548621392', 2, '2025-05-15 03:11:44', 0),
(26, 16, 'Fantabulous Service provided to me with great client support.', 'Nachiket Bhandari', '8745963212', 3, '2025-05-15 06:59:48', 0),
(27, 16, 'Better Services', 'Mithesh Kumar', '8754963850', 3, '2025-05-15 07:01:01', 0),
(28, 16, 'Customer Satisfaction with good quality products and services provided.', 'Jeevan Shah', '8754189635', 3, '2025-05-15 07:03:45', 0),
(29, 16, 'Got the superb experience with the services and was so much helpful.', 'Dinesh Tiwari', '8745963215', 3, '2025-05-21 01:39:52', 0);

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
(1, 'Cibbo Cafe and Bar | European Cafe and Bar', 'uploads/company_logos/8d131cd4b73b5da2ed91b3270e6f0914.png', 'Fergusson College, Pune', 'https://cibbo.in/', 15, 'https://g.page/r/CRhP63_LKd7zEBM/review'),
(16, 'Yewale Amruttulya', 'uploads/company_logos/23ccfd9089dd15d5824185704dfbf33b.png', 'Baner, Pune', 'https://www.yewaleamruttulya.com/', 17, 'https://g.page/r/CRhP63_LKd7zEBM/review'),
(17, 'Spintech Info', 'uploads/Spintech4.jpg', 'Balewadi, Pune', 'https://www.spintech.info/', 19, 'https://g.page/r/CRhP63_LKd7zEBM/review'),
(18, 'Starbucks', 'uploads/xyz8.jpg', 'Koregaon Park, Pune', 'https://starbucks.in/', 18, 'https://g.page/r/CRhP63_LKd7zEBM/review'),
(19, 'Hitech Company', 'uploads/company_logos/875d5a2cdb78a8bc7b2ac2ea6e15a4be.png', 'Magarpatta, Hadapsar, Pune.', 'https://www.hitech.com', 16, 'https://www.hitech.com');

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE `keywords` (
  `id` int(11) NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `keyword` varchar(100) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `admin_id`, `category`, `keyword`, `is_active`, `created_at`) VALUES
(1, 15, 'service_quality', 'professional', 1, '2025-05-08 09:41:17'),
(2, 16, 'service_quality', 'efficient', 1, '2025-05-08 09:41:17'),
(3, 15, 'service_quality', 'attentive', 0, '2025-05-08 09:41:17'),
(4, 17, 'service_quality', 'knowledgeable', 1, '2025-05-08 09:41:17'),
(5, 18, 'service_quality', 'friendly', 1, '2025-05-08 09:41:17'),
(6, 19, 'service_quality', 'helpful', 1, '2025-05-08 09:41:17'),
(7, 15, 'service_quality', 'courteous', 0, '2025-05-08 09:41:17'),
(8, 17, 'service_quality', 'responsive', 1, '2025-05-08 09:41:17'),
(9, 16, 'product_quality', 'high quality', 0, '2025-05-08 09:41:17'),
(10, 15, 'product_quality', 'durable', 1, '2025-05-08 09:41:17'),
(11, 17, 'product_quality', 'reliable', 1, '2025-05-08 09:41:17'),
(12, 18, 'product_quality', 'excellent', 1, '2025-05-08 09:41:17'),
(13, 19, 'product_quality', 'premium', 1, '2025-05-08 09:41:17'),
(14, 17, 'product_quality', 'well-made', 1, '2025-05-08 09:41:17'),
(15, 18, 'product_quality', 'superior', 1, '2025-05-08 09:41:17'),
(16, 16, 'customer_experience', 'satisfied', 0, '2025-05-08 09:41:17'),
(17, 19, 'customer_experience', 'pleased', 1, '2025-05-08 09:41:17'),
(18, 16, 'customer_experience', 'happy', 0, '2025-05-08 09:41:17'),
(19, 17, 'customer_experience', 'impressed', 1, '2025-05-08 09:41:17'),
(20, 18, 'customer_experience', 'delighted', 1, '2025-05-08 09:41:17'),
(21, 19, 'customer_experience', 'exceeded expectations', 1, '2025-05-08 09:41:17'),
(22, 18, 'customer_experience', 'great experience', 1, '2025-05-08 09:41:17'),
(23, 17, 'customer_experience', 'wonderful experience', 1, '2025-05-08 09:41:17'),
(24, 16, 'business_specific', 'on-time', 1, '2025-05-08 09:41:17'),
(25, 17, 'business_specific', 'clean', 1, '2025-05-08 09:41:17'),
(26, 16, 'business_specific', 'organized', 0, '2025-05-08 09:41:17'),
(27, 19, 'business_specific', 'affordable', 1, '2025-05-08 09:41:17'),
(28, 18, 'business_specific', 'value for money', 1, '2025-05-08 09:41:17'),
(29, 17, 'business_specific', 'revenue growth', 1, '2025-05-08 09:41:17'),
(30, 18, 'business_specific', 'profit margin', 1, '2025-05-08 09:41:17'),
(36, 16, 'service_quality', 'personalization', 0, '2025-05-14 05:54:57'),
(37, 16, 'service_quality', 'support', 1, '2025-05-14 05:56:05'),
(38, 16, 'service_quality', 'intuitiveness', 0, '2025-05-14 05:58:50'),
(39, 16, 'service_quality', 'flexibility', 1, '2025-05-14 05:59:57'),
(40, 16, 'product_quality', 'precision', 1, '2025-05-14 06:00:43');

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
  MODIFY `auto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `company_credentials`
--
ALTER TABLE `company_credentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `keywords`
--
ALTER TABLE `keywords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
