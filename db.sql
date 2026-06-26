-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2026 at 05:19 AM
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
-- Database: `ebook_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ebook_id` bigint(20) UNSIGNED NOT NULL,
  `borrow_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('borrowed','returned','expired') NOT NULL DEFAULT 'borrowed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_policies`
--

CREATE TABLE `borrow_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('student','teacher','staff','alumni') NOT NULL,
  `max_books` int(11) NOT NULL,
  `borrow_days` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrow_policies`
--

INSERT INTO `borrow_policies` (`id`, `role`, `max_books`, `borrow_days`, `active`, `created_at`, `updated_at`) VALUES
(1, 'student', 5, 10, 1, '2026-06-22 06:17:01', '2026-06-22 06:17:01'),
(2, 'teacher', 10, 30, 1, '2026-06-22 06:17:16', '2026-06-22 06:17:16'),
(3, 'staff', 10, 30, 1, '2026-06-22 06:17:24', '2026-06-22 06:17:24'),
(4, 'alumni', 5, 30, 1, '2026-06-22 06:17:34', '2026-06-22 06:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(4, '000', 'เบ็ดเตล็ด หรือความรู้ทั่วไป', 'สารคดีทั่วไป คอมพิวเตอร์', 1, NULL, NULL),
(5, '100', 'ปรัชญา และจิตวิทยา', 'จิตวิทยา การคิด ปรัชญา', 1, NULL, NULL),
(6, '200', 'ศาสนา', 'คำสอน ศาสนาเปรียบเทียบ', 1, NULL, NULL),
(7, '300', 'สังคมศาสตร์', 'การเมือง กฎหมาย การศึกษา ประเพณี', 1, NULL, NULL),
(8, '400', 'ภาษาศาสตร์', 'ไวยากรณ์ พจนานุกรม ภาษาต่าง ๆ', 1, NULL, NULL),
(9, '500', 'วิทยาศาสตร์', 'คณิตศาสตร์ ฟิสิกส์ เคมี ชีววิทยา', 1, NULL, NULL),
(10, '600', 'วิทยาศาสตร์ประยุกต์ หรือเทคโนโลยี', 'การแพทย์ วิศวกรรมศาสตร์ การเกษตร', 1, NULL, NULL),
(11, '700', 'ศิลปกรรม และนันทนาการ', 'ศิลปะ ดนตรี กีฬา การถ่ายภาพ', 1, NULL, NULL),
(12, '800', 'วรรณคดี', 'นวนิยาย เรื่องสั้น บทกวี', 1, NULL, NULL),
(13, '900', 'ประวัติศาสตร์ และภูมิศาสตร์', 'ประวัติศาสตร์ ภูมิศาสตร์ การท่องเที่ยว', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publish_year` year(4) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `preview_file` varchar(255) DEFAULT NULL,
  `total_pages` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `borrow_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`id`, `title`, `author`, `isbn`, `publisher`, `publish_year`, `category_id`, `description`, `keywords`, `cover`, `file_path`, `preview_file`, `total_pages`, `status`, `created_at`, `updated_at`, `view_count`, `borrow_count`) VALUES
(7, 'กก', 'นาย ก', '1222', 'กขค', '2001', 5, '...', 'นาย ก,ศึกษา', 'covers/Oyd2XfJkWFJRv7JW1tBOAxnn4wHbMr9ImWRV6yUK.jpg', 'ebooks/hBQC9WFjnj8JIdORwdcW8779anwaAA5t59RLLnKW.pdf', NULL, 320, 1, '2026-06-25 18:29:02', '2026-06-25 18:29:02', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_15_065003_create_categories_table', 2),
(5, '2026_06_15_070058_create_ebooks_table', 3),
(6, '2026_06_15_070907_create_borrows_table', 4),
(7, '2026_06_15_072603_create_borrow_policies_table', 4),
(8, '2026_06_15_073325_add_stats_to_ebooks_table', 5),
(9, '2026_06_22_135507_add_role_to_users_table', 6),
(10, '2026_06_25_045319_add_preview_file_to_ebooks_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ewX6v18glAzMifXnOjSheTGpYKINGlouMGPaKIDf', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRzBqZHRmaHp3a2FUd1NEQm9yamY5WGppdzRKTURjYlEyUEp6OGxNOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9lYm9va3MiO3M6NToicm91dGUiO3M6MTI6ImVib29rcy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1782277233),
('PlRo36TL5Ra3x6ionZGc1t8kKUWlAtsd7JPRZelC', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTklkRDQ3MnZ5WENnY1hjMjh6aXNiUkNVNDlhbmdSeWMyYzJqVXhUMCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvY2F0ZWdvcmllcyI7czo1OiJyb3V0ZSI7czoxNjoiY2F0ZWdvcmllcy5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1782378397),
('qUzMpPDxXNsldkykMYwfYC1VcFXcTWZ16xZn2elV', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiS21SY29LbWxIWjM0S1UxaWdpWXFXT2ZhZEZjN1V6UUs2SjV2R0FpQSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9lYm9va3MiO3M6NToicm91dGUiO3M6MTI6ImVib29rcy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1782438070),
('Sl5LqPUMqz8PjyrrQWyoOcFxzpSKtc9ZSP4ehVqY', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVXhIR2ZMZEUxRWp1TDFVejVDU3VyV2hwdmRuVGppanc0MEdCMVh5bSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9lYm9va3MvNiI7czo1OiJyb3V0ZSI7czoxMToiZWJvb2tzLnNob3ciO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1782375342);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` enum('student','teacher','staff','alumni','admin') NOT NULL DEFAULT 'student',
  `faculty` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `faculty`, `department`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'RUS APP', 'r@g.com', 'student', NULL, NULL, 1, NULL, '$2y$12$C.FMuPNuySuTi/awqW/E0OUXjllUqDwFVSqo7EDqhH1Q0cf5OkQBu', 'xmGzl3pZhXo02OntQxmJTnGdEBREDTUkMh3Ys2aZAx8SlCyxJ8iccs8bQ9lc', '2026-06-14 23:30:20', '2026-06-14 23:30:20'),
(2, 'Admin System', 'admin@rmutsb.ac.th', 'admin', 'สำนักวิทยบริการ', 'IT', 1, NULL, '$2y$12$C.FMuPNuySuTi/awqW/E0OUXjllUqDwFVSqo7EDqhH1Q0cf5OkQBu', NULL, '2026-06-22 14:00:05', '2026-06-22 14:00:05'),
(3, 'Student Test', 'student@rmutsb.ac.th', 'student', 'คณะวิทยาศาสตร์', 'เทคโนโลยีสารสนเทศ', 1, NULL, '$2y$12$C.FMuPNuySuTi/awqW/E0OUXjllUqDwFVSqo7EDqhH1Q0cf5OkQBu', NULL, '2026-06-22 14:00:05', '2026-06-22 14:00:05'),
(4, 'Teacher Test', 'teacher@rmutsb.ac.th', 'teacher', 'คณะวิทยาศาสตร์', 'เทคโนโลยีสารสนเทศ', 1, NULL, '$2y$12$C.FMuPNuySuTi/awqW/E0OUXjllUqDwFVSqo7EDqhH1Q0cf5OkQBu', NULL, '2026-06-22 14:00:05', '2026-06-22 14:00:05'),
(5, 'Staff Test', 'staff@rmutsb.ac.th', 'staff', 'สำนักวิทยบริการ', 'ห้องสมุด', 1, NULL, '$2y$12$C.FMuPNuySuTi/awqW/E0OUXjllUqDwFVSqo7EDqhH1Q0cf5OkQBu', NULL, '2026-06-22 14:00:05', '2026-06-22 14:00:05'),
(6, 'Alumni Test', 'alumni@rmutsb.ac.th', 'alumni', 'คณะวิทยาศาสตร์', 'เทคโนโลยีสารสนเทศ', 1, NULL, '$2y$12$C.FMuPNuySuTi/awqW/E0OUXjllUqDwFVSqo7EDqhH1Q0cf5OkQBu', NULL, '2026-06-22 14:00:05', '2026-06-22 14:00:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `borrows_user_id_foreign` (`user_id`),
  ADD KEY `borrows_ebook_id_foreign` (`ebook_id`);

--
-- Indexes for table `borrow_policies`
--
ALTER TABLE `borrow_policies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `borrow_policies_role_unique` (`role`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ebooks_category_id_foreign` (`category_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `borrow_policies`
--
ALTER TABLE `borrow_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `borrows_ebook_id_foreign` FOREIGN KEY (`ebook_id`) REFERENCES `ebooks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `borrows_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD CONSTRAINT `ebooks_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
