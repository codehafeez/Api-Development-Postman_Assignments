-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2023 at 03:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fantasy`
--

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
-- Table structure for table `leagues`
--

CREATE TABLE `leagues` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leagues`
--

INSERT INTO `leagues` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(7, 'abc2', 'abc2@gmail.com', '$2y$10$Di3Bxa6MukVnG9zK9Q0G1.w26jafxEu933TetZ0zWUgKXFJIiOeI2', '2023-04-19 03:43:52', '2023-04-19 03:43:52'),
(10, 'aaaa', 'aaaa@gmail.com', '$2y$10$FmG/sHWEtBF9v5gfqxZnUuAP4zg8gPUa4yuyzFzonnw1OpECZccHe', '2023-04-19 05:20:45', '2023-04-19 05:20:45'),
(11, 'bbb', 'bbbb@gmail.com', '$2y$10$K5A9lQa6LNLUZ/cdRpR7FefA.UcE0gfz5dCs6tjMusGKrxJ9woeBa', '2023-04-19 05:20:50', '2023-04-19 05:20:50');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'fantasy', '41c9a239258563dec31454dd31b643e512e07a8b926ea515f879c0e8a38af59f', '[\"*\"]', NULL, NULL, '2023-04-17 04:53:58', '2023-04-17 04:53:58'),
(2, 'App\\Models\\User', 2, 'fantasy', '31fffedb89a481d5dae82717c76b81e27f62bc751779ff00dd14e3823203aaf2', '[\"*\"]', NULL, NULL, '2023-04-17 04:54:46', '2023-04-17 04:54:46'),
(3, 'App\\Models\\User', 3, 'fantasy', '45bfac88dc1cc27aee539587640006b9e3895730720bcf3db52cdc9f78e870e7', '[\"*\"]', NULL, NULL, '2023-04-17 04:56:16', '2023-04-17 04:56:16'),
(4, 'App\\Models\\User', 3, 'fantasy', 'b1baa9c1d2bf4a517403482894a6d3bdfb27166738847141bc084ae1e0e02516', '[\"*\"]', NULL, NULL, '2023-04-17 04:58:29', '2023-04-17 04:58:29'),
(5, 'App\\Models\\User', 3, 'fantasy', '8772eb590d72b8d5d107d0835f87e0f190df90a210ae5efaa8762e6d218eb6b1', '[\"*\"]', NULL, NULL, '2023-04-17 04:58:43', '2023-04-17 04:58:43'),
(6, 'App\\Models\\User', 3, 'fantasy', 'f73c9a1c41b868b642076c64d1202149d82dfcd358070307768265234cbbeccc', '[\"*\"]', NULL, NULL, '2023-04-17 04:59:40', '2023-04-17 04:59:40'),
(7, 'App\\Models\\User', 3, 'fantasy', '3088d64ab2b83f03b6a04ac0649e53bd70ef8e3bb41cdb724b9d68aa08093ce7', '[\"*\"]', NULL, NULL, '2023-04-17 05:05:21', '2023-04-17 05:05:21'),
(8, 'App\\Models\\User', 2, 'forgot-password', 'c717947133befe3362046ed7b5ed2f3fd76bd6dccb63b18c7793b5b8254304ea', '[\"*\"]', NULL, NULL, '2023-04-17 05:07:23', '2023-04-17 05:07:23'),
(9, 'App\\Models\\User', 2, 'forgot-password', 'e0400b9e9d938fa77f8a4fa6d44fabc7e4c692d3f3982c93e6392d9b948cc918', '[\"*\"]', NULL, NULL, '2023-04-17 05:08:21', '2023-04-17 05:08:21'),
(10, 'App\\Models\\User', 2, 'forgot-password', 'f71df5e764406c6ab87b5b3b9faa24b32a701e63d86d6ffb3ef80b079d5cdd4c', '[\"*\"]', NULL, NULL, '2023-04-17 05:08:27', '2023-04-17 05:08:27'),
(11, 'App\\Models\\User', 2, 'forgot-password', '5bd1d1bf2b1704cac8a47a3902e7059463eceff32cbb1f6659fccc4175639331', '[\"*\"]', NULL, NULL, '2023-04-17 05:09:07', '2023-04-17 05:09:07'),
(12, 'App\\Models\\User', 2, 'forgot-password', '567fe39450c553bebb1ad1739a274a4f5718df36c090f44660b0026bf7f48976', '[\"*\"]', NULL, NULL, '2023-04-17 05:09:43', '2023-04-17 05:09:43'),
(13, 'App\\Models\\User', 2, 'forgot-password', '5c57544922e80213063345daee164f1207ee90be3a4f01cd419caa298f2920ed', '[\"*\"]', NULL, NULL, '2023-04-17 05:13:31', '2023-04-17 05:13:31'),
(14, 'App\\Models\\User', 2, 'fantasy', '7c9965975d19265d7c9152782489f2714a8d66844d3f7bcb9dd7d81a4fd32dfc', '[\"*\"]', NULL, NULL, '2023-04-17 05:14:31', '2023-04-17 05:14:31'),
(15, 'App\\Models\\User', 2, 'fantasy', 'ba70737fab17bb99bbe09e31191dcc27d0224f11566fd0df8c12fed324a0f44b', '[\"*\"]', NULL, NULL, '2023-04-17 05:16:09', '2023-04-17 05:16:09'),
(16, 'App\\Models\\User', 2, 'fantasy', 'dbc35269b5f0ee57870b291876e106a4aef7db32f9d5b83fa3634aef9595b7b0', '[\"*\"]', NULL, NULL, '2023-04-17 05:21:58', '2023-04-17 05:21:58'),
(17, 'App\\Models\\User', 2, 'fantasy', '2be56b7725e4753ee8688fbd8f5388bc419ddb1493b30e460e0d6fe8ef9e6281', '[\"*\"]', NULL, NULL, '2023-04-17 05:23:22', '2023-04-17 05:23:22'),
(18, 'App\\Models\\User', 2, 'fantasy', '728ff2a4f8575c5081fa53e78bdd4be322d7d368fc13fbbbf1769548b69e57ab', '[\"*\"]', NULL, NULL, '2023-04-17 05:23:25', '2023-04-17 05:23:25'),
(19, 'App\\Models\\User', 2, 'fantasy', '9fc11360c023af3283227709459c2114aafa80b585859d36be35b5f8fb62135a', '[\"*\"]', NULL, NULL, '2023-04-17 05:23:37', '2023-04-17 05:23:37'),
(20, 'App\\Models\\User', 2, 'fantasy', 'd60821508bc70930dadfacfb481c99ee95dcfa31f61c877974662361a696f4e5', '[\"*\"]', NULL, NULL, '2023-04-17 05:24:34', '2023-04-17 05:24:34'),
(21, 'App\\Models\\User', 2, 'fantasy', '8da5cc0defb8d713a61e47d58f8b18bb1933e86eb43ee3247f47f89b27d440e3', '[\"*\"]', NULL, NULL, '2023-04-17 05:25:16', '2023-04-17 05:25:16'),
(22, 'App\\Models\\User', 2, 'fantasy', '360e129f86730ad02c0477a653b92e876d5ae67ff3e0d03d29fac865bf4c9f9f', '[\"*\"]', NULL, NULL, '2023-04-17 05:25:27', '2023-04-17 05:25:27'),
(23, 'App\\Models\\User', 2, 'fantasy', '0121454702b9baa2bf708c987e6076223d62576255b24a6de3498f7326d2ef73', '[\"*\"]', NULL, NULL, '2023-04-17 05:25:53', '2023-04-17 05:25:53'),
(24, 'App\\Models\\User', 2, 'fantasy', 'd86c043a4e6173a83aee2e8bc4db3e6d7598522fbbe32adefacac551b0045d87', '[\"*\"]', NULL, NULL, '2023-04-17 05:25:57', '2023-04-17 05:25:57'),
(25, 'App\\Models\\User', 2, 'fantasy', '13427ac4d81342d83fefa5371f0edae6c462ace3121386d1e766bb709a537f32', '[\"*\"]', NULL, NULL, '2023-04-17 05:26:40', '2023-04-17 05:26:40'),
(26, 'App\\Models\\User', 2, 'fantasy', '8b10fc504558a6d63161fb276c2059b039780ed480580635711fb62cb343b971', '[\"*\"]', NULL, NULL, '2023-04-17 05:37:49', '2023-04-17 05:37:49'),
(27, 'App\\Models\\User', 2, 'fantasy', '98accff37ad0ec8928d8d31e6d1380a113832b64773daae769786dc3a1d25bea', '[\"*\"]', NULL, NULL, '2023-04-17 05:48:38', '2023-04-17 05:48:38'),
(28, 'App\\Models\\User', 2, 'fantasy', 'dd9247426f08f6980cc34d6182fa76d15c75b6e07e8b2b5ca0cbf47e85bc2b72', '[\"*\"]', NULL, NULL, '2023-04-17 05:54:28', '2023-04-17 05:54:28'),
(29, 'App\\Models\\User', 2, 'fantasy', '8f7988c855b7f029dd1be5879d1a721e000bf57052c9a34d6f3bcbe955d8ec82', '[\"*\"]', NULL, NULL, '2023-04-17 07:00:12', '2023-04-17 07:00:12'),
(30, 'App\\Models\\User', 4, 'fantasy', '435c1890999218d0d0e5f6b1325ce4356551c2314b3e89e3ee6caa1d867eec72', '[\"*\"]', NULL, NULL, '2023-04-17 07:51:38', '2023-04-17 07:51:38'),
(31, 'App\\Models\\User', 4, 'fantasy', 'd6d1759276e6620aa1bcdc0dbd00470c380ffd2ba1cc6f389e8f953f7ea2cdab', '[\"*\"]', NULL, NULL, '2023-04-17 07:52:44', '2023-04-17 07:52:44'),
(32, 'App\\Models\\User', 4, 'fantasy', 'e5e74e3c329b1144ef141d3a92f39765aa7bd9e29e5ba14239cbf4e81bc46bee', '[\"*\"]', NULL, NULL, '2023-04-17 08:04:06', '2023-04-17 08:04:06'),
(33, 'App\\Models\\User', 4, 'fantasy', '48b6cd98dd27d88e3b841b2fcd75a3ef77bc0fb5805088fabd89bbcbcf7a1d8a', '[\"*\"]', NULL, NULL, '2023-04-17 10:40:08', '2023-04-17 10:40:08'),
(34, 'App\\Models\\User', 4, 'fantasy', '0f5a4734d29311bf0c68401ddaa5c2736fa2035f18cae9984d93514e3cb14e04', '[\"*\"]', NULL, NULL, '2023-04-17 10:40:20', '2023-04-17 10:40:20'),
(35, 'App\\Models\\User', 5, 'fantasy', '077d8734dc18cf0641d4c0138dd1aead7d91bb2dc62199893337a060ec10cafa', '[\"*\"]', NULL, NULL, '2023-04-19 01:35:27', '2023-04-19 01:35:27'),
(36, 'App\\Models\\User', 6, 'fantasy', '853bda3139b62ee08c526b40f911663669987bf1181d34fe53e3f30e34baa078', '[\"*\"]', NULL, NULL, '2023-04-19 01:48:10', '2023-04-19 01:48:10'),
(37, 'App\\Models\\User', 6, 'fantasy', 'a4ee0470acb5350a4b4c7b28166d5af6ff9fe7e9026cc6f5710a68b7e99913f5', '[\"*\"]', NULL, NULL, '2023-04-19 01:49:31', '2023-04-19 01:49:31'),
(38, 'App\\Models\\User', 6, 'MyApp', 'cfc5b73421ac95107c94808ab39ecb82e3ab34e5d7030f07a59f71ea67286b2d', '[\"*\"]', NULL, NULL, '2023-04-19 01:50:39', '2023-04-19 01:50:39'),
(39, 'App\\Models\\User', 7, 'fantasy', '001f166e472782df74b38f436d2d49c1470329d062cdf723c1d711718e9764c6', '[\"*\"]', NULL, NULL, '2023-04-19 01:53:01', '2023-04-19 01:53:01'),
(40, 'App\\Models\\User', 7, 'MyApp', '67d55f68ac25cc0ac82b59c4460138a4bafcbe5231665c418879b4f606da7028', '[\"*\"]', NULL, NULL, '2023-04-19 01:53:32', '2023-04-19 01:53:32'),
(41, 'App\\Models\\User', 7, 'MyApp', 'a1a7b06d39fbeafad207b128287118e12f5779b7d5722831191d28ec70edec5e', '[\"*\"]', NULL, NULL, '2023-04-19 06:51:24', '2023-04-19 06:51:24'),
(42, 'App\\Models\\User', 7, 'fantasy', '3a85684768603a45a70ca32024b5c1b544d5639b9dbc4839c274cee69e3b970c', '[\"*\"]', '2023-04-19 07:08:32', NULL, '2023-04-19 06:59:58', '2023-04-19 07:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 'Noman', 'noman@octalyte.com', '123123123', NULL, '$2y$10$UhJl9vhejsLnyMOTvrcDC.MZrOW6TDEqQkTMSNEZEpyfihSBJDwmq', NULL, '2023-04-19 01:48:10', '2023-04-19 01:48:10'),
(7, 'Abdul Hafeez', 'abdul.hafeez@octalyte.com', '123123123', NULL, '$2y$10$4Pzxtg1X62dAV7x1JCy68ORTY1Awze.LyHIxJ69DTNB5XePxtx1Bm', '42bGQI1QVjwFZZrQq2IfdZrS2xzZvAf5Y5gL59EeMeOfz22ivXagjXEi8elw', '2023-04-19 01:53:01', '2023-04-19 06:23:13');

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
-- Indexes for table `leagues`
--
ALTER TABLE `leagues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leagues`
--
ALTER TABLE `leagues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
