-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 30, 2025 at 06:01 AM
-- Server version: 8.3.0
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iitm_display_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_cache`
--

DROP TABLE IF EXISTS `iitmdp_cache`;
CREATE TABLE IF NOT EXISTS `iitmdp_cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_cache_locks`
--

DROP TABLE IF EXISTS `iitmdp_cache_locks`;
CREATE TABLE IF NOT EXISTS `iitmdp_cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_categories`
--

DROP TABLE IF EXISTS `iitmdp_categories`;
CREATE TABLE IF NOT EXISTS `iitmdp_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iitmdp_categories`
--

INSERT INTO `iitmdp_categories` (`id`, `name`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'News', 1, '2025-09-29 06:44:03', '2025-09-29 06:44:03'),
(2, 'Temperature', 2, '2025-09-29 06:44:03', '2025-09-29 06:44:03'),
(3, 'teast 2', 3, '2025-09-30 00:22:03', '2025-09-30 00:23:49');

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_chart_data`
--

DROP TABLE IF EXISTS `iitmdp_chart_data`;
CREATE TABLE IF NOT EXISTS `iitmdp_chart_data` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `chart_id` bigint UNSIGNED NOT NULL,
  `data` json NOT NULL,
  `labels` json DEFAULT NULL,
  `datasets` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iitmdp_chart_data_chart_id_foreign` (`chart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iitmdp_chart_data`
--

INSERT INTO `iitmdp_chart_data` (`id`, `chart_id`, `data`, `labels`, `datasets`, `created_at`, `updated_at`) VALUES
(1, 1, '[]', '[\"Label 1\", \"Label 2\", \"Label 3\", \"Label 4\", \"Label 5\"]', '[{\"data\": [10, 20, 30, 40, 50], \"label\": \"Data Series 1\", \"borderColor\": \"#36a2eb\", \"backgroundColor\": \"#36a2eb\"}]', '2025-09-29 06:50:47', '2025-09-29 06:50:47'),
(2, 2, '[]', '[\"Label 1\", \"Label 2\", \"Label 3\", \"Label 4\", \"Label 5\"]', '[{\"data\": [10, 20, 30, 40, 50], \"fill\": false, \"label\": \"Data Series 1\", \"tension\": 0.4, \"borderColor\": \"#36a2eb\", \"backgroundColor\": \"#36a2eb\"}]', '2025-09-29 06:51:05', '2025-09-29 06:51:05'),
(3, 3, '[]', '[\"Label 1\", \"Label 2\", \"Label 3\", \"Label 4\", \"Label 5\"]', '[{\"data\": [10, 20, 30, 40, 50], \"label\": \"Data Series\", \"backgroundColor\": [\"#ff6384\", \"#36a2eb\", \"#ffcd56\", \"#4bc0c0\", \"#9966ff\"]}]', '2025-09-29 06:51:37', '2025-09-29 06:51:37'),
(4, 4, '[]', '[\"Label 1\", \"Label 2\", \"Label 3\", \"Label 4\", \"Label 5\"]', '[{\"data\": [10, 20, 30, 40, 50], \"label\": \"Data Series\", \"backgroundColor\": [\"#ff6384\", \"#36a2eb\", \"#ffcd56\", \"#4bc0c0\", \"#9966ff\"]}]', '2025-09-29 06:51:43', '2025-09-29 06:51:43'),
(5, 5, '[]', '[\"Label 1\", \"Label 2\", \"Label 3\", \"Label 4\", \"Label 5\"]', '[{\"data\": [10, 20, 30, 40, 50], \"label\": \"Data Series\", \"borderColor\": \"#36a2eb\", \"backgroundColor\": \"#36a2eb\"}]', '2025-09-29 06:51:59', '2025-09-29 06:51:59'),
(6, 6, '[]', '[\"Label 1\", \"Label 2\", \"Label 3\", \"Label 4\", \"Label 5\"]', '[{\"data\": [10, 20, 30, 40, 50], \"label\": \"Data Series\", \"borderColor\": \"#36a2eb\", \"backgroundColor\": \"#36a2eb\"}]', '2025-09-29 06:52:09', '2025-09-29 06:52:09');

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_failed_jobs`
--

DROP TABLE IF EXISTS `iitmdp_failed_jobs`;
CREATE TABLE IF NOT EXISTS `iitmdp_failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iitmdp_failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_iitmdp_migrations`
--

DROP TABLE IF EXISTS `iitmdp_iitmdp_migrations`;
CREATE TABLE IF NOT EXISTS `iitmdp_iitmdp_migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iitmdp_iitmdp_migrations`
--

