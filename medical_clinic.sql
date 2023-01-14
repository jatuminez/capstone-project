-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2023 at 05:16 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_ID` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_ID`, `password`) VALUES
(1, '$2y$10$37T6yYvTU4oHpwncGnq/LuQMu6nuurK.HO4XHN1LQfoavXzIps8Gy'),
(3, '$2y$10$KU0tWRQgnKxoI/wBZ/Ej3O5B7TgE3gTQjUuQgw.fDigc9Ui/19JBG');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `app_ID` int(11) NOT NULL,
  `pat_ID` int(11) NOT NULL,
  `staff_ID` int(11) NOT NULL,
  `app_Type` varchar(25) NOT NULL,
  `app_Date` date NOT NULL,
  `app_Time` time NOT NULL,
  `app_Complain` text NOT NULL,
  `app_Status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`app_ID`, `pat_ID`, `staff_ID`, `app_Type`, `app_Date`, `app_Time`, `app_Complain`, `app_Status`) VALUES
(2, 2, 1, 'Urgent', '2023-01-09', '00:30:00', 'wetwetwee', 'Completed'),
(3, 3, 2, 'Not Urgent', '2023-01-12', '13:32:00', 'fjfjjfj', 'Cancelled'),
(4, 1, 1, 'Not Urgent', '2023-01-09', '10:45:00', 'ewrtertert', 'Pending'),
(7, 1, 1, '', '2023-01-13', '04:38:00', 'rterter', ''),
(9, 1, 1, '', '2023-02-02', '22:50:00', 'fsfs', ''),
(10, 1, 1, '', '2023-01-14', '22:51:00', 'serfdfs', '');

-- --------------------------------------------------------

--
-- Table structure for table `consultation`
--

CREATE TABLE `consultation` (
  `con_ID` int(11) NOT NULL,
  `app_ID` int(11) NOT NULL,
  `staff_ID` int(11) NOT NULL,
  `pat_ID` int(11) NOT NULL,
  `dis_ID` int(11) DEFAULT NULL,
  `con_Date` date NOT NULL,
  `con_Assessment` text NOT NULL,
  `con_VitalSigns` text NOT NULL,
  `con_MedDose` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `consultation`
--

INSERT INTO `consultation` (`con_ID`, `app_ID`, `staff_ID`, `pat_ID`, `dis_ID`, `con_Date`, `con_Assessment`, `con_VitalSigns`, `con_MedDose`) VALUES
(1, 1, 1, 1, 3, '2023-01-04', 'ujyjy', 'fssfgfsdg', 'gfdgdfg'),
(2, 1, 1, 2, 2, '2023-01-04', 'hfdghg', 'hfdgjuytrihar', 'etayhyetrh'),
(4, 0, 2, 1, 3, '2023-01-07', 'gdfgdfgd', 'fdgdrfdgd', 'drgdfg'),
(5, 0, 2, 3, NULL, '2023-01-08', 'ewrw', 'werewr', 'dfgsdf');

-- --------------------------------------------------------

--
-- Table structure for table `dispense`
--

CREATE TABLE `dispense` (
  `dis_ID` int(11) NOT NULL,
  `med_ID` int(11) NOT NULL,
  `pat_ID` int(15) NOT NULL,
  `dis_Num` int(11) NOT NULL,
  `dis_Date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dispense`
--

INSERT INTO `dispense` (`dis_ID`, `med_ID`, `pat_ID`, `dis_Num`, `dis_Date`) VALUES
(1, 1, 1, 2, '2023-01-04'),
(2, 2, 2, 2, '2023-01-04'),
(3, 2, 1, 0, '2023-01-06');

-- --------------------------------------------------------

--
-- Table structure for table `medicine_inventory`
--

CREATE TABLE `medicine_inventory` (
  `med_inv_ID` int(11) NOT NULL,
  `med_ID` int(11) NOT NULL,
  `med_invDate` date NOT NULL DEFAULT current_timestamp(),
  `med_invQuantity` int(11) NOT NULL,
  `med_invUnit` varchar(10) NOT NULL,
  `med_invCost` float NOT NULL,
  `med_invTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine_list`
--

CREATE TABLE `medicine_list` (
  `med_ID` int(11) NOT NULL,
  `med_Name` varchar(20) NOT NULL,
  `med_Category` varchar(30) NOT NULL,
  `med_Description` text NOT NULL,
  `med_ExpDate` date NOT NULL,
  `med_Unit` varchar(10) NOT NULL,
  `med_Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_list`
--

INSERT INTO `medicine_list` (`med_ID`, `med_Name`, `med_Category`, `med_Description`, `med_ExpDate`, `med_Unit`, `med_Quantity`) VALUES
(1, 'biogesic', 'anti-inflammatory', 'To reduce inflammation and relieve pain', '2024-12-05', '500mg', 34),
(2, 'Cetirizine ', 'antihistamine', 'an antihistamine medicine that helps the symptoms of allergies', '2026-12-11', '10mg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pat_ID` int(15) NOT NULL,
  `pat_Type` varchar(20) NOT NULL,
  `pat_Date` date NOT NULL DEFAULT current_timestamp(),
  `pat_Fname` varchar(15) NOT NULL,
  `pat_Lname` varchar(15) NOT NULL,
  `pat_MI` varchar(3) NOT NULL,
  `pat_Suffix` varchar(4) NOT NULL,
  `pat_Address` text NOT NULL,
  `pat_Gender` varchar(7) NOT NULL,
  `pat_Bdate` date NOT NULL,
  `pat_BloodType` varchar(4) NOT NULL,
  `pat_ContactNum` varchar(13) NOT NULL,
  `pat_Email` varchar(30) NOT NULL,
  `pat_EmergencyNum` varchar(13) NOT NULL,
  `pat_FamHistory` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pat_ID`, `pat_Type`, `pat_Date`, `pat_Fname`, `pat_Lname`, `pat_MI`, `pat_Suffix`, `pat_Address`, `pat_Gender`, `pat_Bdate`, `pat_BloodType`, `pat_ContactNum`, `pat_Email`, `pat_EmergencyNum`, `pat_FamHistory`) VALUES
(1, 'Student', '2022-12-05', 'JA', 'Tuminez', 'E.', 'N/A', 'teteter', 'Male', '2000-05-24', 'O', '09387012416', 'jatuminez@gmail.com', '32543453', 'wtsrsfsfsr\r\ndsdgsdg'),
(2, 'Student', '2023-01-04', 'Gilliane Mae', 'Gortayo', 'F.', 'N/A', 'jggkkkkgkgkgk', 'Female', '2023-01-04', 'O', '07569756666', 'gillianemaegortayo@gmail.com', '57566666666', 'gfjfjfjtyf'),
(3, 'Employee/Faculty', '2023-01-05', 'Ben', 'Nicolas', 'P.', 'N/A', 'tyertyryrtyr', 'Male', '2023-01-05', 'A', '86786558959', 'bennicolas@gmail.com', '59875954736', 'egegeggegrgy3y');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_ID` int(15) NOT NULL,
  `staff_Type` varchar(10) NOT NULL,
  `staff_Fname` varchar(15) NOT NULL,
  `staff_Lname` varchar(15) NOT NULL,
  `staff_MI` varchar(4) NOT NULL,
  `staff_Suffix` varchar(4) NOT NULL,
  `staff_Address` text NOT NULL,
  `staff_ContactNum` varchar(13) NOT NULL,
  `staff_Email` varchar(30) NOT NULL,
  `staff_LicenseNum` varchar(15) NOT NULL,
  `staff_Specialization` varchar(15) NOT NULL,
  `staff_Username` varchar(20) NOT NULL,
  `staff_Password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_ID`, `staff_Type`, `staff_Fname`, `staff_Lname`, `staff_MI`, `staff_Suffix`, `staff_Address`, `staff_ContactNum`, `staff_Email`, `staff_LicenseNum`, `staff_Specialization`, `staff_Username`, `staff_Password`) VALUES
