-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2021 at 06:18 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yashii`
--

-- --------------------------------------------------------

--
-- Table structure for table `broadcast_messages`
--

CREATE TABLE `broadcast_messages` (
  `id` int(11) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `duration` int(11) NOT NULL,
  `fees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `Id` int(11) NOT NULL,
  `TRN` int(20) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `firstname` varchar(11) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` int(11) NOT NULL,
  `course` varchar(255) NOT NULL,
  `address` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`id`, `firstname`, `lastname`, `email`, `mobile`, `course`, `address`) VALUES
(1, 'felix', 'kumafutsa', 'howard@gmail.com', 997473256, 'lightweight', 'mzuzu 2'),
(2, 'dan', 'masoo', '0009999', 0, 'lightweight', 'mjmm');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `mobile` int(20) NOT NULL,
  `address` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manager_messages`
--

CREATE TABLE `manager_messages` (
  `id` int(11) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager_messages`
--

INSERT INTO `manager_messages` (`id`, `sender_email`, `subject`, `content`, `date`) VALUES
(1, 'razack@gmail.com', 'ffd gfd', 'fgffffffffffffffffffffffffffffffffffffsdsdd', '2021-03-16 00:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `TRN` varchar(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `first_installment` int(20) NOT NULL,
  `second_installment` int(20) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `TRN`, `firstname`, `lastname`, `first_installment`, `second_installment`, `balance`) VALUES
(5, 'mz3322', 'dan', 'kumafutsa', 333333, 33333333, 0);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `question_id` int(11) NOT NULL,
  `question_number` int(11) NOT NULL,
  `question` text NOT NULL,
  `choice1` text NOT NULL,
  `choice2` text NOT NULL,
  `choice3` text NOT NULL,
  `choice4` text NOT NULL,
  `correct_choice` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`question_id`, `question_number`, `question`, `choice1`, `choice2`, `choice3`, `choice4`, `correct_choice`) VALUES
(1, 2, 'where can one obtain a driving licence?', 'mzuzu', 'mra', 'nico', 'airtel', 'mra'),
(2, 3, 'Mention on human made road accident?', 'being drunk', 'rainfall', 'fog', 'animals', 'being drunk');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL,
  `score` int(2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `firstname`, `lastname`, `course`, `score`, `date`) VALUES
(1, 'richard', 'chikuse', 'lightweight', 34, '2021-03-10 13:58:09');

-- --------------------------------------------------------

--
-- Table structure for table `road_traffic`
--

CREATE TABLE `road_traffic` (
  `id` int(11) NOT NULL,
  `TRN` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedu`
--

CREATE TABLE `schedu` (
  `schdule_id` int(11) NOT NULL,
  `nthawi` date NOT NULL,
  `nyengo` time NOT NULL,
  `nyengo1` time NOT NULL,
  `location` varchar(20) NOT NULL,
  `course` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `secretary_messages`
--

CREATE TABLE `secretary_messages` (
  `id` int(11) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secretary_messages`
--

INSERT INTO `secretary_messages` (`id`, `sender_email`, `subject`, `content`, `date`) VALUES
(3, 'razack@gmail.com', 'ddddd', 'dddddddd', '2021-03-10 01:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `age` int(2) NOT NULL,
  `mobile` int(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `course` varchar(50) NOT NULL,
  `TRN` varchar(50) NOT NULL,
  `nyumba` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstname`, `lname`, `gender`, `age`, `mobile`, `email`, `course`, `TRN`, `nyumba`) VALUES
(2, 'richard', 'adssad', 'xca', 22, 999837383, 'ssasassassas', 'lightweight', 'aassa', 'ccsaa');

-- --------------------------------------------------------

--
-- Table structure for table `student_messages`
--

CREATE TABLE `student_messages` (
  `id` int(11) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `reciever_email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_messages`
--

INSERT INTO `student_messages` (`id`, `sender_email`, `reciever_email`, `subject`, `content`, `date`) VALUES
(2, 'danmasoo@gmail.com', 'dan@gmail.com', 'welcome notice', 'you are welcome', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `create_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `mobile`, `address`, `role`, `create_at`) VALUES
(102, 'dan', 'masoo', 'danny 1', 'dan', 'dan@gmail.com', '', '', 'instructor', '2021-03-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `broadcast_messages`
--
ALTER TABLE `broadcast_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_email` (`sender_email`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course name` (`course_name`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `course_name` (`course`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `manager_messages`
--
ALTER TABLE `manager_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TRN` (`TRN`) USING BTREE;

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `road_traffic`
--
ALTER TABLE `road_traffic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedu`
--
ALTER TABLE `schedu`
  ADD PRIMARY KEY (`schdule_id`);

--
-- Indexes for table `secretary_messages`
--
ALTER TABLE `secretary_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course name` (`course`),
  ADD KEY `TRN` (`TRN`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `student_messages`
--
ALTER TABLE `student_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `broadcast_messages`
--
ALTER TABLE `broadcast_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager_messages`
--
ALTER TABLE `manager_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `road_traffic`
--
ALTER TABLE `road_traffic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedu`
--
ALTER TABLE `schedu`
  MODIFY `schdule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `secretary_messages`
--
ALTER TABLE `secretary_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_messages`
--
ALTER TABLE `student_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
