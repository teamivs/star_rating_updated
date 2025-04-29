-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 06:35 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET
  AUTOCOMMIT = 0;

START TRANSACTION;

SET
  time_zone = "+00:00";

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
CREATE TABLE
  `comments` (
    `auto_id` int (11) NOT NULL,
    `comments` text DEFAULT NULL,
    `name_add` varchar(255) DEFAULT NULL,
    `mobile_no` varchar(255) DEFAULT NULL,
    `star_rating` int (11) DEFAULT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `comments`
--
INSERT INTO
  `comments` (
    `auto_id`,
    `comments`,
    `name_add`,
    `mobile_no`,
    `star_rating`,
    `created_at`
  )
VALUES
  (
    1,
    'Add comment',
    'satyajit',
    '8999745565',
    2,
    '2025-02-03 12:57:02'
  ),
  (
    2,
    'add comment 2',
    'Shubham',
    '897989879879',
    2,
    '2025-02-03 12:58:29'
  ),
  (
    3,
    'wqewqewq',
    'adesh',
    '6456548',
    3,
    '2025-02-03 12:59:08'
  ),
  (
    5,
    'aewqeq',
    'wewqewqe',
    '32423234',
    2,
    '2025-02-04 04:56:30'
  ),
  (
    6,
    '3242423423fsdfds',
    'sdfsf',
    '434234',
    1,
    '2025-02-04 06:57:34'
  ),
  (
    7,
    'fsdfs',
    'sdfd',
    '423423',
    1,
    '2025-02-04 06:59:40'
  ),
  (
    8,
    'ascd',
    'apurva',
    '1234',
    2,
    '2025-03-08 06:10:52'
  ),
  (9, NULL, NULL, NULL, 0, '2025-03-10 03:39:14'),
  (10, '22', 'a', '11', 2, '2025-03-10 03:51:07'),
  (
    11,
    '111111111111',
    'A',
    '122',
    3,
    '2025-03-10 03:54:07'
  ),
  (12, 's', 'a', '11', 2, '2025-03-10 03:57:18'),
  (13, 's', 'a', '11', 2, '2025-03-10 03:58:06'),
  (14, NULL, NULL, NULL, 0, '2025-03-10 04:00:23'),
  (
    15,
    'test',
    'apurva',
    '8446587334',
    3,
    '2025-04-23 04:25:58'
  ),
  (
    16,
    'test',
    'apurva',
    '8446587334',
    3,
    '2025-04-23 04:26:09'
  );

-- --------------------------------------------------------
--
-- Table structure for table `company_credentials`
--
CREATE TABLE
  `company_credentials` (
    `id` int (11) NOT NULL,
    `company_name` varchar(255) NOT NULL,
    `company_logo` varchar(255) DEFAULT NULL,
    `company_url` varchar(255) NOT NULL,
    `company_location` varchar(255) DEFAULT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- --------------------------------------------------------
--
-- Table structure for table `login`
--
CREATE TABLE
  `login` (
    `id` int (11) NOT NULL,
    `name` varchar(255) NOT NULL,
    `username` varchar(255) DEFAULT NULL,
    `password` varchar(255) DEFAULT NULL,
    `role` enum ('super_admin', 'admin') NOT NULL DEFAULT 'admin',
    `timestam` timestamp NOT NULL DEFAULT current_timestamp()
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `login`
--
INSERT INTO
  `login` (
    `id`,
    `name`,
    `username`,
    `password`,
    `role`,
    `timestam`
  )
VALUES
  (
    6,
    'apurva',
    'admin@gmail.com',
    'admin',
    'admin',
    '2025-03-08 06:28:14'
  ),
  (
    8,
    'aaa',
    'admin@gmail.com',
    '$2y$10$SalgwgfYsRHvfN6RKs5LBuWpcOyZKHzH0t7cfyZ.9WRHrqk.Nraea',
    'admin',
    '2025-03-08 08:04:47'
  ),
  (
    9,
    'aa',
    'admin@gmail.com',
    '$2y$10$Gz5iXSbKzrChF/rg0Kz1nu8rOBqAyvWjcL9EGXgfHdkUxy2jrj62q',
    'admin',
    '2025-03-08 08:07:13'
  ),
  (
    11,
    'avc',
    'admin@gmail.com',
    '$2y$10$2m6ah13/Bw9NpgmNjFl8lOwcUNQpdBv9rZLcxg/C6wjxD02kDyvV2',
    'admin',
    '2025-03-08 08:12:50'
  ),
  (
    12,
    'avc',
    'admin@gmail.com',
    '$2y$10$cLToRKZliKJU8jZlQEZh7uPjPpiQ2CxcagyGF67vw5NyMYfHLxNIq',
    'admin',
    '2025-03-08 08:13:13'
  ),
  (
    13,
    'aa',
    'admin@gmail.com',
    'admin',
    'admin',
    '2025-03-08 11:42:41'
  ),
  (
    14,
    'ac',
    'admin@gmail.com',
    'admin',
    'admin',
    '2025-03-08 11:44:00'
  );

-- Insert super admin user
INSERT INTO
  `login` (`name`, `username`, `password`, `role`)
VALUES
  (
    'Super Admin',
    'superadmin@admin.com',
    'admin123',
    'super_admin'
  );

-- --------------------------------------------------------
--
-- Table structure for table `smtp_credentials`
--
CREATE TABLE
  `smtp_credentials` (
    `id` int (11) NOT NULL,
    `user_id` int (11) NOT NULL,
    `smtp_host` varchar(255) NOT NULL,
    `smtp_port` int (11) NOT NULL,
    `smtp_email` varchar(255) NOT NULL,
    `smtp_password` varchar(255) NOT NULL,
    UNIQUE KEY `user_id` (`user_id`),
    CONSTRAINT `smtp_credentials_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`) ON DELETE CASCADE
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

--
-- Dumping data for table `smtp_credentials`
--
INSERT INTO
  `smtp_credentials` (
    `id`,
    `smtp_host`,
    `smtp_port`,
    `smtp_email`,
    `smtp_password`
  )
VALUES
  (2, 'aaaa', 1111, 'admin@gmail.com', 'admin'),
  (3, 'aaaa', 1111, 'admin@gmail.com', 'admin');

--
-- Indexes for dumped tables
--
--
-- Indexes for table `comments`
--
ALTER TABLE `comments` ADD PRIMARY KEY (`auto_id`);

--
-- Indexes for table `company_credentials`
--
ALTER TABLE `company_credentials` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login` ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp_credentials`
--
ALTER TABLE `smtp_credentials` ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments` MODIFY `auto_id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 17;

--
-- AUTO_INCREMENT for table `company_credentials`
--
ALTER TABLE `company_credentials` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 15;

--
-- AUTO_INCREMENT for table `smtp_credentials`
--
ALTER TABLE `smtp_credentials` MODIFY `id` int (11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;