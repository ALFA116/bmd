-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 20, 2025 at 02:42 PM
-- Server version: 8.0.41
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dd`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2013_01_22_004335_create_roles_table', 1),
(10, '2014_10_12_000000_create_users_table', 1),
(11, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(12, '2019_08_19_000000_create_failed_jobs_table', 1),
(13, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(14, '2025_01_22_004405_create_wallets_table', 1),
(15, '2025_01_22_004514_create_transactions_table', 1),
(16, '2025_02_11_005955_create_user_transactions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', NULL, NULL, NULL),
(2, 'bank', NULL, NULL, NULL),
(3, 'siswa', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED NOT NULL,
  `status` enum('ditransfer','dibayar','diambil','approved','rejected','Menunggu') COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `users_id`, `status`, `order_code`, `price`, `quantity`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 5, 'approved', '67fc6e155ee7a', 100000, 1, 'topup1', '2025-04-13 19:08:21', '2025-04-13 20:46:58', NULL),
(2, 5, 'Menunggu', '67fc6e2a04fd0', 50000, 1, 'Withdrawal', '2025-04-13 19:08:42', '2025-04-13 19:08:42', NULL),
(3, 5, 'Menunggu', '67fc6e3d8ca07', 25000, 1, 'jajan1', '2025-04-13 19:09:01', '2025-04-13 19:09:01', NULL),
(4, 4, 'rejected', '67fc6eafbe91d', 50000, 1, 'topup1', '2025-04-13 19:10:55', '2025-04-13 19:13:10', NULL),
(5, 4, 'Menunggu', '67fc6eb9b9ba7', 500000, 1, 'topup2', '2025-04-13 19:11:05', '2025-04-13 19:11:05', NULL),
(6, 4, 'approved', '67fc6ed521e6b', 75000, 1, 'Withdrawal', '2025-04-13 19:11:33', '2025-04-13 19:26:14', NULL),
(7, 4, 'Menunggu', '67fc6f1b4d4bb', 5000, 1, 'bahlul', '2025-04-13 19:12:43', '2025-04-13 19:12:43', NULL),
(8, 4, 'dibayar', '67fc8b58de94e', 175000, 1, 'test1', '2025-04-13 21:13:12', '2025-04-13 21:13:12', NULL),
(9, 4, 'ditransfer', '67fc8b9996826', 25000, 1, 'buat lu', '2025-04-13 21:14:17', '2025-04-13 21:14:17', NULL),
(10, 4, 'Menunggu', '67fc8d197fb96', 25000, 1, 'Withdrawal', '2025-04-13 21:20:41', '2025-04-13 21:20:41', NULL),
(11, 4, 'dibayar', '67fc8daebd99b', 100000, 1, 'test3', '2025-04-13 21:23:10', '2025-04-13 21:23:10', NULL),
(12, 4, 'dibayar', '67fc8e835da1e', 10000, 1, 'test3', '2025-04-13 21:26:43', '2025-04-13 21:26:43', NULL),
(13, 4, 'ditransfer', '67fc8e90c3898', 30000, 1, 'bahlul', '2025-04-13 21:26:56', '2025-04-13 21:26:56', NULL),
(14, 4, 'Menunggu', '67fc8f8b5a01c', 10000, 1, 'Withdrawal', '2025-04-13 21:31:07', '2025-04-13 21:31:07', NULL),
(15, 4, 'Menunggu', '67fc9006f41cb', 150000, 1, 'test3', '2025-04-13 21:33:11', '2025-04-13 21:33:11', NULL),
(16, 4, 'Menunggu', '67fc900fd6bea', 90000, 1, 'Withdrawal', '2025-04-13 21:33:19', '2025-04-13 21:33:19', NULL),
(17, 4, 'Menunggu', '67fc9025ac25a', 30000, 1, 'test3', '2025-04-13 21:33:41', '2025-04-13 21:33:41', NULL),
(18, 4, 'Menunggu', '67fc902fd0f53', 30000, 1, 'Withdrawal', '2025-04-13 21:33:51', '2025-04-13 21:33:51', NULL),
(19, 4, 'Menunggu', '67fc90409581f', 100000, 1, 'topup1', '2025-04-13 21:34:08', '2025-04-13 21:34:08', NULL),
(20, 5, 'Menunggu', '67fca79c588d0', 25000, 1, 'gg', '2025-04-13 23:13:48', '2025-04-13 23:13:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles_id` bigint UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `roles_id`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Alfa', 'admin@gmail.com', NULL, '$2y$12$yXiPCkWhFkBypgNeaybSoeV67vyN7P9QrZb9QqQIKTC.oU13cL8U2', 1, NULL, '2025-04-13 19:06:34', '2025-04-13 19:06:34', NULL),
(2, 'Bank', 'bank@gmail.com', NULL, '$2y$12$soVSMLK9gHwQC9Yefm/t6OqgxTddUBxK6byFLT3ZYL/4PZP12QNte', 2, NULL, '2025-04-13 19:06:34', '2025-04-13 19:06:34', NULL),
(3, 'Siswa', 'siswa@gmail.com', NULL, '$2y$12$8tXJyfMAOrgM656wA7obGeNaioJLOuh8hbZXEwbkXZhW1j4X9KeQi', 3, NULL, '2025-04-13 19:06:34', '2025-04-13 19:06:34', NULL),
(4, 'Abeng', 'filbert@gmail.com', NULL, '$2y$12$MhXiGKAqySVwoQqfC4GeJ.Km0/6aXddGHxxcYxyZ/LvLeTmhg0mDO', 3, NULL, '2025-04-13 19:06:34', '2025-04-13 19:06:34', NULL),
(5, 'Lekus', 'leksa@gmail.com', NULL, '$2y$12$HcstYzIQHokUSjaQ5uFe9O06Aq54BHVkco/agnjsDx6eBzUpo0GSG', 3, NULL, '2025-04-13 19:06:34', '2025-04-13 19:06:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint UNSIGNED NOT NULL,
  `users_id` bigint UNSIGNED NOT NULL,
  `credit` double NOT NULL DEFAULT '0',
  `debit` double NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `users_id`, `credit`, `debit`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 25000, 0, 'active', '2025-04-13 19:06:34', '2025-04-13 20:46:58', NULL),
(2, 2, 0, 0, 'active', '2025-04-13 19:06:34', '2025-04-13 19:06:34', NULL),
(3, 3, 0, 0, 'active', '2025-04-13 19:06:34', '2025-04-13 19:06:34', NULL),
(4, 4, 330000, 0, 'active', '2025-04-13 19:06:34', '2025-04-13 21:32:06', NULL),
(5, 5, 150000, 0, 'active', '2025-04-13 19:06:34', '2025-04-13 20:46:58', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_users_id_foreign` (`users_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_roles_id_foreign` (`roles_id`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_transactions_user_id_foreign` (`user_id`),
  ADD KEY `user_transactions_transaction_id_foreign` (`transaction_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_users_id_foreign` (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_roles_id_foreign` FOREIGN KEY (`roles_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD CONSTRAINT `user_transactions_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `user_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_users_id_foreign` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
