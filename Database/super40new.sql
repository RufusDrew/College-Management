-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2023 at 06:47 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `super40`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_info`
--

CREATE TABLE `admission_info` (
  `roll_no` int(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `father_name` varchar(64) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  `course_code` varchar(11) NOT NULL,
  `session` varchar(10) NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `prospectus_issued` varchar(10) NOT NULL,
  `prospectus_amount` varchar(10) NOT NULL,
  `form_b` varchar(20) NOT NULL,
  `applicant_status` varchar(20) NOT NULL,
  `application_status` varchar(20) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `other_phone` varchar(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `permanent_address` varchar(150) NOT NULL,
  `current_address` varchar(150) NOT NULL,
  `place_of_birth` varchar(150) NOT NULL,
  `matric_complition_date` varchar(10) NOT NULL,
  `matric_awarded_date` varchar(10) NOT NULL,
  `matric_certificate` varchar(100) NOT NULL,
  `fa_complition_date` varchar(10) NOT NULL,
  `fa_awarded_date` varchar(10) NOT NULL,
  `fa_certificate` varchar(100) NOT NULL,
  `ba_complition_date` varchar(10) NOT NULL,
  `ba_awarded_date` varchar(10) NOT NULL,
  `ba_certificate` varchar(100) NOT NULL,
  `semester` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `obtain_marks` int(11) NOT NULL,
  `state` varchar(20) NOT NULL,
  `admission_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admission_info`
--

INSERT INTO `admission_info` (`roll_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `email`, `mobile_no`, `course_code`, `session`, `profile_image`, `prospectus_issued`, `prospectus_amount`, `form_b`, `applicant_status`, `application_status`, `cnic`, `dob`, `other_phone`, `gender`, `permanent_address`, `current_address`, `place_of_birth`, `matric_complition_date`, `matric_awarded_date`, `matric_certificate`, `fa_complition_date`, `fa_awarded_date`, `fa_certificate`, `ba_complition_date`, `ba_awarded_date`, `ba_certificate`, `semester`, `total_marks`, `obtain_marks`, `state`, `admission_date`) VALUES
(1023, 'AMAN', '', 'DEEP', 'SKJ', 'amandeepbettiah@gmail.com', '1233211231', 'BCA', '2019-2022', 'male avatar1.jpg', '', '', '', 'Admitted', 'Approved', '123456578222', '2000-01-14', '', 'Male', 'Bettiah', 'Bettiah', 'BETTIAH', '2017-04-14', '2017-05-14', 'CBSE-Result-2020-class-10-marksheet.jpg', '2019-04-14', '2019-05-14', 'CBSE-Result-2020-class-10-marksheet.jpg', '', '', '', 0, 0, 0, '', '2023-03-14 13:38:32'),
(1024, 'ADITI', '', 'ARYA', 'JAI HO', 'amandeepbettiah@gmail.com', '1234561231', 'BCA', '2020-2023', 'female avatar.png', '', '', '', 'Admitted', 'Approved', '123412341234', '2001-01-11', '', 'Female', 'Bettiah', 'Bettiah', 'BETTIAH', '2018-04-14', '2023-05-31', 'CBSE-Result-2020-class-10-marksheet.jpg', '2020-04-30', '2023-05-31', 'CBSE-12th-result-2020-class-12-marksheet.jpg', '', '', '', 0, 0, 0, '', '2023-03-14 17:26:04'),
(1025, 'RUFUS', '', 'GURIA', 'SBI', 'amandeepbettiah@gmail.com', '1233211231', 'BCA', '2019-2022', 'male avtar2.png', '', '', '', 'Admitted', 'Approved', '123456578222', '2000-01-14', '', 'Male', 'Bettiah', 'Bettiah', 'BETTIAH', '2017-04-14', '2017-05-14', 'CBSE-Result-2020-class-10-marksheet.jpg', '2019-04-14', '2019-05-14', 'CBSE-Result-2020-class-10-marksheet.jpg', '', '', '', 0, 0, 0, '', '2023-03-28 18:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `class_result`
--

CREATE TABLE `class_result` (
  `class_result_id` int(11) NOT NULL,
  `roll_no` varchar(30) NOT NULL,
  `course_code` varchar(30) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `semester` varchar(11) NOT NULL,
  `total_marks` varchar(11) NOT NULL,
  `obtain_marks` varchar(11) NOT NULL,
  `result_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_result`
--

INSERT INTO `class_result` (`class_result_id`, `roll_no`, `course_code`, `subject_code`, `semester`, `total_marks`, `obtain_marks`, `result_date`) VALUES
(69, '2', 'BCA', 'BCA-102', '1', '100', '80', '14-03-23'),
(70, '1', 'BCA', 'BCA-102', '1', '100', '75', '14-03-23'),
(71, '2', 'BCA', 'BCA-104', '1', '100', '90', '14-03-23'),
(72, '1', 'BCA', 'BCA-104', '1', '100', '75', '14-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `semester_or_year` varchar(10) NOT NULL,
  `no_of_year` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_code`, `course_name`, `semester_or_year`, `no_of_year`) VALUES
('BCA', 'BCA', '6', 3),
('MCA', 'MCA', '4', 2);

-- --------------------------------------------------------

--
-- Table structure for table `course_subjects`
--

CREATE TABLE `course_subjects` (
  `subject_code` varchar(10) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `semester` int(10) NOT NULL,
  `credit_hours` int(5) NOT NULL,
  `total_mark` int(3) NOT NULL,
  `pass_mark` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_subjects`
--

INSERT INTO `course_subjects` (`subject_code`, `subject_name`, `course_code`, `semester`, `credit_hours`, `total_mark`, `pass_mark`) VALUES
('BCA-102', 'Computer Fundamentals', 'BCA', 1, 50, 100, 35),
('BCA-103', 'Business communication & Information System', 'BCA', 1, 50, 100, 35),
('BCA-104', 'C Programming', 'BCA', 1, 60, 100, 35),
('BCA-105', 'Lab on DOS & Windows', 'BCA', 1, 60, 100, 35),
('BCA-106', 'Lab on C', 'BCA', 1, 60, 100, 35),
('BCA-201', 'Discrete Mathematics', 'BCA', 2, 50, 100, 35),
('BCA-202', 'Computer Architecture', 'BCA', 2, 50, 100, 35),
('BCA-203', 'Data Structure Through C', 'BCA', 2, 50, 100, 35),
('BCA-204', 'System Analysis and Design', 'BCA', 2, 50, 100, 35),
('BCA-205', 'Lab on MS-Office', 'BCA', 2, 60, 100, 35),
('BCA-206', 'Lab on Data Structure Through C', 'BCA', 2, 60, 100, 35);

-- --------------------------------------------------------

--
-- Table structure for table `feestructure`
--

CREATE TABLE `feestructure` (
  `fid` int(11) NOT NULL,
  `course_code` varchar(10) DEFAULT NULL,
  `semester` int(2) DEFAULT NULL,
  `active` int(1) DEFAULT NULL,
  `fee_amount` int(10) NOT NULL,
  `createddate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feestructure`
--

INSERT INTO `feestructure` (`fid`, `course_code`, `semester`, `active`, `fee_amount`, `createddate`) VALUES
(7, 'BCA', 1, 1, 15000, '2023-03-14 17:37:19'),
(8, 'MCA', 1, 1, 20000, '2023-03-14 17:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `user_id` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `Role` varchar(10) NOT NULL,
  `account` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`ID`, `user_id`, `Password`, `Role`, `account`) VALUES
(79, 'admin', 'admin', 'Admin', 'Activate'),
(81, 'testteacher@gmail.com', '0082d5fd', 'Teacher', 'Activate'),
(82, '1', '7589cf3a', 'Student', ''),
(83, '2', '9c407d5d', 'Student', 'Activate'),
(84, '3', '67e9ff67', 'Student', '');

-- --------------------------------------------------------

--
-- Table structure for table `mytable`
--

CREATE TABLE `mytable` (
  `id` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `course_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` int(11) NOT NULL,
  `session` varchar(30) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `session`, `created_date`) VALUES
(2, '2019-2022', '2023-03-13 14:03:15'),
(3, '2018-2021', '2023-03-13 14:03:15'),
(4, '2020-2023', '2023-03-13 14:03:38'),
(5, '2021-2024', '2023-03-13 14:03:38');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `attendance_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `attendance` int(11) NOT NULL,
  `attendance_date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`attendance_id`, `course_code`, `subject_code`, `semester`, `student_id`, `attendance`, `attendance_date`) VALUES
(13, 'BCA', 'BCA-102', 1, '2', 1, '14-03-23'),
(14, 'BCA', 'BCA-102', 1, '1', 1, '14-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `student_courses`
--

CREATE TABLE `student_courses` (
  `student_course_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `roll_no` varchar(10) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `assign_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_courses`
--

INSERT INTO `student_courses` (`student_course_id`, `course_code`, `semester`, `roll_no`, `subject_code`, `session`, `assign_date`) VALUES
(182, 'BCA', 1, '2', 'BCA-102', '', '14-03-23'),
(183, 'BCA', 1, '2', 'BCA-103', '', '14-03-23'),
(184, 'BCA', 1, '2', 'BCA-104', '', '14-03-23'),
(185, 'BCA', 1, '2', 'BCA-105', '', '14-03-23'),
(186, 'BCA', 1, '2', 'BCA-106', '', '14-03-23'),
(187, 'BCA', 1, '1', 'BCA-102', '', '14-03-23'),
(188, 'BCA', 1, '1', 'BCA-103', '', '14-03-23'),
(189, 'BCA', 1, '1', 'BCA-104', '', '14-03-23'),
(190, 'BCA', 1, '1', 'BCA-105', '', '14-03-23'),
(191, 'BCA', 1, '1', 'BCA-106', '', '14-03-23'),
(192, 'BCA', 1, '3', 'BCA-102', '', '29-03-23'),
(193, 'BCA', 1, '3', 'BCA-103', '', '29-03-23'),
(194, 'BCA', 1, '3', 'BCA-104', '', '29-03-23'),
(195, 'BCA', 1, '3', 'BCA-105', '', '29-03-23'),
(196, 'BCA', 1, '3', 'BCA-106', '', '29-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `student_fee`
--

CREATE TABLE `student_fee` (
  `fee_voucher` int(11) NOT NULL,
  `roll_no` varchar(30) NOT NULL,
  `amount` int(11) NOT NULL,
  `posting_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(10) NOT NULL,
  `feecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_fee`
--

INSERT INTO `student_fee` (`fee_voucher`, `roll_no`, `amount`, `posting_date`, `status`, `feecode`) VALUES
(19, '2', 15000, '2023-03-14 17:38:34', 'Paid', 7);

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `roll_no` int(20) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `father_name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mobile_no` varchar(11) NOT NULL,
  `course_code` varchar(11) NOT NULL,
  `session` varchar(10) NOT NULL,
  `profile_image` varchar(100) NOT NULL,
  `prospectus_issued` varchar(10) NOT NULL,
  `prospectus_amount` varchar(10) NOT NULL,
  `form_b` varchar(20) NOT NULL,
  `applicant_status` varchar(20) NOT NULL,
  `application_status` varchar(20) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `other_phone` varchar(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `permanent_address` varchar(150) NOT NULL,
  `current_address` varchar(150) NOT NULL,
  `place_of_birth` varchar(150) NOT NULL,
  `matric_complition_date` varchar(10) NOT NULL,
  `matric_awarded_date` varchar(10) NOT NULL,
  `matric_certificate` varchar(100) NOT NULL,
  `fa_complition_date` varchar(10) NOT NULL,
  `fa_awarded_date` varchar(10) NOT NULL,
  `fa_certificate` varchar(100) NOT NULL,
  `ba_complition_date` varchar(10) NOT NULL,
  `ba_awarded_date` varchar(10) NOT NULL,
  `ba_certificate` varchar(100) NOT NULL,
  `semester` int(11) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `obtain_marks` int(11) NOT NULL,
  `state` varchar(20) NOT NULL,
  `admission_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`roll_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `email`, `mobile_no`, `course_code`, `session`, `profile_image`, `prospectus_issued`, `prospectus_amount`, `form_b`, `applicant_status`, `application_status`, `cnic`, `dob`, `other_phone`, `gender`, `permanent_address`, `current_address`, `place_of_birth`, `matric_complition_date`, `matric_awarded_date`, `matric_certificate`, `fa_complition_date`, `fa_awarded_date`, `fa_certificate`, `ba_complition_date`, `ba_awarded_date`, `ba_certificate`, `semester`, `total_marks`, `obtain_marks`, `state`, `admission_date`) VALUES
(1, 'ADITI', '', 'ARYA', 'JAI HO', 'amandeepbettiah@gmail.com', '1234561231', 'BCA', '2020-2023', 'female avatar.png', 'Yes', 'Yes', '', 'Admitted', 'Approved', '123412341234', '2001-01-11', '', 'Female', 'Bettiah', 'Bettiah', 'BETTIAH', '2018-04-14', '2023-05-31', 'CBSE-Result-2020-class-10-marksheet.jpg', '2020-04-30', '2023-05-31', 'CBSE-12th-result-2020-class-12-marksheet.jpg', '', '', '', 0, 0, 0, '', '2023-03-14 18:23:41'),
(2, 'AMAN', '', 'DEEP', 'SKJ', 'amandeepbettiah@gmail.com', '1233211231', 'BCA', '2019-2022', 'male avatar1.jpg', 'Yes', 'No', '', 'Admitted', 'Approved', '123456578222', '2000-01-14', '', 'Male', 'Bettiah', 'Bettiah', 'BETTIAH', '2017-04-14', '2017-05-14', 'CBSE-Result-2020-class-10-marksheet.jpg', '2019-04-14', '2019-05-14', 'CBSE-Result-2020-class-10-marksheet.jpg', '', '', '', 1, 0, 0, '', '2023-03-14 17:03:07'),
(3, 'RUFUS', '', 'GURIA', 'SBI', 'amandeepbettiah@gmail.com', '1233211231', 'BCA', '2019-2022', 'male avtar2.png', 'Yes', 'Yes', '', 'Admitted', 'Approved', '123456578222', '2000-01-14', '', 'Male', 'Bettiah', 'Bettiah', 'BETTIAH', '2017-04-14', '2017-05-14', 'CBSE-Result-2020-class-10-marksheet.jpg', '2019-04-14', '2019-05-14', 'CBSE-Result-2020-class-10-marksheet.jpg', '', '', '', 0, 0, 0, '', '2023-03-28 18:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_attendance`
--

CREATE TABLE `teacher_attendance` (
  `attendance_id` int(11) NOT NULL,
  `teacher_id` varchar(30) NOT NULL,
  `attendance` int(11) NOT NULL,
  `attendance_date` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_attendance`
--

INSERT INTO `teacher_attendance` (`attendance_id`, `teacher_id`, `attendance`, `attendance_date`) VALUES
(11, '12', 1, '14-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_courses`
--

CREATE TABLE `teacher_courses` (
  `teacher_courses_id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `teacher_id` varchar(10) NOT NULL,
  `subject_code` varchar(10) NOT NULL,
  `assign_date` varchar(10) NOT NULL,
  `total_classes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_courses`
--

INSERT INTO `teacher_courses` (`teacher_courses_id`, `course_code`, `semester`, `teacher_id`, `subject_code`, `assign_date`, `total_classes`) VALUES
(22, 'BCA', 1, '12', 'BCA-102', '14-03-23', 40),
(23, 'BCA', 1, '12', 'BCA-104', '14-03-23', 36);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_info`
--

CREATE TABLE `teacher_info` (
  `teacher_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `father_name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_no` varchar(11) NOT NULL,
  `profile_image` blob NOT NULL,
  `teacher_status` varchar(10) NOT NULL,
  `application_status` varchar(10) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `other_phone` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `permanent_address` varchar(100) NOT NULL,
  `current_address` varchar(100) NOT NULL,
  `place_of_birth` varchar(50) NOT NULL,
  `matric_complition_date` varchar(10) NOT NULL,
  `matric_awarded_date` varchar(10) NOT NULL,
  `matric_certificate` varchar(100) NOT NULL,
  `fa_complition_date` varchar(10) NOT NULL,
  `fa_awarded_date` varchar(10) NOT NULL,
  `fa_certificate` varchar(100) NOT NULL,
  `ba_complition_date` varchar(10) NOT NULL,
  `ba_awarded_date` varchar(10) NOT NULL,
  `ba_certificate` varchar(100) NOT NULL,
  `ma_complition_date` varchar(10) NOT NULL,
  `ma_awarded_date` varchar(100) NOT NULL,
  `ma_certificate` varchar(101) NOT NULL,
  `last_qualification` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `hire_date` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_info`
--

INSERT INTO `teacher_info` (`teacher_id`, `first_name`, `middle_name`, `last_name`, `father_name`, `email`, `phone_no`, `profile_image`, `teacher_status`, `application_status`, `cnic`, `dob`, `other_phone`, `gender`, `permanent_address`, `current_address`, `place_of_birth`, `matric_complition_date`, `matric_awarded_date`, `matric_certificate`, `fa_complition_date`, `fa_awarded_date`, `fa_certificate`, `ba_complition_date`, `ba_awarded_date`, `ba_certificate`, `ma_complition_date`, `ma_awarded_date`, `ma_certificate`, `last_qualification`, `state`, `hire_date`) VALUES
(12, 'Teacher 1', '', '', '', 'testteacher@gmail.com', '1231231231', 0x6d616c65206176746172322e706e67, 'Permanent', 'Yes', '123412341234', '1993-01-01', 0, 'Male', 'Bettiah', 'Bettiah', 'Bettiah', '2006-04-14', '2006-04-14', 'CBSE-Result-2020-class-10-marksheet.jpg', '2008-04-14', '2008-05-30', 'CBSE-12th-result-2020-class-12-marksheet.jpg', '2011-06-20', '2011-12-15', 'University-Bachelor-Degree-Certificate.jpg', '2013-06-20', '2013-12-20', 'University-Bachelor-Degree-Certificate.jpg', '', '', '14-03-23');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_salary_allowances`
--

CREATE TABLE `teacher_salary_allowances` (
  `teacher_id` int(11) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `medical_allowance` int(11) NOT NULL,
  `hr_allowance` int(11) NOT NULL,
  `scale` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_salary_allowances`
--

INSERT INTO `teacher_salary_allowances` (`teacher_id`, `basic_salary`, `medical_allowance`, `hr_allowance`, `scale`) VALUES
(12, 35000, 35, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_salary_report`
--

CREATE TABLE `teacher_salary_report` (
  `salary_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `paid_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_salary_report`
--

INSERT INTO `teacher_salary_report` (`salary_id`, `teacher_id`, `total_amount`, `status`, `paid_date`) VALUES
(36, 12, 61250, 'Paid', '2023-03-14 17:26:04'),
(37, 12, 61250, 'Paid', '2023-03-14 17:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `time_table`
--

CREATE TABLE `time_table` (
  `id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `semester` int(11) NOT NULL,
  `timing_from` varchar(10) NOT NULL,
  `timing_to` varchar(10) NOT NULL,
  `day` varchar(20) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `room_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_table`
--

INSERT INTO `time_table` (`id`, `course_code`, `semester`, `timing_from`, `timing_to`, `day`, `subject_code`, `room_no`) VALUES
(19, 'BCA', 1, '08:00', '09:00', '1', 'BCA-102', 102),
(20, 'BCA', 1, '10:00', '11:00', '2', 'BCA-104', 102),
(21, 'MCA', 1, '09:00', '10:30', '3', 'BCA-201', 103);

-- --------------------------------------------------------

--
-- Table structure for table `validateuser`
--

CREATE TABLE `validateuser` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `mobno` varchar(10) DEFAULT NULL,
  `otpval` varchar(8) DEFAULT NULL,
  `createddate` datetime DEFAULT NULL,
  `validupto` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `validateuser`
--

INSERT INTO `validateuser` (`id`, `email`, `fullname`, `mobno`, `otpval`, `createddate`, `validupto`) VALUES
(67, 'amandeepbth@gmail.com', 'Aman Deep', '1234567890', '270287', '2023-03-13 19:27:44', '2023-03-13 19:42:44'),
(68, 'amandeepbettiah@gmail.com', 'Aman Deep', '1234567890', '233916', '2023-03-13 19:29:41', '2023-03-13 19:44:41'),
(69, 'amandeepbettiah@gmail.com', 'aman deep', '1234567890', '703191', '2023-03-13 23:33:12', '2023-03-13 23:48:12'),
(70, 'amandeepbettiah@gmail.com', 'aman deep', '1234123411', '979805', '2023-03-13 23:59:40', '2023-03-14 00:14:40'),
(71, 'amandeepbettiah@gmail.com', 'Aman Deep', '1233211231', '610365', '2023-03-14 11:56:37', '2023-03-14 12:11:37'),
(72, 'amandeepbettiah@gmail.com', 'Test Student', '1234561231', '238411', '2023-03-14 12:15:24', '2023-03-14 12:30:24');

-- --------------------------------------------------------

--
-- Table structure for table `weekdays`
--

CREATE TABLE `weekdays` (
  `day_id` int(11) NOT NULL,
  `day_name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weekdays`
--

INSERT INTO `weekdays` (`day_id`, `day_name`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admission_info`
--
ALTER TABLE `admission_info`
  ADD PRIMARY KEY (`roll_no`);

--
-- Indexes for table `class_result`
--
ALTER TABLE `class_result`
  ADD PRIMARY KEY (`class_result_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `course_subjects`
--
ALTER TABLE `course_subjects`
  ADD PRIMARY KEY (`subject_code`);

--
-- Indexes for table `feestructure`
--
ALTER TABLE `feestructure`
  ADD PRIMARY KEY (`fid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mytable`
--
ALTER TABLE `mytable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `student_courses`
--
ALTER TABLE `student_courses`
  ADD PRIMARY KEY (`student_course_id`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `student_fee`
--
ALTER TABLE `student_fee`
  ADD PRIMARY KEY (`fee_voucher`),
  ADD KEY `roll_no` (`roll_no`);

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`roll_no`);

--
-- Indexes for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD PRIMARY KEY (`teacher_courses_id`);

--
-- Indexes for table `teacher_info`
--
ALTER TABLE `teacher_info`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `teacher_salary_allowances`
--
ALTER TABLE `teacher_salary_allowances`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `teacher_salary_report`
--
ALTER TABLE `teacher_salary_report`
  ADD PRIMARY KEY (`salary_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `time_table`
--
ALTER TABLE `time_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `validateuser`
--
ALTER TABLE `validateuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weekdays`
--
ALTER TABLE `weekdays`
  ADD PRIMARY KEY (`day_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admission_info`
--
ALTER TABLE `admission_info`
  MODIFY `roll_no` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1026;

--
-- AUTO_INCREMENT for table `class_result`
--
ALTER TABLE `class_result`
  MODIFY `class_result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `feestructure`
--
ALTER TABLE `feestructure`
  MODIFY `fid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_courses`
--
ALTER TABLE `student_courses`
  MODIFY `student_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `student_fee`
--
ALTER TABLE `student_fee`
  MODIFY `fee_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `teacher_attendance`
--
ALTER TABLE `teacher_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  MODIFY `teacher_courses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `teacher_info`
--
ALTER TABLE `teacher_info`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teacher_salary_report`
--
ALTER TABLE `teacher_salary_report`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `time_table`
--
ALTER TABLE `time_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `validateuser`
--
ALTER TABLE `validateuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `weekdays`
--
ALTER TABLE `weekdays`
  MODIFY `day_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teacher_salary_report`
--
ALTER TABLE `teacher_salary_report`
  ADD CONSTRAINT `teacher_salary_report_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_salary_allowances` (`teacher_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
