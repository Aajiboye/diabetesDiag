-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2019 at 08:58 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diabetes_diagnosis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

CREATE TABLE `tbl_patient` (
  `fld_patientid` int(11) NOT NULL,
  `fld_firstname` text NOT NULL,
  `fld_lastname` text NOT NULL,
  `fld_email` varchar(40) NOT NULL,
  `fld_cardNumber` varchar(500) NOT NULL,
  `fld_password` varchar(100) NOT NULL,
  `fld_dob` date NOT NULL,
  `fld_diagnosis` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`fld_patientid`, `fld_firstname`, `fld_lastname`, `fld_email`, `fld_cardNumber`, `fld_password`, `fld_dob`, `fld_diagnosis`) VALUES
(22, 'Abraham', 'Ajiboye', 'siracube@gmail.com', 'NG0022', 'ghtyrufjd34677&&*9##Dejkeyz106**ghtyrufjd34677&&*9##', '1993-01-01', 0),
(23, 'Temidayo', 'Abraham', 'temiabraham@gmail.com', 'NG0023', 'ghtyrufjd34677&&*9##Temiabraham123ghtyrufjd34677&&*9##', '2019-12-13', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  ADD PRIMARY KEY (`fld_patientid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_patient`
--
ALTER TABLE `tbl_patient`
  MODIFY `fld_patientid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
