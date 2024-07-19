-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 12:53 PM
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
-- Database: `pms`
--

-- --------------------------------------------------------

--
-- Table structure for table `adadduser`
--

CREATE TABLE `adadduser` (
  `email` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adadduser`
--

INSERT INTO `adadduser` (`email`, `pass`) VALUES
('Admin', 'Admin123'),
('Admin12', '12345'),
('Admin123', 'Admin123'),
('Admin567', 'Admin123'),
('farhan', 'admin123'),
('salmon', 'Admin123'),
('shalini', 'Admin'),
('shalinis', 'Admin123'),
('Test', 'Test123');

-- --------------------------------------------------------

--
-- Table structure for table `addstudent`
--

CREATE TABLE `addstudent` (
  `student_id` varchar(30) NOT NULL,
  `student_name` varchar(30) NOT NULL,
  `student_email` varchar(30) NOT NULL,
  `student_phone` varchar(10) NOT NULL,
  `student_department` varchar(6) NOT NULL,
  `student_cgpa` varchar(30) NOT NULL,
  `student_skills` varchar(30) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `tenth_percentage` varchar(30) NOT NULL,
  `pluspercentage` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `placement_status` varchar(30) NOT NULL,
  `company_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addstudent`
--

INSERT INTO `addstudent` (`student_id`, `student_name`, `student_email`, `student_phone`, `student_department`, `student_cgpa`, `student_skills`, `dob`, `tenth_percentage`, `pluspercentage`, `gender`, `placement_status`, `company_name`) VALUES
('22MCA001', 'ADITHYA RAO S', '', '9876543210', '', '9.2', '', '', '', '', '', 'Not Placed', 'clair'),
('22MCA002', 'ARUNKUMAR T', '', '9876543211', '', '7.8', '', '', '', '', '', 'Not Placed', 'Accenture'),
('22MCA003', 'BHAVTHARANI R.K', '', '9876543212', '', '8.5', '', '', '', '', '', 'Placed', 'protivity'),
('22MCA004', 'BUVANYASHRI P', '', '9876543213', '', '6.3', '', '', '', '', '', 'bhuvi@gmail.com', 'bhuviniyashri'),
('22MCA005', 'CHANDAR R', '', '9876543214', '', '8.8', '', '', '', '', '', '', ''),
('22MCA006', 'DHARANI P', '', '9876543215', '', '9.8', '', '', '', '', '', 'Placed', 'ZOHO'),
('22MCA007', 'DINESH S', '', '9876543216', '', '6.9', '', '', '', '', '', '', ''),
('22MCA008', 'DIVYA BHARATHI P', '', '9876543217', '', '8', '', '', '', '', '', 'Placed', 'DevRev'),
('22MCA009', 'GOKULRAJ A', '', '9876543218', '', '7.5', '', '', '', '', '', '', ''),
('22MCA010', 'HARISHBABU K', '', '9876543219', '', '6.7', '', '', '', '', '', '', ''),
('22MCA011', 'HARSHA NIVETHA J', '', '9876543220', '', '9.5', '', '', '', '', '', '', ''),
('22MCA012', 'ISAIMOZHI S', '', '9876543221', '', '8.2', '', '', '', '', '', 'Not Placed', 'DevRev'),
('22MCA013', 'JAYARAGAVI K S', '', '9876543222', '', '7.4', '', '', '', '', '', '', ''),
('22MCA014', 'JEYASURYA V', '', '9876543223', '', '9', '', '', '', '', '', '', ''),
('22MCA015', 'JOLENE ISABELLA MENEZES', '', '9876543224', '', '6.5', '', '', '', '', '', '', ''),
('22MCA016', 'JOYSON JEBADURAI A', '', '9876543225', '', '8.7', '', '', '', '', '', '', ''),
('22MCA017', 'KAVIN GUNASEKARAN', '', '9876543226', '', '7.2', '', '', '', '', '', 'Placed', 'Digit ai'),
('22MCA018', 'KAVIN KRISHNA K', '', '9876543227', '', '9.3', '', '', '', '', '', '', ''),
('22MCA019', 'KAVIYARASU A', '', '9876543228', '', '8.4', '', '', '', '', '', '', ''),
('22MCA020', 'KEERTHANA S', '', '9876543229', '', '7.9', '', '', '', '', '', '', ''),
('22MCA021', 'KEERTHANADEVI S', '', '9876543230', '', '8.1', '', '', '', '', '', '', ''),
('22MCA022', 'KIRUPPA SRI S', '', '9876543231', '', '6', '', '', '', '', '', '', ''),
('22MCA023', 'KISHORE KUMAR V', '', '9876543232', '', '9.7', '', '', '', '', '', '', ''),
('22MCA024', 'MADHUMITHA K', '', '9876543233', '', '8.9', '', '', '', '', '', '', ''),
('22MCA025', 'MANOJ KUMAR K', '', '9876543234', '', '7.6', '', '', '', '', '', '', ''),
('22MCA026', 'MOHAMED ASIF S', '', '9876543235', '', '7.3', '', '', '', '', '', 'Placed', 'Avasoft1'),
('22MCA027', 'MOHAMMEDIRFAN A', '', '9876543236', '', '8.3', '', '', '', '', '', 'Placed', 'DevRev'),
('22MCA028', 'MOHAN  A', '', '9876543237', '', '6.6', '', '', '', '', '', '', ''),
('22MCA029', 'MOHANPATHI S', '', '9876543238', '', '9.1', '', '', '', '', '', '', ''),
('22MCA030', 'NANDHINI M', '', '9876543239', '', '7.7', '', '', '', '', '', '', ''),
('22MCA031', 'NERAIMATHI S', '', '9876543240', '', '8.8', '', '', '', '', '', '', ''),
('22MCA032', 'NITHIESH SOMASUNDARAM', '', '9876543241', '', '6.4', '', '', '', '', '', '', ''),
('22MCA033', 'PAVITH AMARNATH P', '', '9876543242', '', '9.6', '', '', '', '', '', 'Placed', 'google'),
('22MCA034', 'POOJA R', '', '9876543243', '', '8.6', '', '', '', '', '', 'Placed', 'Renix'),
('22MCA035', 'PREETHI S', '', '9876543244', '', '7', '', '', '', '', '', 'Placed', 'Accenture'),
('22MCA036', 'PRIYADHARSHINI M', '', '9876543245', '', '8.2', '', '', '', '', '', 'Not Placed', 'TECHMAHINDRA'),
('22MCA037', 'PRIYANKA R', '', '9876543246', '', '6.8', '', '', '', '', '', '', ''),
('22MCA038', 'RAMA LAKSHMI T', '', '9876543247', '', '9.4', '', '', '', '', '', '', ''),
('22MCA039', 'RAMESHKUMAR K', '', '9876543248', '', '7.5', '', '', '', '', '', '', ''),
('22MCA040', 'RAMYA C', '', '9876543249', '', '8', '', '', '', '', '', '', ''),
('22MCA041', 'SALAI SOUMYA S', '', '9876543250', '', '8.7', '', '', '', '', '', '', ''),
('22MCA042', 'SAMYUKTHA P', '', '9876543251', '', '6.3', '', '', '', '', '', 'Placed', 'clair'),
('22MCA043', 'SANDHIYA V', '', '9876543252', '', '9.8', '', '', '', '', '', '', ''),
('22MCA044', 'SARUBALA B', '', '9876543253', '', '7.2', '', '', '', '', '', '', ''),
('22MCA045', 'SHAKTHI D', '', '9876543254', '', '8.9', '', '', '', '', '', '', ''),
('22MCA046', 'SHIYAM P', '', '9876543255', '', '7.4', '', '', '', '', '', '', ''),
('22MCA047', 'SHREENITHI V M', '', '9876543256', '', '6.5', '', '', '', '', '', '', ''),
('22MCA048', 'SHUBHAKARINI S', '', '9876543257', '', '9.3', '', '', '', '', '', '', ''),
('22MCA049', 'SHUNMUGA PRIYA B', '', '9876543258', '', '8.1', '', '', '', '', '', '', ''),
('22MCA050', 'SIBI CHAKRAVARTHI S', '', '9876543259', '', '8.6', '', '', '', '', '', '', ''),
('22MCA051', 'SNEHA M', '', '9876543260', '', '7.8', '', '', '', '', '', '', ''),
('22MCA052', 'SNEHALATHAA T', '', '9876543261', '', '9.2', '', '', '', '', '', '', ''),
('22MCA053', 'SRIDHARUN P', '', '9876543262', '', '8', '', '', '', '', '', 'Placed', 'Renix'),
('22MCA054', 'SRISABARISH N', '', '9876543263', '', '7.6', '', '', '', '', '', '', ''),
('22MCA055', 'SUBASH KARTHIK R', '', '9876543264', '', '6.9', '', '', '', '', '', '', ''),
('22MCA056', 'SUBASHRI B S', '', '9876543265', '', '9', '', '', '', '', '', '', ''),
('22MCA057', 'TAMILARASAN G', '', '9876543266', '', '8.3', '', '', '', '', '', '', ''),
('22MCA058', 'THARANYA K', '', '9876543267', '', '7.1', '', '', '', '', '', '', ''),
('22MCA059', 'THARUN RAJA K', '', '9876543268', '', '8.5', '', '', '', '', '', 'Placed', 'Digit ai'),
('22MCA060', 'VASAN R', '', '9876543269', '', '7.4', '', '', '', '', '', '', ''),
('22MCA061', 'VETRIKANI V', '', '9876543270', '', '9.7', '', '', '', '', '', '', ''),
('22MCA063', 'yeswanth', 'yes@gmail.com', '9988667712', 'MCA', '6.2', 'java,css', '14-01-2001', '90', '89', 'male', '', ''),
('22MCA065', 'Salmon', 'sal@gmail.com', '998866773', 'MCA', '6.2', '15-07-2000', '90', '89', 'male', 'python', 'Placed', 'google'),
('22MCA066', 'Mustak', 'mus@gmail.com', '9876543213', 'MCA', '8.68', 'python', '2000-06-06', '77', '88', 'male', 'Placed', 'Linkednin'),
('﻿22MCA064', 'SAKTHIVEL', 'sakthi@gmail.com', '9876543219', 'MCA', '8.2', 'python', '12-01-2001', '86', '53', 'male', 'Placed', 'CAMPALIN');

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `adminid` varchar(30) NOT NULL,
  `adminpass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`adminid`, `adminpass`) VALUES
