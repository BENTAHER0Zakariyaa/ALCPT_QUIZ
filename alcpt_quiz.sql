-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2021 at 09:24 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alcpt_quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidats`
--

CREATE TABLE `candidats` (
  `candidatId` int(11) NOT NULL,
  `candidatTestId` int(11) NOT NULL,
  `candidatLastname` varchar(150) NOT NULL,
  `candidatFistname` varchar(150) NOT NULL,
  `candidatMatricule` varchar(150) NOT NULL,
  `candidatService` varchar(150) NOT NULL,
  `candidatRank` varchar(150) NOT NULL,
  `candidatCountry` varchar(150) NOT NULL,
  `candidatInstructorName` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructorId` int(11) NOT NULL,
  `instructorRank` varchar(50) DEFAULT NULL,
  `instructorName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `questionId` int(11) NOT NULL,
  `testId` int(11) NOT NULL,
  `questionNumber` int(11) NOT NULL,
  `question` text DEFAULT NULL,
  `questionType` varchar(100) DEFAULT NULL,
  `answerA` text DEFAULT NULL,
  `answerB` text DEFAULT NULL,
  `answerC` text DEFAULT NULL,
  `answerD` text DEFAULT NULL,
  `correctAnswer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `scoreId` int(11) NOT NULL,
  `testId` int(11) NOT NULL,
  `candidatId` int(11) NOT NULL,
  `listening` int(11) DEFAULT NULL,
  `reading` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `testId` int(11) NOT NULL,
  `testName` varchar(50) DEFAULT NULL,
  `testAudio` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userName`, `userPassword`) VALUES
(1, 'admin', '$2y$10$bggvAwQiCtqtRM.G87SZPOjFUhC6qOSUjvybpxl6Dr2VYrfTT5oYO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidats`
--
ALTER TABLE `candidats`
  ADD PRIMARY KEY (`candidatId`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructorId`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionId`),
  ADD KEY `FK_quizId` (`testId`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`scoreId`),
  ADD KEY `FK_testId` (`testId`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`testId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidats`
--
ALTER TABLE `candidats`
  MODIFY `candidatId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructorId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `questionId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `scoreId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `testId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_quizId` FOREIGN KEY (`testId`) REFERENCES `tests` (`testId`);

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `FK_testId` FOREIGN KEY (`testId`) REFERENCES `tests` (`testId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
