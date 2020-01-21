-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2020 at 04:05 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstoneproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkers`
--

CREATE TABLE `checkers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `schedule_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `remarks_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkers`
--

INSERT INTO `checkers` (`id`, `schedule_id`, `user_id`, `remarks_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 12, 'Round 1', '2020-01-19 16:00:00', NULL, NULL),
(2, 1, 1, 12, 'Round 2', '2020-01-19 16:00:00', NULL, NULL),
(3, 2, 1, 9, 'Round 1', '2020-01-19 16:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `checker_details`
--

CREATE TABLE `checker_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `round_id` bigint(20) UNSIGNED NOT NULL,
  `violation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checker_details`
--

INSERT INTO `checker_details` (`id`, `round_id`, `violation_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, NULL, NULL, NULL),
(2, 2, 1, NULL, NULL, NULL),
(3, 3, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_11_04_122146_create_subject_codes_table', 1),
(4, '2019_11_04_133501_create_teachers_table', 1),
(5, '2019_11_04_133503_create_subjects_table', 1),
(6, '2019_11_04_133504_create_rooms_table', 1),
(7, '2019_11_04_133921_create_schedules_table', 1),
(8, '2020_01_08_122550_create_violations_table', 1),
(9, '2020_01_08_122804_create_remarks_table', 1),
(10, '2020_01_08_122939_create_checkers_table', 1),
(11, '2020_01_08_123309_create_rounds_table', 1),
(12, '2020_01_08_123657_create_checker_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `remarks_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `remarks`
--

INSERT INTO `remarks` (`id`, `remarks_desc`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Present', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(2, 'No Teacher Around', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(3, 'No Student and Teacher Around', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(4, 'Fieldwork', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(5, 'Research Subject/OJT', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(6, 'On Leave w/ substitute', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(7, 'Lab Schedule', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(8, 'No Lab Schedule Yet', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(9, 'At Lecture Room', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(10, 'No Final Loading Yet', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(11, 'No Allowed Faculty Yet', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL),
(12, 'At Labortary', '2020-01-21 05:05:17', '2020-01-21 05:05:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bldg` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_desc`, `bldg`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'H3B', 'DPT', '2020-01-21 05:03:32', '2020-01-21 05:03:32', NULL),
(2, 'BE 221', 'BE', '2020-01-21 05:12:04', '2020-01-21 05:12:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rounds`
--

CREATE TABLE `rounds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checker_id` bigint(20) UNSIGNED NOT NULL,
  `round_no` bigint(20) NOT NULL,
  `remarks_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_check` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rounds`
--

INSERT INTO `rounds` (`id`, `checker_id`, `round_no`, `remarks_id`, `status`, `time_check`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 12, '1', '12:30', NULL, NULL, NULL),
(2, 2, 2, 12, '2', '12:30', NULL, NULL, NULL),
(3, 3, 1, 4, 'Round 1 for schedule 2', '10:30', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_code_id` bigint(20) UNSIGNED NOT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `subject_code_id`, `teacher_id`, `room_id`, `start_time`, `end_time`, `school_year`, `semester`, `term`, `day`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, '10:30 PM', '12:30 AM', '2020', '2', '2', 'M-T-W-T-F', '2020-01-21 05:03:56', '2020-01-21 05:03:56', NULL),
(2, 2, 2, 2, '5:30 PM', '6:30 PM', '2020', '2', '2', 'M-T-W-T-F', '2020-01-21 05:12:31', '2020-01-21 05:12:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subject_codes`
--

CREATE TABLE `subject_codes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_codes`
--

INSERT INTO `subject_codes` (`id`, `subject_code`, `subject_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '00001', 'Thesis 1', '2020-01-21 05:03:39', '2020-01-21 05:03:39', NULL),
(2, '00002', 'Algebra', '2020-01-21 05:12:15', '2020-01-21 05:12:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fullname`, `image`, `course`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vince', '1579611802.jpeg', 'CCE', '2020-01-21 05:03:24', '2020-01-21 05:03:24', NULL),
(2, 'Mark', '1579612315.jpeg', 'CHE', '2020-01-21 05:11:55', '2020-01-21 05:11:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` bigint(20) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `id_number`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vince', 12345, '$2y$10$2ZasL2/og3.smW8u.XTaq.N692jAC2Z9z7UFTaz6nD5wpdhtKMrn2', NULL, '2020-01-21 05:02:58', '2020-01-21 05:02:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `violations`
--

CREATE TABLE `violations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `violation_details` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `violations`
--

INSERT INTO `violations` (`id`, `violation_details`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Not Wearing ID', '2020-01-21 05:05:10', '2020-01-21 05:05:10', NULL),
(2, 'Not Wearing Uniform', '2020-01-21 05:05:10', '2020-01-21 05:05:10', NULL),
(3, 'Not Wearing Prescribed Uniform', '2020-01-21 05:05:10', '2020-01-21 05:05:10', NULL),
(4, 'Wearing Maong Pants', '2020-01-21 05:05:10', '2020-01-21 05:05:10', NULL),
(5, 'Not Weaing Presscribed Footwear', '2020-01-21 05:05:10', '2020-01-21 05:05:10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkers`
--
ALTER TABLE `checkers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checkers_schedule_id_foreign` (`schedule_id`),
  ADD KEY `checkers_user_id_foreign` (`user_id`),
  ADD KEY `checkers_remarks_id_foreign` (`remarks_id`);

--
-- Indexes for table `checker_details`
--
ALTER TABLE `checker_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `checker_details_round_id_foreign` (`round_id`),
  ADD KEY `checker_details_violation_id_foreign` (`violation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rounds`
--
ALTER TABLE `rounds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rounds_checker_id_foreign` (`checker_id`),
  ADD KEY `rounds_remarks_id_foreign` (`remarks_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_subject_code_id_foreign` (`subject_code_id`),
  ADD KEY `schedules_teacher_id_foreign` (`teacher_id`),
  ADD KEY `schedules_room_id_foreign` (`room_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_codes`
--
ALTER TABLE `subject_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_number_unique` (`id_number`);

--
-- Indexes for table `violations`
--
ALTER TABLE `violations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkers`
--
ALTER TABLE `checkers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checker_details`
--
ALTER TABLE `checker_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rounds`
--
ALTER TABLE `rounds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject_codes`
--
ALTER TABLE `subject_codes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `violations`
--
ALTER TABLE `violations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkers`
--
ALTER TABLE `checkers`
  ADD CONSTRAINT `checkers_remarks_id_foreign` FOREIGN KEY (`remarks_id`) REFERENCES `remarks` (`id`),
  ADD CONSTRAINT `checkers_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`),
  ADD CONSTRAINT `checkers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `checker_details`
--
ALTER TABLE `checker_details`
  ADD CONSTRAINT `checker_details_round_id_foreign` FOREIGN KEY (`round_id`) REFERENCES `rounds` (`id`),
  ADD CONSTRAINT `checker_details_violation_id_foreign` FOREIGN KEY (`violation_id`) REFERENCES `violations` (`id`);

--
-- Constraints for table `rounds`
--
ALTER TABLE `rounds`
  ADD CONSTRAINT `rounds_checker_id_foreign` FOREIGN KEY (`checker_id`) REFERENCES `checkers` (`id`),
  ADD CONSTRAINT `rounds_remarks_id_foreign` FOREIGN KEY (`remarks_id`) REFERENCES `remarks` (`id`);

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`),
  ADD CONSTRAINT `schedules_subject_code_id_foreign` FOREIGN KEY (`subject_code_id`) REFERENCES `subject_codes` (`id`),
  ADD CONSTRAINT `schedules_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
