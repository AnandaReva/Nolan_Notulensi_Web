-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2024 at 10:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_tes`
--

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content_id` bigint(20) UNSIGNED NOT NULL,
  `item` text DEFAULT NULL,
  `due` date DEFAULT NULL,
  `pic` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`id`, `content_id`, `item`, `due`, `pic`, `created_at`, `updated_at`) VALUES
(657, 747, 'a11(dataTelahAda)', '2023-10-06', 1, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(658, 747, 'a12(dataTelahAda)', '2023-09-22', 3, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(659, 747, 'a13(dataTelahAda)', NULL, 4, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(660, 748, 'a21(dataTelahAda)', '2023-10-12', 4, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(661, 749, 'a31(dataTelahAda)', '2023-10-11', 1, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(662, 750, 'a41', '2023-11-07', 3, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(709, 777, 'a1', NULL, 2, '2023-12-06 08:12:09', '2023-12-06 08:12:09'),
(710, 777, 'a2', NULL, 5, '2023-12-06 08:12:09', '2023-12-06 08:12:09'),
(749, 777, 'coba', NULL, NULL, '2023-12-23 06:29:00', '2023-12-23 06:29:00'),
(766, 824, 'a1', NULL, NULL, '2023-12-22 00:02:14', '2023-12-22 00:02:14'),
(767, 825, 'a2', NULL, NULL, '2023-12-22 00:02:14', '2023-12-22 00:02:14'),
(768, 825, 'a22', NULL, NULL, '2023-12-22 00:02:14', '2023-12-22 00:02:14'),
(783, 839, 'a1', '2024-01-04', 1, '2024-01-01 01:01:30', '2024-01-01 01:01:30'),
(784, 839, 'a2', '2024-01-02', 3, '2024-01-01 01:01:30', '2024-01-01 01:01:30'),
(785, 840, 'a21', NULL, NULL, '2024-01-01 01:01:31', '2024-01-01 01:01:31'),
(792, 847, 'a11', '2023-12-21', 1, '2024-01-01 01:27:02', '2024-01-01 01:27:02'),
(817, 872, 'a1', NULL, NULL, '2024-01-01 02:09:37', '2024-01-01 02:09:37'),
(818, 873, 'a2', NULL, 3, '2024-01-01 02:09:37', '2024-01-01 02:09:37'),
(823, 876, 'aw', '2024-01-01', 4, '2024-01-01 02:20:05', '2024-01-01 02:20:05'),
(824, 876, 'a2', '2024-01-18', 6, '2024-01-01 02:20:05', '2024-01-01 02:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `discussion` text DEFAULT NULL,
  `meeting_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `discussion`, `meeting_id`, `created_at`, `updated_at`) VALUES
(3, 'Materi Perkuliahan sudah dirumuskan bersama, PPT didistribusikan kepaada seluruh pengajar  di masing-masing MK.', 3, '2023-09-22 08:18:01', '2023-09-22 08:18:01'),
(4, 'Dosen pengajar sudah diplot untuk setiap matakuliah masing-masing prodi.', 3, '2023-09-22 08:18:01', '2023-09-22 08:18:01'),
(747, 'd1', 149, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(748, 'd2', 149, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(749, 'd3', 149, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(750, 'd4a', 149, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(751, 'd5a', 149, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(777, 'd1', 160, '2023-12-06 08:12:09', '2023-12-06 08:12:09'),
(824, 'd1', 196, '2023-12-22 00:02:14', '2023-12-22 00:02:14'),
(825, 'd2', 196, '2023-12-22 00:02:14', '2023-12-22 00:02:14'),
(839, 'd1', 199, '2024-01-01 01:01:30', '2024-01-01 01:01:30'),
(840, 'd2', 199, '2024-01-01 01:01:31', '2024-01-01 01:01:31'),
(847, 'd1', 197, '2024-01-01 01:27:02', '2024-01-01 01:27:02'),
(872, 'd1', 198, '2024-01-01 02:09:37', '2024-01-01 02:09:37'),
(873, 'dsada', 198, '2024-01-01 02:09:37', '2024-01-01 02:09:37'),
(876, 'd1', 194, '2024-01-01 02:20:05', '2024-01-01 02:20:05');

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
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(225) NOT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` varchar(225) NOT NULL,
  `inisiator` bigint(20) UNSIGNED NOT NULL,
  `note_taker` bigint(20) UNSIGNED NOT NULL,
  `meeting_status` enum('Approved','Distributed','Open') NOT NULL,
  `former_id` bigint(20) UNSIGNED DEFAULT NULL,
  `file` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`id`, `title`, `date`, `created_at`, `updated_at`, `location`, `inisiator`, `note_taker`, `meeting_status`, `former_id`, `file`) VALUES
(1, 'Rapat Mingguan  Program Studi Ilmu Komputer', '2023-09-13', '2023-09-22 04:31:08', '2023-09-22 04:31:08', 'MS Teams', 1, 2, '', 0, NULL),
(3, 'Rapat KMK', '2023-08-22', '2023-09-22 04:33:57', '2023-09-22 04:33:57', 'Ruang Rapat Rektorat', 2, 2, 'Distributed', 0, NULL),
(149, 'tes', '2023-10-19', '2023-10-19 04:22:28', '2023-10-19 04:48:54', 'Meet', 2, 3, 'Open', NULL, NULL),
(160, 'cobaFinalizeAddNote', '2023-12-07', '2023-12-04 04:59:46', '2023-12-04 04:59:46', 'Meet', 1, 2, 'Open', NULL, NULL),
(162, 'as', '2023-12-08', '2023-12-04 05:27:16', '2023-12-04 05:27:16', 'Meet', 4, 3, 'Open', NULL, NULL),
(187, 'cobaTTD', '2023-12-07', '2023-12-06 09:05:21', '2023-12-06 09:05:21', 'Meet', 5, 6, 'Open', NULL, NULL),
(194, 'sds', '2023-12-01', '2023-12-14 06:33:14', '2024-01-01 02:16:58', 'Meet', 2, 4, 'Distributed', NULL, NULL),
(195, 'cobaAttendace2', '2023-12-07', '2023-12-14 21:23:03', '2023-12-14 21:23:03', 'Meet', 1, 1, 'Open', NULL, NULL),
(196, 'mkkkm', '2023-12-15', '2023-12-17 23:59:52', '2023-12-17 23:59:52', 'Meet2', 3, 2, 'Open', NULL, NULL),
(197, 'dwd', '2023-12-18', '2023-12-18 07:31:26', '2023-12-22 00:16:20', 'Meet', 1, 4, 'Distributed', NULL, NULL),
(198, 'dasdsad', '2023-11-30', '2023-12-31 01:27:59', '2024-01-01 02:14:04', 'Meet2', 2, 4, 'Distributed', NULL, NULL),
(199, 'dada', '2024-01-02', '2024-01-01 00:57:27', '2024-01-01 00:57:27', 'Meet', 3, 2, 'Open', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_file`
--

CREATE TABLE `meeting_file` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` bigint(20) UNSIGNED NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_file`
--

INSERT INTO `meeting_file` (`id`, `meeting_id`, `fileName`, `url`, `created_at`, `updated_at`) VALUES
(55, 198, 'createPostBerhasil.png', 'meetingFile/createPostBerhasil.png', '2023-12-31 01:27:59', '2023-12-31 01:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_participant`
--

CREATE TABLE `meeting_participant` (
  `meeting_id` bigint(20) UNSIGNED NOT NULL,
  `participant_id` bigint(20) UNSIGNED NOT NULL,
  `attendance_status` tinyint(1) NOT NULL,
  `signature` varchar(10000) DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meeting_participant`
--

INSERT INTO `meeting_participant` (`meeting_id`, `participant_id`, `attendance_status`, `signature`, `url`, `created_at`, `updated_at`) VALUES
(3, 3, 1, '', NULL, '2023-09-22 08:13:17', '2023-09-22 08:13:17'),
(3, 1, 1, '', NULL, '2023-09-22 08:13:17', '2023-09-22 08:13:17'),
(3, 6, 1, '', NULL, '2023-09-22 08:13:17', '2023-09-22 08:13:17'),
(149, 1, 0, NULL, NULL, '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(149, 2, 0, NULL, NULL, '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(149, 3, 0, NULL, NULL, '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(149, 4, 1, '149-4-05122023.png', 'signatureFile/149-4-05122023.png', '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(149, 5, 1, '149-5-04112023.png', 'signatureFile/149-5-04112023.png', '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(149, 6, 1, '149-6-05122023.png', 'signatureFile/149-6-05122023.png', '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(160, 1, 1, NULL, NULL, '2023-12-04 04:59:47', '2023-12-04 04:59:47'),
(160, 2, 1, '160-2-06122023.png', 'signatureFile/160-2-06122023.png', '2023-12-04 04:59:47', '2023-12-04 04:59:47'),
(160, 3, 1, NULL, NULL, '2023-12-04 04:59:47', '2023-12-04 04:59:47'),
(160, 4, 0, NULL, NULL, '2023-12-04 04:59:47', '2023-12-04 04:59:47'),
(160, 5, 0, NULL, NULL, '2023-12-04 04:59:47', '2023-12-04 04:59:47'),
(160, 6, 0, NULL, NULL, '2023-12-04 04:59:47', '2023-12-04 04:59:47'),
(162, 1, 0, NULL, NULL, '2023-12-04 05:27:16', '2023-12-04 05:27:16'),
(162, 2, 0, NULL, NULL, '2023-12-04 05:27:16', '2023-12-04 05:27:16'),
(162, 3, 1, NULL, NULL, '2023-12-04 05:27:16', '2023-12-04 05:27:16'),
(162, 4, 1, '162-4-05122023.png', 'signatureFile/162-4-05122023.png', '2023-12-04 05:27:16', '2023-12-04 05:27:16'),
(162, 5, 0, NULL, NULL, '2023-12-04 05:27:16', '2023-12-04 05:27:16'),
(162, 6, 0, NULL, NULL, '2023-12-04 05:27:16', '2023-12-04 05:27:16'),
(187, 1, 1, NULL, NULL, '2023-12-06 09:05:21', '2023-12-06 09:05:21'),
(187, 2, 1, '187-2-08122023.png', 'signatureFile/187-2-08122023.png', '2023-12-06 09:05:21', '2023-12-06 09:05:21'),
(187, 3, 1, NULL, NULL, '2023-12-06 09:05:21', '2023-12-06 09:05:21'),
(187, 4, 1, '187-4-06122023.png', 'signatureFile/187-4-06122023.png', '2023-12-06 09:05:21', '2023-12-06 09:05:21'),
(187, 5, 1, NULL, NULL, '2023-12-06 09:05:21', '2023-12-06 09:05:21'),
(187, 6, 1, NULL, NULL, '2023-12-06 09:05:21', '2023-12-06 09:05:21'),
(194, 4, 1, NULL, NULL, '2023-12-14 06:33:14', '2024-01-01 02:20:05'),
(194, 5, 1, NULL, NULL, '2023-12-14 06:33:14', '2024-01-01 02:20:05'),
(194, 6, 1, NULL, NULL, '2023-12-14 06:33:14', '2024-01-01 02:20:05'),
(196, 2, 1, '196-2-29122023.png', 'signatureFile/196-2-29122023.png', '2023-12-17 23:59:52', '2023-12-29 01:31:48'),
(196, 3, 1, NULL, NULL, '2023-12-17 23:59:52', '2023-12-29 01:31:48'),
(194, 1, 0, NULL, NULL, '2023-12-18 07:27:00', '2024-01-01 02:20:05'),
(194, 2, 0, NULL, NULL, '2023-12-18 07:27:00', '2024-01-01 02:20:05'),
(194, 3, 0, NULL, NULL, '2023-12-18 07:29:45', '2024-01-01 02:20:05'),
(197, 1, 1, NULL, NULL, '2023-12-18 07:31:26', '2024-01-01 01:27:02'),
(197, 3, 0, NULL, NULL, '2023-12-18 07:31:26', '2024-01-01 01:27:02'),
(197, 4, 1, '197-4-22122023.png', 'signatureFile/197-4-22122023.png', '2023-12-18 07:31:26', '2024-01-01 01:27:02'),
(197, 2, 0, NULL, NULL, '2023-12-18 07:37:15', '2024-01-01 01:27:02'),
(197, 5, 0, NULL, NULL, '2023-12-18 07:37:15', '2024-01-01 01:27:02'),
(197, 6, 1, NULL, NULL, '2023-12-18 07:40:01', '2024-01-01 01:27:02'),
(196, 1, 1, NULL, NULL, '2023-12-21 23:17:57', '2023-12-29 01:31:48'),
(198, 1, 1, '198-1-31122023.png', 'signatureFile/198-1-31122023.png', '2023-12-31 01:27:59', '2024-01-01 02:09:37'),
(198, 3, 0, NULL, NULL, '2023-12-31 01:27:59', '2024-01-01 02:09:37'),
(198, 5, 0, NULL, NULL, '2023-12-31 01:27:59', '2024-01-01 02:09:37'),
(198, 4, 1, NULL, NULL, '2023-12-31 01:29:00', '2024-01-01 02:09:37'),
(199, 2, 1, '199-2-01012024.png', 'signatureFile/199-2-01012024.png', '2024-01-01 00:57:27', '2024-01-01 01:01:30'),
(199, 3, 1, NULL, NULL, '2024-01-01 00:57:27', '2024-01-01 01:01:30'),
(199, 4, 1, NULL, NULL, '2024-01-01 00:57:27', '2024-01-01 01:01:30'),
(198, 6, 1, NULL, NULL, '2024-01-01 01:25:59', '2024-01-01 02:09:37');

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
(6, '2014_10_12_000000_create_users_table', 1),
(7, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2023_09_22_025900_create_participant', 1),
(11, '2023_09_22_030610_create_meeting', 1),
(12, '2023_09_22_031220_create_content', 1),
(13, '2023_09_22_031230_create_action', 1),
(14, '2023_09_22_031635_create_meeting_participant', 1),
(15, '2023_09_22_034233_f_ix_participant', 2),
(16, '2023_09_22_033133_foreign_meeting_participant', 3),
(17, '2023_09_22_034759_foreign_action', 4),
(18, '2023_09_22_080637_add_time_stamp_meeting_participant', 5),
(19, '2023_10_16_061704_add_table_file', 6),
(22, '2023_10_24_070012_create_revision_history_table', 7),
(24, '2023_10_27_133451_create_rejection_message_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `participant`
--

CREATE TABLE `participant` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(225) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participant`
--

INSERT INTO `participant` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Bayu Wicaksono', 'bayu@universitaspertamina.ac.id', '2023-09-22 07:59:02', '2023-09-22 07:59:02'),
(2, 'Arya Ashari', 'arya@universitaspertamina.ac.id', '2023-09-22 07:59:02', '2023-09-22 07:59:02'),
(3, 'Farhan Dwi Septian', 'farhan@universitaspertamina.ac.id', '2023-09-22 08:00:18', '2023-09-22 08:00:18'),
(4, 'Reva Ananda', 'aarevaananda@gmail.com', '2023-09-22 08:00:18', '2023-09-22 08:00:18'),
(5, 'Ahmad Arroziqi', 'namadepannamabelakang1781945@gmail.com', '2023-09-22 08:00:18', '2023-09-22 08:00:18'),
(6, 'Sita', 'felizia060110@gmail.com', '2023-09-22 08:00:18', '2023-09-22 08:00:18');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rejection_message`
--

CREATE TABLE `rejection_message` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `writer` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rejection_message`
--

INSERT INTO `rejection_message` (`id`, `meeting_id`, `message`, `writer`, `created_at`, `updated_at`) VALUES
(1, 149, 'coba reject', 4, '2023-10-28 08:50:31', '2023-10-28 08:50:31'),
(2, 149, 'coba2', 4, '2023-10-28 08:53:38', '2023-10-28 08:53:38'),
(9, 198, 'dsada', 4, '2024-01-01 01:14:07', '2024-01-01 01:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `revision_history`
--

CREATE TABLE `revision_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meeting_id` bigint(20) UNSIGNED NOT NULL,
  `discussion_log` longtext DEFAULT NULL,
  `editor` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '2023-10-24 00:14:19',
  `updated_at` timestamp NOT NULL DEFAULT '2023-10-24 00:14:19'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `revision_history`
--

INSERT INTO `revision_history` (`id`, `meeting_id`, `discussion_log`, `editor`, `created_at`, `updated_at`) VALUES
(8, 149, '{\"content\":\"d4a\",\"action\":\"[{\\\"item\\\":\\\"a41\\\",\\\"due\\\":\\\"2023-11-07\\\",\\\"pic\\\":\\\"3\\\"}]\"}', 3, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(9, 149, '{\"content\":\"d5a\",\"action\":\"[]\"}', 3, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(12, 197, '{\"content\":\"d2\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":\\\"2023-12-20\\\",\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2023-12-18 07:40:01', '2023-12-18 07:40:01'),
(13, 196, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":\\\"2023-12-23\\\",\\\"pic\\\":\\\"1\\\"}]\"}', 2, '2023-12-21 23:17:57', '2023-12-21 23:17:57'),
(14, 196, '{\"content\":\"d2\",\"action\":\"[{\\\"item\\\":\\\"a21\\\",\\\"due\\\":\\\"2023-12-19\\\",\\\"pic\\\":\\\"2\\\"}]\"}', 2, '2023-12-21 23:22:10', '2023-12-21 23:22:10'),
(15, 196, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 2, '2023-12-21 23:56:50', '2023-12-21 23:56:50'),
(16, 196, '{\"content\":\"d2\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 2, '2023-12-21 23:56:50', '2023-12-21 23:56:50'),
(17, 197, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a11\\\",\\\"due\\\":\\\"2023-12-21\\\",\\\"pic\\\":\\\"1\\\"}]\"}', 4, '2023-12-31 01:25:19', '2023-12-31 01:25:19'),
(18, 197, '{\"content\":\"d2\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":\\\"2023-12-20\\\",\\\"pic\\\":\\\"3\\\"},{\\\"item\\\":\\\"a22New\\\",\\\"due\\\":\\\"2023-12-20\\\",\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2023-12-31 01:25:19', '2023-12-31 01:25:19'),
(19, 197, '{\"content\":\"d3 New\",\"action\":\"[]\"}', 4, '2023-12-31 01:25:19', '2023-12-31 01:25:19'),
(20, 197, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a11\\\",\\\"due\\\":\\\"2023-12-21\\\",\\\"pic\\\":\\\"1\\\"}]\"}', 4, '2023-12-31 01:25:48', '2023-12-31 01:25:48'),
(21, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2023-12-31 01:29:00', '2023-12-31 01:29:00'),
(22, 198, '{\"content\":\"d2\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2023-12-31 01:29:00', '2023-12-31 01:29:00'),
(23, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2023-12-31 01:46:53', '2023-12-31 01:46:53'),
(24, 198, '{\"content\":\"d2\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2023-12-31 01:46:53', '2023-12-31 01:46:53'),
(25, 199, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":\\\"2024-01-04\\\",\\\"pic\\\":\\\"1\\\"},{\\\"item\\\":\\\"a2\\\",\\\"due\\\":\\\"2024-01-02\\\",\\\"pic\\\":\\\"3\\\"}]\"}', 2, '2024-01-01 01:00:29', '2024-01-01 01:00:29'),
(26, 199, '{\"content\":\"d2\",\"action\":\"[{\\\"item\\\":\\\"a21\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 2, '2024-01-01 01:00:29', '2024-01-01 01:00:29'),
(27, 199, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":\\\"2024-01-04\\\",\\\"pic\\\":\\\"1\\\"},{\\\"item\\\":\\\"a2\\\",\\\"due\\\":\\\"2024-01-02\\\",\\\"pic\\\":\\\"3\\\"}]\"}', 2, '2024-01-01 01:01:31', '2024-01-01 01:01:31'),
(28, 199, '{\"content\":\"d2\",\"action\":\"[{\\\"item\\\":\\\"a21\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 2, '2024-01-01 01:01:31', '2024-01-01 01:01:31'),
(29, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:14:55', '2024-01-01 01:14:55'),
(30, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:14:55', '2024-01-01 01:14:55'),
(31, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:22:25', '2024-01-01 01:22:25'),
(32, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:22:25', '2024-01-01 01:22:25'),
(33, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:25:59', '2024-01-01 01:25:59'),
(34, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:25:59', '2024-01-01 01:25:59'),
(35, 197, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a11\\\",\\\"due\\\":\\\"2023-12-21\\\",\\\"pic\\\":\\\"1\\\"}]\"}', 4, '2024-01-01 01:27:02', '2024-01-01 01:27:02'),
(36, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:34:34', '2024-01-01 01:34:34'),
(37, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:34:34', '2024-01-01 01:34:34'),
(38, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:36:34', '2024-01-01 01:36:34'),
(39, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:36:34', '2024-01-01 01:36:34'),
(40, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:45:03', '2024-01-01 01:45:03'),
(41, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:45:03', '2024-01-01 01:45:03'),
(42, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:51:03', '2024-01-01 01:51:03'),
(43, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:51:03', '2024-01-01 01:51:03'),
(44, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:53:39', '2024-01-01 01:53:39'),
(45, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:53:39', '2024-01-01 01:53:39'),
(46, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:55:59', '2024-01-01 01:55:59'),
(47, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:55:59', '2024-01-01 01:55:59'),
(48, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:57:16', '2024-01-01 01:57:16'),
(49, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:57:16', '2024-01-01 01:57:16'),
(50, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:58:04', '2024-01-01 01:58:04'),
(51, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:58:04', '2024-01-01 01:58:04'),
(52, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:58:19', '2024-01-01 01:58:19'),
(53, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:58:19', '2024-01-01 01:58:19'),
(54, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 01:58:24', '2024-01-01 01:58:24'),
(55, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 01:58:24', '2024-01-01 01:58:24'),
(56, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 02:07:11', '2024-01-01 02:07:11'),
(57, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 02:07:11', '2024-01-01 02:07:11'),
(58, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 02:08:11', '2024-01-01 02:08:11'),
(59, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 02:08:11', '2024-01-01 02:08:11'),
(60, 198, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"a1\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2024-01-01 02:09:37', '2024-01-01 02:09:37'),
(61, 198, '{\"content\":\"dsada\",\"action\":\"[{\\\"item\\\":\\\"a2\\\",\\\"due\\\":null,\\\"pic\\\":\\\"3\\\"}]\"}', 4, '2024-01-01 02:09:37', '2024-01-01 02:09:37'),
(62, 194, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"aw\\\",\\\"due\\\":\\\"2024-01-01\\\",\\\"pic\\\":\\\"4\\\"},{\\\"item\\\":\\\"a2\\\",\\\"due\\\":\\\"2024-01-18\\\",\\\"pic\\\":\\\"6\\\"}]\"}', 4, '2024-01-01 02:16:53', '2024-01-01 02:16:53'),
(63, 194, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"aw\\\",\\\"due\\\":\\\"2024-01-01\\\",\\\"pic\\\":\\\"4\\\"},{\\\"item\\\":\\\"a2\\\",\\\"due\\\":\\\"2024-01-18\\\",\\\"pic\\\":\\\"6\\\"}]\"}', 4, '2024-01-01 02:19:09', '2024-01-01 02:19:09'),
(64, 194, '{\"content\":\"d1\",\"action\":\"[{\\\"item\\\":\\\"aw\\\",\\\"due\\\":\\\"2024-01-01\\\",\\\"pic\\\":\\\"4\\\"},{\\\"item\\\":\\\"a2\\\",\\\"due\\\":\\\"2024-01-18\\\",\\\"pic\\\":\\\"6\\\"}]\"}', 4, '2024-01-01 02:20:05', '2024-01-01 02:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`id`),
  ADD KEY `action_content_id_foreign` (`content_id`),
  ADD KEY `action_pic_foreign` (`pic`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_meeting_id_foreign` (`meeting_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `note_taker_fk_id_participant` (`note_taker`),
  ADD KEY `inisiator_fk_id_participant` (`inisiator`);

--
-- Indexes for table `meeting_file`
--
ALTER TABLE `meeting_file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meeting_file_meeting_id_foreign` (`meeting_id`);

--
-- Indexes for table `meeting_participant`
--
ALTER TABLE `meeting_participant`
  ADD KEY `meeting_participant_meeting_id_foreign` (`meeting_id`),
  ADD KEY `meeting_participant_participant_id_foreign` (`participant_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rejection_message`
--
ALTER TABLE `rejection_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rejection_message_meeting_id_foreign` (`meeting_id`),
  ADD KEY `rejection_message_writer_foreign` (`writer`);

--
-- Indexes for table `revision_history`
--
ALTER TABLE `revision_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `revision_history_meeting_id_foreign` (`meeting_id`);

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
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=825;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=877;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `meeting_file`
--
ALTER TABLE `meeting_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `participant`
--
ALTER TABLE `participant`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rejection_message`
--
ALTER TABLE `rejection_message`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `revision_history`
--
ALTER TABLE `revision_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `action_content_id_foreign` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `action_pic_foreign` FOREIGN KEY (`pic`) REFERENCES `participant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `content_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meeting`
--
ALTER TABLE `meeting`
  ADD CONSTRAINT `inisiator_fk_id_participant` FOREIGN KEY (`inisiator`) REFERENCES `participant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `note_taker_fk_id_participant` FOREIGN KEY (`note_taker`) REFERENCES `participant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meeting_file`
--
ALTER TABLE `meeting_file`
  ADD CONSTRAINT `meeting_file_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `meeting_participant`
--
ALTER TABLE `meeting_participant`
  ADD CONSTRAINT `meeting_participant_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `meeting_participant_participant_id_foreign` FOREIGN KEY (`participant_id`) REFERENCES `participant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rejection_message`
--
ALTER TABLE `rejection_message`
  ADD CONSTRAINT `rejection_message_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rejection_message_writer_foreign` FOREIGN KEY (`writer`) REFERENCES `participant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `revision_history`
--
ALTER TABLE `revision_history`
  ADD CONSTRAINT `revision_history_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
