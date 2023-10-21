-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 21, 2023 at 11:19 AM
-- Server version: 8.0.32
-- PHP Version: 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edu_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `Attachment`
--

CREATE TABLE `Attachment` (
  `attachment_id` int NOT NULL,
  `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `filetype` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `thread_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Attachment`
--

INSERT INTO `Attachment` (`attachment_id`, `filename`, `filetype`, `thumbnail`, `thread_id`) VALUES
(8, '1684077271_d875dfe00423c2f7bd36.jpeg', 'jpeg', NULL, 52),
(9, '1684077271_a1a3c6f17ccc01b0d601.jpeg', 'jpeg', NULL, 52),
(10, '1684081837_50a8ad021589054c8eb5.png', 'png', NULL, 53),
(11, '1684081837_0f093d4630ed488c519f.png', 'png', NULL, 53),
(12, '1684081837_a006657648ae1f66ec36.png', 'png', NULL, 53),
(15, '1684714918_527cf4074a25f39825d1.jpeg', 'jpeg', NULL, 76),
(16, '1684714918_cd3a786678c28cfc6e9a.jpeg', 'jpeg', NULL, 76);

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE `Comment` (
  `comment_id` int NOT NULL,
  `content` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `thread_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`comment_id`, `content`, `created_at`, `updated_at`, `thread_id`, `user_id`) VALUES
