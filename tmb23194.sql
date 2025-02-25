-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: devweb2023.cis.strath.ac.uk:3306
-- Generation Time: Aug 07, 2024 at 08:08 PM
-- Server version: 8.0.37-0ubuntu0.22.04.3
-- PHP Version: 8.1.2-1ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmb23194`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` ( 
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(225) NOT NULL DEFAULT 'Recivied'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `userid`, `name`, `email`, `message`, `status`) VALUES
(1, 2, 'Krish', 'krishdasani123@gmail.com', 'Hi there ', 'Recivied'),
(2, 2, 'Krish', 'krishdasani123@gmail.com', 'Hi there ', 'Replied');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `portfolio_id` int NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` varchar(225) NOT NULL,
  `path` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `userid`, `portfolio_id`, `name`, `description`, `path`) VALUES
(1, 2, 1, '1c0919106f.jpg', '', '1c0919106f.jpg'),
(2, 2, 1, '4cbee1c951.jpg', '', '4cbee1c951.jpg'),
(3, 2, 1, 'Bombay_High_Court_1.jpg', '', 'Bombay_High_Court_1.jpg'),
(4, 2, 1, 'Suchit.jpg', '', 'Suchit.jpg'),
(5, 2, 1, 'cartoon.jpg', '', 'cartoon.jpg'),
(6, 2, 1, 'celeb.jpg', '', 'celeb.jpg'),
(7, 2, 1, 'd.jpg', '', 'd.jpg'),
(8, 2, 1, 'dawood.jpg', '', 'dawood.jpg'),
(9, 2, 1, 'download.jpg', '', 'download.jpg'),
(10, 2, 1, 'ran2.jpg', '', 'ran2.jpg'),
(13, 2, 1, 'virat.jpg', '', 'virat.jpg'),
(14, 2, 2, '1c0919106f.jpg', '', '1c0919106f.jpg'),
(15, 2, 2, '4cbee1c951.jpg', '', '4cbee1c951.jpg'),
(16, 2, 2, 'Bombay_High_Court_1.jpg', '', 'Bombay_High_Court_1.jpg'),
(17, 2, 2, 'Suchit.jpg', '', 'Suchit.jpg'),
(18, 2, 2, 'cartoon.jpg', '', 'cartoon.jpg'),
(19, 2, 2, 'celeb.jpg', '', 'celeb.jpg'),
(20, 2, 2, 'd.jpg', '', 'd.jpg'),
(21, 2, 2, 'dawood.jpg', '', 'dawood.jpg'),
(22, 2, 2, 'download.jpg', '', 'download.jpg'),
(23, 2, 2, 'ran2.jpg', '', 'ran2.jpg'),
(24, 2, 2, 'sarvesh.jpg', '', 'sarvesh.jpg'),
(25, 2, 2, 'urvashi.jpg', '', 'urvashi.jpg'),
(26, 2, 2, 'virat.jpg', '', 'virat.jpg'),
(27, 2, 3, '1c0919106f.jpg', '', '1c0919106f.jpg'),
(28, 2, 3, '4cbee1c951.jpg', '', '4cbee1c951.jpg'),
(29, 2, 3, 'Bombay_High_Court_1.jpg', '', 'Bombay_High_Court_1.jpg'),
(30, 2, 3, 'Suchit.jpg', '', 'Suchit.jpg'),
(31, 2, 3, 'cartoon.jpg', '', 'cartoon.jpg'),
(32, 2, 3, 'celeb.jpg', '', 'celeb.jpg'),
(33, 2, 3, 'd.jpg', '', 'd.jpg'),
(34, 2, 3, 'dawood.jpg', '', 'dawood.jpg'),
(35, 2, 3, 'download.jpg', '', 'download.jpg'),
(36, 2, 3, 'ran2.jpg', '', 'ran2.jpg'),
(37, 2, 3, 'sarvesh.jpg', '', 'sarvesh.jpg'),
(38, 2, 3, 'urvashi.jpg', '', 'urvashi.jpg'),
(39, 2, 3, 'virat.jpg', '', 'virat.jpg'),
(40, 2, 6, 'image-1.jpg', '', 'image-1.jpg'),
(41, 2, 6, 'image-10.jpg', '', 'image-10.jpg'),
(42, 2, 6, 'image-11.jpg', '', 'image-11.jpg'),
(43, 2, 6, 'image-12.jpg', '', 'image-12.jpg'),
(44, 2, 6, 'image-13.jpg', '', 'image-13.jpg'),
(45, 2, 6, 'image-14.jpg', '', 'image-14.jpg'),
(46, 2, 6, 'image-15.jpg', '', 'image-15.jpg'),
(47, 2, 6, 'image-16.jpg', '', 'image-16.jpg'),
(48, 2, 6, 'image-17.jpg', '', 'image-17.jpg'),
(49, 2, 6, 'image-18.jpg', '', 'image-18.jpg'),
(50, 2, 6, 'image-19.jpg', '', 'image-19.jpg'),
(51, 2, 6, 'image-2.jpg', '', 'image-2.jpg'),
(52, 2, 6, 'image-3.jpg', '', 'image-3.jpg'),
(53, 2, 6, 'image-4.jpg', '', 'image-4.jpg'),
(54, 2, 6, 'image-5.jpg', '', 'image-5.jpg'),
(55, 2, 6, 'image-6.jpg', '', 'image-6.jpg'),
(56, 2, 6, 'image-7.jpg', '', 'image-7.jpg'),
(57, 2, 6, 'image-8.jpg', '', 'image-8.jpg'),
(58, 2, 6, 'image-9.jpg', '', 'image-9.jpg'),
(59, 2, 7, 'gettyimages-1705162581-612x612.jpg', '', 'gettyimages-1705162581-612x612.jpg'),
(60, 2, 7, 'gettyimages-1705233603-612x612.jpg', '', 'gettyimages-1705233603-612x612.jpg'),
(61, 2, 7, 'gettyimages-1707570552-612x612.jpg', '', 'gettyimages-1707570552-612x612.jpg'),
(62, 2, 7, 'gettyimages-1712284433-612x612.jpg', '', 'gettyimages-1712284433-612x612.jpg'),
(63, 2, 7, 'gettyimages-1715816961-612x612.jpg', '', 'gettyimages-1715816961-612x612.jpg'),
(64, 2, 7, 'gettyimages-1745437131-612x612.jpg', '', 'gettyimages-1745437131-612x612.jpg'),
(65, 2, 7, 'gettyimages-1745437183-612x612.jpg', '', 'gettyimages-1745437183-612x612.jpg'),
(66, 2, 7, 'gettyimages-1782807205-612x612.jpg', '', 'gettyimages-1782807205-612x612.jpg'),
(67, 2, 7, 'gettyimages-1806661467-612x612.jpg', '', 'gettyimages-1806661467-612x612.jpg'),
(68, 2, 8, '000_34Y96RL.jpg', '', '000_34Y96RL.jpg'),
(69, 2, 8, '1700348401042_ae2ead23-8688-450b-adf0-4bf9ada8aa7c.jpg', '', '1700348401042_ae2ead23-8688-450b-adf0-4bf9ada8aa7c.jpg'),
(70, 2, 8, 'FBL-EURO-2024-MATCH46-POR-FRA-572_1720216053006_1720216106826.jpg', '', 'FBL-EURO-2024-MATCH46-POR-FRA-572_1720216053006_1720216106826.jpg'),
(71, 2, 8, 'Nico Williams Spain Euro 2024.jpg', '', 'Nico Williams Spain Euro 2024.jpg'),
(72, 2, 8, 'download.jpg', '', 'download.jpg'),
(73, 2, 8, 'fbl-euro-2024-match51-esp-eng.jpg', '', 'fbl-euro-2024-match51-esp-eng.jpg'),
(74, 2, 8, 'unnamed.jpg', '', 'unnamed.jpg'),
(75, 2, 9, '55927-lakshya-sen.jpg', '', '55927-lakshya-sen.jpg'),
(76, 2, 9, '5iKc9469dOuq_7MDPgaF2aMLo_1440x960.jpg', '', '5iKc9469dOuq_7MDPgaF2aMLo_1440x960.jpg'),
(77, 2, 9, 'AP24213656982606-1-2024-08-9b24f4b4cce1c06012a5f30c91511608.jpg', '', 'AP24213656982606-1-2024-08-9b24f4b4cce1c06012a5f30c91511608.jpg'),
(78, 2, 9, 'EMPOWERING MOMENTS 310724 OLYMPICS.jpg', '', 'EMPOWERING MOMENTS 310724 OLYMPICS.jpg'),
(79, 2, 9, 'FLQQEY45XJKWFLZ74NHSESKAQI.jpg', '', 'FLQQEY45XJKWFLZ74NHSESKAQI.jpg'),
(80, 2, 9, 'SEI215856459.jpg', '', 'SEI215856459.jpg'),
(81, 2, 9, 'indian-hockey-team-defeat-great-britan-paris-olympics-2024_202408782624.jpg', '', 'indian-hockey-team-defeat-great-britan-paris-olympics-2024_202408782624.jpg'),
(82, 2, 9, 'lugapskt1zdoxbgpw6uf.jpg', '', 'lugapskt1zdoxbgpw6uf.jpg'),
(83, 2, 9, 'download.jpeg', '', 'download.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `portfolio_id` int NOT NULL,
  `userid` int NOT NULL,
  `name` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `image_path` varchar(225) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`portfolio_id`, `userid`, `name`, `description`, `image_path`) VALUES
(7, 2, 'CricketWorldCup', 'This folder consists of photos of some moments cricket world cup,enjoy!', '7/7/cover.jpg'),
(8, 2, 'Euro2024', 'This folder consists of photos of some moments of euro 2024', '8/8/cover.jpg'),
(9, 2, 'ParisOlympics2023', 'This folder consists of photos of some moments of paris olympics 2024', '9/9/cover.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Tags`
--

