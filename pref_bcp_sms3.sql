-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 07:25 PM
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
-- Database: `pref_bcp_sms3`
--

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_admin`
--

CREATE TABLE `bcp_sms3_admin` (
  `AccountId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcp_sms3_admin`
--

INSERT INTO `bcp_sms3_admin` (`AccountId`, `name`, `password`) VALUES
(1234, 'rey', '1234'),
(20001, 'Nick Jhoven M. Zoleta', '12344');

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_grave`
--

CREATE TABLE `bcp_sms3_grave` (
  `graveId` int(50) NOT NULL,
  `grave` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcp_sms3_grave`
--

INSERT INTO `bcp_sms3_grave` (`graveId`, `grave`) VALUES
(1, '4.1.3.1 Possession, use or sale prohibited drugs or chemicals and hallucinogenic drugs or substances in any form within the school premises, or the possession of any regulated drug without the proper prescription.'),
(2, '4.1.3.2 Theft pilferage of school equipment, materials or supplies, extortion, robbery or an attempt thereof and any form of dishonesty.'),
(3, '4.1.3.3 Forgery or falsification and/ or alteration of academic or official records or documents of any kind.'),
(4, '4.1.3.4 Willful disregard of authority, disrespect, discourtesy and disobedience to any school official, member of faculty. administration or their representative.'),
(5, '4.1.3.5 Direct assault upon a person of authority or any school official, faculty member non-academic staff or any personal of the school community'),
(6, '4.1.3.6 Having been convicted of a crime and/or moral turpitude in any court of justice.'),
(7, '4.1.3.7 Committing any act punishable under existing law of the land within and outside the campus and violation of the laws of the Commission on Higher Education.'),
(8, '4.1.3.8 Tampering/altering such as changing original photos of ID cards, registration cards, and other school forms.'),
(9, '4.1.3.9 Allowing other students or individuals to use their school ID for any purpose.'),
(10, '4.1.3.10 Using the name and seal of BESTLINK on printed matters such as program, invitation, announcement, tickets, certification,solicitation etc., without permission from school president or her official representatives.'),
(11, '4.1.3.12 Posting inappropriate photos, videos or messages (Cyber Crime).'),
(12, '4.1.3.13 Bullying, harassing, defaming, or discriminating against fellow students, faculty, administrators, employees or any other person in social media platforms.'),
(13, '4.1.3.14 Discussing, ventilating uploading grievances, concerns, or issues in social networking platforms.'),
(14, '4.1.3.15 Exploding of firecrackers, pyrotechnics, pillbox bomb, molotov bomb, and others.'),
(15, '4.1.3.16 Carrying deadly weapon and/ or dangerous weapon Including Improvised weapon, explosive and incendiaries Inside the campus.'),
(16, '4.1.3.17 Unauthorized use, opening and/or reading or browsing of computer program, files and the like.'),
(17, '4.1.3.18 Recruitment to fraternities, hazing and other similar act (RA 8049),'),
(18, '4.1.3.19 Unauthorized bringing of outsiders inside the classroom laboratory or office that destroys properties and/or distracts classroom instruction.'),
(19, '4.1.3.20 Provoking offensive action that leads to violence.'),
(20, '4.1.3.21 Holding of rallies, meetings, activities or programs without necessary permit from the school authorities.'),
(21, '4.1.3.22 Unauthorized copying of computer programs, files and others.'),
(22, '4.1.3.23-Uttering/expressing profane or indecent language.'),
(23, '4.1.3.24 Gambling or playing cards and any misdemeanor/ misbehavior within 100 meters away from the school.'),
(24, '4.1.3.25 Unauthorized selling of tickets/solicitation.'),
(25, '4.1.3.1 Possession, use or sale prohibited drugs or chemicals and hallucinogenic drugs or substances in any form within the school premises, or the possession of any regulated drug without the proper prescription.'),
(26, '4.1.3.2 Theft pilferage of school equipment, materials or supplies, extortion, robbery or an attempt thereof and any form of dishonesty.'),
(27, '4.1.3.3 Forgery or falsification and/ or alteration of academic or official records or documents of any kind.'),
(28, '4.1.3.4 Willful disregard of authority, disrespect, discourtesy and disobedience to any school official, member of faculty. administration or their representative.'),
(29, '4.1.3.5 Direct assault upon a person of authority or any school official, faculty member non-academic staff or any personal of the school community'),
(30, '4.1.3.6 Having been convicted of a crime and/or moral turpitude in any court of justice.'),
(31, '4.1.3.7 Committing any act punishable under existing law of the land within and outside the campus and violation of the laws of the Commission on Higher Education.'),
(32, '4.1.3.8 Tampering/altering such as changing original photos of ID cards, registration cards, and other school forms.'),
(33, '4.1.3.9 Allowing other students or individuals to use their school ID for any purpose.'),
(34, '4.1.3.10 Using the name and seal of BESTLINK on printed matters such as program, invitation, announcement, tickets, certification,solicitation etc., without permission from school president or her official representatives.'),
(35, '4.1.3.12 Posting inappropriate photos, videos or messages (Cyber Crime).'),
(36, '4.1.3.13 Bullying, harassing, defaming, or discriminating against fellow students, faculty, administrators, employees or any other person in social media platforms.'),
(37, '4.1.3.14 Discussing, ventilating uploading grievances, concerns, or issues in social networking platforms.'),
(38, '4.1.3.15 Exploding of firecrackers, pyrotechnics, pillbox bomb, molotov bomb, and others.'),
(39, '4.1.3.16 Carrying deadly weapon and/ or dangerous weapon Including Improvised weapon, explosive and incendiaries Inside the campus.'),
(40, '4.1.3.17 Unauthorized use, opening and/or reading or browsing of computer program, files and the like.'),
(41, '4.1.3.18 Recruitment to fraternities, hazing and other similar act (RA 8049),'),
(42, '4.1.3.19 Unauthorized bringing of outsiders inside the classroom laboratory or office that destroys properties and/or distracts classroom instruction.'),
(43, '4.1.3.20 Provoking offensive action that leads to violence.'),
(44, '4.1.3.21 Holding of rallies, meetings, activities or programs without necessary permit from the school authorities.'),
(45, '4.1.3.22 Unauthorized copying of computer programs, files and others.'),
(46, '4.1.3.23-Uttering/expressing profane or indecent language.'),
(47, '4.1.3.24 Gambling or playing cards and any misdemeanor/ misbehavior within 100 meters away from the school.'),
(48, '4.1.3.25 Unauthorized selling of tickets/solicitation.');

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_major`
--

CREATE TABLE `bcp_sms3_major` (
  `majorId` int(20) NOT NULL,
  `major` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcp_sms3_major`
--

INSERT INTO `bcp_sms3_major` (`majorId`, `major`) VALUES
(1, '4.1.2.1 Unauthorized bringing out of chairs, tables, books, and other school facilities/equipment\r\n'),
(2, '4.1.2.2 Smoking within the Campus.\r\n'),
(3, '4.1.2.3 Excessive public display of affection e.g. kissing. hugging, necking, petting, and the like.\r\n'),
(4, '4.1.2.4 Possession, and distribution or perusal of pornographic magazines, pictures, films, cartridges, cards, key chains, figurines, and the like.\r\n'),
(5, '4.1.2.5 Vandalism or destruction of school property belonging to any member of the faculty, administration, non-teaching staff.\r\n'),
(6, '4.1.2.6 Entering or being in the school premises under the Influence of liquor or prohibited drugs.\r\n'),
(7, '4.1.2.7 Unauthorized operation of the school equipment Including electrical switches.\r\n'),
(8, '4.1.2.8 Acts of disrespect in words or indeed committee against any administrator, faculty member, co-academic personnel, security guards, maintenance personnel, student and visitors.\r\n'),
(9, '4.1.2.9 Illegal intrusion in the classroom and/or any office.\r\n'),
(10, '4.1.2.10 Committing acts of bullying.\r\n'),
(11, '4.1.2.11 Creating malicious, information (e.g bomb threat, gossiping, misrepresentation, slanderous and libelous utterances.)\r\n'),
(12, '4.1.2.12 Unauthorized use of funds of an organization/cl for his/her personal interest.\r\n'),
(13, '4.1.2.13 Acts of cheating.\r\n'),
(14, '4.1.2.13.1 Actual use of cheating paraphernalia during t quizzes and periodic examinations.\r\n'),
(15, '4.1.2.13.2 Having someone else take the prelims, midterm and final examination for another.\r\n'),
(16, '4.1.2.13.3 Exchanging examination notebooks, booklets, passing one\'s notebook to another to enable the latter copy it.\r\n'),
(17, '4.1.2.13.4 Reading or looking deliberately at another student\'s examination paper paper/notebook/booklet to another or showing one\'s\r\n'),
(18, '4.1.2.13.5 Dictating answer during examination.\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_minor`
--

CREATE TABLE `bcp_sms3_minor` (
  `minorId` int(50) NOT NULL,
  `minor` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bcp_sms3_minor`
--

INSERT INTO `bcp_sms3_minor` (`minorId`, `minor`) VALUES
(1, '4.1.1 Not wearing a school ID card'),
(2, '4.1.2 Eating inside the classroom, chewing bubble gums'),
(3, '4.1.3 Loitering near the gate or any act that may block the flow of human traffic'),
(4, '4.1.4 Public Display of Affection'),
(5, '4.1.5 Unauthorized posting or use of banners'),
(6, '4.1.6 Spitting on the floor or any act that creates unsanitary conditions'),
(7, '4.1.7 Improper haircut, dyeing of hair, or wearing inappropriate accessories'),
(8, '4.1.8 Entering faculty restrooms without consent'),
(9, '4.1.9 Male students entering female comfort rooms or vice versa'),
(10, '4.1.10 Unhygienic use of college facilities'),
(11, '4.1.11 Bringing in pointed objects'),
(12, '4.1.12 Refusal to submit to lawful inspection'),
(13, '4.1.13 Using lewd gestures to provoke others'),
(14, '4.1.14 Charging cellphones and gadgets inside classrooms and hallways');

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_studentinfo`
--

CREATE TABLE `bcp_sms3_studentinfo` (
  `Id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `address` int(11) NOT NULL,
  `email` int(11) NOT NULL,
  `bday` int(11) NOT NULL,
  `guardianname` int(11) NOT NULL,
  `g_phonenumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms3_user`
--

CREATE TABLE `bcp_sms3_user` (
  `AccountId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `year` int(50) NOT NULL,
  `course` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `login` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bcp_sms_log`
--

CREATE TABLE `bcp_sms_log` (
  `Studentnumber_Id` int(20) NOT NULL,
  `Nameid` int(50) NOT NULL,
  `yearid` int(50) NOT NULL,
  `courseid` int(50) NOT NULL,
  `sectionid` int(50) NOT NULL,
  `severityid` int(50) NOT NULL,
  `offencesid` int(50) NOT NULL,
  `evidence` int(50) NOT NULL,
  `involve` int(50) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bcp_sms3_admin`
--
ALTER TABLE `bcp_sms3_admin`
  ADD PRIMARY KEY (`AccountId`);

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
-- Indexes for table `bcp_sms3_user`
--
ALTER TABLE `bcp_sms3_user`
  ADD PRIMARY KEY (`AccountId`);

--
-- Indexes for table `bcp_sms_log`
--
ALTER TABLE `bcp_sms_log`
  ADD PRIMARY KEY (`Studentnumber_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bcp_sms3_admin`
--
ALTER TABLE `bcp_sms3_admin`
  MODIFY `AccountId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20002;

--
-- AUTO_INCREMENT for table `bcp_sms3_grave`
--
ALTER TABLE `bcp_sms3_grave`
  MODIFY `graveId` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `bcp_sms3_major`
--
ALTER TABLE `bcp_sms3_major`
  MODIFY `majorId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `bcp_sms3_minor`
--
ALTER TABLE `bcp_sms3_minor`
  MODIFY `minorId` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `bcp_sms3_user`
--
ALTER TABLE `bcp_sms3_user`
  MODIFY `AccountId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bcp_sms_log`
--
ALTER TABLE `bcp_sms_log`
  MODIFY `Studentnumber_Id` int(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
