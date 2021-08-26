-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2019 at 02:32 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'Adejumo david', 'ade@gmail.com', 'passcode');

-- --------------------------------------------------------

--
-- Table structure for table `admitpatient_room`
--

CREATE TABLE `admitpatient_room` (
  `AdmitID` int(11) NOT NULL,
  `PatientID` varchar(50) NOT NULL,
  `Disease` text NOT NULL,
  `RoomNo` varchar(50) NOT NULL,
  `AdmitDate` text NOT NULL,
  `DoctorID` varchar(50) NOT NULL,
  `AP_Remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admitpatient_room`
--

INSERT INTO `admitpatient_room` (`AdmitID`, `PatientID`, `Disease`, `RoomNo`, `AdmitDate`, `DoctorID`, `AP_Remarks`) VALUES
(1, 'P-1', 'Malaria', '101', '22/10/2015', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `admitpatient_ward`
--

CREATE TABLE `admitpatient_ward` (
  `AdmitID` int(11) NOT NULL,
  `PatientID` varchar(50) NOT NULL,
  `Disease` text NOT NULL,
  `Wardname` varchar(100) NOT NULL,
  `AdmitDate` text NOT NULL,
  `DoctorID` varchar(50) NOT NULL,
  `AP_Remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bill_room`
--

CREATE TABLE `bill_room` (
  `BillNo` int(11) NOT NULL,
  `DischargeID` int(11) NOT NULL,
  `BillingDate` text NOT NULL,
  `NoOfDays` int(11) NOT NULL,
  `RoomCharges` double NOT NULL,
  `TotalRoomCharges` double NOT NULL,
  `ServiceCharges` double NOT NULL,
  `TotalCharges` double NOT NULL,
  `PaymentMode` text NOT NULL,
  `PaymentModeDetails` text NOT NULL,
  `ChargesPaid` double NOT NULL,
  `DueCharges` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_room`
--

INSERT INTO `bill_room` (`BillNo`, `DischargeID`, `BillingDate`, `NoOfDays`, `RoomCharges`, `TotalRoomCharges`, `ServiceCharges`, `TotalCharges`, `PaymentMode`, `PaymentModeDetails`, `ChargesPaid`, `DueCharges`) VALUES
(1, 1, '24/10/2015', 2, 1200, 2400, 2300, 4700, 'by Cash', '', 4700, 0);

-- --------------------------------------------------------

--
-- Table structure for table `bill_ward`
--

CREATE TABLE `bill_ward` (
  `BillNo` int(11) NOT NULL,
  `DischargeID` int(11) NOT NULL,
  `BillingDate` text NOT NULL,
  `BedCharges` double NOT NULL,
  `NoOfDays` int(11) NOT NULL,
  `TotalBedCharges` double NOT NULL,
  `ServiceCharges` double NOT NULL,
  `TotalCharges` double NOT NULL,
  `PaymentMode` text NOT NULL,
  `PaymentModeDetails` text NOT NULL,
  `ChargesPaid` double NOT NULL,
  `DueCharges` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `checkk`
--

CREATE TABLE `checkk` (
  `sea` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checkk`
--

INSERT INTO `checkk` (`sea`) VALUES
('a'),
('a');

-- --------------------------------------------------------

--
-- Table structure for table `dischargepatient_room`
--

CREATE TABLE `dischargepatient_room` (
  `ID` int(11) NOT NULL,
  `AdmitID` int(11) NOT NULL,
  `DischargeDate` text NOT NULL,
  `DP_Remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dischargepatient_room`
--

INSERT INTO `dischargepatient_room` (`ID`, `AdmitID`, `DischargeDate`, `DP_Remarks`) VALUES
(1, 1, '24/10/2015', '');

-- --------------------------------------------------------

--
-- Table structure for table `dischargepatient_ward`
--

CREATE TABLE `dischargepatient_ward` (
  `ID` int(11) NOT NULL,
  `AdmitID` int(11) NOT NULL,
  `DischargeDate` text NOT NULL,
  `DP_Remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DoctorID` varchar(50) NOT NULL,
  `DoctorName` text NOT NULL,
  `FatherName` text NOT NULL,
  `Address` text NOT NULL,
  `ContactNo` text NOT NULL,
  `Email` text NOT NULL,
  `Qualifications` text NOT NULL,
  `Specialization` text NOT NULL,
  `Gender` text NOT NULL,
  `Bloodgroup` text NOT NULL,
  `DateOfJoining` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DoctorID`, `DoctorName`, `FatherName`, `Address`, `ContactNo`, `Email`, `Qualifications`, `Specialization`, `Gender`, `Bloodgroup`, `DateOfJoining`) VALUES
('1', 'Chidubem\r\n', 'Uzochukwu', 'Anambra', '08160417161', 'emperorcuzzy6@gmail.com', 'MBBS', 'Heart', 'M', 'O+', '10/9/2017');

-- --------------------------------------------------------

--
-- Table structure for table `patientregistration`
--

CREATE TABLE `patientregistration` (
  `PatientID` varchar(50) NOT NULL,
  `Patientname` text NOT NULL,
  `Fathername` text NOT NULL,
  `Address` text NOT NULL,
  `ContactNo` text NOT NULL,
  `Email` text NOT NULL,
  `Age` int(11) NOT NULL,
  `Gen` text NOT NULL,
  `BG` text NOT NULL,
  `Remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patientregistration`
--

INSERT INTO `patientregistration` (`PatientID`, `Patientname`, `Fathername`, `Address`, `ContactNo`, `Email`, `Age`, `Gen`, `BG`, `Remarks`) VALUES
('P-1', 'Rahuls', 'Ajay', 'Indore', '8765654567', 'rahul@gmail.com', 23, 'M', 'A+', ''),
('P-2', 'Peace', 'Akan', 'eCuzzy Crescent, Lagos', '08160417161', 'peaceakan@yahoo.com', 25, 'F', 'O+', ''),
('P-3', 'Chidubem', 'Uzochukwu', 'Computer village, Alaba', '08160417161', 'emperorcuzzy6@gmail.com', 27, 'M', 'O+', 'Good to go'),
('P-4', 'militao', 'maximilliano', 'madrid', '011223445', 'jumodavid22@gmail.com', 22, 'M', 'O+', 'farenheit');

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `NameOfUser` varchar(250) NOT NULL,
  `ContactNo` varchar(15) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`username`, `password`, `NameOfUser`, `ContactNo`, `Email`, `level`) VALUES
('admin', 'cuzyy', 'James Peace', '08067220797', 'jamespeace@yahoo.com', 'Doctor');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `RoomNo` varchar(50) NOT NULL,
  `RoomType` varchar(100) NOT NULL,
  `RoomCharges` int(11) NOT NULL,
  `RoomStatus` varchar(100) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`RoomNo`, `RoomType`, `RoomCharges`, `RoomStatus`) VALUES
('101', 'General', 1500, 'Vacant'),
('102', 'Deluxe', 2200, 'Vacant');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` varchar(11) NOT NULL,
  `Prescription` varchar(250) NOT NULL,
  `ServiceDate` varchar(50) NOT NULL,
  `PatientID` varchar(50) NOT NULL,
  `ServiceCharges` int(11) NOT NULL,
  `diagnosis` varchar(500) NOT NULL,
  `labrep` varchar(500) NOT NULL,
  `amtpaid` int(11) NOT NULL,
  `bal` int(11) NOT NULL,
  `app` varchar(10) NOT NULL,
  `appdate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ServiceID`, `Prescription`, `ServiceDate`, `PatientID`, `ServiceCharges`, `diagnosis`, `labrep`, `amtpaid`, `bal`, `app`, `appdate`) VALUES
('SID-0', 'Paracetamol 2 tablets daily for two days', '21/5/2017', 'P-1', 4500, 'Headache', 'No Report', 4500, 0, 'NO', '21/5/2017'),
('SID-1', 'Wiper 4 tablets daily for 3days', '22/10/2017', 'P-2', 3000, 'Fever', 'No Report', 2150, 850, 'YES', '21/09/2017');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(100) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `user_password`, `level`) VALUES
('admin', 'cuzyy', '');

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

CREATE TABLE `ward` (
  `wardname` varchar(100) NOT NULL,
  `wardtype` varchar(50) NOT NULL,
  `NoOfBeds` int(11) NOT NULL,
  `Charges` int(11) NOT NULL
) ENGINE=InnoDB AVG_ROW_LENGTH=8192 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`wardname`, `wardtype`, `NoOfBeds`, `Charges`) VALUES
('A', 'General', 4, 1300),
('B', 'General', 5, 3400);

-- --------------------------------------------------------

--
-- Table structure for table `wardboy_nurse_tbl`
--

CREATE TABLE `wardboy_nurse_tbl` (
  `ID` varchar(50) NOT NULL,
  `W_N_Name` varchar(250) NOT NULL,
  `Category` varchar(250) NOT NULL,
  `Address` varchar(250) NOT NULL,
  `ContactNo` varchar(15) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Qualifications` varchar(250) NOT NULL,
  `BloodGroup` varchar(50) NOT NULL,
  `DateOfJoining` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wardboy_nurse_tbl`
--

INSERT INTO `wardboy_nurse_tbl` (`ID`, `W_N_Name`, `Category`, `Address`, `ContactNo`, `Email`, `Qualifications`, `BloodGroup`, `DateOfJoining`) VALUES
('W-1', 'Ngozi Peace', 'Nurse', 'unknown address', '08160414147', 'ngozipeace@gmail.com', 'BSc Biology', 'O+', '11/12/2017');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admitpatient_room`
--
ALTER TABLE `admitpatient_room`
  ADD PRIMARY KEY (`AdmitID`),
  ADD KEY `DoctorID` (`DoctorID`),
  ADD KEY `DoctorID_2` (`DoctorID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `RoomNo` (`RoomNo`);

--
-- Indexes for table `admitpatient_ward`
--
ALTER TABLE `admitpatient_ward`
  ADD PRIMARY KEY (`AdmitID`),
  ADD KEY `DoctorID` (`DoctorID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `Wardname` (`Wardname`);

--
-- Indexes for table `bill_room`
--
ALTER TABLE `bill_room`
  ADD PRIMARY KEY (`BillNo`),
  ADD KEY `DischargeID` (`DischargeID`),
  ADD KEY `DischargeID_2` (`DischargeID`);

--
-- Indexes for table `bill_ward`
--
ALTER TABLE `bill_ward`
  ADD PRIMARY KEY (`BillNo`),
  ADD KEY `DischargeID` (`DischargeID`);

--
-- Indexes for table `dischargepatient_room`
--
ALTER TABLE `dischargepatient_room`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AdmitID` (`AdmitID`);

--
-- Indexes for table `dischargepatient_ward`
--
ALTER TABLE `dischargepatient_ward`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `AdmitID` (`AdmitID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DoctorID`);

--
-- Indexes for table `patientregistration`
--
ALTER TABLE `patientregistration`
  ADD PRIMARY KEY (`PatientID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`RoomNo`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `ward`
--
ALTER TABLE `ward`
  ADD PRIMARY KEY (`wardname`);

--
-- Indexes for table `wardboy_nurse_tbl`
--
ALTER TABLE `wardboy_nurse_tbl`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admitpatient_room`
--
ALTER TABLE `admitpatient_room`
  MODIFY `AdmitID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admitpatient_ward`
--
ALTER TABLE `admitpatient_ward`
  MODIFY `AdmitID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bill_room`
--
ALTER TABLE `bill_room`
  MODIFY `BillNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `bill_ward`
--
ALTER TABLE `bill_ward`
  MODIFY `BillNo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dischargepatient_room`
--
ALTER TABLE `dischargepatient_room`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dischargepatient_ward`
--
ALTER TABLE `dischargepatient_ward`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admitpatient_room`
--
ALTER TABLE `admitpatient_room`
  ADD CONSTRAINT `admitpatient_room_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patientregistration` (`PatientID`),
  ADD CONSTRAINT `admitpatient_room_ibfk_2` FOREIGN KEY (`RoomNo`) REFERENCES `room` (`RoomNo`),
  ADD CONSTRAINT `admitpatient_room_ibfk_3` FOREIGN KEY (`DoctorID`) REFERENCES `doctor` (`DoctorID`);

--
-- Constraints for table `admitpatient_ward`
--
ALTER TABLE `admitpatient_ward`
  ADD CONSTRAINT `admitpatient_ward_ibfk_1` FOREIGN KEY (`Wardname`) REFERENCES `ward` (`wardname`),
  ADD CONSTRAINT `admitpatient_ward_ibfk_2` FOREIGN KEY (`PatientID`) REFERENCES `patientregistration` (`PatientID`),
  ADD CONSTRAINT `admitpatient_ward_ibfk_3` FOREIGN KEY (`DoctorID`) REFERENCES `doctor` (`DoctorID`);

--
-- Constraints for table `bill_room`
--
ALTER TABLE `bill_room`
  ADD CONSTRAINT `bill_room_ibfk_1` FOREIGN KEY (`DischargeID`) REFERENCES `dischargepatient_room` (`ID`);

--
-- Constraints for table `bill_ward`
--
ALTER TABLE `bill_ward`
  ADD CONSTRAINT `bill_ward_ibfk_1` FOREIGN KEY (`DischargeID`) REFERENCES `dischargepatient_ward` (`ID`);

--
-- Constraints for table `dischargepatient_room`
--
ALTER TABLE `dischargepatient_room`
  ADD CONSTRAINT `dischargepatient_room_ibfk_1` FOREIGN KEY (`AdmitID`) REFERENCES `admitpatient_room` (`AdmitID`);

--
-- Constraints for table `dischargepatient_ward`
--
ALTER TABLE `dischargepatient_ward`
  ADD CONSTRAINT `dischargepatient_ward_ibfk_1` FOREIGN KEY (`AdmitID`) REFERENCES `admitpatient_ward` (`AdmitID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`username`) REFERENCES `registration` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