(1, 'Doctor', 'Joey Anthony', 'Tuminez', 'E.', 'N/A', 'Brgy. Nagba Tigbauaun Iloilo', '09669663078', 'tuminezjoeyanthony@gmail.com', '1234567', 'Surgery', 'admin', '$2y$10$b.WNAi9mz'),
(2, 'Doctor', 'Dranoj James', 'Sorongon', 'A.', 'N/A', 'wrytrwywywery', '66553636566', 'dranojjamessorongon@gmail.com', '534663546354', 'yiyiyi', '', ''),
(3, 'Nurse', 'Ainnah Rose', 'Segotier', 'A.', 'N/A', 'garsgsdgsery5rshgersgfsdg', '67857462654', 'ainnahrosesegotier@gmail.com', '657347647673', 'fsghyhrthrt', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplies_inventory`
--

CREATE TABLE `supplies_inventory` (
  `sup_inv_ID` int(11) NOT NULL,
  `sup_ID` int(11) NOT NULL,
  `sup_invDate` date NOT NULL DEFAULT current_timestamp(),
  `sup_invQuantity` int(11) NOT NULL,
  `sup_invCost` float NOT NULL,
  `sup_invTotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplies_list`
--

CREATE TABLE `supplies_list` (
  `sup_ID` int(11) NOT NULL,
  `sup_Name` varchar(100) NOT NULL,
  `sup_Description` text NOT NULL,
  `sup_ExpDate` date NOT NULL,
  `sup_Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplies_list`
--

INSERT INTO `supplies_list` (`sup_ID`, `sup_Name`, `sup_Description`, `sup_ExpDate`, `sup_Quantity`) VALUES
(1, 'j', 'rtytryy', '2022-12-30', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_ID`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`app_ID`),
  ADD KEY `pat_ID` (`pat_ID`),
  ADD KEY `staff_ID` (`staff_ID`);

