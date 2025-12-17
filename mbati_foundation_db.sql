-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2025 at 06:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mbati_foundation_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` enum('draft','upcoming','active','completed') DEFAULT 'draft',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `title`, `category_id`, `category`, `description`, `start_date`, `end_date`, `location`, `status`, `image`, `created_at`, `updated_at`) VALUES
(2, 'test1', 6, NULL, 'dfdddcxccx', '2025-12-17', '2026-01-02', 'Kirinyaga county ', 'active', 'uploads/activities/activity_6941c9bb0ff9f.png', '2025-12-16 21:06:03', '2025-12-16 21:11:11'),
(3, 'test2', 4, NULL, 'yrysdh', '2025-12-17', '2026-01-10', 'kimbo', 'draft', 'uploads/activities/activity_69423493a003b.png', '2025-12-17 04:41:55', '2025-12-17 04:41:55'),
(4, 'Youth Leadership Summit 2024', 1, NULL, 'A 3-day intensive leadership training program for 50 young leaders from Luanda Constituency, focusing on community development and project management.', '2024-03-15', '2024-03-17', 'Luanda Town Hall', 'completed', 'https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:12', '2025-12-17 12:18:12'),
(5, 'Maternal Health Workshop Series', 2, NULL, 'Educational workshops for 120 expectant mothers across 5 communities, covering prenatal care, nutrition, and postnatal support.', '2024-04-01', '2024-04-30', 'Various Community Centers', 'completed', 'https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13'),
(7, 'Harold Mbati Champions Cup 2023', 4, NULL, 'Annual youth football tournament with 32 teams participating, engaging 500+ youth and identifying 15 talented players for academy trials.', '2023-12-01', '2023-12-31', 'Various Sports Grounds', 'completed', 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13'),
(8, 'Digital Literacy Program', 1, NULL, 'Trained 75 youth in basic computer skills, internet usage, and digital entrepreneurship over a 4-week period at Luanda ICT Center.', '2024-01-01', '2024-01-31', 'Luanda ICT Center', 'completed', 'https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13'),
(9, 'Child Nutrition & Wellness Drive', 2, NULL, 'Provided nutritional supplements and health check-ups for 200 children under 5 years across 3 communities, with nutrition education for parents.', '2024-03-01', '2024-03-31', 'Multiple Communities', 'completed', 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13'),
(10, 'Youth Entrepreneurship Incubator', 1, NULL, '6-month program supporting 30 young entrepreneurs with business training, mentorship, and seed funding to launch sustainable ventures.', '2024-04-01', NULL, 'Luanda Business Hub', 'active', 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13'),
(11, 'Harold Mbati Champions Cup 2024', 4, NULL, 'Current season with 40 youth teams competing, featuring weekly matches, talent scouting, and community engagement activities.', '2024-05-01', NULL, 'Various Sports Facilities', 'active', 'https://images.unsplash.com/photo-1515187029135-18ee286d815b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13'),
(12, 'Classroom Renovation Project', 3, NULL, 'Renovating 8 classrooms across 3 primary schools, improving learning environments for 600+ students with better lighting, desks, and learning materials.', '2024-03-01', NULL, '3 Primary Schools', 'active', 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13'),
(13, 'Mobile Health Clinic Initiative', 2, NULL, 'Weekly mobile clinic serving remote communities with maternal health services, child vaccinations, and basic healthcare for 150+ families monthly.', '2024-02-01', NULL, 'Remote Communities', 'active', 'https://images.unsplash.com/photo-1551601651-2a8555f1a136?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13'),
(14, 'Youth Innovation Challenge', 1, NULL, '3-day hackathon where youth develop innovative solutions to community challenges, with winners receiving seed funding.', '2024-06-15', '2024-06-17', 'Luanda Innovation Hub', 'upcoming', 'https://images.unsplash.com/photo-1553877522-43269d4ea984?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13'),
(15, 'Community Maternal Health Fair', 2, NULL, 'Free health check-ups, vaccinations, and educational workshops for mothers and children across 5 community centers.', '2024-07-10', '2024-07-10', '5 Community Centers', 'upcoming', 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13'),
(16, 'Teacher Professional Development', 3, NULL, 'Comprehensive training program for 50 teachers from 8 schools, focusing on modern teaching methods and child-centered learning.', '2024-09-01', NULL, 'Luanda Teachers College', 'draft', 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', '2025-12-17 12:18:13', '2025-12-17 12:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$gl30XANA28jb3jaOI2Y3ZOjKwJ1I4nEsIqhRMgP4qqvK1O276Jbc.', '2025-12-16 20:34:19');

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `title`, `description`, `cover_image`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test', 'jhdhhd', 'uploads/albums/album_cover_6941d0eb26807.png', 'eeee', 'active', '2025-12-16 21:36:43', '2025-12-16 21:36:43'),
(2, 'test', 'deede', 'uploads/albums/album_cover_694232a46793c.png', 'Community Outreach', 'active', '2025-12-17 04:33:40', '2025-12-17 04:33:40');

-- --------------------------------------------------------

--
-- Table structure for table `album_images`
--

CREATE TABLE `album_images` (
  `id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `album_images`
--

