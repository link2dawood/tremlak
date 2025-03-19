-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 12:05 PM
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
-- Database: `tremlak360`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartment_attribute`
--

CREATE TABLE `apartment_attribute` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `price` varchar(20) NOT NULL DEFAULT '0',
  `type` varchar(150) DEFAULT NULL,
  `conditionp` varchar(200) DEFAULT NULL,
  `grossm2` float DEFAULT 1,
  `netm2` float DEFAULT 0,
  `bed_rooms` int(11) DEFAULT 0,
  `living_rooms` int(11) DEFAULT 0,
  `bath_rooms` int(11) DEFAULT 0,
  `age` varchar(100) DEFAULT 'new',
  `status` varchar(30) DEFAULT NULL,
  `floors` int(11) DEFAULT 0,
  `building_floors` int(11) DEFAULT 1,
  `heating` varchar(100) DEFAULT NULL,
  `elevator` varchar(20) DEFAULT NULL,
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `mata_description` text DEFAULT NULL,
  `mata_tags` varchar(255) DEFAULT NULL,
  `mata_title` int(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_details`
--

CREATE TABLE `blog_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `lang` varchar(10) DEFAULT NULL,
  `lang_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `broker_offices`
--

CREATE TABLE `broker_offices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `certificate_no` varchar(255) DEFAULT NULL,
  `certificate_no_later` varchar(5) NOT NULL DEFAULT 'false',
  `image_path` varchar(255) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,0=block',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `building_attribute`
--

CREATE TABLE `building_attribute` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `price` varchar(20) NOT NULL DEFAULT '0',
  `conditionp` varchar(200) DEFAULT NULL,
  `grossm2` int(11) DEFAULT 1,
  `flats` int(11) DEFAULT 0,
  `shops` int(11) DEFAULT 0,
  `storage_rooms` int(11) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `floors` int(11) DEFAULT 1,
  `elevator` varchar(20) DEFAULT NULL,
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buy_credits`
--

CREATE TABLE `buy_credits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `payment_type` varchar(20) DEFAULT NULL,
  `fname` varchar(200) DEFAULT NULL,
  `lname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `tax_number` varchar(255) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `discount` int(11) NOT NULL DEFAULT 0,
  `currency` varchar(15) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,0=expire',
  `expire_date` varchar(150) DEFAULT NULL,
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `number` int(11) NOT NULL DEFAULT 0,
  `position` int(11) NOT NULL DEFAULT 0,
  `show_on_home` varchar(15) NOT NULL DEFAULT 'false',
  `image_path` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `create_date` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_packages`
--

CREATE TABLE `credit_packages` (
  `id` int(11) NOT NULL,
  `credits` float NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `color` varchar(20) NOT NULL DEFAULT '#e30a17',
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_package_details`
--

CREATE TABLE `credit_package_details` (
  `id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text_1` varchar(255) DEFAULT NULL,
  `text_2` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `lang` varchar(10) DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(10) UNSIGNED NOT NULL,
  `flags` varchar(200) DEFAULT NULL,
  `title` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `default` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `flags`, `title`, `code`, `symbol`, `rate`, `status`, `default`) VALUES
