-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2024 at 11:51 AM
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
-- Database: `hrm`
--

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
(4, '2013_11_01_070215_create_roles_table', 1),
(5, '2014_10_12_000000_create_users_table', 1);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `identity` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `identity`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin', '2024-09-14 01:42:23', NULL);

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
('0PvDMGvmFDoYrQcdB7LjY2CvECgz6kAuRQd6HHvp', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSE15a2J4Y21MMXBncVRudWhDaVp5dEhXREUzSTVGUEczb3owMFVDaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1726300454),
('bZSvuRRWMwgN8jHM8BsWLYMYu9CrnECDzZaBxvcS', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibjZiQ2Z1OWtrbGh3amZ6dndiVVYwZjFsWXpFYlhsSDlhN2lFaGpLOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1726300490),
('GeqJBYh1IE51SoF8jrrlQtviNGLBF64cQoHihD38', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6InFINVV4S0h2b1lRYmowZDdqV0Z0SklwOXNxMmRhUzBNSXR3MTBQaDUiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vbG9jYWxob3N0L2hybS9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6InVzZXJJZCI7czozMjoiZVRKdllVdzBRekowVWxCNVpqTTNMMDlHUlhsWmR6MDkiO3M6ODoidXNlck5hbWUiO3M6MzI6Ik56VkZTSEl5VXpCMlREaDJjbTFUZUVoWU9WTlZkejA5IjtzOjc6InJvbGVfaWQiO3M6MzI6ImVUSnZZVXcwUXpKMFVsQjVaak0zTDA5R1JYbFpkejA5IjtzOjU6ImVtcElEIjtzOjMyOiJOelZGU0hJeVV6QjJURGgyY20xVGVFaFlPVk5WZHowOSI7czoxMDoiYWNjZXNzVHlwZSI7czozMjoiZVRKdllVdzBRekowVWxCNVpqTTNMMDlHUlhsWmR6MDkiO3M6NDoicm9sZSI7czozMjoiTVd0R1prRmtVVkpVTVdKMlp6VjZUbGQzYjJKb1VUMDkiO3M6MTI6InJvbGVJZGVudGl0eSI7czozMjoiVm05VWNYa3hkalptU21KTWNIWXhNbGMyYmxaWWR6MDkiO3M6NToiaW1hZ2UiO3M6MTI6Im5vLWltYWdlLnBuZyI7fQ==', 1726307198),
('JLfCThCmbZNZJ7JQHjGTEo9E0mZ58ZqEkNZa3vxI', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IllyMzRCaTl3NmtKdWJHaWRNOTVWaU5aZ1V4Y1hGNVNiaVQ1QVRQbTkiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vbG9jYWxob3N0L2hybS9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6InVzZXJJZCI7czozMjoiZVRKdllVdzBRekowVWxCNVpqTTNMMDlHUlhsWmR6MDkiO3M6ODoidXNlck5hbWUiO3M6MzI6Ik56VkZTSEl5VXpCMlREaDJjbTFUZUVoWU9WTlZkejA5IjtzOjc6InJvbGVfaWQiO3M6MzI6ImVUSnZZVXcwUXpKMFVsQjVaak0zTDA5R1JYbFpkejA5IjtzOjU6ImVtcElEIjtzOjMyOiJOelZGU0hJeVV6QjJURGgyY20xVGVFaFlPVk5WZHowOSI7czoxMDoiYWNjZXNzVHlwZSI7czozMjoiZVRKdllVdzBRekowVWxCNVpqTTNMMDlHUlhsWmR6MDkiO3M6NDoicm9sZSI7czozMjoiTVd0R1prRmtVVkpVTVdKMlp6VjZUbGQzYjJKb1VUMDkiO3M6MTI6InJvbGVJZGVudGl0eSI7czozMjoiVm05VWNYa3hkalptU21KTWNIWXhNbGMyYmxaWWR6MDkiO3M6NToiaW1hZ2UiO3M6MTI6Im5vLWltYWdlLnBuZyI7fQ==', 1726302326),
('LcvZETpVPEPqJpfrbZJfxYYXrnXx6cZamyq4xlXd', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2FWM1NFdWZ4UENaNTN5N3pqZExUSEZ1cTZTMTJkSGk1c0FONjdOYiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1726300017),
('MXUjIIN4RJAu0Iuh10KEuHUnyyeu5zwdwrR8Wtar', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IkxoUDBmTEh1QkRJTEhuUHM5dllPMVBkTksyd2lVanNIWXJyTENNaVkiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vbG9jYWxob3N0L2hybS9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6InVzZXJJZCI7czozMjoiZVRKdllVdzBRekowVWxCNVpqTTNMMDlHUlhsWmR6MDkiO3M6ODoidXNlck5hbWUiO3M6MzI6Ik56VkZTSEl5VXpCMlREaDJjbTFUZUVoWU9WTlZkejA5IjtzOjc6InJvbGVfaWQiO3M6MzI6ImVUSnZZVXcwUXpKMFVsQjVaak0zTDA5R1JYbFpkejA5IjtzOjU6ImVtcElEIjtzOjMyOiJOelZGU0hJeVV6QjJURGgyY20xVGVFaFlPVk5WZHowOSI7czoxMDoiYWNjZXNzVHlwZSI7czozMjoiZVRKdllVdzBRekowVWxCNVpqTTNMMDlHUlhsWmR6MDkiO3M6NDoicm9sZSI7czozMjoiTVd0R1prRmtVVkpVTVdKMlp6VjZUbGQzYjJKb1VUMDkiO3M6MTI6InJvbGVJZGVudGl0eSI7czozMjoiVm05VWNYa3hkalptU21KTWNIWXhNbGMyYmxaWWR6MDkiO3M6NToiaW1hZ2UiO3M6MTI6Im5vLWltYWdlLnBuZyI7fQ==', 1726304784),
('oOn0GLuTxTa0Ebk6GAlmuMuyP1Htqv7dEK7hZQjL', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVU3N3NrUGZLOHZ1SXRZMG9GMWZ0dklkeTRzZnk2U3lBNnhWcWxjUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1726300492),
('xeXxT6KpJJ19c4nFWu480cTsSSrEjg8pxjuDwldq', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiajhvT1BjRW9CY3lJZmthNzNSRllEUEJtWk0zTnhGUENoN1ZKZnlCSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1726299998),
('z6xOeJ04T8rc9cewRO4zV5UQtyhmxt606mTNMGnd', NULL, NULL, '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYzJKN2E2eWRubzZFY0lCQ2NVc0p4TTFvcWQ3U1pEM0oyWUszNU9rMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6ODoiaHR0cDovLzoiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1726300014),
('ZzVnGMa49QEzTCH8d6iUZBWToFydLgNlCanbc29w', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IldVR2xkb1JGZm9SRHcxMXNPYTZhV2IyRFlybXdXZTJNOFU3bXZla0ciO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vbG9jYWxob3N0L2hybS9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6InVzZXJJZCI7czozMjoiZVRKdllVdzBRekowVWxCNVpqTTNMMDlHUlhsWmR6MDkiO3M6ODoidXNlck5hbWUiO3M6MzI6Ik56VkZTSEl5VXpCMlREaDJjbTFUZUVoWU9WTlZkejA5IjtzOjc6InJvbGVfaWQiO3M6MzI6ImVUSnZZVXcwUXpKMFVsQjVaak0zTDA5R1JYbFpkejA5IjtzOjU6ImVtcElEIjtzOjMyOiJOelZGU0hJeVV6QjJURGgyY20xVGVFaFlPVk5WZHowOSI7czoxMDoiYWNjZXNzVHlwZSI7czozMjoiZVRKdllVdzBRekowVWxCNVpqTTNMMDlHUlhsWmR6MDkiO3M6NDoicm9sZSI7czozMjoiTVd0R1prRmtVVkpVTVdKMlp6VjZUbGQzYjJKb1VUMDkiO3M6MTI6InJvbGVJZGVudGl0eSI7czozMjoiVm05VWNYa3hkalptU21KTWNIWXhNbGMyYmxaWWR6MDkiO3M6NToiaW1hZ2UiO3M6MTI6Im5vLWltYWdlLnBuZyI7fQ==', 1726303422);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `full_access` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1=>yes 0=>no',
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1=>active 0=>inactive',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `contact_no`, `address`, `designation`, `date_of_birth`, `role_id`, `password`, `image`, `full_access`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', 'marchant@gmail.com', '123', NULL, NULL, NULL, 1, '$2y$12$e.BxlEyZUlCLrWUGyy.BmeUYXjY7/oYRvSV.WZCZFsUkYHncSrq0u', NULL, 1, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users1`
--

CREATE TABLE `users1` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_identity_unique` (`identity`);

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
  ADD UNIQUE KEY `users_contact_no_unique` (`contact_no`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_index` (`role_id`);

--
-- Indexes for table `users1`
--
ALTER TABLE `users1`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users1_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users1`
--
ALTER TABLE `users1`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
