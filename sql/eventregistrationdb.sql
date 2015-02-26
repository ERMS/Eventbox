-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2015 at 08:51 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eventregistrationdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`Attendee_ID` int(10) NOT NULL,
  `Event_ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Status` varchar(10) NOT NULL,
  `Attendee_Title` varchar(10) NOT NULL,
  `Hour_Confirmed` int(2) NOT NULL,
  `Minute_Confirmed` int(2) NOT NULL,
  `CH_Confirmed` varchar(2) NOT NULL,
  `Day_Confirmed` int(2) NOT NULL,
  `Month_Confirmed` int(2) NOT NULL,
  `Year_Confirmed` int(4) NOT NULL,
  `Hour_Requested` int(2) NOT NULL,
  `Minute_Requested` int(2) NOT NULL,
  `CH_Requested` varchar(2) NOT NULL,
  `Day_Requested` int(2) NOT NULL,
  `Month_Requested` int(2) NOT NULL,
  `Year_Requested` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`Event_ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Event_Title` varchar(30) NOT NULL,
  `Event_Description` varchar(300) NOT NULL,
  `Event_ContactNumber` int(20) NOT NULL,
  `Event_Privacy` varchar(10) NOT NULL,
  `Event_Deadline` varchar(30) NOT NULL,
  `Event_Slot` int(10) NOT NULL,
  `Event_File` blob NOT NULL,
  `Event_Country` varchar(20) NOT NULL,
  `Event_City` varchar(20) NOT NULL,
  `Event_Street` varchar(20) NOT NULL,
  `Event_Additional` varchar(100) NOT NULL,
  `Event_Logo` blob NOT NULL,
  `Event_Password` longtext NOT NULL,
  `Event_StartHour` int(2) NOT NULL,
  `Event_StartMinute` int(2) NOT NULL,
  `Event_StartCH` varchar(2) NOT NULL,
  `Event_EndHour` int(2) NOT NULL,
  `Event_EndMinute` int(2) NOT NULL,
  `Event_EndCH` varchar(2) NOT NULL,
  `Event_StartDay` int(2) NOT NULL,
  `Event_StartMonth` varchar(10) NOT NULL,
  `Event_StartYear` int(4) NOT NULL,
  `Event_EndDay` int(2) NOT NULL,
  `Event_EndMonth` varchar(10) NOT NULL,
  `Event_EndYear` int(4) NOT NULL,
  `Event_Status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE IF NOT EXISTS `form` (
`Form_ID` int(10) NOT NULL,
  `Event_ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Form_Order` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE IF NOT EXISTS `management` (
  `Event_ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Day_Created` int(2) NOT NULL,
  `Month_Created` int(2) NOT NULL,
  `Year_Created` int(4) NOT NULL,
  `Minute_Created` int(2) NOT NULL,
  `Hour_Created` int(2) NOT NULL,
  `CH_Created` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
`Registration_ID` int(10) NOT NULL,
  `Form_ID` int(10) NOT NULL,
  `User_ID` int(10) NOT NULL,
  `Form_Value` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`User_ID` int(10) NOT NULL,
  `User_Password` longtext NOT NULL,
  `User_ProfilePicture` blob NOT NULL,
  `User_Email` varchar(40) NOT NULL,
  `User_FirstName` varchar(20) NOT NULL,
  `User_LastName` varchar(20) NOT NULL,
  `User_Country` varchar(20) NOT NULL,
  `User_City` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`Attendee_ID`), ADD KEY `Attendee_ID` (`Attendee_ID`), ADD KEY `Event_ID` (`Event_ID`), ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`Event_ID`), ADD KEY `User_ID` (`User_ID`), ADD KEY `User_ID_2` (`User_ID`), ADD KEY `Event_ID` (`Event_ID`), ADD KEY `User_ID_3` (`User_ID`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
 ADD PRIMARY KEY (`Form_ID`), ADD KEY `Form_ID` (`Form_ID`), ADD KEY `Event_ID` (`Event_ID`), ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
 ADD PRIMARY KEY (`Event_ID`,`User_ID`), ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
 ADD PRIMARY KEY (`Registration_ID`), ADD KEY `Registration_ID` (`Registration_ID`), ADD KEY `Form_ID` (`Form_ID`), ADD KEY `User_ID` (`User_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `Attendee_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
MODIFY `Event_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
MODIFY `Form_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
MODIFY `Registration_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `User_ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`Event_ID`) REFERENCES `event` (`Event_ID`) ON DELETE CASCADE,
ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE;

--
-- Constraints for table `event`
--
ALTER TABLE `event`
ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE;

--
-- Constraints for table `form`
--
ALTER TABLE `form`
ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`Event_ID`) REFERENCES `event` (`Event_ID`) ON DELETE CASCADE,
ADD CONSTRAINT `form_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE;

--
-- Constraints for table `management`
--
ALTER TABLE `management`
ADD CONSTRAINT `management_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE,
ADD CONSTRAINT `management_ibfk_3` FOREIGN KEY (`Event_ID`) REFERENCES `event` (`Event_ID`) ON DELETE CASCADE;

--
-- Constraints for table `registration`
--
ALTER TABLE `registration`
ADD CONSTRAINT `registration_ibfk_1` FOREIGN KEY (`Form_ID`) REFERENCES `form` (`Form_ID`) ON DELETE CASCADE,
ADD CONSTRAINT `registration_ibfk_2` FOREIGN KEY (`User_ID`) REFERENCES `user` (`User_ID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