(2, 'flags/us.svg', 'US Doller', 'USD', '$', 1.00, 1, 1),
(3, 'flags/trky.svg', 'Turkish Lira', 'TRY', '₺', 32.26, 1, 2),
(4, 'uploads/flags/1719722394_europe.svg', 'Europe', 'EUR', '€', 0.93, 1, 2),
(5, 'flags/ksa.svg', 'Saudi Riyal', 'SAR', 'SAR', 3.75, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `description_templates`
--

CREATE TABLE `description_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_type_id` int(11) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `body` text NOT NULL,
  `lang` varchar(10) NOT NULL,
  `lang_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `create_date` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `town_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=block,1=active',
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_form`
--

CREATE TABLE `dynamic_form` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) DEFAULT NULL,
  `label` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `placeholder` mediumtext DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `feature_category_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features_category`
--

CREATE TABLE `features_category` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features_category_details`
--

CREATE TABLE `features_category_details` (
  `id` int(11) NOT NULL,
  `feature_category_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lang` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features_details`
--

CREATE TABLE `features_details` (
  `id` int(11) NOT NULL,
  `feature_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filled_dynamic_form`
--

CREATE TABLE `filled_dynamic_form` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `type` varchar(250) DEFAULT NULL,
  `placeholder` varchar(255) DEFAULT NULL,
  `value` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `house_attribute`
--

CREATE TABLE `house_attribute` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `price` varchar(20) NOT NULL DEFAULT '0',
  `conditionp` varchar(255) DEFAULT NULL,
  `grossm2` float DEFAULT 1,
  `netm2` float DEFAULT 1,
  `landm2` float DEFAULT 0,
  `bed_rooms` int(11) DEFAULT 0,
  `living_rooms` int(11) DEFAULT 0,
  `bath_rooms` int(11) DEFAULT 0,
  `age` varchar(100) DEFAULT NULL,
  `floors` int(11) DEFAULT 1,
  `garden` varchar(20) DEFAULT NULL,
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `land_attribute`
--

CREATE TABLE `land_attribute` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `price` varchar(20) NOT NULL DEFAULT '0',
  `pricem2` float NOT NULL DEFAULT 0,
  `type` varchar(150) DEFAULT NULL,
  `status` varchar(150) DEFAULT NULL,
  `landm2` float DEFAULT 1,
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(10) UNSIGNED NOT NULL,
  `flags` varchar(255) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `short_name` varchar(5) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `default` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `flags`, `name`, `short_name`, `status`, `default`) VALUES
(1, 'flags/us.svg', 'English', 'en', 1, '1'),
(2, 'flags/ksa.svg', 'عربى', 'ar', 1, '0'),
(4, 'flags/sp.svg', 'Français', 'fr', 1, '0'),
(8, 'flags/trky.svg', 'Türkçe', 'tr', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `mandatory` varchar(15) DEFAULT 'false',
  `show_in_filters` varchar(5) NOT NULL DEFAULT 'false',
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_details`
--

CREATE TABLE `location_details` (
  `id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `visitors` int(11) NOT NULL DEFAULT 0,
  `slug` varchar(300) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_type_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `town_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `latitude` varchar(30) DEFAULT NULL,
  `longitude` varchar(30) DEFAULT NULL,
  `outlook_ids` varchar(150) DEFAULT NULL,
  `location_ids` varchar(150) DEFAULT NULL,
  `location_values` text DEFAULT NULL,
  `currency_id` int(11) DEFAULT NULL,
  `price` int(15) NOT NULL DEFAULT 0,
  `price_in_usd` float DEFAULT 0,
  `duration` int(11) NOT NULL DEFAULT 0 COMMENT 'months',
  `highlight` varchar(5) NOT NULL DEFAULT 'false',
  `featured` int(11) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes\r\n',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,0=block',
  `admin_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active,0=Blocked',
  `expire_status` int(11) DEFAULT 0 COMMENT '0=no,1=expire',
  `preview_image` varchar(255) DEFAULT NULL,
  `expire_date` varchar(150) DEFAULT NULL,
  `create_date` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `image_path` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `create_date` varchar(30) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_types_details`
--

CREATE TABLE `property_types_details` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `lang` varchar(10) NOT NULL DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `phone_number` varchar(150) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `offer_image` varchar(250) DEFAULT NULL,
  `property_expiration_days` int(11) NOT NULL DEFAULT 30,
  `credit_expiration_days` int(11) NOT NULL DEFAULT 10,
  `create_ad` float NOT NULL DEFAULT 0,
  `renew_ad` float NOT NULL DEFAULT 0,
  `credits_one_month` float NOT NULL DEFAULT 0,
  `credits_two_month` float NOT NULL DEFAULT 0,
  `credits_three_month` float NOT NULL DEFAULT 0,
  `highlight_in_color` float NOT NULL DEFAULT 0,
  `free_images` int(11) NOT NULL DEFAULT 0,
  `credits_per_image` int(11) NOT NULL DEFAULT 0,
  `seo_description` text DEFAULT NULL,
  `seo_keywords` text DEFAULT NULL,
  `seo_author` varchar(255) DEFAULT NULL,
  `seo_canonical` varchar(250) DEFAULT NULL,
  `STRIPE_PUBLIC_KEY` text DEFAULT NULL,
  `STRIPE_SECRET_KEY` text DEFAULT NULL,
  `min_price` int(11) NOT NULL DEFAULT 1000,
  `max_price` int(11) NOT NULL DEFAULT 1000000000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `phone_number`, `email`, `logo`, `offer_image`, `property_expiration_days`, `credit_expiration_days`, `create_ad`, `renew_ad`, `credits_one_month`, `credits_two_month`, `credits_three_month`, `highlight_in_color`, `free_images`, `credits_per_image`, `seo_description`, `seo_keywords`, `seo_author`, `seo_canonical`, `STRIPE_PUBLIC_KEY`, `STRIPE_SECRET_KEY`, `min_price`, `max_price`) VALUES
(1, 'Tremlak360', '+447222555555', 'tremlak@gmail.com', 'uploads/logo/1708498300_header-logo2.svg', 'uploads/offer_image/1716470976_bbb.jpg', 30, 15, 1, 5, 10, 20, 25, 2, 2, 2, 'SEO Description', 'advanced search, agency, agent, classified, directory, house, listing, property, real estate, real estate agency, real estate agent, rental', 'SEO Author', 'SEO Canonical', 'pk_test_51LqECbKWjGX3QQm1gD4ucvUjLWBlGNu0RfEJzjZjlXu717LDIZn2ZjbC7pY4lqf1zd4WYK3QAYTMeiesvyKm3dbF00O2iRpiXL', 'sk_test_51LqECbKWjGX3QQm1xcpciJvGBC4V8Wl8CuPUEqskk4nUUmAnYPZYf7KMUo9Tlgi3JKETw8dN7e08X726tBR4FH9R00FhV6C9ar', 1000, 1000000000);

-- --------------------------------------------------------

--
-- Table structure for table `social_media_links`
--

CREATE TABLE `social_media_links` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL DEFAULT 'agent',
  `user_id` int(11) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(250) DEFAULT NULL,
  `twitter` varchar(250) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `town`
--

CREATE TABLE `town` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `currency_id` int(11) DEFAULT NULL,
  `create_date` varchar(50) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `balance` float NOT NULL DEFAULT 0,
  `user_type` int(11) NOT NULL DEFAULT 0 COMMENT '1=admin, 0=agent',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=block,1=active',
  `approve_profile` int(11) NOT NULL DEFAULT 0,
  `broker_office_id` int(11) DEFAULT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `whatsapp` varchar(150) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `image_path` varchar(150) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `balance`, `user_type`, `status`, `approve_profile`, `broker_office_id`, `fname`, `lname`, `email`, `phone`, `whatsapp`, `website`, `image_path`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 138, 1, 1, 1, 1, 'admin', 'swrer', 'admin@gmail.com', '03421674008', '+923421674008', NULL, 'uploads/profile/1717682280_2345.jpg', '2024-03-19 08:02:32', '$2y$12$KToZboBoxlfqIijcqHOY7.v99c8/qm3LYYvhdPlhiSRUT8ZtnPAE6', 'ifQuW0orh3oIiJqqkYF0tmZvDuleNcO2Xs0tzB7npvb4ca5i2e4Qa18hWTQo', NULL, '2024-06-06 13:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `use_credits`
--

CREATE TABLE `use_credits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `amount` float NOT NULL DEFAULT 0,
  `currency_id` int(11) DEFAULT NULL,
  `create_date` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `villa_attribute`
--

CREATE TABLE `villa_attribute` (
  `id` int(11) NOT NULL,
  `property_type_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `price` varchar(20) NOT NULL DEFAULT '0',
  `conditionp` varchar(200) DEFAULT NULL,
  `grossm2` float DEFAULT 1,
  `netm2` float DEFAULT 0,
  `landm2` float DEFAULT 1,
  `bed_rooms` int(11) DEFAULT 0,
  `living_rooms` int(11) DEFAULT 0,
  `bath_rooms` int(11) DEFAULT 0,
  `age` varchar(100) DEFAULT NULL,
  `floors` int(11) DEFAULT 1,
  `garden` varchar(20) DEFAULT NULL,
  `create_date` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartment_attribute`
--
ALTER TABLE `apartment_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_details`
--
ALTER TABLE `blog_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_fk` (`blog_id`);

--
-- Indexes for table `broker_offices`
--
ALTER TABLE `broker_offices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `broker_offices_city_fk` (`city_id`);

--
-- Indexes for table `building_attribute`
--
ALTER TABLE `building_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_credits`
--
ALTER TABLE `buy_credits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buy_credits_user_id_fk` (`user_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_packages`
--
ALTER TABLE `credit_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_package_details`
--
ALTER TABLE `credit_package_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currency_code_unique` (`code`);

--
-- Indexes for table `description_templates`
--
ALTER TABLE `description_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id_fk` (`package_id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `district_city_fk` (`city_id`),
  ADD KEY `districts_town_id_fk` (`town_id`);

--
-- Indexes for table `dynamic_form`
--
ALTER TABLE `dynamic_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dynamic_form_property_type_fk` (`property_type_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_category_id_fk` (`feature_category_id`);

--
-- Indexes for table `features_category`
--
ALTER TABLE `features_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features_category_details`
--
ALTER TABLE `features_category_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_category_id_details` (`feature_category_id`);

--
-- Indexes for table `features_details`
--
ALTER TABLE `features_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feature_id_details_fk` (`feature_id`);

--
-- Indexes for table `filled_dynamic_form`
--
ALTER TABLE `filled_dynamic_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filled_dynamic_form_property_fk` (`property_id`);

--
-- Indexes for table `house_attribute`
--
ALTER TABLE `house_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_attribute`
--
ALTER TABLE `land_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_details`
--
ALTER TABLE `location_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id_fk` (`location_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_fk` (`user_id`);

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
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_user_id_fk` (`user_id`),
  ADD KEY `property_type_id_fk` (`property_type_id`),
  ADD KEY `city_id_fk` (`city_id`),
  ADD KEY `district_id_fk` (`district_id`),
  ADD KEY `town_id_fk` (`town_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id_fk` (`property_id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types_details`
--
ALTER TABLE `property_types_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_type_id_fk_lang` (`property_type_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media_links`
--
ALTER TABLE `social_media_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_fk` (`user_id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `town`
--
ALTER TABLE `town`
  ADD PRIMARY KEY (`id`),
  ADD KEY `town_city_id_fk` (`city_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `user_broker_office_id` (`broker_office_id`);

--
-- Indexes for table `use_credits`
--
ALTER TABLE `use_credits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `villa_attribute`
--
ALTER TABLE `villa_attribute`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartment_attribute`
--
ALTER TABLE `apartment_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_details`
--
ALTER TABLE `blog_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `broker_offices`
--
ALTER TABLE `broker_offices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `building_attribute`
--
ALTER TABLE `building_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buy_credits`
--
ALTER TABLE `buy_credits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `credit_packages`
--
ALTER TABLE `credit_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_package_details`
--
ALTER TABLE `credit_package_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `description_templates`
--
ALTER TABLE `description_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dynamic_form`
--
ALTER TABLE `dynamic_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features_category`
--
ALTER TABLE `features_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features_category_details`
--
ALTER TABLE `features_category_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features_details`
--
ALTER TABLE `features_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filled_dynamic_form`
--
ALTER TABLE `filled_dynamic_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `house_attribute`
--
ALTER TABLE `house_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `land_attribute`
--
ALTER TABLE `land_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location_details`
--
ALTER TABLE `location_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property_types_details`
--
ALTER TABLE `property_types_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media_links`
--
ALTER TABLE `social_media_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `use_credits`
--
ALTER TABLE `use_credits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `villa_attribute`
--
ALTER TABLE `villa_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blog_details`
--
ALTER TABLE `blog_details`
  ADD CONSTRAINT `blogs_fk` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `broker_offices`
--
ALTER TABLE `broker_offices`
  ADD CONSTRAINT `broker_offices_city_fk` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `buy_credits`
--
ALTER TABLE `buy_credits`
  ADD CONSTRAINT `buy_credits_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `package_id_fk` FOREIGN KEY (`package_id`) REFERENCES `credit_packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `district_city_fk` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `districts_town_id_fk` FOREIGN KEY (`town_id`) REFERENCES `town` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dynamic_form`
--
ALTER TABLE `dynamic_form`
  ADD CONSTRAINT `dynamic_form_property_type_fk` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `features`
--
ALTER TABLE `features`
  ADD CONSTRAINT `feature_category_id_fk` FOREIGN KEY (`feature_category_id`) REFERENCES `features_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `features_category_details`
--
ALTER TABLE `features_category_details`
  ADD CONSTRAINT `feature_category_id_details` FOREIGN KEY (`feature_category_id`) REFERENCES `features_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `features_details`
--
ALTER TABLE `features_details`
  ADD CONSTRAINT `feature_id_details_fk` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `outlook_id_fk` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `filled_dynamic_form`
--
ALTER TABLE `filled_dynamic_form`
  ADD CONSTRAINT `filled_dynamic_form_property_fk` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `location_details`
--
ALTER TABLE `location_details`
  ADD CONSTRAINT `location_id_fk` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `city_id_fk` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `district_id_fk` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `properties_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_type_id_fk` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `town_id_fk` FOREIGN KEY (`town_id`) REFERENCES `town` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_id_fk` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_types_details`
--
ALTER TABLE `property_types_details`
  ADD CONSTRAINT `property_type_id_fk_lang` FOREIGN KEY (`property_type_id`) REFERENCES `property_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `social_media_links`
--
ALTER TABLE `social_media_links`
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `town`
--
ALTER TABLE `town`
  ADD CONSTRAINT `town_city_id_fk` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