INSERT INTO `iitmdp_iitmdp_migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_25_112254_create_categories_table', 1),
(5, '2025_09_25_112258_create_news_table', 1),
(6, '2025_09_25_112302_create_videos_table', 1),
(7, '2025_09_25_112321_create_slideshows_table', 1),
(8, '2025_09_29_050835_create_meteorological_tabs_table', 1),
(9, '2025_09_29_050841_create_meteorological_charts_table', 1),
(10, '2025_09_29_050845_create_chart_data_table', 1),
(11, '2025_09_29_055927_update_meteorological_charts_table_chart_types', 1);

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_jobs`
--

DROP TABLE IF EXISTS `iitmdp_jobs`;
CREATE TABLE IF NOT EXISTS `iitmdp_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iitmdp_jobs_queue_index` (`queue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_job_batches`
--

DROP TABLE IF EXISTS `iitmdp_job_batches`;
CREATE TABLE IF NOT EXISTS `iitmdp_job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_meteorological_charts`
--

DROP TABLE IF EXISTS `iitmdp_meteorological_charts`;
CREATE TABLE IF NOT EXISTS `iitmdp_meteorological_charts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tab_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chart_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chart_config` json DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iitmdp_meteorological_charts_tab_id_foreign` (`tab_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iitmdp_meteorological_charts`
--

INSERT INTO `iitmdp_meteorological_charts` (`id`, `tab_id`, `title`, `chart_type`, `chart_config`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bar Chart', 'bar', NULL, 1, 1, '2025-09-29 06:50:44', '2025-09-29 06:50:44'),
(2, 1, 'Line Chart', 'line', NULL, 2, 1, '2025-09-29 06:51:04', '2025-09-29 06:51:04'),
(3, 2, 'Pie Chart', 'pie', NULL, 1, 1, '2025-09-29 06:51:36', '2025-09-29 06:51:36'),
(4, 2, 'Doughnut Chart', 'doughnut', NULL, 2, 1, '2025-09-29 06:51:42', '2025-09-29 06:51:42'),
(5, 3, 'Radar Chart', 'radar', NULL, 1, 1, '2025-09-29 06:51:58', '2025-09-29 06:51:58'),
(6, 3, 'Bubble Chart', 'bubble', NULL, 2, 1, '2025-09-29 06:52:04', '2025-09-29 06:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_meteorological_tabs`
--

DROP TABLE IF EXISTS `iitmdp_meteorological_tabs`;
CREATE TABLE IF NOT EXISTS `iitmdp_meteorological_tabs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `heading` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_station` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'solapur',
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iitmdp_meteorological_tabs`
--

INSERT INTO `iitmdp_meteorological_tabs` (`id`, `heading`, `data_station`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Solapur Obs', 'solapur', 1, 1, '2025-09-29 06:50:28', '2025-09-29 06:50:28'),
(2, 'Delhi Obs', 'delhi', 2, 1, '2025-09-29 06:51:23', '2025-09-29 06:51:23'),
(3, 'Pune Obs', 'pune', 3, 1, '2025-09-29 06:51:56', '2025-09-29 06:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_news`
--

DROP TABLE IF EXISTS `iitmdp_news`;
CREATE TABLE IF NOT EXISTS `iitmdp_news` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `iitmdp_news_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iitmdp_news`
--

INSERT INTO `iitmdp_news` (`id`, `category_id`, `title`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cloud Aersosol Interaction and Precipitation Enhancement Experiment', 1, '2025-09-29 06:46:37', '2025-09-29 06:46:37'),
(2, 1, 'Seasonal Prediction', 2, '2025-09-29 06:46:42', '2025-09-29 06:46:42'),
(3, 1, 'Extended Range Prediction', 3, '2025-09-29 06:46:50', '2025-09-29 06:46:50'),
(4, 1, 'Parameterization of Processes', 4, '2025-09-29 06:47:00', '2025-09-29 06:47:00'),
(5, 1, 'Metropolitan Air Quality', 5, '2025-09-29 06:47:10', '2025-09-29 06:47:10'),
(6, 1, 'Climate Variability', 6, '2025-09-29 06:47:18', '2025-09-29 06:47:18'),
(7, 1, 'Atmospheric Electricity & Lightning', 7, '2025-09-29 06:47:26', '2025-09-29 06:47:26'),
(8, 1, 'Research Test Beds', 8, '2025-09-29 06:47:33', '2025-09-29 06:47:33'),
(9, 1, 'Development of Skilled Manpower', 9, '2025-09-29 06:47:41', '2025-09-29 06:47:41'),
(10, 1, 'High Performance Computing', 10, '2025-09-29 06:47:49', '2025-09-29 06:47:49'),
(11, 2, 'AMET-Chennai: 26–39°C | RH 69% | 993mb | 6m/s W', 1, '2025-09-29 06:49:04', '2025-09-29 06:49:04'),
(12, 2, 'IMD-Chennai: 22–36°C | RH 42% | 962mb | 11m/s S', 2, '2025-09-29 06:49:16', '2025-09-29 06:49:16'),
(13, 2, 'SITS-Chennai: 20–45°C | RH 72% | 995mb | 5m/s S', 3, '2025-09-29 06:49:25', '2025-09-29 06:49:25'),
(14, 2, 'SRM-Agri-Chennai: 28–35°C | RH 51% | 984mb | 12m/s SE', 4, '2025-09-29 06:49:37', '2025-09-29 06:49:37'),
(15, 2, 'AWS001-Chennai: 27–40°C | RH 30% | 1006mb | 4m/s E', 5, '2025-09-29 06:49:44', '2025-09-29 06:49:44'),
(16, 2, 'IITM-Pune: 30–43°C | RH 54% | 1000mb | 3m/s SE', 6, '2025-09-29 06:49:52', '2025-09-29 06:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_password_reset_tokens`
--

DROP TABLE IF EXISTS `iitmdp_password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `iitmdp_password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_sessions`
--

DROP TABLE IF EXISTS `iitmdp_sessions`;
CREATE TABLE IF NOT EXISTS `iitmdp_sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `iitmdp_sessions_user_id_index` (`user_id`),
  KEY `iitmdp_sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iitmdp_sessions`
--

INSERT INTO `iitmdp_sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('jTkUBjGeO7jazhOIvNb3QCWrOAGvU72t0yOQKsVE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code-Insiders/1.105.0-insider Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieEp0VTRseE1mY1FnU2tGN2VvbHR2Qzl2V0dIWkhnTTVGTGlUZmVWdCI7czo1OiJlcnJvciI7czozNjoiUGxlYXNlIGxvZyBpbiB0byBhY2Nlc3MgYWRtaW4gcGFuZWwuIjtzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MTp7aTowO3M6NToiZXJyb3IiO319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTAwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4/aWQ9MWVjYjg4NjEtNWNlOC00ZmFiLTk1ZWEtODAxYjZkZDU2OWFjJnZzY29kZUJyb3dzZXJSZXFJZD0xNzU5MjA4NTA5NTM1Ijt9fQ==', 1759208510),
('THf3Yr4NEHwJtB193YAUgaGm7P0xE4bmILYp6oYc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code-Insiders/1.105.0-insider Chrome/138.0.7204.235 Electron/37.3.1 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSzhJVlc1WHJDZks0MDhKV1Y1WXVGTzIyUElyQnB2UHpDSkNoeTRmQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1759208510),
('TVhaPOQWiUKBhWBwdQIHw8RELUeKY7nYvKbvz6IW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSVBwdzNCUUZwWFUwNmlIT3lHNkFrZXFJQWMzYmVmYlV1cjExRHdxZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1759211720);

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_slideshows`
--

DROP TABLE IF EXISTS `iitmdp_slideshows`;
CREATE TABLE IF NOT EXISTS `iitmdp_slideshows` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('image','video','gif') COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iitmdp_slideshows`
--

INSERT INTO `iitmdp_slideshows` (`id`, `title`, `filename`, `path`, `type`, `mime_type`, `size`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'BFS-Landscape', '1759149260_BFS-Landscape.mp4', 'slideshows/1759149260_BFS-Landscape.mp4', 'video', 'video/mp4', 31344033, 1, '2025-09-29 07:04:20', '2025-09-30 00:03:25'),
(4, 'iitm_logo-preview', '1759210429_iitm_logo-preview.png', 'slideshows/1759210429_iitm_logo-preview.png', 'image', 'image/png', 44186, 2, '2025-09-30 00:03:49', '2025-09-30 00:03:49');

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_users`
--

DROP TABLE IF EXISTS `iitmdp_users`;
CREATE TABLE IF NOT EXISTS `iitmdp_users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iitmdp_users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iitmdp_users`
--

INSERT INTO `iitmdp_users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@iitm-display.com', NULL, '$2y$12$R42NCBIrCxBNf0Gx3TFKceXsWpcvkDQerC865CpQxW.kBtr9y0s1i', NULL, '2025-09-29 06:44:03', '2025-09-29 06:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `iitmdp_videos`
--

DROP TABLE IF EXISTS `iitmdp_videos`;
CREATE TABLE IF NOT EXISTS `iitmdp_videos` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint NOT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `iitmdp_videos`
--

INSERT INTO `iitmdp_videos` (`id`, `title`, `filename`, `path`, `mime_type`, `size`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'BFS-Landscape', '1759148417_BFS-Landscape.mp4', 'videos/1759148417_BFS-Landscape.mp4', 'video/mp4', 31344033, 1, '2025-09-29 06:50:17', '2025-09-29 06:50:17');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
