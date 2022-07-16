-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2022 at 09:12 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mygallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `art`
--

CREATE TABLE `art` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `source` varchar(225) NOT NULL,
  `author` varchar(225) NOT NULL,
  `category` int(11) NOT NULL,
  `creationDate` varchar(225) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `uploadedBy` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `priceCurrency` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `art`
--

INSERT INTO `art` (`id`, `name`, `source`, `author`, `category`, `creationDate`, `description`, `uploadedBy`, `price`, `priceCurrency`, `lastUpdated`, `status`) VALUES
(15, 'Screenshot', 'art/629f7cb04da938.03352483.png', 'Tkdaz', 17, '2022-06-07', 'A Screenshot', 4, 200, 'USD', '2022-06-13 18:55:46', 1),
(16, 'Screenshot2', 'art/629f808e614b52.64468462.png', 'Tkadz', 17, '2022-06-05', 'lorem ipsum', 4, 20, 'USD', '2022-06-13 18:55:36', 1),
(17, '13 people', 'art/629f9788586550.32184303.jpg', 'undefined', 1, '2022-06-06', 'people moving around the city', 4, 150, 'USD', '2022-06-07 18:23:04', 1),
(18, 'Monkey', 'art/629f9acf4fab93.10325041.jpg', 'beez', 15, '2022-05-07', 'A brown monkey drinking whiskey', 4, 190, 'USD', '2022-06-07 18:37:03', 1),
(19, 'Lion', 'art/629f9b49ce1284.82429816.jpg', 'nyash', 15, '2022-04-19', 'A wounded smoking lion', 4, 500, 'USD', '2022-06-07 18:39:05', 1),
(20, 'love', 'art/62a05a280a6624.71737659.jpg', 'nyash', 16, '2022-06-08', 'an expression of love', 4, 350, 'USD', '2022-06-08 08:14:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `artID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `dateAdded`, `lastUpdated`) VALUES
(1, 'UNCATEGORISED', '2022-06-07 18:42:52', '2022-06-13 18:55:23'),
(15, 'ANIMALS', '2022-06-07 06:06:29', '2022-06-07 18:29:16'),
(16, 'LOVE', '2022-06-08 08:06:14', '2022-06-08 08:14:18'),
(17, 'SCREENSHOTS', '2022-06-13 08:06:55', '2022-06-13 18:55:12');

-- --------------------------------------------------------

--
-- Table structure for table `paymentDetails`
--

CREATE TABLE `paymentDetails` (
  `id` int(11) NOT NULL,
  `payMethod` varchar(225) NOT NULL,
  `uniqueGroupID` varchar(225) NOT NULL,
  `username` varchar(225) NOT NULL,
  `userID` int(11) NOT NULL,
  `amount` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `cardNumber` varchar(225) NOT NULL,
  `cardExp` varchar(225) NOT NULL,
  `cardCvv` varchar(11) NOT NULL,
  `datePayed` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentDetails`
--

INSERT INTO `paymentDetails` (`id`, `payMethod`, `uniqueGroupID`, `username`, `userID`, `amount`, `phone`, `cardNumber`, `cardExp`, `cardCvv`, `datePayed`, `lastUpdated`) VALUES
(16, 'ecocash', 'ru1QMqO4BK', 'BKJ', 6, '190', '6969986986', '', '', '', '2022-06-14 08:06:47', '2022-06-14 18:47:15'),
(17, 'card', 'v2iLrrZKaL', 'N,M', 6, '850', '', '4000 3999 3939 2023', '2022-06-20', '768', '2022-06-14 08:06:47', '2022-06-14 18:47:59'),
(18, 'card', 'eyOM7FGwmc', 'TAA', 6, '190', '', '6060 9965 8888 9484', '2022-06-21', '788', '2022-06-14 09:06:02', '2022-06-14 19:02:08'),
(19, 'ecocash', 'gsqZgy1jwd', 'NYASH', 5, '540', '0970970970', '', '', '', '2022-06-14 09:06:05', '2022-06-14 19:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `uniqueGroupID` varchar(225) NOT NULL,
  `artID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `datePayed` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `uniqueGroupID`, `artID`, `userID`, `datePayed`, `lastUpdated`) VALUES
(26, 'ru1QMqO4BK', 18, 6, '2022-06-14 08:06:47', '2022-06-14 18:47:15'),
(27, 'v2iLrrZKaL', 19, 6, '2022-06-14 08:06:47', '2022-06-14 18:47:59'),
(28, 'v2iLrrZKaL', 20, 6, '2022-06-14 08:06:47', '2022-06-14 18:47:59'),
(29, 'eyOM7FGwmc', 18, 6, '2022-06-14 09:06:02', '2022-06-14 19:02:08'),
(30, 'gsqZgy1jwd', 20, 5, '2022-06-14 09:06:05', '2022-06-14 19:05:28'),
(31, 'gsqZgy1jwd', 18, 5, '2022-06-14 09:06:05', '2022-06-14 19:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `dateJoined` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `role`, `status`, `dateJoined`, `lastUpdated`) VALUES
(2, 'aaliyah@gmail.com', '$2y$10$ppWz.kEiEWvEoTZf2NzjGO6ZH/NSDD5qbYTgF0d27J224jwI.eUvy', 'AALIYAH', 'MUSHONGA', 'user', 1, '2022-05-26 09:05:52', '2022-06-05 14:35:54'),
(3, 'hebede@gmail.com', '$2y$10$Esi6wxtwXlZt8LGF3q7K2.9kViHN/4b7N0TXZLKcc2hjtF8jSL3V2', 'HEBERT', 'MUGOMBI', 'admin', 1, '2022-05-26 09:05:58', '2022-06-07 18:44:19'),
(4, 'nozybee@gmail.com', '$2y$10$HW3Srn5gUpGHupagg1lqdO/be.x3YwtWPCBE35brJFjXRm8QUQfc2', 'BEAULAH', 'TSHUMA', 'admin', 1, '2022-05-30 04:05:34', '2022-06-07 18:08:29'),
(5, 'nyasha@gmail.com', '$2y$10$M.QSIEonynjrcDhZqDUnp.8UspDF5Oiyr7hA21jTpqGOpJVXvVVti', 'NYASHA', 'CHIBHARO', 'admin', 1, '2022-06-07 06:06:47', '2022-06-14 19:05:49'),
(6, 'tkadzzz@gmail.com', '$2y$10$FBjRHkitbaVC0gfUGwZDmOXxoZVpy6ll4kMwkhLqcQ1EHwgtBTU4O', 'TANAKA', 'KADZUNGE', 'admin', 1, '2022-06-12 09:06:29', '2022-06-12 19:31:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `art`
--
ALTER TABLE `art`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentDetails`
--
ALTER TABLE `paymentDetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueGroupID` (`uniqueGroupID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `art`
--
ALTER TABLE `art`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `paymentDetails`
--
ALTER TABLE `paymentDetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
