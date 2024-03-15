-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220331.b9ddf0b305
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 13, 2024 at 04:18 PM
-- Server version: 10.4.33-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jlenz19`
--

-- --------------------------------------------------------

--
-- Table structure for table `final_movie`
--

CREATE TABLE `final_movie` (
  `MovieId` int(15) NOT NULL,
  `ReviewId` int(15) NOT NULL,
  `MovieTitle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `final_movie`
--

INSERT INTO `final_movie` (`MovieId`, `ReviewId`, `MovieTitle`) VALUES
(1, 1, 'Mamma Mia'),
(2, 2, 'Harry Potter and the Sorcerer\'s Stone'),
(3, 3, 'Eternals'),
(4, 4, 'Suicide Squad');

-- --------------------------------------------------------

--
-- Table structure for table `final_review`
--

CREATE TABLE `final_review` (
  `ReviewId` int(15) NOT NULL,
  `MovieId` int(15) NOT NULL,
  `Rating` int(1) NOT NULL,
  `Review` text NOT NULL,
  `ReviewTitle` varchar(15) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `final_review`
--

INSERT INTO `final_review` (`ReviewId`, `MovieId`, `Rating`, `Review`, `ReviewTitle`, `FirstName`, `LastName`) VALUES
(1, 1, 5, 'one of my all-time favorite movies!', 'So Much Fun!', 'Debby', 'Johnson'),
(2, 2, 4, 'Beginning to such an awesome franchise. The characters are so charming!', 'A Classic', 'Draco', 'Fan'),
(3, 3, 2, 'I feel like Marvel could do so much better. Very boring in comparison to their other projects', 'very surprising', 'Tony ', 'Stark'),
(4, 4, 1, 'Too fast-paced and just a lot going on. Characters were fun though. ', 'Not Very Good', 'Tyler', 'Creator'),
(5, 1, 3, 'The scenery is pretty but like....why is there so much singing :/', 'Weird Movie', 'Jaxon', 'Grace'),
(6, 1, 5, 'singing is beautiful. Meryl Streep is a Godsend in this movie', 'So good !', 'Mathew', 'Bester'),
(7, 2, 5, 'OMG LOVE!!! Harry Potter is my LIFE!', 'LOVE!', 'Jessica', 'Potter'),
(8, 2, 3, 'it was pretty good. the story was solid but the acting was kinda meh for me ngl', 'Meh', 'Harry', 'Smith');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `final_movie`
--
ALTER TABLE `final_movie`
  ADD PRIMARY KEY (`MovieId`),
  ADD KEY `FOREIGN` (`ReviewId`);

--
-- Indexes for table `final_review`
--
ALTER TABLE `final_review`
  ADD PRIMARY KEY (`ReviewId`),
  ADD KEY `FOREIGN` (`MovieId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `final_movie`
--
ALTER TABLE `final_movie`
  MODIFY `MovieId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `final_review`
--
ALTER TABLE `final_review`
  MODIFY `ReviewId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