CREATE TABLE `Tags` (
  `id` int NOT NULL,
  `Tag` varchar(225) NOT NULL,
  `image_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `company` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(225) COLLATE utf8mb4_general_ci NOT NULL,
  `about` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(225) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `company`, `phone`, `about`, `password`) VALUES
(1, 'krishdasani123@gmail.com', 'Varshi Tech', '8169874720', 'u reierr rrgne3 ns', '$2y$10$EkEHtYHpdfTnPDiGUREsdOheq54ZfgXLtPdos1YS5uN8W3RnoQ8Wu'),
(2, 'dasanikrish.varshi@gmail.com', 'Varshi Tech', '8169874720', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras quis rutrum dolor, vel posuere nunc. Sed vehicula aliquet ultricies. Sed eu sodales erat. Nunc malesuada erat in eleifend vehicula. Etiam eget pellentesque felis, eu scelerisque nisl. Praesent elementum elit sit amet nisi ullamcorper efficitur. Cras viverra turpis quis erat tempor, at aliquam elit tristique.\r\n\r\nDuis rhoncus efficitur molestie. Sed eu diam vehicula, ornare nisi nec, finibus ante. Ut fermentum, velit ut porta laoreet, erat dui pellentesque urna, eu consectetur metus diam sit amet magna. Ut lobortis pulvinar congue. Vivamus tristique sapien vel quam tincidunt, sagittis cursus ipsum ornare. Mauris convallis rutrum ligula, vitae rutrum dolor. Ut consectetur vestibulum nunc eu aliquam. Etiam pretium dui ac metus blandit malesuada. Duis est enim, convallis at neque in, interdum convallis eros. Aliquam sit amet nisl nec dui facilisis semper. Nunc venenatis rutrum enim sit amet convallis. Suspendisse potenti. Mauris in arcu quis erat eleifend accumsan.\r\n\r\nPellentesque vitae consequat dui. Mauris et lacus dolor. Proin quis tempus odio. In quis tellus convallis, pulvinar nulla nec, mollis mauris. Nam commodo condimentum lectus at ultricies. Aenean malesuada purus id turpis fermentum iaculis. Curabitur eget velit id neque lacinia scelerisque quis non mauris. Sed non orci a ex venenatis tempus ut ac est. Aenean commodo enim ut vehicula commodo. Donec turpis velit, dignissim pellentesque sem in, sollicitudin bibendum enim.\r\n\r\nMaecenas non ante in dolor tincidunt euismod quis et velit. Aenean eget lacus semper, fermentum massa eu, sagittis nisl. Nulla egestas luctus erat vitae lobortis. Praesent suscipit rhoncus leo nec lobortis. Integer elit orci, consequat a lacinia sed, mollis sed risus. Duis enim urna, ornare sit amet bibendum sed, suscipit non elit. Phasellus scelerisque ligula enim, nec molestie mauris efficitur nec. Curabitur sed nisl odio. Donec sed arcu vitae nibh finibus placerat at id justo.\r\n\r\nClass aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque nec ipsum lacinia, sagittis sem ac, posuere justo. In auctor est cursus, imperdiet velit vel, viverra arcu. Integer feugiat felis sit amet mollis interdum. Nunc eu augue nisl. Nullam ac orci id ipsum suscipit rutrum eget ut justo. Proin nec mattis orci. Morbi et odio in neque varius ultricies. Nulla cursus vel est a pharetra. Nullam eget tortor in odio hendrerit consectetur. Nulla venenatis risus ut hendrerit lobortis. Donec interdum odio nec venenatis scelerisque. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sit amet odio ac felis feugiat congue. Phasellus efficitur lorem ut euismod cursus. Sed urna quam, elementum nec augue a, vestibulum egestas est.\r\n\r\nNam tristique malesuada imperdiet. Sed nec turpis velit. Nunc sed scelerisque arcu. Proin et dui posuere, fermentum tellus sit amet, aliquam tellus. Cras hendrerit neque at tortor aliquam, eu vehicula est fringilla. Sed quis nunc quis purus tincidunt imperdiet. Curabitur nisl lorem, blandit sit amet gravida egestas, luctus at sapien. Aliquam fermentum ante nisl, in ultrices urna pellentesque ac. Praesent quis bibendum metus, nec lobortis lectus. Proin suscipit nibh ut ligula suscipit, quis laoreet nisl luctus. Duis at ultrices ex. Nunc mattis dignissim.', '$2y$10$ZN/paiDBXmhf6T/oQwkEceQrUR38OpCb7tF2L6D2zBvYuDr4gitLy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`portfolio_id`);

--
-- Indexes for table `Tags`
--
ALTER TABLE `Tags`
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
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `portfolio_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Tags`
--
ALTER TABLE `Tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
