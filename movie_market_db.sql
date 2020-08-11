-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2020 at 03:19 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_market_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`id`, `email`, `password`, `token_id`) VALUES
(1, 'admin@gmail.com', '$2y$10$YC84MPs1XXtM7wV/vvrnUO2Hod531V5N461tdbO2GzlEBrGizgGLK', 'hcue839fn8ebc93ndkd937e00ncjxnaie783');

-- --------------------------------------------------------

--
-- Table structure for table `cart_table`
--

CREATE TABLE `cart_table` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_table`
--

INSERT INTO `cart_table` (`id`, `movie_id`, `user_id`, `price`) VALUES
(25, 3, 4, 1400);

-- --------------------------------------------------------

--
-- Table structure for table `genre_table`
--

CREATE TABLE `genre_table` (
  `id` int(11) NOT NULL,
  `genre_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre_table`
--

INSERT INTO `genre_table` (`id`, `genre_name`) VALUES
(1, 'Action'),
(2, 'Comedy'),
(3, 'Adventure');

-- --------------------------------------------------------

--
-- Table structure for table `items_table`
--

CREATE TABLE `items_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `purchase_id` varchar(200) NOT NULL,
  `price` bigint(20) NOT NULL,
  `trans_date` date NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items_table`
--

INSERT INTO `items_table` (`id`, `user_id`, `movie_id`, `purchase_id`, `price`, `trans_date`, `status`) VALUES
(4, 4, 2, '562931784616720', 2, '2020-08-10', 1),
(5, 6, 1, '562931784616720', 1, '2020-08-10', 1),
(6, 6, 3, '562931784616720', 3, '2020-08-10', 1),
(7, 6, 1, '018881255429532', 1, '2020-08-10', 1),
(8, 6, 1, '100641275521354', 1, '2020-08-10', 1),
(9, 6, 3, '100641275521354', 3, '2020-08-10', 1),
(10, 4, 3, '798090636983678', 3, '2020-08-10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movies_table`
--

CREATE TABLE `movies_table` (
  `id` int(11) NOT NULL,
  `movie_title` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `genre_id` int(11) NOT NULL,
  `token_id` varchar(200) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies_table`
--

INSERT INTO `movies_table` (`id`, `movie_title`, `price`, `photo`, `description`, `genre_id`, `token_id`, `created_at`) VALUES
(1, 'Avengers End Game', 4000, '579193221031-avengers.jpg', 'After Thanos, an intergalactic warlord, disintegrates half of the universe, the Avengers must reunite and assemble again to reinvigorate their trounced allies and restore balance.', 1, 'e55e463d70763a0a5fd0a7e73530f942', '2020-08-10'),
(2, 'Captain Marvel', 3000, '112318231631-captainmarvel.jpg', 'Amidst a mission, Vers, a Kree warrior, gets separated from her team and is stranded on Earth. However, her life takes an unusual turn after she teams up with Fury, a S.H.I.E.L.D. agent.', 1, 'e3a3f5971e93522d962f691ee867bff9', '2020-08-10'),
(3, 'Toy Story 2', 1400, '979378705187-toystory.jpg', 'Before Andy leaves for college, his toys are mistakenly delivered to a day care centre. Woody convinces the other toys that they were not dumped and leads them on an expedition back home.', 2, '7dd738caf874911ef181dc4fa646e5be', '2020-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_table`
--

CREATE TABLE `purchase_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `bag_id` varchar(200) NOT NULL,
  `bag_token` varchar(200) NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_table`
--

INSERT INTO `purchase_table` (`id`, `user_id`, `amount`, `bag_id`, `bag_token`, `purchase_date`) VALUES
(4, 6, 8400, '562931784616720', '4df27b2fbdd7267016afbd8eefe71ae2', '2020-08-10'),
(5, 6, 4000, '018881255429532', '3403d46574e543199caa3124bae3af04', '2020-08-10'),
(6, 6, 5400, '100641275521354', '310c3adf5b284992fdc755095b9c7b41', '2020-08-10'),
(7, 4, 1400, '798090636983678', '3ab6b96cc3f2e27cd0d880d1e4b91abe', '2020-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `users_table`
--

CREATE TABLE `users_table` (
  `id` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `user_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `age` int(11) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token_id` varchar(200) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_table`
--

INSERT INTO `users_table` (`id`, `email`, `user_details`, `age`, `password`, `token_id`, `created_at`) VALUES
(4, 'collinsbenson0039@gmail.com', '{\"full_name\":\"Benson Francis\",\"date_of_birth\":\"2020-08-29\",\"phone_no\":\"07051457771\",\"address\":\"4, Abayomi Street, off Olanrenwaju Street, Oregun - Ikeja, Lagos.\"}', 0, '$2y$10$YC84MPs1XXtM7wV/vvrnUO2Hod531V5N461tdbO2GzlEBrGizgGLK', '7824e655f34bcb2687e04bfb417509f0', '2020-08-09'),
(6, 'enddy@gmail.com', '{\"full_name\":\"enddy bongo\",\"date_of_birth\":\"2020-08-29\",\"address\":\"\",\"phone_no\":\"\"}', 0, '$2y$10$0Z0UXQtwWmf8lY7aTWtsI..F6aitnKj./qO3JeJxmt0Zh5gFjHnSW', '9cbe3e2fe70a6229185e901b150b98d5', '2020-08-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_table`
--
ALTER TABLE `cart_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genre_table`
--
ALTER TABLE `genre_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_table`
--
ALTER TABLE `items_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies_table`
--
ALTER TABLE `movies_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_table`
--
ALTER TABLE `purchase_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart_table`
--
ALTER TABLE `cart_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `genre_table`
--
ALTER TABLE `genre_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `items_table`
--
ALTER TABLE `items_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `movies_table`
--
ALTER TABLE `movies_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `purchase_table`
--
ALTER TABLE `purchase_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users_table`
--
ALTER TABLE `users_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
