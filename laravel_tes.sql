-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2023 at 01:18 PM
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
(1, 1, 'Follow Up ke program studi', '2023-09-22', 3, '2023-09-22 08:24:56', '2023-09-22 08:24:56'),
(2, 2, 'Patikan semua yang dibutuhkan tersedia', NULL, 4, '2023-09-22 08:24:56', '2023-09-22 08:24:56'),
(68, 1, 'Disebarkan kepada Mahasiswa', '2023-09-22', 1, '2023-08-27 13:35:25', '2023-08-27 13:35:25'),
(623, 722, 'a13a', '2023-11-01', 2, '2023-10-27 00:45:08', '2023-10-27 00:45:08'),
(630, 727, 'a11', '2023-10-18', 1, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(631, 727, 'a12', '2023-11-02', 4, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(632, 727, 'a31a', NULL, 2, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(633, 728, 'a31a', '2023-10-25', 3, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(634, 729, 'a41a', NULL, 3, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(635, 730, 'a51', '2023-10-26', 6, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(657, 747, 'a11(dataTelahAda)', '2023-10-06', 1, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(658, 747, 'a12(dataTelahAda)', '2023-09-22', 3, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(659, 747, 'a13(dataTelahAda)', NULL, 4, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(660, 748, 'a21(dataTelahAda)', '2023-10-12', 4, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(661, 749, 'a31(dataTelahAda)', '2023-10-11', 1, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(662, 750, 'a41', '2023-11-07', 3, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(663, 752, 'a11', '2023-11-15', 4, '2023-11-02 06:27:11', '2023-11-02 06:27:11'),
(666, 755, 'a1', '2023-10-26', 3, '2023-11-04 05:02:54', '2023-11-04 05:02:54');

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
(1, 'Jadwal Perkuliahan Sudah dibuat dan sudah diunggah ke siup, Ada beberapa perubahan dari program studi dibatasi hingga 2 minggu kedepan.', 2, '2023-09-22 08:16:23', '2023-09-22 08:16:23'),
(2, 'Dosen tidak tetap untuk MKU sudah dihubungi semua dan konfirmasi bisa mengajar unutk semester depan.', 2, '2023-09-22 08:18:01', '2023-09-22 08:18:01'),
(3, 'Materi Perkuliahan sudah dirumuskan bersama, PPT didistribusikan kepaada seluruh pengajar  di masing-masing MK.', 3, '2023-09-22 08:18:01', '2023-09-22 08:18:01'),
(4, 'Dosen pengajar sudah diplot untuk setiap matakuliah masing-masing prodi.', 3, '2023-09-22 08:18:01', '2023-09-22 08:18:01'),
(5, 'KPI WRA tercapai 75%, selanjutnya merumuskan upaya-upaya unutk menylesaikan program yang memungkinkan.', 4, '2023-09-22 08:18:01', '2023-09-22 08:18:01'),
(6, 'Permasalahan-permasalahan akademik yang terjadi contohnya seperti penjadwalan, dosen pengajar yang selama ini terjadi.', 4, '2023-09-22 08:18:01', '2023-09-22 08:18:01'),
(722, 'd1', 157, '2023-10-27 00:45:08', '2023-10-27 00:45:08'),
(727, 'd1', 150, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(728, 'd3', 150, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(729, 'd4', 150, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(730, 'd5baru', 150, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(731, 'd6a', 150, '2023-10-28 23:49:46', '2023-10-28 23:49:46'),
(747, 'd1', 149, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(748, 'd2', 149, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(749, 'd3', 149, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(750, 'd4a', 149, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(751, 'd5a', 149, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(752, 'd1', 159, '2023-11-02 06:27:11', '2023-11-02 06:27:11'),
(753, 'd2', 159, '2023-11-02 06:27:11', '2023-11-02 06:27:11'),
(755, 'd1', 158, '2023-11-04 05:02:54', '2023-11-04 05:02:54'),
(756, 'd2', 158, '2023-11-04 05:02:54', '2023-11-04 05:02:54');

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
(2, 'Rapat Persiapan Perkuliahan', '2023-09-08', '2023-09-22 04:31:08', '2023-09-22 04:31:08', 'Ms Teams', 3, 4, 'Distributed', 0, NULL),
(3, 'Rapat KMK', '2023-08-22', '2023-09-22 04:33:57', '2023-09-22 04:33:57', 'Ruang Rapat Rektorat', 2, 2, 'Distributed', 0, NULL),
(4, 'Rapat WRA', '2023-08-15', '2023-09-22 04:33:57', '2023-09-22 04:33:57', 'RoofTop', 3, 4, 'Approved', 0, NULL),
(149, 'tes', '2023-10-19', '2023-10-19 04:22:28', '2023-10-19 04:48:54', 'Meet', 2, 3, 'Open', NULL, NULL),
(150, 'coba1', '2023-10-21', '2023-10-19 05:06:29', '2023-10-22 23:20:56', 'Teams', 5, 4, 'Open', NULL, NULL),
(157, 'cobaFile2', '2023-10-19', '2023-10-27 00:45:08', '2023-10-27 00:58:48', 'Meet', 4, 3, 'Open', NULL, NULL),
(158, 'coba3', '2023-10-20', '2023-10-28 02:53:06', '2023-10-28 02:53:06', 'Meet', 3, 2, 'Open', NULL, NULL),
(159, 'cobaSave', '2023-11-10', '2023-11-02 06:27:11', '2023-11-02 06:27:11', 'Meet', 2, 3, 'Open', NULL, NULL);

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
(43, 159, '105221025_RevaAnanda_Take Home Task_5.pdf', 'meetingFile/bgFVrAofeAewLSoCLorJdYn2gLeAdzk853aXh4Jd.pdf', '2023-11-02 06:27:11', '2023-11-02 06:27:11');

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
(2, 1, 1, '', NULL, '2023-09-22 08:09:09', '2023-09-22 08:09:13'),
(2, 3, 1, '', NULL, '2023-09-22 08:10:04', '2023-09-22 08:10:04'),
(2, 4, 1, '', NULL, '2023-09-22 08:10:56', '2023-09-22 08:10:56'),
(2, 6, 0, '', NULL, '2023-09-22 08:10:56', '2023-09-22 08:10:56'),
(3, 3, 1, '', NULL, '2023-09-22 08:13:17', '2023-09-22 08:13:17'),
(3, 1, 1, '', NULL, '2023-09-22 08:13:17', '2023-09-22 08:13:17'),
(3, 6, 1, '', NULL, '2023-09-22 08:13:17', '2023-09-22 08:13:17'),
(4, 6, 1, '', NULL, '2023-09-22 08:14:23', '2023-09-22 08:14:23'),
(4, 5, 1, '', NULL, '2023-09-22 08:14:23', '2023-09-22 08:14:23'),
(4, 2, 1, '', NULL, '2023-09-22 08:14:23', '2023-09-22 08:14:23'),
(4, 1, 0, '', NULL, '2023-09-22 08:14:23', '2023-09-22 08:14:23'),
(149, 1, 0, NULL, NULL, '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(149, 2, 0, NULL, NULL, '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(149, 3, 0, NULL, NULL, '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(149, 4, 1, '149-4-04112023.png', 'signatureFile/149-4-04112023.png', '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(149, 5, 1, '149-5-04112023.png', 'signatureFile/149-5-04112023.png', '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(149, 6, 1, NULL, NULL, '2023-10-19 04:22:28', '2023-10-19 04:22:28'),
(150, 1, 0, NULL, NULL, '2023-10-19 05:06:29', '2023-10-19 05:06:29'),
(150, 2, 0, NULL, NULL, '2023-10-19 05:06:29', '2023-10-19 05:06:29'),
(150, 3, 0, NULL, NULL, '2023-10-19 05:06:29', '2023-10-19 05:06:29'),
(150, 4, 1, NULL, NULL, '2023-10-19 05:06:29', '2023-10-19 05:06:29'),
(150, 5, 1, NULL, NULL, '2023-10-19 05:06:29', '2023-10-19 05:06:29'),
(150, 6, 1, NULL, NULL, '2023-10-19 05:06:29', '2023-10-19 05:06:29'),
(157, 1, 0, NULL, NULL, '2023-10-27 00:45:08', '2023-10-27 00:45:08'),
(157, 2, 0, NULL, NULL, '2023-10-27 00:45:08', '2023-10-27 00:45:08'),
(157, 3, 0, NULL, NULL, '2023-10-27 00:45:08', '2023-10-27 00:45:08'),
(157, 4, 0, NULL, NULL, '2023-10-27 00:45:08', '2023-10-27 00:45:08'),
(157, 5, 1, NULL, NULL, '2023-10-27 00:45:08', '2023-10-27 00:45:08'),
(157, 6, 1, NULL, NULL, '2023-10-27 00:45:08', '2023-10-27 00:45:08'),
(158, 1, 0, NULL, NULL, '2023-10-28 02:53:06', '2023-10-28 02:53:06'),
(158, 2, 1, NULL, NULL, '2023-10-28 02:53:06', '2023-10-28 02:53:06'),
(158, 3, 1, NULL, NULL, '2023-10-28 02:53:06', '2023-10-28 02:53:06'),
(158, 4, 0, NULL, NULL, '2023-10-28 02:53:06', '2023-10-28 02:53:06'),
(158, 5, 0, NULL, NULL, '2023-10-28 02:53:06', '2023-10-28 02:53:06'),
(158, 6, 0, NULL, NULL, '2023-10-28 02:53:06', '2023-10-28 02:53:06'),
(159, 1, 0, NULL, NULL, '2023-11-02 06:27:11', '2023-11-02 06:27:11'),
(159, 2, 1, NULL, NULL, '2023-11-02 06:27:11', '2023-11-02 06:27:11'),
(159, 3, 1, NULL, NULL, '2023-11-02 06:27:11', '2023-11-02 06:27:11'),
(159, 4, 0, NULL, NULL, '2023-11-02 06:27:11', '2023-11-02 06:27:11'),
(159, 5, 1, NULL, NULL, '2023-11-02 06:27:11', '2023-11-02 06:27:11'),
(159, 6, 0, NULL, NULL, '2023-11-02 06:27:11', '2023-11-02 06:27:11');

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
(4, 'Reva Ananda', 'reva@universitaspertamina.ac.id', '2023-09-22 08:00:18', '2023-09-22 08:00:18'),
(5, 'Ahmad Arroziqi', 'ahmad@universitaspertamina.ac.id', '2023-09-22 08:00:18', '2023-09-22 08:00:18'),
(6, 'Sita', 'sita@universitaspertamina.ac.id', '2023-09-22 08:00:18', '2023-09-22 08:00:18');

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
(3, 158, 'reject farhan', 3, '2023-11-02 05:36:31', '2023-11-02 05:36:31');

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
(6, 150, '{\"content\":\"d5b\",\"action\":\"[{\\\"item\\\":\\\"a51b\\\",\\\"due\\\":\\\"2023-10-20\\\",\\\"pic\\\":\\\"2\\\"},{\\\"item\\\":\\\"a52b\\\",\\\"due\\\":null,\\\"pic\\\":\\\"0\\\"}]\"}', 4, '2023-10-25 07:09:52', '2023-10-25 07:09:52'),
(7, 150, '{\"content\":\"d6\",\"action\":\"[]\"}', 4, '2023-10-25 07:09:52', '2023-10-25 07:09:52'),
(8, 149, '{\"content\":\"d4a\",\"action\":\"[{\\\"item\\\":\\\"a41\\\",\\\"due\\\":\\\"2023-11-07\\\",\\\"pic\\\":\\\"3\\\"}]\"}', 3, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(9, 149, '{\"content\":\"d5a\",\"action\":\"[]\"}', 3, '2023-11-02 06:04:39', '2023-11-02 06:04:39'),
(10, 158, '{\"content\":\"d2\",\"action\":\"[]\"}', 2, '2023-11-04 05:02:55', '2023-11-04 05:02:55');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=667;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=757;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `meeting_file`
--
ALTER TABLE `meeting_file`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `revision_history`
--
ALTER TABLE `revision_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `rejection_message_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`id`),
  ADD CONSTRAINT `rejection_message_writer_foreign` FOREIGN KEY (`writer`) REFERENCES `participant` (`id`);

--
-- Constraints for table `revision_history`
--
ALTER TABLE `revision_history`
  ADD CONSTRAINT `revision_history_meeting_id_foreign` FOREIGN KEY (`meeting_id`) REFERENCES `meeting` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
