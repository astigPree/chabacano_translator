-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 04:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cb_translator_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins_tb`
--

CREATE TABLE `admins_tb` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins_tb`
--

INSERT INTO `admins_tb` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin123', '$2y$15$/BAB4Ym3eVC0k2OH4Po3XOckoc94M9JwnElxXyEny7nt0JjQPvX/6', '2024-09-27 23:34:04', '2024-09-27 23:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `dictionary_tb`
--

CREATE TABLE `dictionary_tb` (
  `id` int(11) NOT NULL,
  `chabacano_lang` varchar(255) NOT NULL,
  `tagalog_lang` varchar(255) NOT NULL,
  `english_lang` varchar(255) NOT NULL,
  `definition` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dictionary_tb`
--

INSERT INTO `dictionary_tb` (`id`, `chabacano_lang`, `tagalog_lang`, `english_lang`, `definition`, `created_at`, `updated_at`) VALUES
(1, 'buenas', 'magandang araw', 'good day', 'A common greeting in Chabacano meaning good day or hello.', '2024-09-27 15:22:55', '2024-10-03 14:12:46'),
(2, 'cosa', 'ano', 'what', 'Used to ask what something is or to inquire about something.', '2024-09-27 15:22:55', '2024-09-27 15:22:55'),
(3, 'caminá', 'lakad', 'walk', 'A verb meaning to walk or move by foot.', '2024-09-27 15:22:55', '2024-09-27 15:22:55'),
(4, 'comé', 'kain', 'eat', 'A verb used to indicate eating food.', '2024-09-27 15:22:55', '2024-09-27 15:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `home_page_content_tb`
--

CREATE TABLE `home_page_content_tb` (
  `id` int(11) NOT NULL,
  `hero_title` varchar(255) DEFAULT NULL,
  `hero_content` text DEFAULT NULL,
  `about_us_title` varchar(255) DEFAULT NULL,
  `about_us_content` text DEFAULT NULL,
  `our_mission_title` varchar(255) DEFAULT NULL,
  `our_mission_content` text DEFAULT NULL,
  `our_vision_title` varchar(255) DEFAULT NULL,
  `our_vision_content` text DEFAULT NULL,
  `why_chabacano_title` varchar(255) DEFAULT NULL,
  `why_chabacano_content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `home_page_content_tb`
--

INSERT INTO `home_page_content_tb` (`id`, `hero_title`, `hero_content`, `about_us_title`, `about_us_content`, `our_mission_title`, `our_mission_content`, `our_vision_title`, `our_vision_content`, `why_chabacano_title`, `why_chabacano_content`, `created_at`, `updated_at`) VALUES
(1, 'Chabacano Translator', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ', 'About Us', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ', 'Our Mission', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ', 'Our Vision', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit,', 'Why Chabacano?', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, ', '2024-10-02 13:53:12', '2024-11-03 07:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `story_headers_tb`
--

CREATE TABLE `story_headers_tb` (
  `id` int(11) NOT NULL,
  `heading_title` varchar(255) NOT NULL,
  `heading_content` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `section_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `story_headers_tb`
--

INSERT INTO `story_headers_tb` (`id`, `heading_title`, `heading_content`, `created_at`, `updated_at`, `section_order`) VALUES
(23, 'New Header 1', 'Header 1 content', '2024-10-03 07:03:16', '2024-11-03 14:48:41', 2),
(25, 'New Header 2', 'Header 2 content', '2024-10-03 07:09:27', '2024-11-03 07:19:20', 4),
(26, 'New Header 3', 'New content from edit', '2024-10-03 07:10:02', '2024-11-03 14:48:41', 3),
(27, 'New asdasdasd', 'Header 4 content', '2024-10-03 07:11:32', '2024-11-03 07:20:12', 0),
(31, 'New story 5', 'New story 5', '2024-11-03 07:19:06', '2024-11-03 14:48:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `story_subheaders_tb`
--

CREATE TABLE `story_subheaders_tb` (
  `id` int(11) NOT NULL,
  `heading_id` int(11) NOT NULL,
  `subheading_title` varchar(255) NOT NULL,
  `subheading_content` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `story_subheaders_tb`
--

INSERT INTO `story_subheaders_tb` (`id`, `heading_id`, `subheading_title`, `subheading_content`, `created_at`, `updated_at`) VALUES
(25, 25, 'New Subheader 2', 'Subheader 2 content', '2024-10-03 07:09:27', '2024-10-03 07:09:27'),
(35, 26, 'New Subheader 3', 'New content from edit', '2024-10-03 13:58:45', '2024-10-03 13:58:45'),
(36, 26, 'New Subheader 3 nameeee', 'qweqwewqeqweqweqweqwe', '2024-10-03 13:58:45', '2024-10-03 13:58:45'),
(37, 31, 'New story 5', 'New story 5', '2024-11-03 07:19:06', '2024-11-03 07:19:06'),
(38, 27, 'New Subheader 4', 'Subheader 4 content', '2024-11-03 07:20:12', '2024-11-03 07:20:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins_tb`
--
ALTER TABLE `admins_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dictionary_tb`
--
ALTER TABLE `dictionary_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_page_content_tb`
--
ALTER TABLE `home_page_content_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story_headers_tb`
--
ALTER TABLE `story_headers_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story_subheaders_tb`
--
ALTER TABLE `story_subheaders_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_heading_id` (`heading_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins_tb`
--
ALTER TABLE `admins_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dictionary_tb`
--
ALTER TABLE `dictionary_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `home_page_content_tb`
--
ALTER TABLE `home_page_content_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `story_headers_tb`
--
ALTER TABLE `story_headers_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `story_subheaders_tb`
--
ALTER TABLE `story_subheaders_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `story_subheaders_tb`
--
ALTER TABLE `story_subheaders_tb`
  ADD CONSTRAINT `fk_heading_id` FOREIGN KEY (`heading_id`) REFERENCES `story_headers_tb` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
