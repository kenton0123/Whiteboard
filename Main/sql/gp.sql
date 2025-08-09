-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2025-07-25 15:42:19
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `gp`
--

-- --------------------------------------------------------

--
-- 資料表結構 `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `type` enum('important','upcoming','recent') NOT NULL,
  `title` varchar(255) NOT NULL,
  `course` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `due_date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `activities`
--

INSERT INTO `activities` (`id`, `type`, `title`, `course`, `description`, `due_date`, `created_at`) VALUES
(1, 'important', 'ASSIGNMENT LATE SUBMISSION', '2023-2 SEHS4517 WEB APPLICATION DEVELOPMENT AND MANAGEMENT (Lecture Group B01A,B01B)', 'Overdue: Individual Assignment Late Submission', '2024-03-09 23:59:00', '2024-04-11 15:11:45'),
(2, 'upcoming', 'WEB APPLICATION DEVELOPMENT AND MANAGEMENT PRESENTATION', '2023-2 SEHS4517 WEB APPLICATION DEVELOPMENT AND MANAGEMENT (Lecture Group B01A,B01B)', 'Individual Presentation PPT Submission', '2024-04-25 23:59:00', '2024-04-11 15:11:45'),
(3, 'recent', 'WEB APPLICATION DEVELOPMENT AND MANAGEMENT LECTURE', '2023-2 SEHS4517 WEB APPLICATION DEVELOPMENT AND MANAGEMENT (Lecture Group B01A,B01B)', '(Everyone) Group Project Peer to Peer Evaluation Submission', '2024-04-27 18:00:00', '2024-04-11 15:11:45');

-- --------------------------------------------------------

--
-- 資料表結構 `discuss`
--

CREATE TABLE `discuss` (
  `dis_id` int(11) NOT NULL,
  `com_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `studentid` varchar(11) NOT NULL,
  `msag` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `discuss`
--

INSERT INTO `discuss` (`dis_id`, `com_time`, `studentid`, `msag`) VALUES
(1, '2024-04-12 20:06:39', 'S1', 'hi'),
(2, '2024-04-12 20:09:02', 'S1', 'hello'),
(3, '2024-04-12 20:09:54', 'S1', 'hihihihihihihih'),
(4, '2024-04-13 07:14:50', 'S1', 'testing for the forum');

-- --------------------------------------------------------

--
-- 資料表結構 `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 傾印資料表的資料 `files`
--

INSERT INTO `files` (`id`, `filename`, `filepath`, `title`, `file_type`, `deadline`, `created_at`) VALUES
(1, 'lec1.txt', 'uploads/lec1.txt', 'lec1', 'notes', '0000-00-00 00:00:00', '2024-04-12 14:14:52'),
(3, 'asm1.txt', 'uploads/asm1.txt', 'Asm1', 'assessment', '2024-04-13 22:15:00', '2024-04-12 14:15:34'),
(4, 'asm2.txt', 'uploads/asm2.txt', 'Asm2', 'assessment', '2024-04-11 22:15:00', '2024-04-12 14:15:54'),
(10, 'asm3.txt', 'uploads/asm3.txt', 'asm3', 'assessment', '2024-04-18 17:22:00', '2024-04-13 09:22:45'),
(11, 'asm2048.txt', 'uploads/asm2048.txt', 'Assessment2048', 'assessment', '2048-01-01 01:01:00', '2025-07-25 05:26:35'),
(12, '7.txt', 'uploads/7.txt', '7', 'notes', '0000-00-00 00:00:00', '2025-07-25 05:30:38'),
(13, '7.txt', 'uploads/7.txt', '7', 'assessment', '2025-08-01 12:29:00', '2025-07-25 05:30:54');

-- --------------------------------------------------------

--
-- 資料表結構 `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `polls`
--

INSERT INTO `polls` (`id`, `title`, `description`) VALUES
(3, '1or2', '1or 2'),
(4, 'we', 'qqweqweqwe');

-- --------------------------------------------------------

--
-- 資料表結構 `poll_answers`
--

CREATE TABLE `poll_answers` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `votes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `poll_answers`
--

INSERT INTO `poll_answers` (`id`, `poll_id`, `title`, `votes`) VALUES
(7, 3, '1', 1),
(8, 3, '2', 0),
(9, 4, 'q', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `poll_student`
--

CREATE TABLE `poll_student` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) NOT NULL,
  `poll_ans_id` int(11) NOT NULL,
  `student_id` varchar(11) NOT NULL,
  `title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `poll_student`
--

INSERT INTO `poll_student` (`id`, `poll_id`, `poll_ans_id`, `student_id`, `title`) VALUES
(5, 3, 7, 'S1', '');

-- --------------------------------------------------------

--
-- 資料表結構 `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `student_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `mark` float DEFAULT NULL,
  `submitted_at` datetime DEFAULT NULL,
  `assessment_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- 傾印資料表的資料 `submissions`
--

INSERT INTO `submissions` (`id`, `student_id`, `title`, `file_name`, `file_path`, `file_type`, `deadline`, `mark`, `submitted_at`, `assessment_id`) VALUES
(3, 'S1', NULL, 'S01asm1.txt', 'uploads/S01asm1.txt', NULL, NULL, 70, '2024-04-12 21:56:51', 3),
(4, 'S1', NULL, 'S01asm2.txt', 'uploads/S01asm2.txt', NULL, NULL, 40, '2024-04-12 21:57:03', 4),
(5, 'S2', NULL, 'S02asm2.txt', 'uploads/S02asm2.txt', NULL, NULL, 70, '2024-04-13 11:20:53', 3),
(6, 'S2', NULL, 'S02asm2.txt', 'uploads/S02asm2.txt', NULL, NULL, NULL, '2024-04-13 11:21:08', 4);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `ID` varchar(11) NOT NULL,
  `Name` varchar(128) NOT NULL,
  `Pw` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  `Last_login_time` datetime NOT NULL,
  `saftyquestion` int(11) NOT NULL,
  `Answer` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`ID`, `Name`, `Pw`, `email`, `Last_login_time`, `saftyquestion`, `Answer`) VALUES
