-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2018 at 06:22 PM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Blood_Bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `blood_bank`
--

CREATE TABLE `blood_bank` (
  `B_ID` int(10) UNSIGNED NOT NULL,
  `B_Name` varchar(50) NOT NULL,
  `B_Address` varchar(100) NOT NULL,
  `B_Phone_No` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_bank`
--

INSERT INTO `blood_bank` (`B_ID`, `B_Name`, `B_Address`, `B_Phone_No`) VALUES
(2, 'NagraBank', 'gujarpura', '123'),
(14, 'shaah_g', 'kasur', '1234'),
(15, 'LMS', 'LUMS', '333'),
(16, 'PIC', 'Ghazi road', '555'),
(17, 'zaidi bank', 'abc', '123'),
(20, 'nagragroup', '345', '124');

-- --------------------------------------------------------

--
-- Table structure for table `Blood_Donated`
--

CREATE TABLE `Blood_Donated` (
  `D_iD` int(11) NOT NULL,
  `B_ID` int(10) UNSIGNED NOT NULL,
  `BD_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Blood_Donated`
--

INSERT INTO `Blood_Donated` (`D_iD`, `B_ID`, `BD_id`) VALUES
(79, 2, NULL),
(79, 17, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Blood_Donor`
--

CREATE TABLE `Blood_Donor` (
  `D_ID` int(11) NOT NULL,
  `D_Name` varchar(50) NOT NULL,
  `D_Gender` enum('male','female','other') NOT NULL DEFAULT 'other',
  `D_Age` int(3) NOT NULL,
  `D_Phone_No` text NOT NULL,
  `D_Blood_Group` enum('Ap','An','Bp','Bn','ABp','ABn','Op','Onn') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Blood_Donor`
--

INSERT INTO `Blood_Donor` (`D_ID`, `D_Name`, `D_Gender`, `D_Age`, `D_Phone_No`, `D_Blood_Group`) VALUES
(79, 'Syed Muhammad Hashim', 'male', 22, '3158499494', 'Bp'),
(81, 'Hashim', 'male', 22, '3158499494', 'Bn'),
(82, 'has', 'male', 22, '123', 'Bp');

-- --------------------------------------------------------

--
-- Table structure for table `Blood_Drive`
--

CREATE TABLE `Blood_Drive` (
  `BD_ID` int(11) NOT NULL,
  `Blood_Drive_Name` varchar(50) NOT NULL,
  `B_ID` int(10) UNSIGNED NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Blood_Drive`
--

INSERT INTO `Blood_Drive` (`BD_ID`, `Blood_Drive_Name`, `B_ID`, `Date`) VALUES
(1, 'save a life', 2, '2003-01-02'),
(5, 'become a donor', 14, '0001-01-01'),
(10, 'hellooo', 15, '0001-01-01'),
(11, 'become a hero', 2, '0001-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `Blood_Recipient`
--

CREATE TABLE `Blood_Recipient` (
  `R_id` int(11) NOT NULL,
  `R_name` varchar(50) NOT NULL,
  `R_gender` enum('other','male','female','') NOT NULL DEFAULT 'other',
  `R_age` int(3) NOT NULL,
  `R_phone_No` text NOT NULL,
  `R_blood_group` enum('Ap','An','Bp','Bn','ABp','ABn','Op','Onn') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Blood_Recipient`
--

INSERT INTO `Blood_Recipient` (`R_id`, `R_name`, `R_gender`, `R_age`, `R_phone_No`, `R_blood_group`) VALUES
(14, 'Syeda Mehjabeen Zaidi', 'female', 50, '333', 'Bp'),
(15, 'bukh', 'male', 23, '123', 'Ap');

-- --------------------------------------------------------

--
-- Table structure for table `Blood_Request`
--

CREATE TABLE `Blood_Request` (
  `R_Id` int(11) NOT NULL,
  `Units_Required` int(2) NOT NULL,
  `Till_Required_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Blood_Units_Available`
--

CREATE TABLE `Blood_Units_Available` (
  `B_ID` int(10) UNSIGNED NOT NULL,
  `Ap` int(5) NOT NULL DEFAULT '0',
  `An` int(5) NOT NULL DEFAULT '0',
  `Bp` int(5) NOT NULL DEFAULT '0',
  `Bn` int(5) DEFAULT '0',
  `ABp` int(5) NOT NULL DEFAULT '0',
  `ABn` int(5) NOT NULL DEFAULT '0',
  `Op` int(5) NOT NULL DEFAULT '0',
  `Onn` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Blood_Units_Available`
--

INSERT INTO `Blood_Units_Available` (`B_ID`, `Ap`, `An`, `Bp`, `Bn`, `ABp`, `ABn`, `Op`, `Onn`) VALUES
(17, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Blood_Units_Issued`
--

CREATE TABLE `Blood_Units_Issued` (
  `R_id` int(11) NOT NULL,
  `Units_Issued` int(2) NOT NULL,
  `DateAndTime` datetime NOT NULL,
  `B_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Blood_Units_Issued`
--

INSERT INTO `Blood_Units_Issued` (`R_id`, `Units_Issued`, `DateAndTime`, `B_id`) VALUES
(14, 1, '2018-11-16 21:33:33', 2);

-- --------------------------------------------------------

--
-- Table structure for table `D_Associated_With`
--

CREATE TABLE `D_Associated_With` (
  `D_ID` int(11) NOT NULL,
  `B_ID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `D_Associated_With`
--

INSERT INTO `D_Associated_With` (`D_ID`, `B_ID`) VALUES
(82, 14);

-- --------------------------------------------------------

--
-- Table structure for table `D_Disease`
--

CREATE TABLE `D_Disease` (
  `D_ID` int(11) NOT NULL,
  `D_disease` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `D_Disease`
--

INSERT INTO `D_Disease` (`D_ID`, `D_disease`) VALUES
(81, 'mujtaba'),
(82, 'corns');

-- --------------------------------------------------------

--
-- Table structure for table `R_Associated_With`
--

CREATE TABLE `R_Associated_With` (
  `R_id` int(11) NOT NULL,
  `B_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `R_Associated_With`
--

INSERT INTO `R_Associated_With` (`R_id`, `B_id`) VALUES
(14, 2),
(15, 14);

-- --------------------------------------------------------

--
-- Table structure for table `R_Disease`
--

CREATE TABLE `R_Disease` (
  `R_id` int(11) NOT NULL,
  `R_disease` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `R_Disease`
--

INSERT INTO `R_Disease` (`R_id`, `R_disease`) VALUES
(14, 'blood pressure'),
(15, 'always absent');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blood_bank`
--
ALTER TABLE `blood_bank`
  ADD PRIMARY KEY (`B_ID`);

--
-- Indexes for table `Blood_Donated`
--
ALTER TABLE `Blood_Donated`
  ADD PRIMARY KEY (`D_iD`,`B_ID`),
  ADD KEY `B_ID` (`B_ID`),
  ADD KEY `BD_id` (`BD_id`);

--
-- Indexes for table `Blood_Donor`
--
ALTER TABLE `Blood_Donor`
  ADD PRIMARY KEY (`D_ID`);

--
-- Indexes for table `Blood_Drive`
--
ALTER TABLE `Blood_Drive`
  ADD PRIMARY KEY (`BD_ID`),
  ADD KEY `B_ID` (`B_ID`);

--
-- Indexes for table `Blood_Recipient`
--
ALTER TABLE `Blood_Recipient`
  ADD PRIMARY KEY (`R_id`);

--
-- Indexes for table `Blood_Units_Available`
--
ALTER TABLE `Blood_Units_Available`
  ADD PRIMARY KEY (`B_ID`),
  ADD KEY `B_ID` (`B_ID`);

--
-- Indexes for table `Blood_Units_Issued`
--
ALTER TABLE `Blood_Units_Issued`
  ADD PRIMARY KEY (`R_id`,`DateAndTime`),
  ADD KEY `B_id` (`B_id`);

--
-- Indexes for table `D_Associated_With`
--
ALTER TABLE `D_Associated_With`
  ADD PRIMARY KEY (`D_ID`,`B_ID`),
  ADD KEY `B_ID` (`B_ID`);

--
-- Indexes for table `D_Disease`
--
ALTER TABLE `D_Disease`
  ADD PRIMARY KEY (`D_ID`,`D_disease`);

--
-- Indexes for table `R_Associated_With`
--
ALTER TABLE `R_Associated_With`
  ADD PRIMARY KEY (`R_id`,`B_id`),
  ADD KEY `B_id` (`B_id`);

--
-- Indexes for table `R_Disease`
--
ALTER TABLE `R_Disease`
  ADD PRIMARY KEY (`R_id`,`R_disease`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blood_bank`
--
ALTER TABLE `blood_bank`
  MODIFY `B_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Blood_Donor`
--
ALTER TABLE `Blood_Donor`
  MODIFY `D_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `Blood_Drive`
--
ALTER TABLE `Blood_Drive`
  MODIFY `BD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Blood_Recipient`
--
ALTER TABLE `Blood_Recipient`
  MODIFY `R_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `Blood_Units_Available`
--
ALTER TABLE `Blood_Units_Available`
  MODIFY `B_ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `R_Associated_With`
--
ALTER TABLE `R_Associated_With`
  MODIFY `B_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Blood_Donated`
--
ALTER TABLE `Blood_Donated`
  ADD CONSTRAINT `Blood_Donated_ibfk_1` FOREIGN KEY (`B_ID`) REFERENCES `blood_bank` (`B_ID`),
  ADD CONSTRAINT `Blood_Donated_ibfk_2` FOREIGN KEY (`D_iD`) REFERENCES `Blood_Donor` (`D_ID`),
  ADD CONSTRAINT `Blood_Donated_ibfk_3` FOREIGN KEY (`BD_id`) REFERENCES `Blood_Drive` (`BD_ID`);

--
-- Constraints for table `Blood_Drive`
--
ALTER TABLE `Blood_Drive`
  ADD CONSTRAINT `Blood_Drive_ibfk_1` FOREIGN KEY (`B_ID`) REFERENCES `blood_bank` (`B_ID`);

--
-- Constraints for table `Blood_Units_Available`
--
ALTER TABLE `Blood_Units_Available`
  ADD CONSTRAINT `Blood_Units_Available_ibfk_1` FOREIGN KEY (`B_ID`) REFERENCES `blood_bank` (`B_ID`);

--
-- Constraints for table `Blood_Units_Issued`
--
ALTER TABLE `Blood_Units_Issued`
  ADD CONSTRAINT `Blood_Units_Issued_ibfk_3` FOREIGN KEY (`B_id`) REFERENCES `blood_bank` (`B_ID`),
  ADD CONSTRAINT `Blood_Units_Issued_ibfk_4` FOREIGN KEY (`R_id`) REFERENCES `Blood_Recipient` (`R_id`);

--
-- Constraints for table `D_Associated_With`
--
ALTER TABLE `D_Associated_With`
  ADD CONSTRAINT `D_Associated_With_ibfk_2` FOREIGN KEY (`B_ID`) REFERENCES `blood_bank` (`B_ID`),
  ADD CONSTRAINT `D_Associated_With_ibfk_3` FOREIGN KEY (`D_ID`) REFERENCES `Blood_Donor` (`D_ID`);

--
-- Constraints for table `D_Disease`
--
ALTER TABLE `D_Disease`
  ADD CONSTRAINT `D_Disease_ibfk_1` FOREIGN KEY (`D_ID`) REFERENCES `Blood_Donor` (`D_ID`);

--
-- Constraints for table `R_Associated_With`
--
ALTER TABLE `R_Associated_With`
  ADD CONSTRAINT `R_Associated_With_ibfk_3` FOREIGN KEY (`B_id`) REFERENCES `blood_bank` (`B_ID`),
  ADD CONSTRAINT `R_Associated_With_ibfk_4` FOREIGN KEY (`R_id`) REFERENCES `Blood_Recipient` (`R_id`);

--
-- Constraints for table `R_Disease`
--
ALTER TABLE `R_Disease`
  ADD CONSTRAINT `R_Disease_ibfk_1` FOREIGN KEY (`R_id`) REFERENCES `Blood_Recipient` (`R_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