('Admin', 'Admin123');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` varchar(30) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `industry` varchar(30) NOT NULL,
  `hq_location` varchar(30) NOT NULL,
  `website` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `industry`, `hq_location`, `website`) VALUES
('1', 'google', 'IT', 'Chennai', 'https://www.google.com/about/c'),
('3', 'clair', 'IT', 'coimbatore', 'https://claire-technologies.co'),
('2', 'Accenture', 'IT', 'Chennai', 'https://www.googleadservices.c'),
('23', 'protivity', 'IT', 'Banglore', 'https://www.protiviti.com/in-e'),
('76', 'Digit ai', 'IT', 'Chennai', 'https://www.digitap.ai/'),
('﻿89', 'Renix', 'IT', 'Tutucorin', 'https://www.renixinformatics.c'),
('76', 'Microsoft', 'IT', 'Delhi', 'https://www.googleadservices.c'),
('81', 'Oracle', 'IT', 'Chennai', 'https://www.googleadservices.c'),
('45', 'Dataspire', 'IT', 'coimbatore', 'https://www.googleadservices.c'),
('3', 'shamla Tech solution', 'IT', 'coimbatore', 'https://www.googleadservices.c'),
('67', 'Byzus', 'IT', 'Trichy', 'https://www.googleadservices.c'),
('4', 'Aqua', 'Managment', 'Mumbai', 'https://www.googleadservices.c'),
('7', 'Forge', 'technical', 'coimbatore', 'https://www.googleadservices.c'),
('10', 'ZOHO', 'technical', 'coimbatore', 'https://www.googleadservices.c'),
('77', 'TerraLogic', 'technical', 'coimbatore', 'https://www.googleadservices.c'),
('9', 'Cult.Fit', 'Managment', 'coimbatore', 'https://www.googleadservices.c'),
('11', 'DevRev', 'IT', 'Banglore', 'https://www.googleadservices.c'),
('33', 'Edurekha', 'Managment', 'Trichy', 'https://www.googleadservices.c'),
('33', 'TECHMAHINDRA', 'IT', 'ERODE', 'https://www.googleadservices.c'),
('54', 'CAMPALIN', 'Managment', 'Madurai', 'https://www.googleadservices.c'),
('90', 'Prochant', 'Managment', 'Tuticorin', 'https://www.googleadservices.c'),
('77', 'google', 'technical', 'Banglore', 'https://www.googleadservices.c'),
('3', 'microsoft', 'technical', 'Trichy', 'https://www.protiviti.com/in-e'),
('﻿100', '2cent', 'IT', 'Hyderabd', 'https://www.tcs.com/'),
('﻿101', 'mypaisa', 'it', 'chennai', 'https://www.googleadservices.c'),
('﻿101', 'mypaisa', 'it', 'chennai', 'https://www.googleadservices.c'),
('﻿101', 'mypaisa', 'it', 'chennai', 'https://www.googleadservices.c'),
('103', 'fast', 'IT', 'Trichy', 'https://www.google.com/about/c'),
('105', 'Linkednin', 'IT', 'Banglore', 'https://www.googleadservices.c'),
('﻿101', 'mypaisa', 'it', 'chennai', 'https://www.googleadservices.c');

-- --------------------------------------------------------

--
-- Table structure for table `pcadduser`
--

CREATE TABLE `pcadduser` (
  `studentid` varchar(30) NOT NULL,
  `studentpass` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pcadduser`
--

INSERT INTO `pcadduser` (`studentid`, `studentpass`) VALUES
('Admin', 'Admin123'),
('Asif', 'Admin123'),
('jaga', 'Admin123'),
('Test', 'Test123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adadduser`
--
ALTER TABLE `adadduser`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `addstudent`
--
ALTER TABLE `addstudent`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `adminlogin`
--
ALTER TABLE `adminlogin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `pcadduser`
--
ALTER TABLE `pcadduser`
  ADD PRIMARY KEY (`studentid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
