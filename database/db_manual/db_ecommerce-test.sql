-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 23, 2025 at 05:45 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ecommerce-test`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ekspedisi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ongkir` bigint NOT NULL,
  `status` int NOT NULL,
  `cby` int DEFAULT NULL,
  `mby` int DEFAULT NULL,
  `isdelete` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `invoice`, `nama_lengkap`, `email`, `no_hp`, `province`, `alamat`, `ekspedisi`, `ongkir`, `status`, `cby`, `mby`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 4, 'INV-2025-001', 'Ujang Budiman', 'ujang@gmail.com', '0895414587000', 'Kalimantan Selatan', 'sad', 'jne', 15000, 2, 4, NULL, '0', '2025-05-23 05:59:57', '2025-05-23 05:59:57'),
(2, 4, 'INV-2025-002', 'Ujang Budiman', 'ujang@gmail.com', '0895414587000', 'Kalimantan Selatan', 'asdad', 'sicepat', 13000, 0, 4, NULL, '0', '2025-05-23 06:09:28', '2025-05-23 06:09:28'),
(3, 1, 'INV-2025-003', 'admin', 'admin@gmail.com', '0895414587000', 'Banten', 'sadadasd', 'sicepat', 13000, 1, 1, NULL, '0', '2025-05-23 09:50:35', '2025-05-23 09:50:35'),
(4, 1, 'INV-2025-004', 'Akbar Hossam', 'akbarhossam123@gmail.com', '0895414587000', 'DKI Jakarta', 'dasasdasdads', 'sicepat', 13000, 0, 1, NULL, '0', '2025-05-23 10:17:53', '2025-05-23 10:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `id` bigint UNSIGNED NOT NULL,
  `cart_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `price` bigint NOT NULL,
  `cby` int DEFAULT NULL,
  `mby` int DEFAULT NULL,
  `isdelete` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`id`, `cart_id`, `product_id`, `qty`, `price`, `cby`, `mby`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 5000, 4, NULL, '0', '2025-05-23 05:59:57', '2025-05-23 05:59:57'),
(2, 2, 5, 1, 10000, 4, NULL, '0', '2025-05-23 06:09:28', '2025-05-23 06:09:28'),
(3, 3, 6, 1, 5000, 1, NULL, '0', '2025-05-23 09:50:35', '2025-05-23 09:50:35'),
(4, 4, 4, 1, 5000, 1, NULL, '0', '2025-05-23 10:17:53', '2025-05-23 10:17:53'),
(5, 4, 5, 1, 10000, 1, NULL, '0', '2025-05-23 10:17:53', '2025-05-23 10:17:53'),
(6, 4, 7, 1, 7000, 1, NULL, '0', '2025-05-23 10:17:53', '2025-05-23 10:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `cart_temporary`
--

CREATE TABLE `cart_temporary` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `price` bigint NOT NULL,
  `cby` int DEFAULT NULL,
  `mby` int DEFAULT NULL,
  `isdelete` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_temporary`
--

INSERT INTO `cart_temporary` (`id`, `product_id`, `user_id`, `qty`, `price`, `cby`, `mby`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 1, 5000, 4, NULL, '1', '2025-05-23 05:59:47', '2025-05-23 05:59:57'),
(2, 5, 4, 1, 10000, 4, NULL, '1', '2025-05-23 06:07:16', '2025-05-23 06:09:28'),
(3, 6, 1, 1, 5000, 1, NULL, '1', '2025-05-23 09:50:02', '2025-05-23 09:50:35'),
(4, 4, 1, 1, 5000, 1, NULL, '1', '2025-05-23 10:17:14', '2025-05-23 10:17:53'),
(5, 5, 1, 1, 10000, 1, NULL, '1', '2025-05-23 10:17:18', '2025-05-23 10:17:53'),
(6, 7, 1, 1, 7000, 1, NULL, '1', '2025-05-23 10:17:21', '2025-05-23 10:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cby` int DEFAULT NULL,
  `mby` int DEFAULT NULL,
  `isdelete` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `cby`, `mby`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 'Minuman', 1, 1, '0', '2025-05-21 04:43:05', '2025-05-21 05:04:37'),
(2, 'Makanan', 1, 1, '0', '2025-05-21 05:04:54', '2025-05-21 05:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2025_05_21_101943_create_categories_table', 2),
(4, '2025_05_22_074136_create_products_table', 3),
(5, '2025_05_22_074953_create_setting_harga_table', 3),
(6, '2025_05_23_004529_create_cart_temporary_table', 4),
(7, '2025_05_23_035004_create_carts_table', 5),
(8, '2025_05_23_035018_create_cart_detail_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_product` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cby` int DEFAULT NULL,
  `mby` int DEFAULT NULL,
  `isdelete` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nama_product`, `category_id`, `gambar`, `keterangan`, `cby`, `mby`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 'ale-ale', 1, 'uploads/products/f84e767c-582f-44d4-ab3a-b597af65574d.jpg', '<p>akbar</p>', 1, 1, '1', '2025-05-22 03:23:19', '2025-05-22 04:03:01'),
(2, 'Chitato', 2, 'uploads/products/05ddc800-7094-45b0-9c0a-83b6ab699fa3.jpg', '<p>asdadasd</p>', 1, NULL, '0', '2025-05-22 04:31:44', '2025-05-22 04:31:44'),
(3, 'Yoghurt', 1, 'uploads/products/b834569c-34d5-4167-a138-6a45dbfd2161.jpg', '<p>asdasdasd</p>', 1, NULL, '0', '2025-05-22 05:39:30', '2025-05-22 05:39:30'),
(4, 'Kuaci', 2, 'uploads/products/cbd6fce1-83e3-43f6-8771-705d50f95d9a.jpg', '<p>asdasdasd</p>', 1, NULL, '0', '2025-05-22 05:40:30', '2025-05-22 05:40:30'),
(5, 'Susu', 1, 'uploads/products/2e4c9773-5881-4535-8e93-cea60ad4f97b.jpg', '<p>asdassd</p>', 1, NULL, '0', '2025-05-22 05:40:53', '2025-05-22 05:40:53'),
(6, 'HappyTost', 2, 'uploads/products/6ab107bd-b314-4245-9cfb-d0ed9858004c.jpg', '<p>asdasada</p>', 1, NULL, '0', '2025-05-23 09:43:42', '2025-05-23 09:43:42'),
(7, 'Florida', 1, 'uploads/products/15f17cbd-789f-47b6-bddb-482f53f9defb.jpg', '<p>asdasasd</p>', 1, NULL, '0', '2025-05-23 09:57:39', '2025-05-23 09:57:39');

-- --------------------------------------------------------

--
-- Table structure for table `setting_harga`
--

CREATE TABLE `setting_harga` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `harga` bigint NOT NULL,
  `cby` int DEFAULT NULL,
  `mby` int DEFAULT NULL,
  `isdelete` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_harga`
--

INSERT INTO `setting_harga` (`id`, `product_id`, `periode_awal`, `periode_akhir`, `harga`, `cby`, `mby`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 2, '2025-05-23', '2025-06-28', 1000, 1, 1, '0', '2025-05-22 04:39:57', '2025-05-22 06:17:49'),
(2, 3, '2025-05-22', '2025-06-07', 5000, 1, NULL, '0', '2025-05-22 05:41:47', '2025-05-22 05:41:47'),
(3, 5, '2025-05-22', '2025-06-07', 10000, 1, NULL, '0', '2025-05-22 05:42:43', '2025-05-22 05:42:43'),
(4, 4, '2025-05-22', '2025-06-07', 5000, 1, NULL, '0', '2025-05-22 05:43:08', '2025-05-22 05:43:08'),
(5, 6, '2025-05-23', '2025-06-07', 5000, 1, NULL, '0', '2025-05-23 09:44:34', '2025-05-23 09:44:34'),
(6, 7, '2025-05-23', '2025-06-07', 7000, 1, NULL, '0', '2025-05-23 09:57:59', '2025-05-23 09:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `tb_ro_provinces`
--

CREATE TABLE `tb_ro_provinces` (
  `province_id` int NOT NULL,
  `province_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tb_ro_provinces`
--

INSERT INTO `tb_ro_provinces` (`province_id`, `province_name`) VALUES
(1, 'Bali'),
(2, 'Bangka Belitung'),
(3, 'Banten'),
(4, 'Bengkulu'),
(5, 'DI Yogyakarta'),
(6, 'DKI Jakarta'),
(7, 'Gorontalo'),
(8, 'Jambi'),
(9, 'Jawa Barat'),
(10, 'Jawa Tengah'),
(11, 'Jawa Timur'),
(12, 'Kalimantan Barat'),
(13, 'Kalimantan Selatan'),
(14, 'Kalimantan Tengah'),
(15, 'Kalimantan Timur'),
(16, 'Kalimantan Utara'),
(17, 'Kepulauan Riau'),
(18, 'Lampung'),
(19, 'Maluku'),
(20, 'Maluku Utara'),
(21, 'Nanggroe Aceh Darussalam (NAD)'),
(22, 'Nusa Tenggara Barat (NTB)'),
(23, 'Nusa Tenggara Timur (NTT)'),
(24, 'Papua'),
(25, 'Papua Barat'),
(26, 'Riau'),
(27, 'Sulawesi Barat'),
(28, 'Sulawesi Selatan'),
(29, 'Sulawesi Tengah'),
(30, 'Sulawesi Tenggara'),
(31, 'Sulawesi Utara'),
(32, 'Sumatera Barat'),
(33, 'Sumatera Selatan'),
(34, 'Sumatera Utara');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL DEFAULT '2',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isdelete` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `logo`, `no_hp`, `gender`, `alamat`, `role`, `email_verified_at`, `password`, `remember_token`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'uploads/logo/1748009874_68308392aa991.jpg', '0895414587000', 'male', 'Griya', 1, NULL, '$2y$12$JYA6GdRlCXPno.HgmriC0.n6jLGm6pWelqRptLGWvjLKlJQ4pZ3Pm', NULL, 0, '2025-05-21 07:32:19', '2025-05-23 09:41:05'),
(4, 'Akbar Hossam Delmiro', 'akbarhossam123@gmail.com', 'uploads/logo/1747993418_6830434a87825.jpg', '0895414587000', 'female', 'Griya Serpong Asri Blok E3 No.16 Rt.03/05, kecamatan cisauk, Tangerang Banten', 2, NULL, '$2y$10$2eZFPRXIumi38swjIzvNdevteT4svQwdbUdHFTZJryUsJR2wfS.yW', NULL, 0, '2025-05-22 08:29:44', '2025-05-23 02:43:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_detail_cart_id_foreign` (`cart_id`),
  ADD KEY `cart_detail_product_id_foreign` (`product_id`);

--
-- Indexes for table `cart_temporary`
--
ALTER TABLE `cart_temporary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_temporary_product_id_foreign` (`product_id`),
  ADD KEY `cart_temporary_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `setting_harga`
--
ALTER TABLE `setting_harga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setting_harga_product_id_foreign` (`product_id`);

--
-- Indexes for table `tb_ro_provinces`
--
ALTER TABLE `tb_ro_provinces`
  ADD PRIMARY KEY (`province_id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart_detail`
--
ALTER TABLE `cart_detail`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart_temporary`
--
ALTER TABLE `cart_temporary`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `setting_harga`
--
ALTER TABLE `setting_harga`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `cart_detail_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_detail_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_temporary`
--
ALTER TABLE `cart_temporary`
  ADD CONSTRAINT `cart_temporary_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_temporary_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `setting_harga`
--
ALTER TABLE `setting_harga`
  ADD CONSTRAINT `setting_harga_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
