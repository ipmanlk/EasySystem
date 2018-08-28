-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 28, 2018 at 10:23 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `navindax_easysystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_delivered`
--

CREATE TABLE `item_delivered` (
  `deliverID` int(10) NOT NULL,
  `itemID` varchar(20) NOT NULL,
  `dateTime` datetime DEFAULT CURRENT_TIMESTAMP,
  `qty` decimal(10,2) NOT NULL,
  `dNote` varchar(20) DEFAULT NULL,
  `mrn` varchar(20) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_delivered`
--

INSERT INTO `item_delivered` (`deliverID`, `itemID`, `dateTime`, `qty`, `dNote`, `mrn`, `location`) VALUES
(12, 'ELE00010103', '2018-08-06 05:19:54', '10.00', '45464', '466', '664');

-- --------------------------------------------------------

--
-- Table structure for table `item_received`
--

CREATE TABLE `item_received` (
  `receiveID` int(10) NOT NULL,
  `itemID` varchar(20) NOT NULL,
  `dateTime` datetime DEFAULT CURRENT_TIMESTAMP,
  `qty` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_received`
--

INSERT INTO `item_received` (`receiveID`, `itemID`, `dateTime`, `qty`) VALUES
(9, 'ELE00010103', '2018-08-06 05:19:06', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `item_stock`
--

CREATE TABLE `item_stock` (
  `itemID` varchar(20) NOT NULL,
  `itemDes` varchar(200) DEFAULT NULL,
  `stockingUM` varchar(20) DEFAULT NULL,
  `partNum` varchar(20) DEFAULT NULL,
  `qty` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_stock`
--

INSERT INTO `item_stock` (`itemID`, `itemDes`, `stockingUM`, `partNum`, `qty`) VALUES
('ELE00010101', 'DMC117035', 'NOS', 'DMC117035', '0.00'),
('ELE00010102', 'Excel CSE 4PR Grey X 305M', 'BOXES', '', '36.00'),
('ELE00010103', 'DMC117060', 'NOS', 'DMC117060', '59.00'),
('ELE00010108', 'DMC117140', 'NOS', 'DMC117140', '209.00'),
('ELE00020104', 'DMC122042', 'NOS', 'DMC122042', '125.00'),
('ELE00030101', 'DMC115022', 'NOS', 'DMC115022', '1625.00'),
('ELE00030102', 'DMC115028', 'NOS', 'DMC115028', '1380.00'),
('ELE00030103', 'DMC115035', 'NOS', 'DMC115035', '4112.00'),
('ELE00030104', 'DMC115040', 'NOS', 'DMC115040', '373.00'),
('ELE00030105', 'DMC115048', 'NOS', 'DMC115048', '3106.00'),
('ELE00030107', 'DMC115063', 'NOS', 'DMC115063', '1973.00'),
('ELE00030108', 'DMC115075', 'NOS', 'DMC115075', '760.00'),
('ELE00030110', 'DMC115110', 'NOS', 'DMC115110', '2050.00'),
('ELV00010101', 'EXCEL cat 6 UPT cable', 'BOX', '', '84.00'),
('ELV00010301', 'CAT 6 plus 23 AWG', 'BOXES', '', '2.00'),
('ELV00020102', 'RFID MIFARE white Blank card', 'NOS', '', '1700.00'),
('ELV00030101', 'Battery ASSY 6V ALK AMP', 'NOS', 'A28110', '75.00'),
('ELV00030201', 'Battery ASSY 6V ALK AMP', 'NOS', 'A21100', '1.00'),
('ELV00040201', 'PCB ASSY MT4', 'NOS', 'A38660-DAKOM', '2.00'),
('ELV00040301', 'PCB ASSY MT4', 'NOS', 'A38660-RFIDB', '8.00'),
('ELV00040401', 'PCB MT4 RUC/ECu/MECU RFID', 'NOS', 'A38670-RMGC', '1.00'),
('ELV00050201', 'CONTROL PANEL', 'NOS', 'CLV-33-RL-B-IR', '1.00'),
('ELV00050401', 'CONTROL PANEL', 'NOS', 'CRP073-SS', '1.00'),
('ELV00050501', '19BUTTON CONTROL PANEL', 'NOS', 'CRP193-SS', '1.00'),
('ELV00050601', '10 BURRON CONTROL PANEL', 'NOS', 'CSR103-SS', '2.00'),
('ELV00060201', 'CONFIDANT KIT', 'NOS', 'CS000ES-AAEB-NPS10L', '1.00'),
('ELV00060202', 'CONFIDANT KIT', 'NOS', 'CS000ES-AAEB-NPS10R', '3.00'),
('ELV00060301', 'CONFIDANT KIT', 'NOS', 'CS000EASAEBNPS30L', '3.00'),
('ELV00070101', 'QUNTUM II RFID', 'NOS', 'QPI-12NAHGOLBNOOOBSC', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`) VALUES
(1, 'ShaNiraj', '$2y$10$vaQU5HDEGkVB9TIZ1Jsc/uidjSOy56Ub4/XVkn5pji0.q1FfWyjfa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_delivered`
--
ALTER TABLE `item_delivered`
  ADD PRIMARY KEY (`deliverID`),
  ADD KEY `fk_itemDelivered_itemStock_idx` (`itemID`);

--
-- Indexes for table `item_received`
--
ALTER TABLE `item_received`
  ADD PRIMARY KEY (`receiveID`),
  ADD KEY `fk_itemReceived_itemStock1_idx` (`itemID`);

--
-- Indexes for table `item_stock`
--
ALTER TABLE `item_stock`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_delivered`
--
ALTER TABLE `item_delivered`
  MODIFY `deliverID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `item_received`
--
ALTER TABLE `item_received`
  MODIFY `receiveID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_delivered`
--
ALTER TABLE `item_delivered`
  ADD CONSTRAINT `fk_itemDelivered_itemStock` FOREIGN KEY (`itemID`) REFERENCES `item_stock` (`itemID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_received`
--
ALTER TABLE `item_received`
  ADD CONSTRAINT `fk_itemReceived_itemStock1` FOREIGN KEY (`itemID`) REFERENCES `item_stock` (`itemID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
