-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2024 at 04:12 PM
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
-- Database: `bcp_sms3_prefect`
--

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_college`
--

CREATE TABLE `bcp_sms3_college` (
  `id` int(11) NOT NULL,
  `Name` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `contactnumber` int(11) NOT NULL,
  `guardianName` int(11) NOT NULL,
  `contact` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_course`
--

CREATE TABLE `bcp_sms3_course` (
  `CourseId` int(11) NOT NULL,
  `Course` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcp_sms3_course`
--

INSERT INTO `bcp_sms3_course` (`CourseId`, `Course`) VALUES
(1, 'BSIT'),
(2, 'BSTM'),
(3, 'ICT'),
(4, 'STEM'),
(5, 'HUMSS'),
(6, 'HE'),
(7, 'ABM'),
(8, 'GAS'),
(9, 'BSP'),
(10, 'BSHM'),
(11, 'BSOA'),
(12, 'BSCRIM'),
(13, 'BSBA'),
(14, 'BLIS'),
(15, 'BEEd,BPEd & BTLed'),
(16, 'BSEDUC'),
(17, 'BSCpE'),
(18, 'BSENTREP'),
(19, 'BSAIS');

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_grave`
--

CREATE TABLE `bcp_sms3_grave` (
  `graveId` int(12) NOT NULL,
  `grave` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcp_sms3_grave`
--

INSERT INTO `bcp_sms3_grave` (`graveId`, `grave`) VALUES
(1, '4.1.3.1 Possession, use or sale prohibited drugs or chemicals and hallucinogenic drugs or substances in any form within the school premises, or the possession of any regulated drug without the proper prescription.\r\n'),
(2, '4.1.3.2 Theft pilferage of school equipment, materials or supplies, extortion, robbery or an attempt thereof and any form of dishonesty.\r\n'),
(3, '4.1.3.3 Forgery or falsification and/ or alteration of academic or official records or documents of any kind.\r\n'),
(4, '4.1.3.4 Willful disregard of authority, disrespect, discourtesy and disobedience to any school official, member of faculty. administration or their representative\r\n'),
(5, '4.1.3.5 Direct assault upon a person of authority or any school official, faculty member non-academic staff or any corsonal of the school community\r\n'),
(6, '4.1.3.6 Having been convicted of a crime and/or moral turpitude in any court of justice.\r\n'),
(7, '4.1.3.7 Committing any act punishable under existing law of the land within and outside the campus and violation of the laws of the Commission on Higher Education.\r\n'),
(8, '4.1.3.8 Tampering/altering such as changing original photos of ID cards, registration cards, and other school forms.\r\n'),
(9, '4.1.3.9 Allowing other students or individuals to use their school ID for any purpose.\r\n'),
(10, '4.1.3.10 Using the name and seal of BESTLINK on printed matters such as program, invitation, announcement, tickets, certification, solicitation atc., without permission from school president or her official representatives.\r\n'),
(11, '4.1.3.11 Exposing/ Destroying the image of the school that hampers its integrity in the different broadcasting network and other social media platforms.\r\n'),
(12, '4.1.3.12 Posting inappropriate photos, videos or messages (Cyber Crime).\r\n'),
(13, '4.1.3.13 Bullying, harassing, defaming, or discriminating against fellow students, faculty, administrators, employees or any other person in social media platforms.\r\n'),
(14, '4.1.3.14 Discussing, ventilating uploading grievances, concerns, or issues in social networking platforms.\r\n'),
(15, '4.1.3.15 Exploding of firecrackers, pyrotechnics, pillbox bomb, molotov bomb, and others.\r\n'),
(16, '4.1.3.16 Carrying deadly weapon and/ or dangerous weapon Including Improvised weapon, explosive and incendiaries Inside the campus.\r\n'),
(17, '4.1.3.17 Unauthorized use, opening and/or reading or browsing of computer program, files and the like.\r\n'),
(18, '4.1.3.18 Recruitment to fraternities, hazing and other similar act (RA 8049),\r\n'),
(19, '4.1.3.19 Unauthorized bringing of outsiders inside the classroom laboratory or office that destroys properties and/or distracts classroom instruction.\r\n'),
(20, '4.1.3.20 Provoking offensive action that leads to violence.\r\n'),
(21, '4.1.3.21 Holding of rallies, meetings, activities or programs without necessary permit from the school authorities.\r\n'),
(22, '4.1.3.22 Unauthorized copying of computer programs, files and others.\r\n'),
(23, '4.1.3.23-Uttering/expressing profane or indecent language.\r\n'),
(24, '4.1.3.24 Gambling or playing cards and any misdemeanor/ misbehavior within 100 meters away from the school.\r\n'),
(25, '4.1.3.25 Unauthorized selling of tickets/solicitation.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_major`
--

CREATE TABLE `bcp_sms3_major` (
  `majorId` int(12) NOT NULL,
  `major` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_minor`
--

CREATE TABLE `bcp_sms3_minor` (
  `minorId` int(11) NOT NULL,
  `minor` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcp_sms3_minor`
--

INSERT INTO `bcp_sms3_minor` (`minorId`, `minor`) VALUES
(1, '4.1.1 Not wearing a school ID card'),
(2, '4.1.2 Eating inside the classroom, chewing bubble gums\r\n'),
(3, '4.1.3 Loitering near the gate or any act that may block the flow of human traffic\r\n'),
(4, '4.1.4 Public Display of Affection\r\n'),
(5, '4.1.5 Unauthorized posting or use of banners\r\n'),
(6, '4.1.6 Spitting on the floor or any act that creates unsanitary conditions\r\n'),
(7, '4.1.7 Improper haircut, dyeing of hair, or wearing inappropriate accessories\r\n'),
(8, '4.1.8 Entering faculty restrooms without consent\r\n'),
(9, '4.1.9 Male students entering female comfort rooms or vice versa\r\n'),
(10, '4.1.10 Unhygienic use of college facilities\r\n'),
(11, '4.1.11 Bringing in pointed objects\r\n'),
(12, '4.1.12 Refusal to submit to lawful inspection\r\n'),
(13, '4.1.13 Using lewd gestures to provoke others\r\n'),
(14, '4.1.14 Charging cellphones and gadgets inside classrooms and hallways\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_notify`
--

CREATE TABLE `bcp_sms3_notify` (
  `notifyId` int(11) NOT NULL,
  `notification_detail` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_register`
--

CREATE TABLE `bcp_sms3_register` (
  `Account_Id` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Year` varchar(255) NOT NULL,
  `Course` varchar(50) NOT NULL,
  `Password` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `User_type` varchar(50) NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcp_sms3_register`
--

INSERT INTO `bcp_sms3_register` (`Account_Id`, `Name`, `Year`, `Course`, `Password`, `User_type`) VALUES
(1, 'vejay ', '4rt', 'BSIT', '12345', '2'),
(9, 'zoleta', '2nd', 'Bsit', '123444', '1');

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_seniorhigh`
--

CREATE TABLE `bcp_sms3_seniorhigh` (
  `Id` int(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year` int(10) NOT NULL,
  `section` varchar(10) NOT NULL,
  `course` varchar(50) NOT NULL,
  `contactnumber` int(15) NOT NULL,
  `address` int(100) NOT NULL,
  `guardianame` varchar(50) NOT NULL,
  `contact` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_year`
--

CREATE TABLE `bcp_sms3_year` (
  `yearId` int(11) NOT NULL,
  `Year` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcp_sms3_year`
--

INSERT INTO `bcp_sms3_year` (`yearId`, `Year`) VALUES
(1, 'Grade 11'),
(2, 'Grade 12'),
(3, '1st year'),
(4, '2nd year'),
(5, '3rd year'),
(6, '4rt year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bcp_sms3_college`
--
ALTER TABLE `bcp_sms3_college`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bcp_sms3_course`
--
ALTER TABLE `bcp_sms3_course`
  ADD PRIMARY KEY (`CourseId`);

--
-- Indexes for table `bcp_sms3_grave`
--
ALTER TABLE `bcp_sms3_grave`
  ADD PRIMARY KEY (`graveId`);

--
-- Indexes for table `bcp_sms3_major`
--
ALTER TABLE `bcp_sms3_major`
  ADD PRIMARY KEY (`majorId`);

--
-- Indexes for table `bcp_sms3_minor`
--
ALTER TABLE `bcp_sms3_minor`
  ADD PRIMARY KEY (`minorId`);

--
-- Indexes for table `bcp_sms3_notify`
--
ALTER TABLE `bcp_sms3_notify`
  ADD PRIMARY KEY (`notifyId`);

--
-- Indexes for table `bcp_sms3_register`
--
ALTER TABLE `bcp_sms3_register`
  ADD PRIMARY KEY (`Account_Id`);

--
-- Indexes for table `bcp_sms3_seniorhigh`
--
ALTER TABLE `bcp_sms3_seniorhigh`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `bcp_sms3_year`
--
ALTER TABLE `bcp_sms3_year`
  ADD PRIMARY KEY (`yearId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bcp_sms3_college`
--
ALTER TABLE `bcp_sms3_college`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bcp_sms3_course`
--
ALTER TABLE `bcp_sms3_course`
  MODIFY `CourseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `bcp_sms3_grave`
--
ALTER TABLE `bcp_sms3_grave`
  MODIFY `graveId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `bcp_sms3_major`
--
ALTER TABLE `bcp_sms3_major`
  MODIFY `majorId` int(12) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bcp_sms3_minor`
--
ALTER TABLE `bcp_sms3_minor`
  MODIFY `minorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `bcp_sms3_register`
--
ALTER TABLE `bcp_sms3_register`
  MODIFY `Account_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `bcp_sms3_seniorhigh`
--
ALTER TABLE `bcp_sms3_seniorhigh`
  MODIFY `Id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bcp_sms3_year`
--
ALTER TABLE `bcp_sms3_year`
  MODIFY `yearId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
