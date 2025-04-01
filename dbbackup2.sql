-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2025 at 05:16 PM
-- Server version: 8.0.27
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `st15_wp_vegetable_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_07_000001_create_roles_table', 1),
(6, '2024_01_07_000002_create_permissions_table', 1),
(7, '2024_01_07_000003_create_users_table', 1),
(8, '2024_01_07_000004_create_permission_role_table', 1),
(9, '2024_01_07_000005_create_categorys_table', 1),
(10, '2024_01_07_000006_create_brands_table', 1),
(11, '2024_01_07_000007_create_units_table', 1),
(12, '2024_01_07_000008_create_products_table', 1),
(13, '2024_01_07_000009_create_variants_table', 1),
(14, '2024_01_07_000010_create_customer_feedback_table', 1),
(15, '2024_01_07_000011_create_logo_clients_table', 1),
(16, '2024_01_07_000012_create_tags_table', 1),
(17, '2024_01_07_000013_create_blogs_table', 1),
(18, '2024_01_07_000014_create_blog_comments_table', 1),
(19, '2024_01_07_000015_create_contacts_table', 1),
(20, '2024_01_07_000016_create_wishlists_table', 1),
(21, '2024_01_07_000017_create_carts_table', 1),
(22, '2024_01_07_000018_create_payment_methods_table', 1),
(23, '2024_01_07_000019_create_sales_table', 1),
(24, '2024_01_07_000020_create_sale_items_table', 1),
(25, '2024_01_07_000021_create_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

DROP TABLE IF EXISTS `tbl_blog`;
CREATE TABLE IF NOT EXISTS `tbl_blog` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_by` bigint UNSIGNED NOT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_blog_create_by_foreign` (`create_by`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`id`, `title`, `content`, `create_by`, `featured_image`, `published_at`, `created_at`, `updated_at`) VALUES
(3, 'Even the all-powerful Pointing has no control about the blind texts', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 2, 'admin/uploads/blog/1736657033_image_1.jpg', '2025-01-11 21:43:53', '2025-01-11 21:43:53', '2025-01-11 21:43:53'),
(4, 'Even the all-powerful Pointing has no control about the blind texts', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 2, 'admin/uploads/blog/1736657063_image_2.jpg', '2025-01-11 21:44:23', '2025-01-11 21:44:23', '2025-01-11 21:44:23'),
(5, 'Even the all-powerful Pointing has no control about the blind texts', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 2, 'admin/uploads/blog/1736657085_image_3.jpg', '2025-01-11 21:44:45', '2025-01-11 21:44:45', '2025-01-11 21:44:45'),
(6, 'Even the all-powerful Pointing has no control about the blind texts', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 2, 'admin/uploads/blog/1736657108_image_4.jpg', '2025-01-11 21:45:08', '2025-01-11 21:45:08', '2025-01-11 21:45:08'),
(7, 'Even the all-powerful Pointing has no control about the blind texts', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 2, 'admin/uploads/blog/1736657139_image_5.jpg', '2025-01-11 21:45:39', '2025-01-11 21:45:39', '2025-01-11 21:45:39'),
(8, 'Even the all-powerful Pointing has no control about the blind texts', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', 2, 'admin/uploads/blog/1736657143_image_6.jpg', '2025-01-11 21:45:43', '2025-01-11 21:45:43', '2025-01-11 21:45:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog_comment`
--

DROP TABLE IF EXISTS `tbl_blog_comment`;
CREATE TABLE IF NOT EXISTS `tbl_blog_comment` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `blog_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_blog_comment_blog_id_foreign` (`blog_id`),
  KEY `tbl_blog_comment_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_blog_comment`
--

