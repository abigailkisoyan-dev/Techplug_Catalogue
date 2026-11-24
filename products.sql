-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2026 at 08:05 PM
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
-- Database: `techplug`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `category`, `description`, `image`) VALUES
(1, 'Samsung Galaxy Smartphone', 25000.00, 'Smartphones', 'A quality Samsung smartphone with excellent features.', 'https://placehold.co/300x200?text=Samsung+Phone'),
(2, 'HP Laptop', 65000.00, 'Laptops', 'A reliable HP laptop suitable for work and study.', 'https://placehold.co/300x200?text=HP+Laptop'),
(3, 'Wireless Headphones', 3500.00, 'Accessories', 'Wireless headphones with clear sound quality.', 'https://placehold.co/300x200?text=Headphones'),
(4, 'Smart Watch', 5000.00, 'Accessories', 'A smart watch for tracking daily activities.', 'https://placehold.co/300x200?text=Smart+Watch'),
(5, 'Bluetooth Speaker', 2500.00, 'Accessories', 'A portable Bluetooth speaker with good sound.', 'https://placehold.co/300x200?text=Speaker'),
(6, 'Lenovo Laptop', 58000.00, 'Laptops', 'A Lenovo laptop for everyday computing.', 'https://placehold.co/300x200?text=Lenovo+Laptop');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
