-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 07, 2025 at 06:13 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `created_at`) VALUES
(49, 1, '2025-01-07 13:19:15'),
(15, 9, '2024-12-29 18:20:56'),
(16, 5, '2024-12-30 10:42:46'),
(47, 3, '2025-01-07 13:09:20'),
(20, 6, '2024-12-30 20:08:13'),
(34, 7, '2025-01-06 14:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `added_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  KEY `cart_id` (`cart_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`item_id`, `cart_id`, `product_id`, `quantity`, `added_at`) VALUES
(23, 1, 10, 1, '2024-12-29 17:54:24'),
(44, 1, 8, 1, '2024-12-30 18:50:40'),
(43, 1, 1, 1, '2024-12-30 17:50:51'),
(17, 14, 1, 1, '2024-12-29 16:42:34'),
(121, 40, 20, 1, '2025-01-07 11:30:40'),
(120, 40, 11, 1, '2025-01-07 11:30:37'),
(122, 41, 22, 1, '2025-01-07 11:36:35'),
(34, 16, 2, 1, '2024-12-30 10:44:24'),
(35, 16, 7, 2, '2024-12-30 10:47:00'),
(37, 17, 1, 1, '2024-12-30 17:33:11'),
(51, 20, 6, 1, '2024-12-30 20:08:13'),
(62, 18, 14, 1, '2025-01-02 23:44:47'),
(61, 18, 1, 1, '2025-01-02 23:20:48'),
(58, 18, 7, 1, '2025-01-02 14:45:43'),
(48, 19, 12, 1, '2024-12-30 19:45:36'),
(49, 19, 7, 1, '2024-12-30 19:45:37'),
(52, 20, 5, 4, '2024-12-30 20:11:29'),
(53, 20, 8, 1, '2024-12-30 20:11:31'),
(63, 21, 23, 1, '2025-01-03 00:39:53'),
(64, 22, 23, 1, '2025-01-03 00:40:30'),
(65, 23, 23, 1, '2025-01-03 00:41:36'),
(66, 23, 22, 1, '2025-01-03 00:41:37'),
(67, 23, 11, 1, '2025-01-03 00:41:41'),
(68, 24, 22, 1, '2025-01-03 00:54:56'),
(69, 17, 15, 1, '2025-01-03 01:00:22'),
(71, 25, 20, 1, '2025-01-03 01:07:29'),
(72, 25, 10, 1, '2025-01-03 01:07:34'),
(73, 25, 16, 1, '2025-01-03 01:07:37'),
(74, 26, 23, 1, '2025-01-03 01:08:20'),
(75, 26, 12, 1, '2025-01-03 01:08:23'),
(76, 26, 1, 1, '2025-01-03 01:08:27'),
(77, 27, 11, 1, '2025-01-03 01:09:47'),
(78, 28, 22, 1, '2025-01-03 01:10:30'),
(79, 1, 23, 5, '2025-01-03 01:25:11'),
(90, 29, 12, 1, '2025-01-05 10:39:32'),
(81, 29, 15, 1, '2025-01-03 01:29:35'),
(82, 29, 6, 1, '2025-01-03 01:29:39'),
(83, 1, 14, 3, '2025-01-04 11:53:12'),
(84, 1, 11, 1, '2025-01-04 11:54:00'),
(85, 30, 1, 1, '2025-01-04 11:56:49'),
(86, 30, 13, 1, '2025-01-04 11:56:54'),
(87, 16, 23, 4, '2025-01-04 12:01:38'),
(88, 31, 22, 1, '2025-01-04 12:34:47'),
(89, 31, 6, 1, '2025-01-04 12:35:00'),
(99, 32, 20, 1, '2025-01-07 10:11:36'),
(92, 32, 22, 3, '2025-01-05 10:40:20'),
(93, 32, 23, 1, '2025-01-05 10:40:24'),
(97, 33, 22, 2, '2025-01-06 14:23:42'),
(103, 35, 26, 1, '2025-01-07 10:30:58'),
(101, 32, 10, 1, '2025-01-07 10:11:44'),
(104, 35, 13, 1, '2025-01-07 10:31:00'),
(105, 35, 12, 1, '2025-01-07 10:31:01'),
(106, 36, 14, 1, '2025-01-07 10:32:32'),
(107, 36, 11, 1, '2025-01-07 10:32:33'),
(108, 36, 26, 1, '2025-01-07 10:32:36'),
(109, 37, 4, 1, '2025-01-07 10:37:58'),
(110, 37, 10, 2, '2025-01-07 10:38:04'),
(112, 37, 1, 1, '2025-01-07 10:55:43'),
(113, 38, 11, 3, '2025-01-07 11:01:07'),
(117, 38, 15, 1, '2025-01-07 11:04:26'),
(116, 38, 12, 1, '2025-01-07 11:04:21'),
(119, 39, 15, 1, '2025-01-07 11:07:20'),
(124, 42, 22, 1, '2025-01-07 11:45:59'),
(125, 42, 14, 1, '2025-01-07 11:46:01'),
(126, 42, 7, 1, '2025-01-07 11:46:04'),
(127, 43, 22, 1, '2025-01-07 11:46:35'),
(132, 39, 26, 1, '2025-01-07 12:20:28'),
(129, 44, 22, 1, '2025-01-07 12:01:50'),
(130, 44, 6, 1, '2025-01-07 12:18:27'),
(133, 45, 26, 1, '2025-01-07 12:33:37'),
(134, 45, 15, 1, '2025-01-07 12:33:40'),
(135, 46, 22, 1, '2025-01-07 12:34:33'),
(137, 46, 20, 1, '2025-01-07 12:34:43'),
(138, 39, 5, 1, '2025-01-07 12:35:14'),
(139, 39, 1, 1, '2025-01-07 12:35:17'),
(141, 46, 11, 1, '2025-01-07 13:14:14'),
(142, 48, 5, 1, '2025-01-07 13:15:40'),
(143, 48, 13, 1, '2025-01-07 13:15:43'),
(144, 48, 26, 1, '2025-01-07 13:18:24'),
(145, 49, 20, 1, '2025-01-07 13:19:15'),
(146, 49, 15, 1, '2025-01-07 13:19:17'),
(147, 49, 11, 1, '2025-01-07 13:19:20'),
(149, 47, 11, 1, '2025-01-07 13:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_title` text NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Computers'),
(2, 'Chargers and Cables'),
(3, 'Components'),
(4, 'Storage Devices'),
(5, 'Accessories');

-- --------------------------------------------------------

--
-- Table structure for table `customer_order`
--

DROP TABLE IF EXISTS `customer_order`;
CREATE TABLE IF NOT EXISTS `customer_order` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_order`
--

INSERT INTO `customer_order` (`order_id`, `user_id`, `order_date`, `total_amount`) VALUES
(29, 1, '2025-01-07 11:55:50', 236000.00),
(2, 1, '2025-01-01 12:20:29', 408000.00),
(3, 1, '2025-01-01 12:20:30', 408000.00),
(4, 1, '2025-01-01 12:20:30', 408000.00),
(5, 1, '2025-01-01 12:20:31', 408000.00),
(6, 1, '2025-01-01 12:20:31', 408000.00),
(7, 3, '2025-01-01 23:27:56', 120000.00),
(8, 1, '2025-01-03 00:55:16', 140500.00),
(9, 1, '2025-01-03 01:09:03', 140500.00),
(10, 1, '2025-01-03 01:38:37', 140500.00),
(11, 1, '2025-01-03 01:39:57', 450.00),
(12, 1, '2025-01-03 01:40:36', 450.00),
(13, 1, '2025-01-03 01:41:48', 10850.00),
(14, 1, '2025-01-03 01:50:02', 10850.00),
(15, 1, '2025-01-03 01:55:00', 7900.00),
(16, 3, '2025-01-03 02:00:28', 124900.00),
(17, 3, '2025-01-03 02:07:42', 60700.00),
(18, 3, '2025-01-03 02:07:46', 60700.00),
(19, 3, '2025-01-03 02:08:40', 132350.00),
(20, 3, '2025-01-03 02:09:50', 2500.00),
(21, 3, '2025-01-03 02:10:33', 7900.00),
(22, 4, '2025-01-04 12:56:30', 13400.00),
(23, 4, '2025-01-04 13:33:58', 129900.00),
(24, 1, '2025-01-05 11:39:37', 135800.00),
(25, 1, '2025-01-07 11:12:08', 60300.00),
(26, 4, '2025-01-07 11:30:04', 126900.00),
(27, 4, '2025-01-07 11:31:05', 22250.00),
(28, 1, '2025-01-07 11:32:51', 21950.00),
(33, 1, '2025-01-07 12:44:13', 43950.00),
(35, 1, '2025-01-07 13:18:39', 127350.00),
(39, 1, '2025-01-07 14:18:36', 59500.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `item_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 9, 14, 1, 19000.00),
(2, 9, 1, 1, 120000.00),
(3, 9, 7, 1, 1500.00),
(4, 10, 14, 1, 19000.00),
(5, 10, 1, 1, 120000.00),
(6, 10, 7, 1, 1500.00),
(7, 11, 23, 1, 450.00),
(8, 12, 23, 1, 450.00),
(9, 13, 23, 1, 450.00),
(10, 13, 22, 1, 7900.00),
(11, 13, 11, 1, 2500.00),
(12, 14, 23, 1, 450.00),
(13, 14, 22, 1, 7900.00),
(14, 14, 11, 1, 2500.00),
(15, 15, 22, 1, 7900.00),
(16, 16, 1, 1, 120000.00),
(17, 16, 15, 1, 4900.00),
(18, 17, 20, 1, 41000.00),
(19, 17, 10, 1, 6500.00),
(20, 17, 16, 1, 13200.00),
(21, 18, 20, 1, 41000.00),
(22, 18, 10, 1, 6500.00),
(23, 18, 16, 1, 13200.00),
(24, 19, 23, 1, 450.00),
(25, 19, 12, 1, 11900.00),
(26, 19, 1, 1, 120000.00),
(27, 20, 11, 1, 2500.00),
(28, 21, 22, 1, 7900.00),
(29, 22, 12, 1, 11900.00),
(30, 22, 7, 1, 1500.00),
(31, 23, 1, 1, 120000.00),
(32, 23, 13, 1, 9900.00),
(33, 24, 12, 1, 11900.00),
(34, 24, 15, 1, 4900.00),
(35, 24, 6, 1, 119000.00),
(36, 25, 20, 1, 41000.00),
(37, 25, 22, 1, 7900.00),
(38, 25, 15, 1, 4900.00),
(39, 25, 10, 1, 6500.00),
(40, 26, 22, 1, 7900.00),
(41, 26, 6, 1, 119000.00),
(42, 27, 26, 1, 450.00),
(43, 27, 13, 1, 9900.00),
(44, 27, 12, 1, 11900.00),
(45, 28, 14, 1, 19000.00),
(46, 28, 11, 1, 2500.00),
(47, 28, 26, 1, 450.00),
(48, 29, 4, 1, 103000.00),
(49, 29, 10, 2, 6500.00),
(50, 29, 1, 1, 120000.00),
(51, 30, 11, 3, 2500.00),
(52, 30, 15, 1, 4900.00),
(53, 30, 12, 1, 11900.00),
(54, 30, 22, 1, 7900.00),
(55, 31, 22, 1, 7900.00),
(56, 32, 22, 1, 7900.00),
(57, 33, 20, 1, 41000.00),
(58, 33, 11, 1, 2500.00),
(59, 33, 26, 1, 450.00),
(60, 34, 22, 1, 7900.00),
(61, 34, 14, 1, 19000.00),
(62, 34, 7, 1, 1500.00),
(63, 35, 26, 1, 450.00),
(64, 35, 22, 1, 7900.00),
(65, 35, 6, 1, 119000.00),
(72, 38, 22, 1, 7800.00),
(73, 38, 20, 1, 41000.00),
(74, 38, 11, 1, 2500.00),
(75, 39, 5, 1, 49000.00),
(76, 39, 13, 1, 9900.00),
(77, 39, 26, 1, 600.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_cat` int NOT NULL,
  `product_brand` varchar(100) NOT NULL,
  `product_title` varchar(50) NOT NULL,
  `product_price` float NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `product_cat` (`product_cat`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_image`) VALUES
