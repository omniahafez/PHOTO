-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 10:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photop8`
--

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `image` varchar(75) NOT NULL,
  `license` varchar(250) NOT NULL,
  `dimension` varchar(150) NOT NULL,
  `format` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 not active\r\n1 active',
  `views` int(150) NOT NULL,
  `taq_id` int(70) NOT NULL,
  `photo_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `title`, `image`, `license`, `dimension`, `format`, `created_at`, `active`, `views`, `taq_id`, `photo_date`) VALUES
(1, ' clock', '4335328b3be842159e171ae44f9f0249.jpeg', 'Free for both personal and commercial use. No need to pay anything. No need to make any attribution.', '192*108', 'jpg', '2024-02-17 09:26:30', 1, 1, 2, '2024-02-17'),
(2, 'mango tree', 'img-10.jpg', 'Free for both personal and commercial use. No need to pay anything. No need to make any attribution.', '7*7', 'jpg', '2024-02-18 14:01:38', 1, 5, 1, '2024-02-18'),
(5, 'pink flower', '4b4d72319cd9ce0c9c49b30cc367c4e7.jpeg', 'Free for both personal and commercial use. No need to pay anything. No need to make any attribution.', '134*200', 'jpg', '2024-02-19 02:07:55', 1, 4, 1, '2024-02-19'),
(7, 'friends', 'd4ec87e8812510cf9460c66fb6e7a4f5.jpeg', 'Free for both personal and commercial use. No need to pay anything. No need to make any attribution.', '14*20', 'jpg', '2024-02-19 20:47:34', 1, 1, 5, '2024-02-19'),
(8, 'vase', '8e2a7957c66da002bcdaed521044801a.jpeg', 'Free for both personal and commercial use. No need to pay anything. No need to make any attribution.', '10*14', 'jpg', '2024-02-19 20:49:47', 1, 7, 1, '2024-02-19'),
(9, 'animal', 'a34557f6af62d309302e9ac86d29ebe5.jpeg', 'Free for both personal and commercial use. No need to pay anything. No need to make any attribution.', '10*14', 'jpg', '2024-02-19 20:52:30', 1, 7, 3, '2024-02-18'),
(10, 'ddd', '891984e806f38cbf2cab2eb236d4db49.jpeg', 'Free for both personal and commercial use. No need to pay anything. No need to make any attribution.', '10*14', 'jpg', '2024-02-19 21:02:57', 1, 2, 5, '2024-02-18');

-- --------------------------------------------------------

--
-- Table structure for table `taq`
--

CREATE TABLE `taq` (
  `id` int(11) NOT NULL,
  `taq_name` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taq`
--

INSERT INTO `taq` (`id`, `taq_name`) VALUES
(2, 'clocks2'),
(6, 'family'),
(1, 'flower'),
(5, 'friends'),
(3, 'trees');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `fullname` varchar(75) NOT NULL,
  `user_name` varchar(75) NOT NULL,
  `password` varchar(60) NOT NULL,
  `email` varchar(75) NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'o inactive user\r\n1 active user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `user_name`, `password`, `email`, `created_at`, `active`) VALUES
(1, 'omnia hafez', 'omnia223', '$2y$10$hF1Wvrn4lRGmmdoH//cHrOM0gVYCgcuEwRvJf3xvmT20C5qDcJ1V.', 'info@un.com', '2024-02-17 13:25:30', 0),
(3, 'yasin ahmed', 'yaso', '$2y$10$UVLd0zK3muY3W6aC5Xiaj.xmoli4/mB.W.3i25mmET7s9Gd9/aEXS', 'bebo@gmail.com', '2024-02-17 13:33:29', 1),
(4, 'ahmed mohamed', 'mody', '$2y$10$rlrrFUU9h17AuCndO0/BLO5w2kOt9S7GK9FsgmmMtyH/TivJUVkRe', 'gg@gg.com', '2024-02-17 13:40:26', 0),
(5, 'mohamed ahmed', 'mezo', '$2y$10$8HwhfUPPWji6PzJfCqZ.4uQuximr4bfZWNVZDziZIF1XHBxcKrOZq', 'nnn@hg.com', '2024-02-17 14:13:02', 0),
(6, 'hithem mohamed', 'mezo', '$2y$10$k4fNd2tSxAGrNtm0mL/vseSFaGhhbITyKHLGGfVJknJsGiIDLbiaq', 'fgfgf@nbbn.com', '2024-02-17 18:37:11', 0),
(8, 'hamza mohamed', 'hamza', '$2y$10$ec1zsjmNYAbDlHk2hnME4eDo06BT8L/hy76ihmYfjBxY5.hUK4eP2', 'xxcc@mm.com', '2024-02-17 18:46:55', 0),
(9, 'dd ff', 'dd', '$2y$10$yf3ZK9h9m6XbG2evlX.CIu28W4T1loXPpRcL.NUZUNwAMzfDfoGpK', 'qqqqq@hh.com', '2024-02-17 19:11:34', 1),
(10, 'gg hh', 'gg', '$2y$10$hhobWt/hdtl/i76bxGuS8.C2b5CuHWJdQ.bkh80hfu6H/e6brYgh2', 'sss@ww.com', '2024-02-17 19:13:53', 0),
(11, 'hh gg', 'hh', '$2y$10$GhrcO/evvPhrViyf8kWCvu/mrZAabZk7hEdY.h/4PLmSLgTzaIYxu', 'll@eee.com', '2024-02-17 19:15:19', 0),
(12, 'gg mm', 'gg', '$2y$10$ACqZ4yW0dc537ktt55qjpuLBFJLqkheXcvzQuWUvha74srw3Py96O', 'sssa@nnn.com', '2024-02-17 19:20:47', 0),
(13, '[gfgh gf]', '[ff]', '[11111]', '[aaaa@gg.com]', '2024-02-18 09:30:47', 0),
(14, 'yasin mohamed', 'yasoo', '$2y$10$Pn0l0NAws9Sd4ONh0b22.e9nSUJ8BJKN6iG3JJeHcLEzsq09VPvR6', 'gggaass@gmail.com', '2024-02-18 09:35:03', 0),
(15, 'yara mohsin', 'yara', '$2y$10$si9RJQu6gdRiFk0HdI4WJ./ycbiVGtyn0erUbrD3LrlPylgPxWhQG', 'jjj@mms.com', '2024-02-25 07:28:11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `taq_id` (`taq_id`);

--
-- Indexes for table `taq`
--
ALTER TABLE `taq`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taq` (`taq_name`);

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
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `taq`
--
ALTER TABLE `taq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`taq_id`) REFERENCES `taq` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