(93, 'hi', '2023-05-14 00:00:00', NULL, 52, 31),
(99, 'i guess it\'s working fine\r\n', '2023-05-18 00:00:00', NULL, 71, 31),
(100, 'testing time ', '2023-05-18 00:00:00', NULL, 71, 31),
(101, 'huh not working?\r\n', '2023-05-18 00:00:00', NULL, 71, 31),
(102, 'now i know why should probably work', '2023-05-18 02:38:34', NULL, 71, 31),
(103, 'good', '2023-05-18 02:38:49', NULL, 71, 31),
(104, 'hi', '2023-05-22 10:22:10', NULL, 76, 31);

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE `Course` (
  `course_id` int NOT NULL,
  `course_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `course_code` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`course_id`, `course_name`, `course_code`) VALUES
(1, 'Web Information System', 'INFS3202'),
(2, 'The Software Engineering', 'CSSE3012'),
(3, 'Algorithms & Data Structures', 'COMP3506'),
(4, 'Design Computing Studio 3', 'DECO3800');

-- --------------------------------------------------------

--
-- Table structure for table `Password_resets`
--

CREATE TABLE `Password_resets` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Password_resets`
--

INSERT INTO `Password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(41, 'alexyun0429@gmail.com', '2125a4d707c171ba', '0000-00-00 00:00:00'),
(42, 'alexyun0429@gmail.com', '3faac6ee262e0a33', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Thread`
--

CREATE TABLE `Thread` (
  `thread_id` int NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `tag` text NOT NULL,
  `user_id` int NOT NULL,
  `course_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Thread`
--

INSERT INTO `Thread` (`thread_id`, `title`, `content`, `created_at`, `updated_at`, `tag`, `user_id`, `course_id`) VALUES
(52, 'Double file', 'Double file', '2023-05-14 00:00:00', NULL, 'Practical', 31, 1),
(53, 'Triple', 'Triple', '2023-05-14 00:00:00', NULL, 'Practical', 31, 1),
(57, 'lecture', 'lecture', '2023-05-16 00:00:00', NULL, 'Lecture', 31, 1),
(58, 'assignment', 'assignment', '2023-05-16 00:00:00', NULL, 'Assignment', 31, 1),
(61, 'hell', 'hell', '2023-05-17 00:00:00', NULL, 'General', 31, 1),
(62, '1', 'as;dfoai sd fa [sodiasidfnioasnfiasnfiasnfi nisadnf ioansf nasifn iasnf asnfo nasof aiosnf ioasnf ioansdf inasif naoisnf oiasn foasnfio nasfn asnf anf oasnfo nasf nasof nasnf asnf oasnf ois', '2023-05-17 00:00:00', NULL, 'General', 31, 1),
(64, 'JaeWon Yun', 'Smart boi', '2023-05-17 00:00:00', NULL, 'General', 31, 1),
(65, 'smth went wrong', 'what went wrong', '2023-05-17 00:00:00', NULL, 'General', 31, 1),
(66, 'Sen', 'wong', '2023-05-17 00:00:00', NULL, 'Practical', 31, 1),
(67, 'd', 'd', '2023-05-17 00:00:00', NULL, 'General', 31, 1),
(68, 'WHHHHYYYY', 'WHHHAHTTTTTT', '2023-05-17 00:00:00', NULL, 'Assignment', 31, 1),
(69, '1st', '1st time', '2023-05-17 16:31:47', NULL, 'General', 31, 1),
(70, 'changed timezone', 'testing', '2023-05-18 02:34:36', NULL, 'Practical', 31, 1),
(71, '2nd trial for timezone', 'trying to confirm whether it works properly', '2023-05-18 02:35:11', NULL, 'Lecture', 31, 1),
(72, 'trying likes', 'latest', '2023-05-18 03:37:33', NULL, 'General', 31, 1),
(73, 'This is ridiculous', 'is it wokring???', '2023-05-18 04:50:18', NULL, 'General', 32, 1),
(74, 'Structure', 'What is sorting?', '2023-05-19 08:14:55', NULL, 'General', 31, 3),
(75, 'What is Agile', 'Scrum? Kanban? Scrumban', '2023-05-19 08:15:27', NULL, 'Assignment', 31, 2),
(76, '123', '123', '2023-05-22 10:21:58', NULL, 'General', 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int NOT NULL,
  `username` text NOT NULL,
  `email` varchar(64) NOT NULL COMMENT 'restriction: must have "@" ',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Restriction: must include at least one capital letter and a number.',
  `role` text NOT NULL COMMENT 'tutor or student',
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `phone` varchar(24) DEFAULT NULL,
  `verification_token` varchar(32) NOT NULL,
  `is_email_verified` tinyint(1) NOT NULL,
  `is_phone_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`user_id`, `username`, `email`, `password`, `role`, `profile_picture`, `phone`, `verification_token`, `is_email_verified`, `is_phone_verified`) VALUES
(14, 'Jaewon', 'alex@gmail.com', '$2y$10$GbX9hOVjaJOlloPl5kS3h.W.g./SVbo.SZeBI8IgfGBxBQQb0NCau', 'student', 'https://infs3202-2ac671c3.uqcloud.net/assignment/writable/uploads/1681557465_ea659221e9b2acd139db.jpeg', NULL, '', 0, 0),
(31, 'JaeWon Yun', 'alexyun0429@gmail.com', '$2y$10$Z6ukBGOxur1WZOVHPZFI.Oz6EuRYk20aOdcU41EpcxisPhJwdj6tm', 'student', 'https://infs3202-2ac671c3.uqcloud.net/assignment/writable/uploads/1684474825_b23bdc77564f00d8a0cb.jpeg', '0422971994', '1726bdbe8c9f40e9d3a707cb7edfa6ea', 1, 1),
(32, 'Testing', 'testing@gmail.com', '$2y$10$Z54nmAEF6FJ9ueh.rD8xmOeYtr05chM57/VGmvWyXYbE8fN75bUSy', 'student', 'https://infs3202-2ac671c3.uqcloud.net/assignment/writable/uploads/1684349599_37b130dcafa258732c6a.png', NULL, '50c2d264760b26b813b54e8a18390aa9', 1, 0),
(38, 'Hellowww', 'hello@gmail.com', '$2y$10$qw2mc1kkZVLjsM7dy56FZeiXoxJaRFzi7WtAmV5KxNthXBsF2rnoq', 'student', NULL, NULL, '34ab050be852e9252b22d196af2442c6', 0, 0),
(48, 'testest', 'test@gmail.com', '$2y$10$gkCsrsy85WgNSDoMoIPe9ec3aZa79wcFwJeHrxxczUWWLGuaiAMmK', 'student', NULL, '+61422971994', 'f25a91e83525b1324c7cad2a58a6422a', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_courses`
--

CREATE TABLE `users_courses` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `course_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_courses`
--

INSERT INTO `users_courses` (`id`, `user_id`, `course_id`) VALUES
(19, 14, 3),
(21, 14, 1),
(22, 14, 4),
(25, 14, 2),
(30, 31, 1),
(31, 31, 3),
(34, 32, 2),
(36, 32, 1),
(37, 32, 3),
(38, 32, 4),
(39, 38, 1),
(40, 31, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Vote`
--

CREATE TABLE `Vote` (
  `vote_id` int NOT NULL,
  `thread_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Vote`
--

INSERT INTO `Vote` (`vote_id`, `thread_id`, `user_id`) VALUES
(53, 73, 31),
(54, 72, 31);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Attachment`
--
ALTER TABLE `Attachment`
  ADD PRIMARY KEY (`attachment_id`),
  ADD KEY `thread_attachment` (`thread_id`);

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `thread_comment` (`thread_id`),
  ADD KEY `user_comment` (`user_id`);

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `Password_resets`
--
ALTER TABLE `Password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Thread`
--
ALTER TABLE `Thread`
  ADD PRIMARY KEY (`thread_id`),
  ADD KEY `user_thread` (`user_id`),
  ADD KEY `course_thread` (`course_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_courses`
--
ALTER TABLE `users_courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Vote`
--
ALTER TABLE `Vote`
  ADD PRIMARY KEY (`vote_id`),
  ADD KEY `thread_vote` (`thread_id`),
  ADD KEY `user_vote` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Attachment`
--
ALTER TABLE `Attachment`
  MODIFY `attachment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `Course`
--
ALTER TABLE `Course`
  MODIFY `course_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Password_resets`
--
ALTER TABLE `Password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `Thread`
--
ALTER TABLE `Thread`
  MODIFY `thread_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users_courses`
--
ALTER TABLE `users_courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `Vote`
--
ALTER TABLE `Vote`
  MODIFY `vote_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Attachment`
--
ALTER TABLE `Attachment`
  ADD CONSTRAINT `thread_attachment` FOREIGN KEY (`thread_id`) REFERENCES `Thread` (`thread_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `thread_comment` FOREIGN KEY (`thread_id`) REFERENCES `Thread` (`thread_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Thread`
--
ALTER TABLE `Thread`
  ADD CONSTRAINT `course_thread` FOREIGN KEY (`course_id`) REFERENCES `Course` (`course_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_thread` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users_courses`
--
ALTER TABLE `users_courses`
  ADD CONSTRAINT `course_id` FOREIGN KEY (`course_id`) REFERENCES `Course` (`course_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `Vote`
--
ALTER TABLE `Vote`
  ADD CONSTRAINT `thread_vote` FOREIGN KEY (`thread_id`) REFERENCES `Thread` (`thread_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_vote` FOREIGN KEY (`user_id`) REFERENCES `User` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
