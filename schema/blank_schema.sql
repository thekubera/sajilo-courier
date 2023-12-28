-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2023 at 11:08 AM
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
-- Database: `sajilo_courier`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(11) NOT NULL,
  `afname` varchar(30) NOT NULL,
  `amname` varchar(30) DEFAULT NULL,
  `alname` varchar(30) NOT NULL,
  `aaddress` varchar(40) NOT NULL,
  `aphone` varchar(14) NOT NULL,
  `aphoto` varchar(30) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_branch`
--

CREATE TABLE `admin_branch` (
  `aid` int(11) NOT NULL,
  `bid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin_staff`
--

CREATE TABLE `admin_staff` (
  `aid` int(11) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `bid` int(11) NOT NULL,
  `bname` varchar(30) NOT NULL,
  `baddress` varchar(40) NOT NULL,
  `bemail` varchar(40) NOT NULL,
  `bphone` varchar(14) NOT NULL,
  `bcountry` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cid` int(11) NOT NULL,
  `cname` varchar(40) NOT NULL,
  `cadd` varchar(40) NOT NULL,
  `cemail` varchar(40) NOT NULL,
  `cphone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `phno` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `phremarks` varchar(100) DEFAULT NULL,
  `phstatus` varchar(15) NOT NULL,
  `phdate` datetime DEFAULT current_timestamp()
) ;

-- --------------------------------------------------------

--
-- Table structure for table `parcel`
--

CREATE TABLE `parcel` (
  `pid` int(11) NOT NULL,
  `prefnum` varchar(25) NOT NULL,
  `pdlength` decimal(10,2) DEFAULT NULL,
  `pdbreadth` decimal(10,2) DEFAULT NULL,
  `pdheight` decimal(10,2) DEFAULT NULL,
  `pweight` decimal(10,2) DEFAULT NULL,
  `pprice` decimal(10,4) DEFAULT NULL,
  `sid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `staffID` int(11) NOT NULL,
  `pstatus` varchar(15) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `receiver`
--

CREATE TABLE `receiver` (
  `rid` int(11) NOT NULL,
  `rbname` varchar(30) NOT NULL,
  `rcountry` varchar(30) NOT NULL,
  `cid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sajilo_user`
--

CREATE TABLE `sajilo_user` (
  `uid` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(60) NOT NULL,
  `utype` varchar(5) NOT NULL,
  `createdate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sender`
--

CREATE TABLE `sender` (
  `sid` int(11) NOT NULL,
  `sbname` varchar(30) NOT NULL,
  `scountry` varchar(30) NOT NULL,
  `cid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `sid` int(11) NOT NULL,
  `sfname` varchar(30) NOT NULL,
  `smname` varchar(30) DEFAULT NULL,
  `slname` varchar(30) NOT NULL,
  `saddress` varchar(40) NOT NULL,
  `sphone` varchar(14) NOT NULL,
  `sphoto` varchar(30) DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  `bid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`),
  ADD UNIQUE KEY `aphone` (`aphone`),
  ADD UNIQUE KEY `uid` (`uid`);

--
-- Indexes for table `admin_branch`
--
ALTER TABLE `admin_branch`
  ADD PRIMARY KEY (`aid`,`bid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `admin_staff`
--
ALTER TABLE `admin_staff`
  ADD UNIQUE KEY `aid` (`aid`,`sid`),
  ADD KEY `sid` (`sid`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `bemail` (`bemail`),
  ADD UNIQUE KEY `bphone` (`bphone`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `cemail` (`cemail`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`phno`,`pid`),
  ADD KEY `parcel_id` (`pid`);

--
-- Indexes for table `parcel`
--
ALTER TABLE `parcel`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `prefnum` (`prefnum`),
  ADD KEY `sender_id` (`sid`),
  ADD KEY `receiver_id` (`rid`),
  ADD KEY `staff_staff_id_parcel_staffID` (`staffID`);

--
-- Indexes for table `receiver`
--
ALTER TABLE `receiver`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `customer_id1` (`cid`);

--
-- Indexes for table `sajilo_user`
--
ALTER TABLE `sajilo_user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `sender`
--
ALTER TABLE `sender`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `customer_id` (`cid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `sphone` (`sphone`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD KEY `bid` (`bid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `phno` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parcel`
--
ALTER TABLE `parcel`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receiver`
--
ALTER TABLE `receiver`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sajilo_user`
--
ALTER TABLE `sajilo_user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sender`
--
ALTER TABLE `sender`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `sajilo_user` (`uid`);

--
-- Constraints for table `admin_branch`
--
ALTER TABLE `admin_branch`
  ADD CONSTRAINT `admin_branch_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `admin` (`aid`) ON DELETE CASCADE,
  ADD CONSTRAINT `admin_branch_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `branch` (`bid`) ON DELETE CASCADE;

--
-- Constraints for table `admin_staff`
--
ALTER TABLE `admin_staff`
  ADD CONSTRAINT `admin_staff_ibfk_1` FOREIGN KEY (`aid`) REFERENCES `admin` (`aid`),
  ADD CONSTRAINT `admin_staff_ibfk_2` FOREIGN KEY (`sid`) REFERENCES `staff` (`sid`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `parcel_id` FOREIGN KEY (`pid`) REFERENCES `parcel` (`pid`);

--
-- Constraints for table `parcel`
--
ALTER TABLE `parcel`
  ADD CONSTRAINT `receiver_id` FOREIGN KEY (`rid`) REFERENCES `receiver` (`rid`),
  ADD CONSTRAINT `sender_id` FOREIGN KEY (`sid`) REFERENCES `sender` (`sid`),
  ADD CONSTRAINT `staff_staff_id_parcel_staffID` FOREIGN KEY (`staffID`) REFERENCES `staff` (`sid`);

--
-- Constraints for table `receiver`
--
ALTER TABLE `receiver`
  ADD CONSTRAINT `customer_id1` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`);

--
-- Constraints for table `sender`
--
ALTER TABLE `sender`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`cid`) REFERENCES `customer` (`cid`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `sajilo_user` (`uid`) ON DELETE CASCADE,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `branch` (`bid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