INSERT INTO `tbl_blog_comment` (`id`, `blog_id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 3, 3, 'hello', '2025-01-01 07:10:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

DROP TABLE IF EXISTS `tbl_brand`;
CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`id`, `name`, `description`, `logo_url`, `created_at`, `updated_at`) VALUES
(12, 'Khmer', '213', 'admin/uploads/brand/1736655214_download (4).jpg', '2025-01-11 21:13:34', '2025-04-01 03:04:43'),
(13, 'Thai', 'dsfdsf', 'admin/uploads/brand/1736655238_images.jpg', '2025-01-11 21:13:58', '2025-04-01 03:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `varient_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_cart_user_id_foreign` (`user_id`),
  KEY `tbl_cart_varient_id_foreign` (`varient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categorys`
--

DROP TABLE IF EXISTS `tbl_categorys`;
CREATE TABLE IF NOT EXISTS `tbl_categorys` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_categorys`
--

INSERT INTO `tbl_categorys` (`id`, `name`, `description`, `image_url`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Fruits', '21312', 'admin/uploads/category/1736654204_category-1.jpg', 1, '2025-01-11 20:56:44', '2025-04-01 02:20:14'),
(4, 'Vegetables', NULL, 'admin/uploads/category/1736654232_category-2.jpg', 1, '2025-01-11 20:57:12', '2025-01-11 20:57:12'),
(5, 'Juices', NULL, 'admin/uploads/category/1736654264_category-3.jpg', 1, '2025-01-11 20:57:44', '2025-01-11 20:57:44'),
(6, 'Dried', NULL, 'admin/uploads/category/1736654286_category-4.jpg', 1, '2025-01-11 20:58:06', '2025-01-11 20:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

DROP TABLE IF EXISTS `tbl_contact`;
CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `map_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `address`, `phone`, `email`, `website`, `map_url`, `created_at`, `updated_at`) VALUES
(4, 'Sen Sok District, Pnom Penh City', '0717396325', 'no@gmail.com', 'Wechat', 'https://maps.google.com/maps?width=100%25&amp;height=100%25&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed', '2025-01-09 04:43:15', '2025-01-15 05:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_feedback`
--

DROP TABLE IF EXISTS `tbl_customer_feedback`;
CREATE TABLE IF NOT EXISTS `tbl_customer_feedback` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_customer_feedback_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_customer_feedback`
--

INSERT INTO `tbl_customer_feedback` (`id`, `user_id`, `comment`, `created_at`, `updated_at`) VALUES
(3, 3, 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '2025-01-11 21:32:01', '2025-01-11 21:32:01'),
(4, 4, 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '2025-01-11 21:32:06', '2025-01-11 21:32:06'),
(5, 5, 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.', '2025-01-11 21:32:09', '2025-01-11 21:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logo_client`
--

DROP TABLE IF EXISTS `tbl_logo_client`;
CREATE TABLE IF NOT EXISTS `tbl_logo_client` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_logo_client`
--

INSERT INTO `tbl_logo_client` (`id`, `name`, `logo_url`, `website_url`, `created_at`, `updated_at`) VALUES
(4, 'Restaurant', 'admin/uploads/logo_client/1736656727_bg5Asset 5@0.6x.png', NULL, '2025-01-11 21:38:47', '2025-01-11 21:38:47'),
(5, 'Restaurant', 'admin/uploads/logo_client/1736656731_bg5Asset 4@0.6x.png', NULL, '2025-01-11 21:38:51', '2025-01-11 21:38:51'),
(6, 'Restaurant', 'admin/uploads/logo_client/1736656735_bg5Asset 3@0.6x.png', NULL, '2025-01-11 21:38:55', '2025-01-11 21:38:55'),
(7, 'Restaurant', 'admin/uploads/logo_client/1736656739_bg5Asset 2@0.6x.png', NULL, '2025-01-11 21:38:59', '2025-01-11 21:38:59'),
(8, 'Restaurant', 'admin/uploads/logo_client/1736656742_bg5Asset 1@0.6x.png', NULL, '2025-01-11 21:39:02', '2025-01-11 21:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

DROP TABLE IF EXISTS `tbl_payment`;
CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sale_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method_id` bigint UNSIGNED NOT NULL,
  `payment_status` enum('pending','completed','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_payment_sale_id_foreign` (`sale_id`),
  KEY `tbl_payment_payment_method_id_foreign` (`payment_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_method`
--

DROP TABLE IF EXISTS `tbl_payment_method`;
CREATE TABLE IF NOT EXISTS `tbl_payment_method` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_payment_method`
--

INSERT INTO `tbl_payment_method` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ABA', '2025-01-10 05:57:49', '2025-04-01 02:01:51'),
(3, 'ACLEDA', '2025-01-11 21:41:15', '2025-01-11 21:41:15'),
(4, 'Paypal', '2025-01-11 21:41:36', '2025-01-11 21:41:36'),
(5, 'Card', '2025-01-11 21:41:49', '2025-04-01 02:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission`
--

DROP TABLE IF EXISTS `tbl_permission`;
CREATE TABLE IF NOT EXISTS `tbl_permission` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_permission_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_permission`
--

INSERT INTO `tbl_permission` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'add_user', '2025-01-10 20:49:35', '2025-01-10 20:50:54'),
(2, 'edit_user', '2025-01-10 20:49:39', '2025-01-10 20:50:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permission_role`
--

DROP TABLE IF EXISTS `tbl_permission_role`;
CREATE TABLE IF NOT EXISTS `tbl_permission_role` (
  `role_id` bigint UNSIGNED NOT NULL,
  `permission_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`role_id`,`permission_id`),
  KEY `tbl_permission_role_permission_id_foreign` (`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_permission_role`
--

INSERT INTO `tbl_permission_role` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(2, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 1, NULL, NULL),
(3, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `brand_id` bigint UNSIGNED DEFAULT NULL,
  `base_unit_id` bigint UNSIGNED DEFAULT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `stock_quantity` int NOT NULL DEFAULT '0',
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_products_category_id_foreign` (`category_id`),
  KEY `tbl_products_brand_id_foreign` (`brand_id`),
  KEY `tbl_products_base_unit_id_foreign` (`base_unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `name`, `description`, `category_id`, `brand_id`, `base_unit_id`, `base_price`, `stock_quantity`, `image_url`, `is_active`, `created_at`, `updated_at`) VALUES
(3, 'Bell Pepper', NULL, 4, 12, 3, 80.00, 100, 'admin/uploads/product/1736655294_product-1.jpg', 1, '2025-01-11 21:14:54', '2025-01-11 21:14:54'),
(4, 'Strawberry', NULL, 3, 12, 3, 120.00, 100, 'admin/uploads/product/1736655323_product-2.jpg', 1, '2025-01-11 21:15:23', '2025-01-11 21:15:23'),
(5, 'Green Beans', NULL, 4, 12, 3, 120.00, 100, 'admin/uploads/product/1736655404_product-3.jpg', 1, '2025-01-11 21:16:44', '2025-01-11 21:16:44'),
(6, 'Purple Cabbage', NULL, 4, 12, 3, 120.00, 100, 'admin/uploads/product/1736655415_product-4.jpg', 1, '2025-01-11 21:16:55', '2025-01-11 21:16:55'),
(7, 'Tomatoe', NULL, 4, 12, 3, 120.00, 100, 'admin/uploads/product/1736655447_product-5.jpg', 1, '2025-01-11 21:17:27', '2025-01-11 21:17:27'),
(8, 'Brocolli', NULL, 4, 12, 3, 120.00, 100, 'admin/uploads/product/1736655459_product-6.jpg', 1, '2025-01-11 21:17:39', '2025-01-11 21:17:39'),
(9, 'Carrots', NULL, 4, 12, 3, 120.00, 100, 'admin/uploads/product/1736655475_product-7.jpg', 1, '2025-01-11 21:17:55', '2025-01-11 21:17:55'),
(10, 'Fruit Juice', NULL, 5, 12, 3, 120.00, 100, 'admin/uploads/product/1736655491_product-8.jpg', 1, '2025-01-11 21:18:11', '2025-01-11 21:18:11'),
(11, 'Onion', NULL, 4, 12, 3, 120.00, 100, 'admin/uploads/product/1736655521_product-9.jpg', 1, '2025-01-11 21:18:41', '2025-01-11 21:18:41'),
(12, 'Apple', NULL, 3, 12, 3, 120.00, 100, 'admin/uploads/product/1736655549_product-10.jpg', 1, '2025-01-11 21:19:09', '2025-01-11 21:19:09'),
(13, 'Garlic', NULL, 4, 12, 3, 120.00, 100, 'admin/uploads/product/1736655565_product-11.jpg', 1, '2025-01-11 21:19:25', '2025-01-11 21:19:25'),
(14, 'Chilli', NULL, 4, 12, 3, 120.00, 100, 'admin/uploads/product/1736655583_product-12.jpg', 1, '2025-01-11 21:19:43', '2025-01-11 21:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

DROP TABLE IF EXISTS `tbl_role`;
CREATE TABLE IF NOT EXISTS `tbl_role` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_role_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Admin', '2025-01-10 20:09:34', '2025-01-10 20:10:21'),
(3, 'Authors', '2025-01-10 20:10:14', '2025-01-10 20:10:14'),
(4, 'Customer', '2025-01-11 21:26:31', '2025-04-01 09:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role_user`
--

DROP TABLE IF EXISTS `tbl_role_user`;
CREATE TABLE IF NOT EXISTS `tbl_role_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role_user`
--

INSERT INTO `tbl_role_user` (`user_id`, `role_id`) VALUES
(2, 2),
(3, 4),
(4, 4),
(5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale`
--

DROP TABLE IF EXISTS `tbl_sale`;
CREATE TABLE IF NOT EXISTS `tbl_sale` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method_id` bigint UNSIGNED NOT NULL,
  `payment_status` enum('pending','completed','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `order_status` enum('processing','shipped','delivered','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'processing',
  `shipping_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_sale_user_id_foreign` (`user_id`),
  KEY `tbl_sale_payment_method_id_foreign` (`payment_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_items`
--

DROP TABLE IF EXISTS `tbl_sale_items`;
CREATE TABLE IF NOT EXISTS `tbl_sale_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sale_id` bigint UNSIGNED NOT NULL,
  `varient_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_sale_items_sale_id_foreign` (`sale_id`),
  KEY `tbl_sale_items_varient_id_foreign` (`varient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tag`
--

DROP TABLE IF EXISTS `tbl_tag`;
CREATE TABLE IF NOT EXISTS `tbl_tag` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_tag_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_tag`
--

INSERT INTO `tbl_tag` (`id`, `name`, `created_at`, `updated_at`) VALUES
(7, 'fruits', '2025-01-11 21:39:55', '2025-01-11 21:39:55'),
(8, 'tomatoe', '2025-01-11 21:40:04', '2025-01-11 21:40:04'),
(9, 'mango', '2025-01-11 21:40:11', '2025-01-11 21:40:11'),
(10, 'apple', '2025-01-11 21:40:20', '2025-01-11 21:40:20'),
(11, 'carrots', '2025-01-11 21:40:28', '2025-01-11 21:40:28'),
(12, 'orange', '2025-01-11 21:40:35', '2025-01-11 21:40:35'),
(13, 'pepper', '2025-01-11 21:40:43', '2025-01-11 21:40:43'),
(14, 'eggplant', '2025-01-11 21:40:51', '2025-01-11 21:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

DROP TABLE IF EXISTS `tbl_unit`;
CREATE TABLE IF NOT EXISTS `tbl_unit` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Kg', '2025-01-11 21:12:51', '2025-04-01 02:23:39'),
(4, 'g', '2025-01-11 21:12:55', '2025-01-11 21:12:55'),
(5, 'small', '2025-01-11 21:20:56', '2025-01-11 21:20:56'),
(6, 'medium', '2025-01-11 21:21:12', '2025-01-11 21:21:12'),
(7, 'large', '2025-01-11 21:21:23', '2025-01-11 21:21:23'),
(8, 'extra large', '2025-01-11 21:21:34', '2025-01-11 21:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `image_url` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_users_username_unique` (`username`),
  UNIQUE KEY `tbl_users_email_unique` (`email`),
  KEY `tbl_role_user` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `email`, `password`, `full_name`, `gender`, `phone`, `address`, `role_id`, `image_url`, `created_at`, `updated_at`) VALUES
(2, 'tsd@gmail.com', 'mm@gmail.com', '$2y$10$U73yOYrnzYqGtvjrSheo5Oc6e43ZYw1tt906eGu3a74ynhKIdmMt2', 'Ou Vannet', 'male', '016572693', 'St 6', 2, 'admin/uploads/user/1736749287_1727491292hok.webp', '2025-01-11 10:33:44', '2025-01-12 23:21:27'),
(3, 'GarrethSmith', 'gs@gmail.com', '$2y$10$u3WWqrtBssF9l4BQHm3gW.mij.6NYhOdqS.8fKcmRiR/Ha8F.cdOS', 'Garreth Smith', 'male', '012345678', 'United State', 4, 'admin/uploads/user/1736656161_person_1.jpg', '2025-01-11 21:29:21', '2025-01-11 21:29:21'),
(4, 'StevenJohn', 'sj@gmail.com', '$2y$10$pT7q4lHEwXwFfYa4JrD37.PBnJAJL.R8gDPo2X7ijGYs1Q.sjSFSG', 'Steven John', 'male', '012345678', 'United State', 4, 'admin/uploads/user/1736656237_person_2.jpg', '2025-01-11 21:30:37', '2025-01-11 21:30:37'),
(5, 'RushSmith', 'rs@gmail.com', '$2y$10$AB/2sqqcDWhr/wWtLnwtHOgN/wV4MnpWUAeBa2lk3cWyzvbZvCWpC', 'Rush Smith', 'male', '012345678', 'United State', 4, 'admin/uploads/user/1736656286_person_3.jpg', '2025-01-11 21:31:26', '2025-01-11 21:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_varient`
--

DROP TABLE IF EXISTS `tbl_varient`;
CREATE TABLE IF NOT EXISTS `tbl_varient` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint UNSIGNED NOT NULL,
  `unit_id` bigint UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity_in_base_unit` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_varient_product_id_foreign` (`product_id`),
  KEY `tbl_varient_unit_id_foreign` (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_varient`
--

INSERT INTO `tbl_varient` (`id`, `product_id`, `unit_id`, `price`, `quantity_in_base_unit`, `created_at`, `updated_at`) VALUES
(3, 3, 5, 120.00, 0.00, '2025-01-11 21:22:06', '2025-01-11 21:22:06'),
(4, 3, 6, 120.00, 0.00, '2025-01-11 21:22:11', '2025-01-11 21:22:11'),
(5, 3, 7, 121.00, 0.00, '2025-01-11 21:22:14', '2025-04-01 02:58:29'),
(6, 3, 8, 120.00, 0.00, '2025-01-11 21:22:19', '2025-01-11 21:22:19'),
(7, 4, 5, 120.00, 0.00, '2025-01-11 21:22:24', '2025-01-11 21:22:24'),
(8, 4, 6, 120.00, 0.00, '2025-01-11 21:22:27', '2025-01-11 21:22:27'),
(9, 4, 7, 120.00, 0.00, '2025-01-11 21:22:30', '2025-01-11 21:22:30'),
(10, 4, 8, 120.00, 0.00, '2025-01-11 21:22:34', '2025-01-11 21:22:34'),
(11, 5, 5, 120.00, 0.00, '2025-01-11 21:22:40', '2025-01-11 21:22:40'),
(12, 5, 6, 120.00, 0.00, '2025-01-11 21:22:43', '2025-01-11 21:22:43'),
(13, 5, 7, 120.00, 0.00, '2025-01-11 21:22:47', '2025-01-11 21:22:47'),
(14, 5, 8, 120.00, 0.00, '2025-01-11 21:22:50', '2025-01-11 21:22:50'),
(15, 6, 5, 120.00, 0.00, '2025-01-11 21:23:05', '2025-01-11 21:23:05'),
(16, 6, 6, 120.00, 0.00, '2025-01-11 21:23:10', '2025-01-11 21:23:10'),
(17, 6, 7, 120.00, 0.00, '2025-01-11 21:23:14', '2025-01-11 21:23:14'),
(18, 6, 8, 120.00, 0.00, '2025-01-11 21:23:17', '2025-01-11 21:23:17'),
(19, 7, 5, 120.00, 0.00, '2025-01-11 21:23:23', '2025-01-11 21:23:23'),
(20, 7, 6, 120.00, 0.00, '2025-01-11 21:23:26', '2025-01-11 21:23:26'),
(21, 7, 7, 120.00, 0.00, '2025-01-11 21:23:29', '2025-01-11 21:23:29'),
(22, 7, 8, 120.00, 0.00, '2025-01-11 21:23:33', '2025-01-11 21:23:33'),
(23, 8, 5, 120.00, 0.00, '2025-01-11 21:23:39', '2025-01-11 21:23:39'),
(24, 8, 6, 120.00, 0.00, '2025-01-11 21:23:42', '2025-01-11 21:23:42'),
(25, 8, 7, 120.00, 0.00, '2025-01-11 21:23:46', '2025-01-11 21:23:46'),
(26, 8, 8, 120.00, 0.00, '2025-01-11 21:23:49', '2025-01-11 21:23:49'),
(27, 9, 5, 120.00, 0.00, '2025-01-11 21:23:54', '2025-01-11 21:23:54'),
(28, 9, 6, 120.00, 0.00, '2025-01-11 21:23:57', '2025-01-11 21:23:57'),
(29, 9, 7, 120.00, 0.00, '2025-01-11 21:24:00', '2025-01-11 21:24:00'),
(30, 9, 8, 120.00, 0.00, '2025-01-11 21:24:04', '2025-01-11 21:24:04'),
(31, 10, 5, 120.00, 0.00, '2025-01-11 21:24:11', '2025-01-11 21:24:11'),
(32, 10, 6, 120.00, 0.00, '2025-01-11 21:24:14', '2025-01-11 21:24:14'),
(33, 10, 7, 120.00, 0.00, '2025-01-11 21:24:17', '2025-01-11 21:24:17'),
(34, 10, 8, 120.00, 0.00, '2025-01-11 21:24:21', '2025-01-11 21:24:21'),
(35, 11, 5, 120.00, 0.00, '2025-01-11 21:24:27', '2025-01-11 21:24:27'),
(36, 11, 6, 120.00, 0.00, '2025-01-11 21:24:30', '2025-01-11 21:24:30'),
(37, 11, 7, 120.00, 0.00, '2025-01-11 21:24:33', '2025-01-11 21:24:33'),
(38, 11, 8, 120.00, 0.00, '2025-01-11 21:24:36', '2025-01-11 21:24:36'),
(39, 12, 5, 120.00, 0.00, '2025-01-11 21:24:47', '2025-01-11 21:24:47'),
(40, 12, 6, 120.00, 0.00, '2025-01-11 21:24:50', '2025-01-11 21:24:50'),
(41, 12, 7, 120.00, 0.00, '2025-01-11 21:24:53', '2025-01-11 21:24:53'),
(42, 12, 8, 120.00, 0.00, '2025-01-11 21:24:56', '2025-01-11 21:24:56'),
(43, 13, 5, 120.00, 0.00, '2025-01-11 21:25:02', '2025-01-11 21:25:02'),
(44, 13, 6, 120.00, 0.00, '2025-01-11 21:25:05', '2025-01-11 21:25:05'),
(45, 13, 7, 120.00, 0.00, '2025-01-11 21:25:08', '2025-01-11 21:25:08'),
(46, 13, 8, 120.00, 0.00, '2025-01-11 21:25:11', '2025-01-11 21:25:11'),
(47, 14, 5, 120.00, 0.00, '2025-01-11 21:25:17', '2025-01-11 21:25:17'),
(48, 14, 6, 120.00, 0.00, '2025-01-11 21:25:20', '2025-01-11 21:25:20'),
(49, 14, 7, 120.00, 0.00, '2025-01-11 21:25:24', '2025-01-11 21:25:24'),
(50, 14, 8, 120.00, 0.00, '2025-01-11 21:25:27', '2025-01-11 21:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

DROP TABLE IF EXISTS `tbl_wishlist`;
CREATE TABLE IF NOT EXISTS `tbl_wishlist` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_wishlist_user_id_foreign` (`user_id`),
  KEY `tbl_wishlist_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD CONSTRAINT `tbl_blog_create_by_foreign` FOREIGN KEY (`create_by`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_blog_comment`
--
ALTER TABLE `tbl_blog_comment`
  ADD CONSTRAINT `tbl_blog_comment_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `tbl_blog` (`id`),
  ADD CONSTRAINT `tbl_blog_comment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`),
  ADD CONSTRAINT `tbl_cart_varient_id_foreign` FOREIGN KEY (`varient_id`) REFERENCES `tbl_varient` (`id`);

--
-- Constraints for table `tbl_customer_feedback`
--
ALTER TABLE `tbl_customer_feedback`
  ADD CONSTRAINT `tbl_customer_feedback_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD CONSTRAINT `tbl_payment_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `tbl_payment_method` (`id`),
  ADD CONSTRAINT `tbl_payment_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `tbl_sale` (`id`);

--
-- Constraints for table `tbl_permission_role`
--
ALTER TABLE `tbl_permission_role`
  ADD CONSTRAINT `tbl_permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `tbl_permission` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD CONSTRAINT `tbl_products_base_unit_id_foreign` FOREIGN KEY (`base_unit_id`) REFERENCES `tbl_unit` (`id`),
  ADD CONSTRAINT `tbl_products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `tbl_brand` (`id`),
  ADD CONSTRAINT `tbl_products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `tbl_categorys` (`id`);

--
-- Constraints for table `tbl_role_user`
--
ALTER TABLE `tbl_role_user`
  ADD CONSTRAINT `tbl_role_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`id`);

--
-- Constraints for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD CONSTRAINT `tbl_sale_payment_method_id_foreign` FOREIGN KEY (`payment_method_id`) REFERENCES `tbl_payment_method` (`id`),
  ADD CONSTRAINT `tbl_sale_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);

--
-- Constraints for table `tbl_sale_items`
--
ALTER TABLE `tbl_sale_items`
  ADD CONSTRAINT `tbl_sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `tbl_sale` (`id`),
  ADD CONSTRAINT `tbl_sale_items_varient_id_foreign` FOREIGN KEY (`varient_id`) REFERENCES `tbl_varient` (`id`);

--
-- Constraints for table `tbl_varient`
--
ALTER TABLE `tbl_varient`
  ADD CONSTRAINT `tbl_varient_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`),
  ADD CONSTRAINT `tbl_varient_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `tbl_unit` (`id`);

--
-- Constraints for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD CONSTRAINT `tbl_wishlist_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `tbl_products` (`id`),
  ADD CONSTRAINT `tbl_wishlist_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