('A1', 'Admin', '$2y$10$eoAYoe53lE27eAFyGM3iYOHJxdIt67kb5uohT83jsBOpwTxkGNgNG', 'aaa@admin.com', '2024-04-13 09:29:46', 0, ''),
('S1', 'Wing', '$2y$10$0eoQnuqzktMFK3Enq.BR3eL5ptuLhISI6dX.xae5ZX1fxPEqkDlpO', 'qwe@123.com', '2025-07-25 06:43:52', 3, 'red'),
('S2', 'Lcc', '$2y$10$stTd8o3pFkUx6xYGZeoIZuqZ6t9qEONSJo517WlaGtuqxl.yqUDDK', 'asd@asd.com', '2025-07-25 08:01:01', 3, 'red'),
('S3', 'Chandaiman', '$2y$10$HoY8Cyit4IKH7NSJ68EdDe1R2FY4eO.IxzInEib8O7tm5g33lLPi.', '1@common.cpce-polyu.edu.hk', '0000-00-00 00:00:00', 0, ''),
('S4', 'dsadsadsa', '$2y$10$.zoWHAeyF7ybB48QmNuY6ejdFbp4AwDThXoOHqoLg5QWeg1K7Rhdy', '1@abc.com', '2024-04-13 10:01:39', 0, ''),
('S5', 'testing', '$2y$10$WeSxIgxtGCWjYxxh0qU6quKWt3F4yDGlKeCiaODjzFhLl3z4s0gnq', '1@abdfgdfg', '0000-00-00 00:00:00', 1, '1'),
('T3', 'chan siu man', '$2y$10$Jg48IOdN7xiIXK0FzW0s5.cQ7iyfssev8NuYBIq1qLx7KZBJTldSa', '1@a.com', '2025-07-25 07:28:13', 1, 'wing');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `discuss`
--
ALTER TABLE `discuss`
  ADD PRIMARY KEY (`dis_id`);

--
-- 資料表索引 `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `poll_answers`
--
ALTER TABLE `poll_answers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `poll_student`
--
ALTER TABLE `poll_student`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Answer` (`ID`,`Name`,`Pw`,`email`,`Last_login_time`,`saftyquestion`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `discuss`
--
ALTER TABLE `discuss`
  MODIFY `dis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poll_answers`
--
ALTER TABLE `poll_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `poll_student`
--
ALTER TABLE `poll_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