(1, 1, 'DELL', 'Dell Precision 5510', 120000, 'Ordinateur portable - Station de travail mobile.\r\n', 'images/DellPrecision5510.png'),
(2, 1, 'DELL', 'Dell Precision 5530', 140000, 'Ordinateur portable - Station de travail mobile', 'images/DellPrecision5530.png'),
(3, 1, 'HP', 'HP ZBook Studio', 140000, 'Station de travail mobile HP ZBook Studio G5', 'images/HPZBOOK.png'),
(4, 1, 'HP', 'PC portable HP i5-1135G7 ', 103000, 'PC portable HP i5-1135G7 8GB/256GB/15.6″', 'images/HPpc.png'),
(5, 1, 'Lenovo', 'Pc portable Lenovo Thinkpad L14', 49000, 'Pc portable Lenovo Thinkpad L14 AMD Ryzen 3 pro/ 8GB/256 NVMe/ 14″', 'images/LenovoThinkpadL14.png'),
(6, 1, 'Lenovo', 'Lenovo IdeaPad-3', 119000, 'PC-Portable Lenovo IdeaPad-3 15ITL6 i5-1135G7|8GB|1TB HDD|GPU MX350 2GB|15.6″', 'images/LenovoIdeaPad.png'),
(7, 2, 'HP', 'Chargeur Compatible HP 19.5V', 1500, 'Chargeur Compatible HP 19.5V 3.33A 4.8mm*1.7mm', 'images/HPCharger.png'),
(8, 2, 'Toshiba', 'Chargeur 15V 4A', 1500, 'Chargeur 15V 4A (6.3×3.0) Compatible pour Toshiba', 'images/ToshibaCharger.png'),
(9, 5, 'Dell', 'Clavier Dell Latitude E5440 Qwerty', 4000, 'Clavier Dell Latitude E5440 Qwerty', 'images/clavierDell.png'),
(10, 5, 'HAVIT', 'Clavier Mécanique Havit KB877L', 6500, 'Clavier Mécanique Havit KB877L Rétro-éclairé USB Type-C', 'images/ClavierHavit.png'),
(11, 5, 'HAVIT', 'Souris RGB Havit Sans-Fil MS65WB', 2500, 'Souris RGB Havit Sans-Fil MS65WB rechargable', 'images/SourisHavit.png'),
(12, 3, 'NVIDIA', 'NVIDIA GeForce GT610 2GB Carte Graphique', 11900, 'NVIDIA GeForce GT610 2GB Carte Graphique First-Tech', 'images/NVIDIAGeForce.png'),
(13, 3, 'NVIDIA', 'NVIDIA GeForce GT730 4GB Carte Graphique', 9900, 'NVIDIA GeForce GT730 4GB Carte Graphique First-Tech', 'images/NVIDIAGeForceGT730'),
(14, 3, 'MSI', 'Carte Mère MSI A520M-A PRO', 19000, 'Carte Mère MSI A520M-A PRO', 'IMAGES/CarteMereMSI.png'),
(15, 4, 'DAHUA', 'DISQUE SSD 256GB DAHUA C800A', 4900, 'DISQUE SSD 256GB DAHUA C800A', 'images/DisqueDAHUA.png'),
(16, 4, 'ADATA', 'SSD NVMe 1TB Adata LEGEND 710 PCIe Gen3 x4', 13200, 'SSD NVMe 1TB Adata LEGEND 710 PCIe Gen3 x4', 'images/SSDADATA.png'),
(20, 1, 'DELL', 'Pc portable Dell Latitude E5470', 41000, 'Pc portable Dell Latitude E5470 i5-6ème/ 8GB/256GB SSD/ 14″', 'images/dellLatitude.png'),
(22, 4, 'Toshiba', 'Disque HDD 3.5″ 1TB Toshiba', 7900, 'Disque HDD 3.5″ 1TB ', 'images/disqueHDD.png'),
(26, 2, 'Lenovo', 'Cable DC Lenovo PIN 65 W', 600, 'Cable DC Lenovo ', 'images/Cable-pc.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mobile` int NOT NULL,
  `address` varchar(250) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `mobile`, `address`, `is_admin`) VALUES
