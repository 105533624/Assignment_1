-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 01, 2026 at 08:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nextgenwebworks`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `eoi_id` int(11) NOT NULL,
  `jobref` varchar(5) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `street` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skills` text DEFAULT NULL,
  `otherskills` text DEFAULT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_reference` varchar(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `salary` varchar(50) NOT NULL,
  `reports_to` varchar(100) NOT NULL,
  `responsibilities` text NOT NULL,
  `essential_requirements` text NOT NULL,
  `preferred_requirements` text NOT NULL,
  `closing_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_reference`, `title`, `description`, `salary`, `reports_to`, `responsibilities`, `essential_requirements`, `preferred_requirements`, `closing_date`) VALUES
(1, 'UXD01', 'Senior UX/UI Designer', 'We are looking for a visionary designer to lead our user experience strategies and craft beautiful, highly functional interfaces for our digital clients.', '$110,000 - $130,000', 'Creative Director', 'Lead the design process from wireframing to high-fidelity prototypes.\nConduct user research and usability testing.\nCollaborate closely with the development team.', 'Minimum 5 years of experience in UI/UX design.\nExpertise in Figma, Adobe Creative Suite, and prototyping tools.\nA strong portfolio demonstrating creative web solutions.', 'Experience with motion design or micro-interactions.\nBackground in branding or visual identity systems.\nFamiliarity with front-end frameworks and design tokens.', '2026-05-30'),
(2, 'DEV02', 'Junior Front-End Developer', 'Join our coding team to bring stunning creative designs to life using standard web technologies with a focus on accessibility.', '$70,000 - $85,000', 'Lead Developer', 'Translate UI/UX design wireframes to actual code.\nEnsure technical feasibility of design layouts.\nOptimize applications for maximum speed and scalability.', 'Proficiency in semantic HTML5 and CSS3.\nUnderstanding of cross-browser compatibility issues.\nStrong communication skills and willingness to learn.', 'Experience deploying static sites via GitHub Pages or Netlify.\nBasic knowledge of accessibility testing tools (WAVE, Lighthouse).\nFamiliarity with version control via Git.', '2026-05-30');

-- --------------------------------------------------------

--
-- Table structure for table `team_contributions`
--

CREATE TABLE `team_contributions` (
  `id` int(11) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `project1_tasks` text NOT NULL,
  `project2_tasks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_contributions`
--

INSERT INTO `team_contributions` (`id`, `member_name`, `project1_tasks`, `project2_tasks`) VALUES
(1, 'Rafay Bilal Chaudry', 'Designed and wrote the HTML and CSS for the About page layout, and created the MySQL database table for team contributions.', 'Created the team contributions MySQL database and connected it to the PHP backend to display the data dynamically.'),
(2, 'Hamnah Chaudhary', 'Configured database architecture using a centralized settings file, developed dynamic job listings via PHP, and implemented advanced search and salary filtering features.', 'Engineered high-distinction website features including client testimonials, file uploads, enhanced CSS styling, and optimized overall backend file structure.'),
(3, 'Vansh Sukhija', 'Created index.html and jobs.html. Fixed and standardized code structure across team files. Managed GitHub repository and Jira board.', 'Built manage.php with full HR dashboard functionality and authentication system. Developed process_eoi.php with server-side validation and prepared statements.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$Yic/q/uRzXjszl2oBHe1JezxJVJOimrq4HWDls1cxYbpRsf3lpRaq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoi_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_reference` (`job_reference`);

--
-- Indexes for table `team_contributions`
--
ALTER TABLE `team_contributions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team_contributions`
--
ALTER TABLE `team_contributions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
