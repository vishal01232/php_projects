-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2021 at 12:19 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social_media`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_pass`) VALUES
(1, 'vishalshah01232@gmail.com', 'vishalsapna'),
(2, 'smartyshah01232@gmail.com', 'smartyshah');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `comment_author` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `post_id`, `user_id`, `comment`, `comment_author`, `date`) VALUES
(1, 3, 6, 'hii!', 'Vishal Shah', '2021-09-28 09:23:03'),
(2, 3, 6, 'hii!', 'Vishal Shah', '2021-09-28 09:31:41'),
(3, 3, 6, 'kaisa hai bhai', 'Vishal Shah', '2021-09-28 09:34:34'),
(4, 3, 6, 'waah!', 'Vishal Shah', '2021-09-28 09:34:51'),
(5, 2, 0, 'thik hai\r\n', '', '2021-10-01 09:34:59');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `receiver` varchar(100) NOT NULL,
  `msg_sub` text NOT NULL,
  `msg_topic` text NOT NULL,
  `reply` text NOT NULL,
  `status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `topic_id`, `post_title`, `post_content`, `post_date`) VALUES
(1, 0, 3, 'i want to learn html,php please teach me', 'hey everyone,this is vishal,and i want to learn something new today.', '2021-09-27 09:23:27'),
(2, 0, 1, 'i want to learn php', 'i want to learn php teach me', '2021-09-27 09:26:34'),
(7, 6, 2, 'kjbluj', 'khjlj,kn', '2021-10-01 10:00:28'),
(8, 6, 2, 'i want to learn html,php please teach me', '<form action=\"home.php?id=<?php echo $user_id; ?>\" method=\"POST\" id=\"f\">\r\n                    <h2>What\'s your question today ? let\'s discuss!</h2>\r\n                    <input type=\"text\" name=\"title\" placeholder=\"Write a Title...\" size=\"82\" required=\"required\" /></br>\r\n                    <textarea cols=\"83\" rows=\"4\" name=\"content\" placeholder=\"Write Description...\"></textarea></br>\r\n                    <select name=\"topic\">\r\n                        <option>Select Topic</option>\r\n                        <?php getTopics();\r\n                        ?>\r\n                    </select>\r\n                    <input type=\"submit\" name=\"sub\" value=\"Post to Timeline\" />\r\n                </form>\r\n                <?php insertPost();\r\n                ?>\r\n                <h3>Most Recent Discussion!</h3>\r\n                <?Php get_posts();\r\n                ?><form action=\"home.php?id=<?php echo $user_id; ?>\" method=\"POST\" id=\"f\">\r\n                    <h2>What\'s your question today ? let\'s discuss!</h2>\r\n                    <input type=\"text\" name=\"title\" placeholder=\"Write a Title...\" size=\"82\" required=\"required\" /></br>\r\n                    <textarea cols=\"83\" rows=\"4\" name=\"content\" placeholder=\"Write Description...\"></textarea></br>\r\n                    <select name=\"topic\">\r\n                        <option>Select Topic</option>\r\n                        <?php getTopics();\r\n                        ?>\r\n                    </select>\r\n                    <input type=\"submit\" name=\"sub\" value=\"Post to Timeline\" />\r\n                </form>\r\n                <?php insertPost();\r\n                ?>\r\n                <h3>Most Recent Discussion!</h3>\r\n                <?Php get_posts();\r\n                ?>', '2021-10-01 10:02:16'),
(11, 7, 3, 'html', 'html', '2021-10-02 11:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_name`) VALUES
(1, 'PHP & MYSQL'),
(2, 'JAVASCRIPT'),
(3, 'HTML'),
(4, 'CSS'),
(5, 'JQuery');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_country` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_birthday` text NOT NULL,
  `user_image` text NOT NULL,
  `user_reg_date` text NOT NULL,
  `last_last_login` text NOT NULL,
  `status` text NOT NULL,
  `ver_code` int(100) NOT NULL,
  `posts` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_country`, `user_gender`, `user_birthday`, `user_image`, `user_reg_date`, `last_last_login`, `status`, `ver_code`, `posts`) VALUES
(2, 'sapna', 'sapna11@@', 'sapnashah01232@gmail.com', 'India', 'Female', '2001-03-05', 'default.jpg', '2021-09-26 15:27:28', '', '', 178390913, ''),
(3, 'jolly', 'jolly11@@', 'jollyshah01232@gmail.com', 'India', 'Female', '1998-03-07', 'default.jpg', '2021-09-26 15:35:42', '', '', 218685891, ''),
(6, 'Vishal Shah', 'vishal11@@', 'vishalshah01232@gmail.com', 'India', 'Male', '2021-09-26', 'default.jpg', '2021-09-26 16:04:42', '2021-09-26 16:04:42', 'verified', 1925870857, 'yes'),
(7, 'smarty', 'smarty11@@', 'smartyshah01232@gmail.com', 'India', 'Male', '2021-09-26', 'default.jpeg', '2021-09-26 16:07:23', '2021-09-26 16:07:23', 'verified', 1632712103, 'yes'),
(8, 'alok', 'alik11@@', 'alok@gmail.com', 'Japan', 'Male', '2021-09-26', 'default.jpg', '2021-09-26 16:54:05', '2021-09-26 16:54:05', 'unverified', 367695758, 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
