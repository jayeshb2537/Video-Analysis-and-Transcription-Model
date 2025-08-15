-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2025 at 12:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Super Admin','Admin','Manager') DEFAULT 'Admin',
  `email` varchar(255) NOT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `role`, `email`, `reset_token`, `reset_expires`) VALUES
(1, 'admin', '$2y$10$D/ICfFP7f7fR6As8w5UPGerdf.djft4bSmU7e6emkJoB3zpUN1m1m', 'Admin', 'jayeshborase200537@gmail.com', 'da1a196baf3906fe0dda1f6ff90454769ada59945cf600d0ccee5ccf6f7986910bbcbb66aad355ecd92ef27d3bc5947a494c', '2025-02-23 15:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'Pain Relief', '2025-02-16 12:29:57'),
(2, 'Antibiotics', '2025-02-16 12:29:57'),
(3, 'Cough & Cold', '2025-02-16 12:29:57'),
(4, 'Vitamins', '2025-02-16 12:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `first_name`, `last_name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Prakash', 'Nikam', 'jayeshborase200537@gmail.com', 'nice website', 'hii dear,\r\n\r\nnice website', '2025-03-29 10:30:51'),
(2, 'jayesh', 'borase', 'jayeshborase200537@gmail.com', 'nice website', 'best product', '2025-03-29 10:31:59'),
(3, 'Prakash', 'Nikam', 'jayeshborase200537@gmail.com', 'nice website', 'hiii hello bro', '2025-04-15 06:57:52');

-- --------------------------------------------------------

--
-- Table structure for table `financial_transactions`
--

CREATE TABLE `financial_transactions` (
  `id` int(11) NOT NULL,
  `type` enum('income','expense') NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `financial_transactions`
--

INSERT INTO `financial_transactions` (`id`, `type`, `amount`, `date`, `description`) VALUES
(1, 'income', 5000.00, '2025-03-01', 'Product Sales'),
(2, 'income', 7000.00, '2025-03-10', 'Service Revenue'),
(3, 'expense', 15000.00, '2025-03-05', 'Office Rent'),
(4, 'expense', 1500.00, '2025-03-12', 'Utilities');

-- --------------------------------------------------------

--
-- Table structure for table `news_updates`
--

CREATE TABLE `news_updates` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news_updates`
--

INSERT INTO `news_updates` (`id`, `title`, `content`, `created_at`, `image`) VALUES
(1, 'Pharmacist Presence', 'Stricter enforcement of regulations requiring registered pharmacists to be present in medical shops.', '2025-03-18 14:09:58', 'uploads/news/Pharma_Generic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` enum('processed','shipped','enroute','arrived','cancelled') NOT NULL DEFAULT 'processed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `payment_mode` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total_price`, `status`, `created_at`, `name`, `email`, `mobile`, `address`, `payment_mode`, `user_id`) VALUES
(4, 5000.00, 'shipped', '2025-02-16 14:50:39', 'Jayesh', 'jayeshborase200537@gmail.com', '6355537351', '64,shri nath ji residency,karadava road,,Surat City', '', 1),
(5, 50.00, 'enroute', '2025-03-20 11:02:06', 'Prakash Nikam', 'nikamprakash731@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', '', NULL),
(6, 120.00, 'processed', '2025-03-20 11:16:55', 'ram', 'ram121@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', '', NULL),
(7, 50.00, 'arrived', '2025-03-22 06:47:54', 'Prakash Nikam', 'jayeshborase123@gmail.com', '', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(8, 50.00, 'enroute', '2025-03-22 06:49:36', 'Prakash Nikam', 'jayeshborase123@gmail.com', '', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(9, 50.00, 'shipped', '2025-03-22 14:41:35', 'Prakash Nikam', 'jayeshborase123@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(10, 50.00, 'shipped', '2025-03-22 15:05:17', 'Prakash Nikam', 'jayeshborase123@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(11, 50.00, 'processed', '2025-03-22 15:07:40', 'Prakash Nikam', 'jayeshborase123@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(12, 50.00, 'processed', '2025-03-22 15:56:18', 'shiv Nikam', 'shiv123@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(13, 170.00, 'processed', '2025-03-22 16:04:53', 'vikas Nikam', 'vikhas123@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(14, 50.00, 'processed', '2025-03-22 16:06:08', 'Prakash Nikam', 'abc@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'COD', NULL),
(15, 120.00, 'processed', '2025-03-22 16:07:39', 'Prakash Nikam', 'abc@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'COD', NULL),
(16, 90.00, 'shipped', '2025-03-29 15:01:13', 'jay patel', 'jay123@gmail.com', '6544489756', '64 dindoli', 'Online', NULL),
(17, 50.00, 'enroute', '2025-03-30 06:51:35', 'ramu patel', 'ramu12@gmail.com', '5644435256', '545 dindoli', 'COD', NULL),
(18, 50.00, 'processed', '2025-03-30 17:13:34', 'jay patel', 'jay53@gmail.com', '65444589', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(19, 50.00, 'shipped', '2025-03-30 18:05:19', 'Prakash Nikam', 'jay123@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'COD', NULL),
(40, 4800.00, 'processed', '2025-04-01 06:49:12', 'vikas chena', 'vikash12@gmail.com', '121551163', '45 dindoli', 'Online', NULL),
(41, 40.00, 'processed', '2025-04-02 12:50:43', 'Prakash Nikam', 'nikamprakash731@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(42, 80.00, 'shipped', '2025-04-02 12:55:19', 'raghu patil', 'raghupatil1007@gmail.com', '9316549394', '23,dindoli', 'Online', NULL),
(43, 400.00, 'enroute', '2025-04-02 13:55:05', 'jayesh borase', 'jayeshborase372005@gmail.com', '6355537353', 'madhuram circle', 'Online', NULL),
(44, 400.00, 'enroute', '2025-04-03 05:03:35', 'Prakash Nikam', 'yasay67922@nokdot.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'COD', NULL),
(45, 18600.00, 'enroute', '2025-04-03 05:05:09', 'Prakash Nikam', 'work.raghupatil@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'COD', NULL),
(46, 400.00, 'arrived', '2025-04-03 05:40:12', 'Prakash Nikam', 'jayeshborase200537@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(47, 90.00, 'enroute', '2025-04-03 05:44:40', 'Prakash Nikam', 'jayeshborase372005@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'COD', NULL),
(48, 40.00, 'enroute', '2025-04-03 14:53:37', 'Prakash Nikam', 'jayeshborase372005@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'Online', NULL),
(49, 40.00, 'cancelled', '2025-04-03 14:55:50', 'Prakash Nikam', 'jayeshborase372005@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'COD', NULL),
(50, 40.00, 'processed', '2025-04-04 04:58:06', 'Prakash Nikam', 'jayeshborase372005@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'COD', NULL),
(51, 400.00, 'processed', '2025-04-04 09:10:40', 'Prakash Nikam', 'jayeshborase372005@gmail.com', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'COD', NULL),
(52, 40.00, 'enroute', '2025-04-14 05:04:20', 'ramesh nikam', 'jayeshborase372005@gmail.com', '8977765489', '64,shri nath ji residency,karadava road,,Surat City', 'COD', 3),
(53, 120.00, 'processed', '2025-04-14 05:53:11', 'ramesh borase', 'jayeshborase372005@gmail.com', '8977765489', '64,shri nath ji residency,karadava road,,Surat City', 'COD', NULL),
(54, 90.00, 'processed', '2025-04-14 06:58:47', 'ramesh borse', 'jayeshborase372005@gmail.com', '8977765489', '64,shri nath ji residency,karadava road,,Surat City', 'COD', NULL),
(55, 80.00, 'shipped', '2025-04-14 07:06:26', 'ramesh borse', 'jayeshborase372005@gmail.com', '8977765489', '64,shri nath ji residency,karadava road,,Surat City', 'COD', 3),
(56, 40.00, 'enroute', '2025-04-14 07:08:44', 'ramesh patel', 'jayeshborase372005@gmail.com', '8977765489', '64,shri nath ji residency,karadava road,,Surat City', 'COD', 7);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(3, 4, 13, 1, 50.00),
(4, 5, 13, 1, 50.00),
(5, 6, 14, 1, 120.00),
(6, 12, 13, 1, 50.00),
(7, 13, 13, 1, 50.00),
(8, 13, 14, 1, 120.00),
(9, 14, 13, 1, 50.00),
(10, 15, 14, 1, 120.00),
(11, 16, 15, 1, 90.00),
(12, 17, 13, 1, 50.00),
(13, 18, 13, 1, 50.00),
(14, 19, 13, 1, 50.00),
(17, 40, 14, 40, 120.00),
(18, 41, 13, 1, 40.00),
(19, 42, 15, 1, 80.00),
(20, 43, 13, 10, 40.00),
(21, 44, 13, 10, 40.00),
(22, 45, 17, 20, 930.00),
(23, 46, 13, 10, 40.00),
(24, 47, 14, 1, 90.00),
(25, 48, 13, 1, 40.00),
(26, 49, 13, 1, 40.00),
(27, 50, 13, 1, 40.00),
(28, 51, 13, 10, 40.00),
(29, 52, 13, 1, 40.00),
(30, 53, 16, 1, 120.00),
(31, 54, 14, 1, 90.00),
(32, 55, 15, 1, 80.00),
(33, 56, 13, 1, 40.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `big_description` longtext DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiry_date` date NOT NULL DEFAULT '2025-12-31',
  `discounted_price` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `description`, `big_description`, `price`, `stock`, `category_id`, `image`, `created_at`, `expiry_date`, `discounted_price`) VALUES
(13, 'Paracetamol', '', 'Pain relief medicine', 'Paracetamol is a valuable and widely accessible medication for pain and fever relief.\n\n However, responsible use and adherence to recommended dosages are essential to ensure safety and prevent potential complications.', 50.00, 10000, 1, 'Paracetamol.png', '2025-02-16 12:30:18', '2025-12-31', 40.00),
(14, 'Amoxicillin', '', 'Antibiotic medicine', 'Amoxicillin Tablets are a broad-spectrum antibiotic used to treat bacterial infections such as respiratory tract infections, urinary tract infections, ear infections, and skin infections. They belong to the penicillin group and work by inhibiting bacterial growth. Always take as prescribed by a healthcare professional.', 120.00, 50, 2, 'amoxicillin.jpg', '2025-02-16 12:30:18', '2025-12-31', 90.00),
(15, 'Cough Syrup', '', 'Used for cold and cough', 'Cough Syrup is a liquid medication used to relieve cough and throat irritation. It may contain expectorants to loosen mucus, suppressants to reduce coughing, or antihistamines for allergy-related coughs. Use as directed by a healthcare professional for effective relief.', 90.00, 80, 3, 'cough_syrup.jpg', '2025-02-16 12:30:18', '2025-12-31', 80.00),
(16, 'Vitamin C Tablets', '', 'Boosts immunity', 'Vitamin C Tablets are dietary supplements that help boost immunity, support skin health, and act as powerful antioxidants. They aid in collagen production, wound healing, and iron absorption. Take as directed by a healthcare professional for best results.', 150.00, 200, 4, 'vitamin_c.jpg', '2025-02-16 12:30:18', '2025-12-31', 120.00),
(17, 'insulin injection', 'diabetes', 'insulin injection for diabetes', 'Insulin Injection is a hormone used to manage blood sugar levels in people with diabetes. It helps the body use glucose for energy and prevents complications related to high blood sugar. Different types of insulin vary in onset and duration of action. Always use as directed by a healthcare professional.', 1000.00, 0, NULL, 'insulin_injection.jpg', '2025-02-23 14:54:32', '2025-12-31', 930.00),
(18, 'Thyroxine Sodium Tablets', 'Thyroid', 'Control Thyroid Disease', 'Thyroxine Sodium Tablets are used to treat hypothyroidism (an underactive thyroid), helping to restore normal thyroid hormone levels in the body. They contain levothyroxine sodium, a synthetic form of the thyroid hormone thyroxine (T4), which regulates metabolism, energy production, and overall body functions. These tablets are commonly prescribed for thyroid hormone replacement therapy and should be taken as directed by a doctor.', 170.00, 50, NULL, 'thyroxine.jpg', '2025-03-31 13:59:45', '2025-12-31', 150.00),
(20, 'Dulcoflex Tablets', 'Constipation', '', 'Dulcoflex Tablets contain bisacodyl, a stimulant laxative used to relieve constipation and promote bowel movements. They work by stimulating the bowel muscles and increasing water content in the intestines, making stool easier to pass. Dulcoflex is commonly used for short-term relief of constipation and bowel cleansing before medical procedures. It should be taken as directed by a doctor.', 230.00, 50, NULL, 'Dulcoflex_Tablets.webp', '2025-03-31 14:35:23', '2025-12-31', 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `upi_payments`
--

CREATE TABLE `upi_payments` (
  `id` int(11) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `upi_id` varchar(50) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed') DEFAULT 'pending',
  `payment_screenshot` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `address`, `role`, `created_at`, `reset_token`, `reset_expires`, `profile_pic`) VALUES
(1, 'Jayesh', 'jayeshborase200537@gmail.com', '$2y$10$tm3VweVwaxzmfiR9MDKI0Oq7MAZWjQIhwUqXXqX0P3WRPUo7C9yKq', '6355537352', '64,shri nath ji residency', 'customer', '2025-02-16 12:01:28', 'ca2fc6a44cece315d2b820adf9d38fa661966b4489909aed6abf532005d679d8a9a14c4ec5b2327a8253dd6376a444668ee4', '2025-04-02 15:15:09', NULL),
(2, 'Prakash Nikam', 'nikamprakash731@gmail.com', '$2y$10$FrjOjr4ACSYRDbDn2Af01uQQTXuuqWuH3gTaWpM5Lx5/USB62Vtpy', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'customer', '2025-03-15 11:41:41', '618dc954ce073de4f53240963d397fe8951872789248fd6a1b17b4e8962a8d8b32c0e0889a375df5617b08f666ce7c3ca26e', '2025-03-17 15:14:52', NULL),
(3, 'jay', 'jay53@gmail.com', '$2y$10$iONJQX1yE6XW6Od5k8J6q.4BtOIkZ6yqcfGE0abnsR0limHbU.Vqu', '65444589', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'customer', '2025-03-30 17:11:24', NULL, NULL, 'uploads/67fdf50157a65_67fa5772326d7_Amit.jpg'),
(4, 'sanjay', 'sanjay24@gmail.com', '$2y$10$CeVPGqLufJM09DwS6GFrreI4w17ZgWtK6hBzJ0yfL7p6hAHyYlkwu', '9245153524', '5,dindoli,surat', 'customer', '2025-04-02 12:14:00', NULL, NULL, NULL),
(5, 'Prakash Nikam', 'pharmacy1medical@gmail.com', '$2y$10$RCnZgOPXWiKpdzNLM4a2Le4bhXwK6WGMbWSt2wTkeyhUlNiyPmYYG', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'customer', '2025-04-04 04:44:28', NULL, NULL, NULL),
(6, 'Prakash Nikam', 'ram135@gmail.com', '$2y$10$U8FDbLbWs8VACHito41rwOf.uxkZEnfDQzl4GcFfU6OwDApmGpFZy', '09824064269', '67B Shree Ram Kutir, Nr Chikuwadi, Udhana Surat', 'customer', '2025-04-04 05:21:15', NULL, NULL, NULL),
(7, 'ramesh', 'pharmacy2medical@gmail.com', '$2y$10$80r4o8u2anXQUCp3lg3XeOvvPifRT5qx1mpwCa2Hgakud7mEYrZgm', '6355537353', '64,shri nath ji residency,karadava road,,Surat City', 'customer', '2025-04-14 07:07:52', NULL, NULL, 'uploads/67fcb6fa26bb2_67fa42dac109a_Rahul.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `financial_transactions`
--
ALTER TABLE `financial_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_updates`
--
ALTER TABLE `news_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `upi_payments`
--
ALTER TABLE `upi_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `financial_transactions`
--
ALTER TABLE `financial_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news_updates`
--
ALTER TABLE `news_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `upi_payments`
--
ALTER TABLE `upi_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