--
-- Indexes for table `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`con_ID`),
  ADD KEY `staff_ID` (`staff_ID`),
  ADD KEY `pat_ID` (`pat_ID`),
  ADD KEY `dis_ID` (`dis_ID`);

--
-- Indexes for table `dispense`
--
ALTER TABLE `dispense`
  ADD PRIMARY KEY (`dis_ID`),
  ADD KEY `pat_ID` (`pat_ID`),
  ADD KEY `med_ID` (`med_ID`);

--
-- Indexes for table `medicine_inventory`
--
ALTER TABLE `medicine_inventory`
  ADD PRIMARY KEY (`med_inv_ID`),
  ADD KEY `med_ID` (`med_ID`);

--
-- Indexes for table `medicine_list`
--
ALTER TABLE `medicine_list`
  ADD PRIMARY KEY (`med_ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pat_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_ID`);

--
-- Indexes for table `supplies_inventory`
--
ALTER TABLE `supplies_inventory`
  ADD PRIMARY KEY (`sup_inv_ID`),
  ADD KEY `sup_ID` (`sup_ID`);

--
-- Indexes for table `supplies_list`
--
ALTER TABLE `supplies_list`
  ADD PRIMARY KEY (`sup_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `app_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `consultation`
--
ALTER TABLE `consultation`
  MODIFY `con_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dispense`
--
ALTER TABLE `dispense`
  MODIFY `dis_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `medicine_inventory`
--
ALTER TABLE `medicine_inventory`
  MODIFY `med_inv_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine_list`
--
ALTER TABLE `medicine_list`
  MODIFY `med_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pat_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_ID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplies_inventory`
--
ALTER TABLE `supplies_inventory`
  MODIFY `sup_inv_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplies_list`
--
ALTER TABLE `supplies_list`
  MODIFY `sup_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`pat_ID`) REFERENCES `patient` (`pat_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `consultation_ibfk_1` FOREIGN KEY (`staff_ID`) REFERENCES `staff` (`staff_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultation_ibfk_2` FOREIGN KEY (`pat_ID`) REFERENCES `patient` (`pat_ID`),
  ADD CONSTRAINT `consultation_ibfk_3` FOREIGN KEY (`dis_ID`) REFERENCES `dispense` (`dis_ID`);

--
-- Constraints for table `dispense`
--
ALTER TABLE `dispense`
  ADD CONSTRAINT `dispense_ibfk_1` FOREIGN KEY (`med_ID`) REFERENCES `medicine_list` (`med_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dispense_ibfk_2` FOREIGN KEY (`pat_ID`) REFERENCES `patient` (`pat_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicine_inventory`
--
ALTER TABLE `medicine_inventory`
  ADD CONSTRAINT `medicine_inventory_ibfk_1` FOREIGN KEY (`med_ID`) REFERENCES `medicine_list` (`med_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supplies_inventory`
--
ALTER TABLE `supplies_inventory`
  ADD CONSTRAINT `supplies_inventory_ibfk_1` FOREIGN KEY (`sup_ID`) REFERENCES `supplies_list` (`sup_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