(1, 'Lina', 'baroud', 'baroudlina@gmail.com', '$2y$10$i27ziGO5zxtYrzhK4fyo9OhpZcXBhvMYypGEJxR7PYPx1OSjyWYZq', 558265372, 'BEZ', 0),
(3, 'yasmine', 'ba', 'baroudyasmine@gmail.com', '$2y$10$ZkcP84bupSuBu02p1.Hzt.v8DpaZJPkxRMecMxSeCQ4j7wB5mdjWu', 553382048, 'BEZ', 0),
(4, 'hocine', 'ba', 'hocineba@gmail.com', '$2y$10$ci7yJW6sJRYyW3L4pqkKd.1/g3ZPob4abwd3WpyEc.eb.CzjDjO1a', 558265371, 'ALGER', 0),
(6, 'ines', 'yahia', 'ines@gmail.com', '$2y$10$XiTc9ZIefnZ8r1/GpDMO8eBUINEkf2Amw.G/ZEX6adKHLfcxM24rC', 558265323, 'bourj', 0),
(7, 'admin', 'test', 'admin@example.com', '$2y$10$hLAWETiB9InRzg4JevYIn.n./i4kXWzeVf3/ERN0fv9CSTmwUbR2S', 558265379, 'alger', 1),
(15, 'adel', 'ba', 'adelba@gmail.com', '$2y$10$JwKziS3WhNWiec1i5/F89OXLlZHWh6lsBiSZwU0f0TYpLW0ptwXD6', 558265345, 'setif', 0),
(20, 'meriem', 'asma', 'asmameriem@gmail.com', '$2y$10$9gr6hO9kiNgaWV7yCBBLKOc6gtOED25ARuqCMxpyvW8LkOraaNaLG', 558265343, 'alger', 0),
(19, 'khawla', 'samet', 'khawlasamet@gmail.com', '$2y$10$IBM53R/N27cA.mPVUB/FZuX8du.CdettI2AozJVioULybO0u1aPpS', 558265360, 'alger', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_cat`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
