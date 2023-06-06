-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2023 at 04:55 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `huge`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `house_number` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `city`, `house_number`, `zip`, `street`, `user_id`) VALUES
(1, 'Graz', '12', '8010', 'Strasse', 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Hosen'),
(2, 'Jeans'),
(3, 'T-Shirts'),
(4, 'Hoodies'),
(5, 'Mäntel'),
(6, 'Jacken'),
(7, 'Hemden');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL,
  `message_sent_at` datetime NOT NULL,
  `message` text NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `from_user_id` (`from_user_id`),
  KEY `to_user_id` (`to_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `message_sent_at`, `message`, `from_user_id`, `to_user_id`, `is_read`) VALUES
(35, '2023-03-30 19:21:32', 'Hallo, ich wollte nur mal die neue Chat Funktion ausprobieren!', 2, 1, 1),
(36, '2023-03-30 19:31:48', 'Nice, es hat super funktioniert, die Nachricht kommt bei mir an!', 1, 2, 1),
(37, '2023-03-30 19:35:42', 'Ich hoffe dir gefällt der Chat so wie er angezeigt wird', 2, 1, 1),
(38, '2023-03-30 19:35:42', '!', 2, 1, 1),
(39, '2023-04-19 10:39:26', 'Test', 1, 2, 1),
(40, '2023-04-19 10:39:31', 'Test neu', 1, 2, 1),
(41, '2023-04-19 10:45:08', 'Test 2', 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_number` int(11) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `order_placed_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `buyer_id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_number`),
  KEY `buyer_id` (`buyer_id`),
  KEY `payment_type` (`payment_type`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_number`, `payment_type`, `order_placed_at`, `buyer_id`, `address_id`) VALUES
(1, 1, '2023-05-10 08:52:49', 1, 1),
(2, 1, '2023-05-10 08:52:49', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

DROP TABLE IF EXISTS `payment_types`;
CREATE TABLE IF NOT EXISTS `payment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`) VALUES
(1, 'Rechnung'),
(2, 'Nachname');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `description` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `dt_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` datetime DEFAULT NULL,
  `dt_deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `rating`, `category`, `seller_id`, `dt_created`, `dt_updated`, `dt_deleted`) VALUES
(1, 'Product1', '22.22', 'Test', 'default.jpg', 1, 1, 24, '2023-05-12 22:01:22', NULL, NULL),
(2, 'Chips', '3.49', 'Test 3', 'default.jpg', NULL, 2, 24, '2023-05-12 22:01:22', NULL, NULL),
(3, 'test 2', '89.00', 'ewew', 'default.jpg', NULL, 7, 24, '2023-05-12 22:01:22', NULL, NULL),
(4, 'Smartphone Galaxy 99', '250.00', 'Super Bow', 'default.jpg', NULL, 3, 24, '2023-05-12 22:01:22', '2023-05-12 22:23:14', NULL),
(5, 'Iphone X', '35.00', 'Xpto Prod', 'default.jpg', NULL, 1, 24, '2023-05-12 22:01:22', NULL, NULL),
(6, 'Motorla xmas', '124.90', 'Prod ctc', 'default.jpg', NULL, 5, 24, '2023-05-12 22:01:22', NULL, NULL),
(7, 'Smartphone Galaxy 99', '250.10', 'Super Bow 992', NULL, NULL, NULL, 24, '2023-05-12 22:17:34', '2023-05-12 22:18:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_in_cart`
--

DROP TABLE IF EXISTS `products_in_cart`;
CREATE TABLE IF NOT EXISTS `products_in_cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` varchar(250) NOT NULL,
  `dt_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` datetime DEFAULT NULL,
  `dt_deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_number` (`id`),
  KEY `product_id` (`product_id`),
  KEY `size` (`size`),
  KEY `order_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_in_cart`
--

INSERT INTO `products_in_cart` (`id`, `product_id`, `price`, `quantity`, `size`, `user_id`, `session_id`, `dt_created`, `dt_updated`, `dt_deleted`) VALUES
(21, 7, '250.10', 1, 5, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 03:33:50', NULL, '2023-05-13 03:56:07'),
(22, 2, '3.49', 5, 4, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 03:55:09', NULL, '2023-05-13 03:56:51'),
(23, 2, '3.49', 5, 4, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 03:55:53', NULL, '2023-05-13 03:56:05'),
(24, 3, '89.00', 2, 7, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 03:57:04', NULL, '2023-05-13 04:18:49'),
(25, 7, '250.10', 2, 4, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 04:00:31', NULL, '2023-05-13 04:18:51'),
(26, 1, '22.22', 2, 6, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 04:01:27', NULL, '2023-05-13 04:18:52'),
(27, 5, '35.00', 2, 7, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 04:16:07', '2023-05-13 04:18:40', '2023-05-13 04:18:47'),
(28, 1, '22.22', 56, 4, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 04:19:05', NULL, '2023-05-13 04:22:26'),
(29, 2, '3.49', 10, 1, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 04:22:14', NULL, '2023-05-13 04:22:29'),
(30, 3, '89.00', 36, 1, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 04:23:20', '2023-05-13 04:23:32', '2023-05-13 04:23:37'),
(31, 4, '250.00', 9, 3, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 04:24:15', '2023-05-13 04:27:32', '2023-05-13 13:44:52'),
(32, 2, '3.49', 2, 1, 24, '09i70rlifkkr5bgo2fbc71sn4s', '2023-05-13 12:02:59', NULL, '2023-05-13 13:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `products_ordered`
--

DROP TABLE IF EXISTS `products_ordered`;
CREATE TABLE IF NOT EXISTS `products_ordered` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `price` decimal(9,2) NOT NULL DEFAULT '0.00',
  `quantity` int(11) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `dt_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_updated` datetime DEFAULT NULL,
  `dt_deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_number` (`id`),
  KEY `product_id` (`product_id`),
  KEY `size` (`size`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rights_group`
--

DROP TABLE IF EXISTS `rights_group`;
CREATE TABLE IF NOT EXISTS `rights_group` (
  `account_type_id` smallint(11) NOT NULL,
  `account_type_name` varchar(75) NOT NULL,
  PRIMARY KEY (`account_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rights_group`
--

INSERT INTO `rights_group` (`account_type_id`, `account_type_name`) VALUES
(1, 'Gast'),
(2, 'User'),
(7, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `name`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL'),
(7, 'XXXL');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index',
  `session_id` varchar(48) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'stores session cookie id to prevent session concurrency',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(254) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s activation status',
  `user_deleted` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s deletion status',
  `user_has_avatar` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 if user has a local avatar, 0 if not',
  `user_remember_me_token` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s remember-me cookie token',
  `user_creation_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the creation of user''s account',
  `user_suspension_timestamp` bigint(20) DEFAULT NULL COMMENT 'Timestamp till the end of a user suspension',
  `user_last_login_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of user''s last login',
  `user_failed_logins` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'user''s failed login attempts',
  `user_last_failed_login` int(10) DEFAULT NULL COMMENT 'unix timestamp of last failed login attempt',
  `user_activation_hash` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s email verification hash string',
  `user_password_reset_hash` char(40) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'user''s password reset code',
  `user_password_reset_timestamp` bigint(20) DEFAULT NULL COMMENT 'timestamp of the password reset request',
  `user_provider_type` text COLLATE utf8_unicode_ci,
  `user_account_type` smallint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`),
  KEY `user_account_type` (`user_account_type`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `session_id`, `user_name`, `user_password_hash`, `user_email`, `user_active`, `user_deleted`, `user_has_avatar`, `user_remember_me_token`, `user_creation_timestamp`, `user_suspension_timestamp`, `user_last_login_timestamp`, `user_failed_logins`, `user_last_failed_login`, `user_activation_hash`, `user_password_reset_hash`, `user_password_reset_timestamp`, `user_provider_type`, `user_account_type`) VALUES
(1, NULL, 'demo', '$2y$10$OvprunjvKOOhM1h9bzMPs.vuwGIsOqZbw88rzSyGCTJTcE61g5WXi', 'demo@demo.com', 1, 0, 0, NULL, 1422205178, NULL, 1683706604, 0, NULL, NULL, NULL, NULL, 'DEFAULT', 7),
(2, NULL, 'demo2', '$2y$10$OvprunjvKOOhM1h9bzMPs.vuwGIsOqZbw88rzSyGCTJTcE61g5WXi', 'demo2@demo.com', 1, 0, 0, NULL, 1422205178, NULL, 1683479283, 0, NULL, NULL, NULL, NULL, 'DEFAULT', 2),
(21, NULL, 'dubb', '$2y$10$SzX.tz0W6xb6f6Nf8ejezeo9/goIfbUpb/p/4SlYGj2gEZE2IG3wq', 'dubb@d.at', 1, 0, 0, NULL, 1679479131, NULL, 1683096509, 0, NULL, NULL, NULL, NULL, 'DEFAULT', 7),
(23, NULL, 'demo3', '$2y$10$u1tyEyWSxrtH2.b./P697.ng.jodkfWX/jAQEeTDAHbLdM8taMHqe', 'test@test.at', 1, 0, 0, NULL, 1683269131, NULL, 1683269145, 0, NULL, NULL, NULL, NULL, 'DEFAULT', NULL),
(24, '09i70rlifkkr5bgo2fbc71sn4s', 'qa', '$2y$10$V4OqWm4GdfHI6F9V7qg6FO1rPG1zCYZDD7dghBAP494.M3MmOAK2W', 'qa@qa.com', 1, 0, 0, NULL, NULL, NULL, 1683940861, 0, NULL, NULL, NULL, NULL, 'DEFAULT', 7);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

--
-- Constraints for table `products_ordered`
--
ALTER TABLE `products_ordered`
  ADD CONSTRAINT `products_ordered_ibfk_1` FOREIGN KEY (`size`) REFERENCES `size` (`id`),
  ADD CONSTRAINT `products_ordered_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_number`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_account_type`) REFERENCES `rights_group` (`account_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