INSERT INTO `album_images` (`id`, `album_id`, `image_path`, `title`, `description`, `sort_order`, `created_at`) VALUES
(1, 2, 'uploads/albums/album_img_6942364d573db.png', 'eeee', 'efeergrg', 0, '2025-12-17 04:49:17'),
(2, 2, 'uploads/albums/album_img_694237c185881.png', NULL, NULL, 0, '2025-12-17 04:55:29'),
(4, 2, 'uploads/albums/album_img_694237c18984a.png', NULL, NULL, 0, '2025-12-17 04:55:29'),
(5, 2, 'uploads/albums/album_img_694237c18b704.png', NULL, NULL, 0, '2025-12-17 04:55:29'),
(6, 2, 'uploads/albums/album_img_694237c18cdc3.png', NULL, NULL, 0, '2025-12-17 04:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Youth Empowerment', 'Programs focused on empowering young people', '2025-12-16 20:51:49'),
(2, 'Sports Development', 'Sports and recreational activities', '2025-12-16 20:51:49'),
(3, 'School Development', 'Educational programs and school improvements', '2025-12-16 20:51:49'),
(4, 'Mother & Child Care', 'Healthcare and support for mothers and children', '2025-12-16 20:51:49'),
(5, 'Community Outreach', 'General community support programs', '2025-12-16 20:51:49'),
(6, 'Environmental', 'Environmental conservation and awareness', '2025-12-16 20:51:49'),
(7, 'Health & Wellness', 'General health and wellness programs', '2025-12-16 20:51:49'),
(8, 'development', 'heefevduxcdx', '2025-12-16 20:53:02'),
(37, 'test1', 'heefevduxcdx', '2025-12-17 04:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `is_read`, `created_at`) VALUES
(1, 'winslause Busale Shioso', 'wenbusale383@gmail.com', NULL, 'gvtftf', 'vffy', 1, '2025-12-17 12:39:15'),
(2, 'Brian Barasa', 'brian236@gmail.com', NULL, 'hhtetedte', 'shwgywgdwyd', 0, '2025-12-17 12:45:52'),
(3, 'winslause Busale Shioso', 'wenbusale383@gmail.com', NULL, 'tets', 'eeef', 0, '2025-12-17 13:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `donor_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) DEFAULT 'KES',
  `payment_method` varchar(50) DEFAULT NULL,
  `status` enum('completed','processing','pending') DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `donation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `donor_name`, `email`, `amount`, `currency`, `payment_method`, `status`, `notes`, `donation_date`) VALUES
(1, 'yfh', 'wenbusale383@gmail.com', 2722.00, 'KES', 'mpesa', 'completed', 'ghu', '2025-12-17 04:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `image_path`, `category_id`, `category`, `description`, `uploaded_at`) VALUES
(1, 'test3', 'uploads/gallery/gallery_694235e6a000e.jpg', NULL, 'Community Outreach', 'dcddyicgccccdcs', '2025-12-17 04:47:34'),
(2, '', 'uploads/gallery/gallery_694237a71cf8e.png', NULL, '', '', '2025-12-17 04:55:03'),
(3, '', 'uploads/gallery/gallery_69427bed95994.jpg', NULL, '', '', '2025-12-17 09:46:21'),
(4, 'fxfxg', 'uploads/gallery/gallery_6942948af0384.png', NULL, 'development', 'vhfuuf', '2025-12-17 11:31:22'),
(5, 'Youth Empowerment Activity', 'uploads/gallery/gallery_69427bed95994.jpg', NULL, 'Youth Empowerment', 'Youth participating in community development activities', '2025-12-17 11:31:46'),
(6, 'Community Outreach Program', 'uploads/gallery/gallery_694235e6a000e.jpg', NULL, 'Community Outreach', 'Community members engaged in outreach programs', '2025-12-17 11:31:46'),
(7, 'School Development Initiative', 'uploads/gallery/gallery_694237a71cf8e.png', NULL, 'School Development', 'Educational programs and school improvements', '2025-12-17 11:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `highlights`
--

CREATE TABLE `highlights` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `video_url` varchar(500) DEFAULT NULL,
  `link_url` varchar(500) DEFAULT NULL,
  `highlight_type` enum('image','video','link') DEFAULT 'image',
  `status` enum('active','inactive') DEFAULT 'active',
  `sort_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `highlights`
--

INSERT INTO `highlights` (`id`, `title`, `description`, `image_path`, `video_url`, `link_url`, `highlight_type`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'ussscss', 'deffregergtrg', 'uploads/highlights/highlight_6942360c00367.png', '', '', 'image', 'active', 1, '2025-12-17 04:48:12', '2025-12-17 04:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `video_url` varchar(500) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `description`, `video_url`, `thumbnail`, `category`, `status`, `created_at`, `updated_at`) VALUES
(1, 'tetts', 'hegeee', 'https://vimeo.com/753580183', 'https://vimeo.com/753580183', 'Health & Wellness', 'active', '2025-12-17 04:35:41', '2025-12-17 04:35:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `album_images`
--
ALTER TABLE `album_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `album_id` (`album_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_gallery_category` (`category_id`);

--
-- Indexes for table `highlights`
--
ALTER TABLE `highlights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `album_images`
--
ALTER TABLE `album_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `highlights`
--
ALTER TABLE `highlights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album_images`
--
ALTER TABLE `album_images`
  ADD CONSTRAINT `album_images_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `gallery`
--
ALTER TABLE `gallery`
  ADD CONSTRAINT `fk_gallery_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
