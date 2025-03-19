-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 09, 2024 at 10:33 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u322103768_tremlak360`
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

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `image_path`, `slug`, `mata_description`, `mata_tags`, `mata_title`, `status`, `create_date`) VALUES
(4, '', 'TREMLAK360-Blog-4', NULL, NULL, NULL, 1, '2024-02-23');

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

--
-- Dumping data for table `blog_details`
--

INSERT INTO `blog_details` (`id`, `blog_id`, `subject`, `body`, `lang`, `lang_id`) VALUES
(1, 4, 'Property and Economic Predictions for Turkey in 2024', '<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Exploring the upcoming trends and expectations in Turkey\'s property and economic sectors for the year 2024, through Trem Global\'s expert lens.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; outline: none !important; font-weight: bolder;\">Sustained Growth in Real Estate</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The real estate sector in Turkey has been on an upward trajectory, a trend that\'s predicted to persist into 2024. Key urban centers are witnessing a surge in development projects, attracting heightened interest from both local and international investors. Cities such secondary markets such as Istanbul, Antalya, and Ankara are particularly in the spotlight for their potential high-yield properties for investments in residential and commercial properties.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; outline: none !important; font-weight: bolder;\">Foreign Investment Continues to Favor Turkey</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Turkey\'s appeal to foreign investors remains strong, bolstered by its strategic geographical position and inviting investment climate. The real estate market, in particular, is expected to keep drawing international attention in 2024. Factors like the property in Turkey\'s burgeoning tourism industry and progressive economic and tax policies are key to this sustained interest from buyers.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; outline: none !important; font-weight: bolder;\">Positive Impact of Economic Expansion on Property Market</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The anticipated economic expansion in Turkey is set to benefit the city property market in 2024. This economic upturn is poised to unlock new investment avenues, enhancing the appeal of investing in the city in both the residential and commercial property sectors.</p>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important; text-align: center;\"><iframe src=\"//www.youtube.com/embed/1L2PIyGczCA\" width=\"560\" height=\"314\" allowfullscreen=\"allowfullscreen\"></iframe></p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; outline: none !important; font-weight: bolder;\">Impact of Technological Innovation on Real Estate</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The advance of technology is reshaping the world and whole real estate investment and apartment construction landscape. Innovations like smart housing, eco-friendly building practices, and emphasis on sustainable developments are set to take center stage in 2024, influencing both investor decisions and consumer preferences.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; outline: none !important; font-weight: bolder;\">Prime Investment Locations in Turkey</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Heading into 2024, the prime locales for property investment in Turkey include Istanbul, Antalya, Izmir, Bursa, and Ankara. These cities stand out due to their diverse service offerings, improving infrastructures, and robust investment potentials, making them hotspots for property investments.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; outline: none !important; font-weight: bolder;\">Opportunities in Immigration and Investment</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Turkey presents a variety of appealing options for foreign nationals looking to reside and invest in the country. The nation\'s immigration and investment programs are expected to be even more attractive in 2024, drawing in more professionals and a global audience.</p>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">&nbsp;</p>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important; text-align: center;\"><img src=\"../storage/uploads/1708669744newHero.png\" alt=\"\" width=\"1920\" height=\"1000\" /></p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; outline: none !important; font-weight: bolder;\">Conclusion</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Looking ahead to 2024, the real estate in Turkey\'s property market shows great promise. Trem Global is committed to keeping our clients, both owners and investors well-informed by tracking and relaying the latest industry developments.</p>', 'en', 1),
(2, 4, 'Subject', '<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">استكشاف الاتجاهات والتوقعات القادمة في القطاعين العقاري والاقتصادي في تركيا لعام 2024، من خلال عدسة خبراء Trem Global.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">النمو المستدام في القطاع العقاري</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The real estate sector in Turkey has been on an upward trajectory, a trend that\'s predicted to persist into 2024. Key urban centers are witnessing a surge in development projects, attracting heightened interest from both local and international investors. Cities such secondary markets such as Istanbul, Antalya, and Ankara are particularly in the spotlight for their potential high-yield properties for investments in residential and commercial properties.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Foreign Investment Continues to Favor Turkey</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Turkey\'s appeal to foreign investors remains strong, bolstered by its strategic geographical position and inviting investment climate. The real estate market, in particular, is expected to keep drawing international attention in 2024. Factors like the property in Turkey\'s burgeoning tourism industry and progressive economic and tax policies are key to this sustained interest from buyers.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Positive Impact of Economic Expansion on Property Market</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The anticipated economic expansion in Turkey is set to benefit the city property market in 2024. This economic upturn is poised to unlock new investment avenues, enhancing the appeal of investing in the city in both the residential and commercial property sectors.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Impact of Technological Innovation on Real Estate</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The advance of technology is reshaping the world and whole real estate investment and apartment construction landscape. Innovations like smart housing, eco-friendly building practices, and emphasis on sustainable developments are set to take center stage in 2024, influencing both investor decisions and consumer preferences.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Prime Investment Locations in Turkey</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Heading into 2024, the prime locales for property investment in Turkey include Istanbul, Antalya, Izmir, Bursa, and Ankara. These cities stand out due to their diverse service offerings, improving infrastructures, and robust investment potentials, making them hotspots for property investments.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Opportunities in Immigration and Investment</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Turkey presents a variety of appealing options for foreign nationals looking to reside and invest in the country. The nation\'s immigration and investment programs are expected to be even more attractive in 2024, drawing in more professionals and a global audience.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Conclusion</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Looking ahead to 2024, the real estate in Turkey\'s property market shows great promise. Trem Global is committed to keeping our clients, both owners and investors well-informed by tracking and relaying the latest industry developments.</p>', 'ar', 2),
(3, 4, 'Subject', '<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Exploring the upcoming trends and expectations in Turkey\'s property and economic sectors for the year 2024, through Trem Global\'s expert lens.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Sustained Growth in Real Estate</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The real estate sector in Turkey has been on an upward trajectory, a trend that\'s predicted to persist into 2024. Key urban centers are witnessing a surge in development projects, attracting heightened interest from both local and international investors. Cities such secondary markets such as Istanbul, Antalya, and Ankara are particularly in the spotlight for their potential high-yield properties for investments in residential and commercial properties.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Foreign Investment Continues to Favor Turkey</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Turkey\'s appeal to foreign investors remains strong, bolstered by its strategic geographical position and inviting investment climate. The real estate market, in particular, is expected to keep drawing international attention in 2024. Factors like the property in Turkey\'s burgeoning tourism industry and progressive economic and tax policies are key to this sustained interest from buyers.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Positive Impact of Economic Expansion on Property Market</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The anticipated economic expansion in Turkey is set to benefit the city property market in 2024. This economic upturn is poised to unlock new investment avenues, enhancing the appeal of investing in the city in both the residential and commercial property sectors.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Impact of Technological Innovation on Real Estate</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The advance of technology is reshaping the world and whole real estate investment and apartment construction landscape. Innovations like smart housing, eco-friendly building practices, and emphasis on sustainable developments are set to take center stage in 2024, influencing both investor decisions and consumer preferences.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Prime Investment Locations in Turkey</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Heading into 2024, the prime locales for property investment in Turkey include Istanbul, Antalya, Izmir, Bursa, and Ankara. These cities stand out due to their diverse service offerings, improving infrastructures, and robust investment potentials, making them hotspots for property investments.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Opportunities in Immigration and Investment</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Turkey presents a variety of appealing options for foreign nationals looking to reside and invest in the country. The nation\'s immigration and investment programs are expected to be even more attractive in 2024, drawing in more professionals and a global audience.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Conclusion</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Looking ahead to 2024, the real estate in Turkey\'s property market shows great promise. Trem Global is committed to keeping our clients, both owners and investors well-informed by tracking and relaying the latest industry developments.</p>', 'fr', 4),
(4, 4, 'Subject', '<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Exploring the upcoming trends and expectations in Turkey\'s property and economic sectors for the year 2024, through Trem Global\'s expert lens.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Sustained Growth in Real Estate</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The real estate sector in Turkey has been on an upward trajectory, a trend that\'s predicted to persist into 2024. Key urban centers are witnessing a surge in development projects, attracting heightened interest from both local and international investors. Cities such secondary markets such as Istanbul, Antalya, and Ankara are particularly in the spotlight for their potential high-yield properties for investments in residential and commercial properties.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Foreign Investment Continues to Favor Turkey</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Turkey\'s appeal to foreign investors remains strong, bolstered by its strategic geographical position and inviting investment climate. The real estate market, in particular, is expected to keep drawing international attention in 2024. Factors like the property in Turkey\'s burgeoning tourism industry and progressive economic and tax policies are key to this sustained interest from buyers.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Positive Impact of Economic Expansion on Property Market</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The anticipated economic expansion in Turkey is set to benefit the city property market in 2024. This economic upturn is poised to unlock new investment avenues, enhancing the appeal of investing in the city in both the residential and commercial property sectors.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Impact of Technological Innovation on Real Estate</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">The advance of technology is reshaping the world and whole real estate investment and apartment construction landscape. Innovations like smart housing, eco-friendly building practices, and emphasis on sustainable developments are set to take center stage in 2024, influencing both investor decisions and consumer preferences.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Prime Investment Locations in Turkey</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Heading into 2024, the prime locales for property investment in Turkey include Istanbul, Antalya, Izmir, Bursa, and Ankara. These cities stand out due to their diverse service offerings, improving infrastructures, and robust investment potentials, making them hotspots for property investments.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Opportunities in Immigration and Investment</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Turkey presents a variety of appealing options for foreign nationals looking to reside and invest in the country. The nation\'s immigration and investment programs are expected to be even more attractive in 2024, drawing in more professionals and a global audience.</p>\r\n<h3 style=\"box-sizing: border-box; font-family: Poppins, sans-serif; font-weight: 500; margin-top: 0px; margin-bottom: 0.5rem; line-height: 1.2; font-size: 1.75rem; letter-spacing: 0.5px; outline: none !important;\"><span style=\"box-sizing: border-box; font-weight: bolder; outline: none !important;\">Conclusion</span></h3>\r\n<p style=\"box-sizing: border-box; font-family: Poppins, sans-serif; margin-top: 0px; margin-bottom: 1rem; font-size: 16px; letter-spacing: 0.5px; outline: none !important;\">Looking ahead to 2024, the real estate in Turkey\'s property market shows great promise. Trem Global is committed to keeping our clients, both owners and investors well-informed by tracking and relaying the latest industry developments.</p>', 'tr', 8);

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

--
-- Dumping data for table `broker_offices`
--

INSERT INTO `broker_offices` (`id`, `user_id`, `title`, `certificate_no`, `certificate_no_later`, `image_path`, `city_id`, `status`, `create_date`) VALUES
(1, NULL, 'GIFTarsg', '123456', 'false', 'uploads/BrokerOffice/1719833143_Screenshot 2024-07-01 at 4.24.36 PM.png', 2, 1, '2024-05-14 11:12:53'),
(2, NULL, 'aaa', '123456789', 'false', '', 2, 1, '2024-05-22 16:21:01');

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

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title`, `number`, `position`, `show_on_home`, `image_path`, `status`) VALUES
(1, 'Lahore', 1122, 35, 'true', 'uploads/city/1715089850_city-listing-3.jpg', 1),
(2, 'Gujranwala', 2233, 37, 'true', 'uploads/city/1715089881_city-listing-4.jpg', 1);

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

--
-- Dumping data for table `credit_packages`
--

INSERT INTO `credit_packages` (`id`, `credits`, `price`, `status`, `color`, `create_date`) VALUES
(1, 10, 100, 1, '#e30a17', '07-05-2024'),
(2, 20, 200, 1, '#0923e1', '07-05-2024'),
(4, 20, 5, 1, '#84de17', '22-06-2024');

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

--
-- Dumping data for table `credit_package_details`
--

INSERT INTO `credit_package_details` (`id`, `package_id`, `title`, `text_1`, `text_2`, `description`, `lang`) VALUES
(17, 3, 'xxx', NULL, NULL, 'aaa', 'en'),
(18, 3, 'xxx', NULL, NULL, 'aaa', 'ar'),
(19, 3, 'xxx', NULL, NULL, 'aaa', 'fr'),
(20, 3, 'xxx', NULL, NULL, 'aaa', 'tr'),
(29, 1, 'Basic', 'text 1 content', 'text 2 content', 'Basic/10 TL', 'en'),
(30, 1, 'Basic', 'text 1 content', 'text 2 content', 'Basic/10 TL', 'ar'),
(31, 1, 'Basic', 'text 1 content', 'text 2 content', 'Basic/10 TL', 'fr'),
(32, 1, 'Basic', 'text 1 content', 'text 2 content', 'Basic/10 TL', 'tr'),
(33, 2, 'Standard', 'text 1 content2', 'text 2 content2', 'Standard/20 TL', 'en'),
(34, 2, 'Standard', 'text 1 content2', 'text 2 content2', 'Standard/20 TL', 'ar'),
(35, 2, 'Standard', 'text 1 content2', 'text 2 content2', 'Basic/10 TL', 'fr'),
(36, 2, 'Standard', 'text 1 content2', 'text 2 content2', 'Standard/20 TL', 'tr'),
(37, 4, 'Premium', 'premium text 1', 'premium text 2', 'TL/20', 'en'),
(38, 4, 'Premium', 'premium text 1', 'premium text 2', 'TL/20', 'ar'),
(39, 4, 'Premium', 'premium text 1', 'premium text 2', 'TL/20', 'fr'),
(40, 4, 'Premium', 'premium text 1', 'premium text 2', 'TL/20', 'tr');

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
(4, 'uploads/flags/1719043561_europe.svg', 'Europe', 'EUR', '€', 0.93, 1, 2),
(5, 'flags/ksa.svg', 'Saudi Riyal', 'SAR', 'SAR', 3.75, 1, 0),
(6, 'uploads/flags/1719043545_kwt.png', 'Kuwait Dinar', 'KWD', 'KWD', 0.31, 1, 0);

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

--
-- Dumping data for table `description_templates`
--

INSERT INTO `description_templates` (`id`, `property_type_id`, `title`, `body`, `lang`, `lang_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Apartment | { Air_Conditioner :: Air Conditioner } | { Indoor::Indoor} | { Outdoor::Outdoor}', '🏠 Apartment Description:  { Air_Conditioner:\"asdasdasdasd\" }\r\n\r\nWelcome to our cozy and modern apartment, designed to offer you comfort and convenience in every corner.\r\n\r\n🛏️ Bedrooms: Enjoy peaceful nights in our spacious and well-appointed bedrooms, perfect for relaxation and rejuvenation.\r\n\r\n🚿 Bathrooms: Immerse yourself in luxury with our sleek and elegant bathrooms, featuring contemporary fixtures and soothing amenities.\r\n\r\n🍳 Kitchen: Unleash your inner chef in our fully-equipped kitchen, complete with state-of-the-art appliances and ample counter space for culinary creations.\r\n\r\n🛋️ Living Area: Relax and unwind in our stylish living area, thoughtfully furnished for both relaxation and entertainment.\r\n\r\n🌳 Balcony: Step outside to our private balcony and soak in panoramic views of the surrounding scenery, providing a serene retreat from the hustle and bustle of city life.\r\n\r\n🏊 Pool: Dive into relaxation at our refreshing pool, where you can bask in the sun or take a refreshing swim to invigorate your senses.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our well-equipped fitness center, featuring state-of-the-art equipment for all your workout needs.\r\n\r\n🅿️ Parking: Enjoy the convenience of hassle-free parking with our secure and spacious parking facilities, ensuring peace of mind for you and your vehicle.\r\n\r\n🔒 Security: Rest easy knowing that your safety is our top priority, with 24/7 security surveillance and secure access control systems in place.\r\n\r\n🌆 Location: Nestled in a vibrant neighborhood, our apartment offers easy access to shopping, dining, and entertainment destinations, ensuring a dynamic and fulfilling lifestyle for our residents.', 'en', 1, '2024-04-29 12:09:53', '2024-04-29 12:09:53'),
(2, 1, 'Apartment', '🏠 Apartment Description:\r\n\r\nWelcome to our cozy and modern apartment, designed to offer you comfort and convenience in every corner.\r\n\r\n🛏️ Bedrooms: Enjoy peaceful nights in our spacious and well-appointed bedrooms, perfect for relaxation and rejuvenation.\r\n\r\n🚿 Bathrooms: Immerse yourself in luxury with our sleek and elegant bathrooms, featuring contemporary fixtures and soothing amenities.\r\n\r\n🍳 Kitchen: Unleash your inner chef in our fully-equipped kitchen, complete with state-of-the-art appliances and ample counter space for culinary creations.\r\n\r\n🛋️ Living Area: Relax and unwind in our stylish living area, thoughtfully furnished for both relaxation and entertainment.\r\n\r\n🌳 Balcony: Step outside to our private balcony and soak in panoramic views of the surrounding scenery, providing a serene retreat from the hustle and bustle of city life.\r\n\r\n🏊 Pool: Dive into relaxation at our refreshing pool, where you can bask in the sun or take a refreshing swim to invigorate your senses.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our well-equipped fitness center, featuring state-of-the-art equipment for all your workout needs.\r\n\r\n🅿️ Parking: Enjoy the convenience of hassle-free parking with our secure and spacious parking facilities, ensuring peace of mind for you and your vehicle.\r\n\r\n🔒 Security: Rest easy knowing that your safety is our top priority, with 24/7 security surveillance and secure access control systems in place.\r\n\r\n🌆 Location: Nestled in a vibrant neighborhood, our apartment offers easy access to shopping, dining, and entertainment destinations, ensuring a dynamic and fulfilling lifestyle for our residents.', 'ar', 2, '2024-04-29 12:09:53', '2024-04-29 12:09:53'),
(3, 1, 'Apartment', '🏠 Apartment Description:\r\n\r\nWelcome to our cozy and modern apartment, designed to offer you comfort and convenience in every corner.\r\n\r\n🛏️ Bedrooms: Enjoy peaceful nights in our spacious and well-appointed bedrooms, perfect for relaxation and rejuvenation.\r\n\r\n🚿 Bathrooms: Immerse yourself in luxury with our sleek and elegant bathrooms, featuring contemporary fixtures and soothing amenities.\r\n\r\n🍳 Kitchen: Unleash your inner chef in our fully-equipped kitchen, complete with state-of-the-art appliances and ample counter space for culinary creations.\r\n\r\n🛋️ Living Area: Relax and unwind in our stylish living area, thoughtfully furnished for both relaxation and entertainment.\r\n\r\n🌳 Balcony: Step outside to our private balcony and soak in panoramic views of the surrounding scenery, providing a serene retreat from the hustle and bustle of city life.\r\n\r\n🏊 Pool: Dive into relaxation at our refreshing pool, where you can bask in the sun or take a refreshing swim to invigorate your senses.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our well-equipped fitness center, featuring state-of-the-art equipment for all your workout needs.\r\n\r\n🅿️ Parking: Enjoy the convenience of hassle-free parking with our secure and spacious parking facilities, ensuring peace of mind for you and your vehicle.\r\n\r\n🔒 Security: Rest easy knowing that your safety is our top priority, with 24/7 security surveillance and secure access control systems in place.\r\n\r\n🌆 Location: Nestled in a vibrant neighborhood, our apartment offers easy access to shopping, dining, and entertainment destinations, ensuring a dynamic and fulfilling lifestyle for our residents.', 'fr', 4, '2024-04-29 12:09:53', '2024-04-29 12:09:53'),
(4, 1, 'Apartment', '🏠 Apartment Description:\r\n\r\nWelcome to our cozy and modern apartment, designed to offer you comfort and convenience in every corner.\r\n\r\n🛏️ Bedrooms: Enjoy peaceful nights in our spacious and well-appointed bedrooms, perfect for relaxation and rejuvenation.\r\n\r\n🚿 Bathrooms: Immerse yourself in luxury with our sleek and elegant bathrooms, featuring contemporary fixtures and soothing amenities.\r\n\r\n🍳 Kitchen: Unleash your inner chef in our fully-equipped kitchen, complete with state-of-the-art appliances and ample counter space for culinary creations.\r\n\r\n🛋️ Living Area: Relax and unwind in our stylish living area, thoughtfully furnished for both relaxation and entertainment.\r\n\r\n🌳 Balcony: Step outside to our private balcony and soak in panoramic views of the surrounding scenery, providing a serene retreat from the hustle and bustle of city life.\r\n\r\n🏊 Pool: Dive into relaxation at our refreshing pool, where you can bask in the sun or take a refreshing swim to invigorate your senses.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our well-equipped fitness center, featuring state-of-the-art equipment for all your workout needs.\r\n\r\n🅿️ Parking: Enjoy the convenience of hassle-free parking with our secure and spacious parking facilities, ensuring peace of mind for you and your vehicle.\r\n\r\n🔒 Security: Rest easy knowing that your safety is our top priority, with 24/7 security surveillance and secure access control systems in place.\r\n\r\n🌆 Location: Nestled in a vibrant neighborhood, our apartment offers easy access to shopping, dining, and entertainment destinations, ensuring a dynamic and fulfilling lifestyle for our residents.', 'tr', 8, '2024-04-29 12:09:53', '2024-04-29 12:09:53'),
(5, 2, 'Villa', '🏡 Villa Description:\r\n\r\nWelcome to our luxurious and spacious villa, where elegance meets comfort, offering an unparalleled living experience.\r\n\r\n🛏️ Bedrooms: Indulge in opulence and tranquility within our lavish bedrooms, meticulously designed to provide utmost comfort and privacy.\r\n\r\n🚿 Bathrooms: Experience the epitome of luxury in our exquisite bathrooms, adorned with premium fixtures and indulgent amenities for a spa-like retreat.\r\n\r\n🍽️ Dining Area: Dine in style and sophistication in our elegant dining area, perfect for hosting memorable gatherings and intimate dinners with loved ones.\r\n\r\n🍳 Kitchen: Unleash your culinary creativity in our gourmet kitchen, equipped with high-end appliances and ample space for culinary endeavors.\r\n\r\n🛋️ Living Space: Relax and unwind in our expansive living space, featuring tasteful furnishings and panoramic views, creating a haven of relaxation and entertainment.\r\n\r\n🌳 Outdoor Oasis: Step into our enchanting outdoor oasis, where lush gardens, serene patios, and refreshing pools invite you to bask in the beauty of nature and enjoy alfresco living at its finest.\r\n\r\n🏊 Pool: Dive into luxury and leisure at our pristine pool, offering a refreshing escape from the tropical heat and a perfect spot for leisurely swims and sun-soaked relaxation.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our state-of-the-art fitness center, complete with modern equipment and inspiring views, ensuring a fulfilling workout experience.\r\n\r\n🅿️ Parking: Enjoy the convenience of ample parking space within our secure compound, providing peace of mind for you and your vehicles.\r\n\r\n🔒 Security: Your safety is our priority, with 24/7 security surveillance and gated access, ensuring a secure and tranquil environment for you and your family.\r\n\r\n🌴 Location: Nestled in a prestigious neighborhood, our villa offers unrivaled access to pristine beaches, world-class dining, and exclusive entertainment, promising a lifestyle of luxury and leisure.', 'en', 1, '2024-04-29 12:11:06', '2024-04-29 12:11:06'),
(6, 2, 'Villa', '🏡 Villa Description:\r\n\r\nWelcome to our luxurious and spacious villa, where elegance meets comfort, offering an unparalleled living experience.\r\n\r\n🛏️ Bedrooms: Indulge in opulence and tranquility within our lavish bedrooms, meticulously designed to provide utmost comfort and privacy.\r\n\r\n🚿 Bathrooms: Experience the epitome of luxury in our exquisite bathrooms, adorned with premium fixtures and indulgent amenities for a spa-like retreat.\r\n\r\n🍽️ Dining Area: Dine in style and sophistication in our elegant dining area, perfect for hosting memorable gatherings and intimate dinners with loved ones.\r\n\r\n🍳 Kitchen: Unleash your culinary creativity in our gourmet kitchen, equipped with high-end appliances and ample space for culinary endeavors.\r\n\r\n🛋️ Living Space: Relax and unwind in our expansive living space, featuring tasteful furnishings and panoramic views, creating a haven of relaxation and entertainment.\r\n\r\n🌳 Outdoor Oasis: Step into our enchanting outdoor oasis, where lush gardens, serene patios, and refreshing pools invite you to bask in the beauty of nature and enjoy alfresco living at its finest.\r\n\r\n🏊 Pool: Dive into luxury and leisure at our pristine pool, offering a refreshing escape from the tropical heat and a perfect spot for leisurely swims and sun-soaked relaxation.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our state-of-the-art fitness center, complete with modern equipment and inspiring views, ensuring a fulfilling workout experience.\r\n\r\n🅿️ Parking: Enjoy the convenience of ample parking space within our secure compound, providing peace of mind for you and your vehicles.\r\n\r\n🔒 Security: Your safety is our priority, with 24/7 security surveillance and gated access, ensuring a secure and tranquil environment for you and your family.\r\n\r\n🌴 Location: Nestled in a prestigious neighborhood, our villa offers unrivaled access to pristine beaches, world-class dining, and exclusive entertainment, promising a lifestyle of luxury and leisure.', 'ar', 2, '2024-04-29 12:11:06', '2024-04-29 12:11:06'),
(7, 2, 'Villa', '🏡 Villa Description:\r\n\r\nWelcome to our luxurious and spacious villa, where elegance meets comfort, offering an unparalleled living experience.\r\n\r\n🛏️ Bedrooms: Indulge in opulence and tranquility within our lavish bedrooms, meticulously designed to provide utmost comfort and privacy.\r\n\r\n🚿 Bathrooms: Experience the epitome of luxury in our exquisite bathrooms, adorned with premium fixtures and indulgent amenities for a spa-like retreat.\r\n\r\n🍽️ Dining Area: Dine in style and sophistication in our elegant dining area, perfect for hosting memorable gatherings and intimate dinners with loved ones.\r\n\r\n🍳 Kitchen: Unleash your culinary creativity in our gourmet kitchen, equipped with high-end appliances and ample space for culinary endeavors.\r\n\r\n🛋️ Living Space: Relax and unwind in our expansive living space, featuring tasteful furnishings and panoramic views, creating a haven of relaxation and entertainment.\r\n\r\n🌳 Outdoor Oasis: Step into our enchanting outdoor oasis, where lush gardens, serene patios, and refreshing pools invite you to bask in the beauty of nature and enjoy alfresco living at its finest.\r\n\r\n🏊 Pool: Dive into luxury and leisure at our pristine pool, offering a refreshing escape from the tropical heat and a perfect spot for leisurely swims and sun-soaked relaxation.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our state-of-the-art fitness center, complete with modern equipment and inspiring views, ensuring a fulfilling workout experience.\r\n\r\n🅿️ Parking: Enjoy the convenience of ample parking space within our secure compound, providing peace of mind for you and your vehicles.\r\n\r\n🔒 Security: Your safety is our priority, with 24/7 security surveillance and gated access, ensuring a secure and tranquil environment for you and your family.\r\n\r\n🌴 Location: Nestled in a prestigious neighborhood, our villa offers unrivaled access to pristine beaches, world-class dining, and exclusive entertainment, promising a lifestyle of luxury and leisure.', 'fr', 4, '2024-04-29 12:11:06', '2024-04-29 12:11:06'),
(8, 2, 'Villa', '🏡 Villa Description:\r\n\r\nWelcome to our luxurious and spacious villa, where elegance meets comfort, offering an unparalleled living experience.\r\n\r\n🛏️ Bedrooms: Indulge in opulence and tranquility within our lavish bedrooms, meticulously designed to provide utmost comfort and privacy.\r\n\r\n🚿 Bathrooms: Experience the epitome of luxury in our exquisite bathrooms, adorned with premium fixtures and indulgent amenities for a spa-like retreat.\r\n\r\n🍽️ Dining Area: Dine in style and sophistication in our elegant dining area, perfect for hosting memorable gatherings and intimate dinners with loved ones.\r\n\r\n🍳 Kitchen: Unleash your culinary creativity in our gourmet kitchen, equipped with high-end appliances and ample space for culinary endeavors.\r\n\r\n🛋️ Living Space: Relax and unwind in our expansive living space, featuring tasteful furnishings and panoramic views, creating a haven of relaxation and entertainment.\r\n\r\n🌳 Outdoor Oasis: Step into our enchanting outdoor oasis, where lush gardens, serene patios, and refreshing pools invite you to bask in the beauty of nature and enjoy alfresco living at its finest.\r\n\r\n🏊 Pool: Dive into luxury and leisure at our pristine pool, offering a refreshing escape from the tropical heat and a perfect spot for leisurely swims and sun-soaked relaxation.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our state-of-the-art fitness center, complete with modern equipment and inspiring views, ensuring a fulfilling workout experience.\r\n\r\n🅿️ Parking: Enjoy the convenience of ample parking space within our secure compound, providing peace of mind for you and your vehicles.\r\n\r\n🔒 Security: Your safety is our priority, with 24/7 security surveillance and gated access, ensuring a secure and tranquil environment for you and your family.\r\n\r\n🌴 Location: Nestled in a prestigious neighborhood, our villa offers unrivaled access to pristine beaches, world-class dining, and exclusive entertainment, promising a lifestyle of luxury and leisure.', 'tr', 8, '2024-04-29 12:11:06', '2024-04-29 12:11:06'),
(9, 3, 'House | { Indoor:: Indoor} |  { Outdoor::Outdoor} : {Swimming_pool::Swimming pool}', '🏡 House Description:\r\n\r\nWelcome to our charming and inviting house, where comfort meets style, creating a warm and welcoming sanctuary for you and your loved ones.\r\n\r\n🛏️ Bedrooms: Experience restful nights and peaceful mornings in our cozy bedrooms, designed to provide comfort and privacy for every member of the family.\r\n\r\n🚿 Bathrooms: Start and end your day in luxury with our well-appointed bathrooms, featuring modern fixtures and soothing amenities for your comfort and convenience.\r\n\r\n🍽️ Dining Area: Gather and share meals in our inviting dining area, where delicious food and memorable conversations come together to create lasting moments.\r\n\r\n🍳 Kitchen: Unleash your culinary talents in our spacious kitchen, equipped with all the essentials and ample counter space for preparing delicious meals and delightful treats.\r\n\r\n🛋️ Living Room: Relax and unwind in our welcoming living room, where plush furnishings and cozy accents invite you to kick back and enjoy moments of leisure and togetherness.\r\n\r\n🌳 Backyard: Step into our serene backyard oasis, where lush greenery, manicured lawns, and charming patio spaces beckon you to enjoy outdoor living and al fresco dining in the embrace of nature.\r\n\r\n🌞 Sunroom: Bask in natural light and soak up the sunshine in our delightful sunroom, a tranquil retreat perfect for reading, lounging, or simply enjoying the beauty of the outdoors from the comfort of your home.\r\n\r\n🌻 Garden: Cultivate your green thumb and nurture your love for gardening in our vibrant garden, a haven of blooms and foliage where you can reconnect with the earth and find peace and inspiration.\r\n\r\n🅿️ Parking: Enjoy the convenience of ample parking space in our driveway or garage, ensuring easy access and secure storage for your vehicles.\r\n\r\n🔒 Security: Your safety is our priority, with reliable security features and systems in place to provide peace of mind for you and your family.\r\n\r\n🏞️ Location: Nestled in a picturesque neighborhood, our house offers the perfect blend of tranquility and convenience, with scenic parks, shopping centers, and schools just moments away.', 'en', 1, '2024-04-29 12:12:26', '2024-04-29 12:12:26'),
(10, 3, 'House', '🏡 House Description:\r\n\r\nWelcome to our charming and inviting house, where comfort meets style, creating a warm and welcoming sanctuary for you and your loved ones.\r\n\r\n🛏️ Bedrooms: Experience restful nights and peaceful mornings in our cozy bedrooms, designed to provide comfort and privacy for every member of the family.\r\n\r\n🚿 Bathrooms: Start and end your day in luxury with our well-appointed bathrooms, featuring modern fixtures and soothing amenities for your comfort and convenience.\r\n\r\n🍽️ Dining Area: Gather and share meals in our inviting dining area, where delicious food and memorable conversations come together to create lasting moments.\r\n\r\n🍳 Kitchen: Unleash your culinary talents in our spacious kitchen, equipped with all the essentials and ample counter space for preparing delicious meals and delightful treats.\r\n\r\n🛋️ Living Room: Relax and unwind in our welcoming living room, where plush furnishings and cozy accents invite you to kick back and enjoy moments of leisure and togetherness.\r\n\r\n🌳 Backyard: Step into our serene backyard oasis, where lush greenery, manicured lawns, and charming patio spaces beckon you to enjoy outdoor living and al fresco dining in the embrace of nature.\r\n\r\n🌞 Sunroom: Bask in natural light and soak up the sunshine in our delightful sunroom, a tranquil retreat perfect for reading, lounging, or simply enjoying the beauty of the outdoors from the comfort of your home.\r\n\r\n🌻 Garden: Cultivate your green thumb and nurture your love for gardening in our vibrant garden, a haven of blooms and foliage where you can reconnect with the earth and find peace and inspiration.\r\n\r\n🅿️ Parking: Enjoy the convenience of ample parking space in our driveway or garage, ensuring easy access and secure storage for your vehicles.\r\n\r\n🔒 Security: Your safety is our priority, with reliable security features and systems in place to provide peace of mind for you and your family.\r\n\r\n🏞️ Location: Nestled in a picturesque neighborhood, our house offers the perfect blend of tranquility and convenience, with scenic parks, shopping centers, and schools just moments away.', 'ar', 2, '2024-04-29 12:12:26', '2024-04-29 12:12:26'),
(11, 3, 'House', '🏡 House Description:\r\n\r\nWelcome to our charming and inviting house, where comfort meets style, creating a warm and welcoming sanctuary for you and your loved ones.\r\n\r\n🛏️ Bedrooms: Experience restful nights and peaceful mornings in our cozy bedrooms, designed to provide comfort and privacy for every member of the family.\r\n\r\n🚿 Bathrooms: Start and end your day in luxury with our well-appointed bathrooms, featuring modern fixtures and soothing amenities for your comfort and convenience.\r\n\r\n🍽️ Dining Area: Gather and share meals in our inviting dining area, where delicious food and memorable conversations come together to create lasting moments.\r\n\r\n🍳 Kitchen: Unleash your culinary talents in our spacious kitchen, equipped with all the essentials and ample counter space for preparing delicious meals and delightful treats.\r\n\r\n🛋️ Living Room: Relax and unwind in our welcoming living room, where plush furnishings and cozy accents invite you to kick back and enjoy moments of leisure and togetherness.\r\n\r\n🌳 Backyard: Step into our serene backyard oasis, where lush greenery, manicured lawns, and charming patio spaces beckon you to enjoy outdoor living and al fresco dining in the embrace of nature.\r\n\r\n🌞 Sunroom: Bask in natural light and soak up the sunshine in our delightful sunroom, a tranquil retreat perfect for reading, lounging, or simply enjoying the beauty of the outdoors from the comfort of your home.\r\n\r\n🌻 Garden: Cultivate your green thumb and nurture your love for gardening in our vibrant garden, a haven of blooms and foliage where you can reconnect with the earth and find peace and inspiration.\r\n\r\n🅿️ Parking: Enjoy the convenience of ample parking space in our driveway or garage, ensuring easy access and secure storage for your vehicles.\r\n\r\n🔒 Security: Your safety is our priority, with reliable security features and systems in place to provide peace of mind for you and your family.\r\n\r\n🏞️ Location: Nestled in a picturesque neighborhood, our house offers the perfect blend of tranquility and convenience, with scenic parks, shopping centers, and schools just moments away.', 'fr', 4, '2024-04-29 12:12:26', '2024-04-29 12:12:26'),
(12, 3, 'House', '🏡 House Description:\r\n\r\nWelcome to our charming and inviting house, where comfort meets style, creating a warm and welcoming sanctuary for you and your loved ones.\r\n\r\n🛏️ Bedrooms: Experience restful nights and peaceful mornings in our cozy bedrooms, designed to provide comfort and privacy for every member of the family.\r\n\r\n🚿 Bathrooms: Start and end your day in luxury with our well-appointed bathrooms, featuring modern fixtures and soothing amenities for your comfort and convenience.\r\n\r\n🍽️ Dining Area: Gather and share meals in our inviting dining area, where delicious food and memorable conversations come together to create lasting moments.\r\n\r\n🍳 Kitchen: Unleash your culinary talents in our spacious kitchen, equipped with all the essentials and ample counter space for preparing delicious meals and delightful treats.\r\n\r\n🛋️ Living Room: Relax and unwind in our welcoming living room, where plush furnishings and cozy accents invite you to kick back and enjoy moments of leisure and togetherness.\r\n\r\n🌳 Backyard: Step into our serene backyard oasis, where lush greenery, manicured lawns, and charming patio spaces beckon you to enjoy outdoor living and al fresco dining in the embrace of nature.\r\n\r\n🌞 Sunroom: Bask in natural light and soak up the sunshine in our delightful sunroom, a tranquil retreat perfect for reading, lounging, or simply enjoying the beauty of the outdoors from the comfort of your home.\r\n\r\n🌻 Garden: Cultivate your green thumb and nurture your love for gardening in our vibrant garden, a haven of blooms and foliage where you can reconnect with the earth and find peace and inspiration.\r\n\r\n🅿️ Parking: Enjoy the convenience of ample parking space in our driveway or garage, ensuring easy access and secure storage for your vehicles.\r\n\r\n🔒 Security: Your safety is our priority, with reliable security features and systems in place to provide peace of mind for you and your family.\r\n\r\n🏞️ Location: Nestled in a picturesque neighborhood, our house offers the perfect blend of tranquility and convenience, with scenic parks, shopping centers, and schools just moments away.', 'tr', 8, '2024-04-29 12:12:26', '2024-04-29 12:12:26'),
(13, 4, 'Building', '🏢 Building Description:\r\n\r\nWelcome to our modern and sophisticated building, where urban living meets contemporary comfort, offering an elevated lifestyle experience in the heart of the city.\r\n\r\n🌇 City Views: Immerse yourself in breathtaking city views from our towering building, where each window offers a glimpse into the bustling energy and vibrant atmosphere of urban life.\r\n\r\n🏬 Commercial Spaces: Discover a world of convenience at your doorstep with our versatile commercial spaces, perfect for retail shops, restaurants, and businesses, providing easy access to everyday essentials and services.\r\n\r\n🏢 Residential Units: Experience upscale living in our luxurious residential units, meticulously designed to offer spacious layouts, premium finishes, and panoramic vistas, ensuring a life of comfort and elegance for residents.\r\n\r\n🛋️ Lobby: Step into our elegant lobby, where sleek architecture and stylish decor welcome you home with a sense of sophistication and hospitality, setting the tone for a refined urban lifestyle.\r\n\r\n🌳 Green Spaces: Find tranquility amidst the hustle and bustle of the city in our lush green spaces, where manicured gardens, serene courtyards, and tranquil parks invite you to relax, recharge, and reconnect with nature.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our state-of-the-art fitness center, equipped with top-of-the-line equipment and inspiring views, offering residents a convenient and enjoyable way to prioritize their health and well-being.\r\n\r\n🅿️ Parking: Enjoy the convenience of secure parking facilities within our building, providing residents and visitors with peace of mind and easy access to their vehicles in the heart of the city.\r\n\r\n🔒 Security: Your safety is our priority, with 24/7 security surveillance, access control systems, and on-site personnel ensuring a safe and secure environment for all occupants of the building.\r\n\r\n🏢 Location: Situated in a prime location, our building offers unparalleled access to transportation hubs, entertainment venues, cultural attractions, and business districts, allowing residents to enjoy the best of city living right at their doorstep.', 'en', 1, '2024-04-29 12:13:42', '2024-04-29 12:13:42'),
(14, 4, 'Building', '🏢 Building Description:\r\n\r\nWelcome to our modern and sophisticated building, where urban living meets contemporary comfort, offering an elevated lifestyle experience in the heart of the city.\r\n\r\n🌇 City Views: Immerse yourself in breathtaking city views from our towering building, where each window offers a glimpse into the bustling energy and vibrant atmosphere of urban life.\r\n\r\n🏬 Commercial Spaces: Discover a world of convenience at your doorstep with our versatile commercial spaces, perfect for retail shops, restaurants, and businesses, providing easy access to everyday essentials and services.\r\n\r\n🏢 Residential Units: Experience upscale living in our luxurious residential units, meticulously designed to offer spacious layouts, premium finishes, and panoramic vistas, ensuring a life of comfort and elegance for residents.\r\n\r\n🛋️ Lobby: Step into our elegant lobby, where sleek architecture and stylish decor welcome you home with a sense of sophistication and hospitality, setting the tone for a refined urban lifestyle.\r\n\r\n🌳 Green Spaces: Find tranquility amidst the hustle and bustle of the city in our lush green spaces, where manicured gardens, serene courtyards, and tranquil parks invite you to relax, recharge, and reconnect with nature.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our state-of-the-art fitness center, equipped with top-of-the-line equipment and inspiring views, offering residents a convenient and enjoyable way to prioritize their health and well-being.\r\n\r\n🅿️ Parking: Enjoy the convenience of secure parking facilities within our building, providing residents and visitors with peace of mind and easy access to their vehicles in the heart of the city.\r\n\r\n🔒 Security: Your safety is our priority, with 24/7 security surveillance, access control systems, and on-site personnel ensuring a safe and secure environment for all occupants of the building.\r\n\r\n🏢 Location: Situated in a prime location, our building offers unparalleled access to transportation hubs, entertainment venues, cultural attractions, and business districts, allowing residents to enjoy the best of city living right at their doorstep.', 'ar', 2, '2024-04-29 12:13:42', '2024-04-29 12:13:42'),
(15, 4, 'Building', '🏢 Building Description:\r\n\r\nWelcome to our modern and sophisticated building, where urban living meets contemporary comfort, offering an elevated lifestyle experience in the heart of the city.\r\n\r\n🌇 City Views: Immerse yourself in breathtaking city views from our towering building, where each window offers a glimpse into the bustling energy and vibrant atmosphere of urban life.\r\n\r\n🏬 Commercial Spaces: Discover a world of convenience at your doorstep with our versatile commercial spaces, perfect for retail shops, restaurants, and businesses, providing easy access to everyday essentials and services.\r\n\r\n🏢 Residential Units: Experience upscale living in our luxurious residential units, meticulously designed to offer spacious layouts, premium finishes, and panoramic vistas, ensuring a life of comfort and elegance for residents.\r\n\r\n🛋️ Lobby: Step into our elegant lobby, where sleek architecture and stylish decor welcome you home with a sense of sophistication and hospitality, setting the tone for a refined urban lifestyle.\r\n\r\n🌳 Green Spaces: Find tranquility amidst the hustle and bustle of the city in our lush green spaces, where manicured gardens, serene courtyards, and tranquil parks invite you to relax, recharge, and reconnect with nature.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our state-of-the-art fitness center, equipped with top-of-the-line equipment and inspiring views, offering residents a convenient and enjoyable way to prioritize their health and well-being.\r\n\r\n🅿️ Parking: Enjoy the convenience of secure parking facilities within our building, providing residents and visitors with peace of mind and easy access to their vehicles in the heart of the city.\r\n\r\n🔒 Security: Your safety is our priority, with 24/7 security surveillance, access control systems, and on-site personnel ensuring a safe and secure environment for all occupants of the building.\r\n\r\n🏢 Location: Situated in a prime location, our building offers unparalleled access to transportation hubs, entertainment venues, cultural attractions, and business districts, allowing residents to enjoy the best of city living right at their doorstep.', 'fr', 4, '2024-04-29 12:13:42', '2024-04-29 12:13:42'),
(16, 4, 'Building', '🏢 Building Description:\r\n\r\nWelcome to our modern and sophisticated building, where urban living meets contemporary comfort, offering an elevated lifestyle experience in the heart of the city.\r\n\r\n🌇 City Views: Immerse yourself in breathtaking city views from our towering building, where each window offers a glimpse into the bustling energy and vibrant atmosphere of urban life.\r\n\r\n🏬 Commercial Spaces: Discover a world of convenience at your doorstep with our versatile commercial spaces, perfect for retail shops, restaurants, and businesses, providing easy access to everyday essentials and services.\r\n\r\n🏢 Residential Units: Experience upscale living in our luxurious residential units, meticulously designed to offer spacious layouts, premium finishes, and panoramic vistas, ensuring a life of comfort and elegance for residents.\r\n\r\n🛋️ Lobby: Step into our elegant lobby, where sleek architecture and stylish decor welcome you home with a sense of sophistication and hospitality, setting the tone for a refined urban lifestyle.\r\n\r\n🌳 Green Spaces: Find tranquility amidst the hustle and bustle of the city in our lush green spaces, where manicured gardens, serene courtyards, and tranquil parks invite you to relax, recharge, and reconnect with nature.\r\n\r\n🏋️ Fitness Center: Stay active and energized in our state-of-the-art fitness center, equipped with top-of-the-line equipment and inspiring views, offering residents a convenient and enjoyable way to prioritize their health and well-being.\r\n\r\n🅿️ Parking: Enjoy the convenience of secure parking facilities within our building, providing residents and visitors with peace of mind and easy access to their vehicles in the heart of the city.\r\n\r\n🔒 Security: Your safety is our priority, with 24/7 security surveillance, access control systems, and on-site personnel ensuring a safe and secure environment for all occupants of the building.\r\n\r\n🏢 Location: Situated in a prime location, our building offers unparalleled access to transportation hubs, entertainment venues, cultural attractions, and business districts, allowing residents to enjoy the best of city living right at their doorstep.', 'tr', 8, '2024-04-29 12:13:42', '2024-04-29 12:13:42'),
(17, 5, 'Land', '🏞️ Land Description:\r\n\r\nWelcome to this pristine piece of land, offering endless possibilities for development and enjoyment amidst nature\'s beauty and tranquility.\r\n\r\n🌳 Natural Beauty: Immerse yourself in the untouched natural beauty of this land, where sprawling meadows, lush forests, and scenic vistas create a serene and picturesque setting for your dreams to take root.\r\n\r\n🌄 Scenic Views: Enjoy breathtaking views of the surrounding landscape from every corner of this expansive land, where panoramic vistas of rolling hills, majestic mountains, or tranquil water bodies inspire a sense of awe and wonder.\r\n\r\n🌿 Potential for Development: Unlock the full potential of this land with its versatility and flexibility for development, whether for residential, commercial, agricultural, or recreational purposes, offering endless opportunities to bring your vision to life.\r\n\r\n🏡 Home Site: Discover the perfect spot to build your dream home amidst the natural splendor of this land, where ample space, privacy, and serenity create an ideal setting for creating lasting memories with family and friends.\r\n\r\n🌱 Agricultural Opportunities: Harness the fertile soil and abundant sunlight of this land for agricultural endeavors, whether for farming, gardening, or cultivating crops, providing a sustainable source of nourishment and connection to the land.\r\n\r\n🚣 Recreational Activities: Embrace the great outdoors with a variety of recreational activities on this land, from hiking, camping, and horseback riding to fishing, boating, and birdwatching, offering endless opportunities for adventure and exploration.\r\n\r\n🛤️ Accessibility: Enjoy convenient access to nearby amenities, services, and transportation routes, ensuring ease of travel and connectivity while still maintaining a sense of seclusion and privacy on this expansive parcel of land.\r\n\r\n🔒 Security: Rest assured knowing that your investment is protected with secure boundaries, monitoring systems, and access control measures in place to safeguard the integrity and value of this land.\r\n\r\n🌍 Location: Nestled in a coveted location, this land offers the perfect blend of natural beauty, accessibility, and potential for development, providing a rare opportunity to own a piece of paradise in an idyllic setting.', 'en', 1, '2024-04-29 12:14:51', '2024-04-29 12:14:51'),
(18, 5, 'Land', '🏞️ Land Description:\r\n\r\nWelcome to this pristine piece of land, offering endless possibilities for development and enjoyment amidst nature\'s beauty and tranquility.\r\n\r\n🌳 Natural Beauty: Immerse yourself in the untouched natural beauty of this land, where sprawling meadows, lush forests, and scenic vistas create a serene and picturesque setting for your dreams to take root.\r\n\r\n🌄 Scenic Views: Enjoy breathtaking views of the surrounding landscape from every corner of this expansive land, where panoramic vistas of rolling hills, majestic mountains, or tranquil water bodies inspire a sense of awe and wonder.\r\n\r\n🌿 Potential for Development: Unlock the full potential of this land with its versatility and flexibility for development, whether for residential, commercial, agricultural, or recreational purposes, offering endless opportunities to bring your vision to life.\r\n\r\n🏡 Home Site: Discover the perfect spot to build your dream home amidst the natural splendor of this land, where ample space, privacy, and serenity create an ideal setting for creating lasting memories with family and friends.\r\n\r\n🌱 Agricultural Opportunities: Harness the fertile soil and abundant sunlight of this land for agricultural endeavors, whether for farming, gardening, or cultivating crops, providing a sustainable source of nourishment and connection to the land.\r\n\r\n🚣 Recreational Activities: Embrace the great outdoors with a variety of recreational activities on this land, from hiking, camping, and horseback riding to fishing, boating, and birdwatching, offering endless opportunities for adventure and exploration.\r\n\r\n🛤️ Accessibility: Enjoy convenient access to nearby amenities, services, and transportation routes, ensuring ease of travel and connectivity while still maintaining a sense of seclusion and privacy on this expansive parcel of land.\r\n\r\n🔒 Security: Rest assured knowing that your investment is protected with secure boundaries, monitoring systems, and access control measures in place to safeguard the integrity and value of this land.\r\n\r\n🌍 Location: Nestled in a coveted location, this land offers the perfect blend of natural beauty, accessibility, and potential for development, providing a rare opportunity to own a piece of paradise in an idyllic setting.', 'ar', 2, '2024-04-29 12:14:51', '2024-04-29 12:14:51'),
(19, 5, 'Land', '🏞️ Land Description:\r\n\r\nWelcome to this pristine piece of land, offering endless possibilities for development and enjoyment amidst nature\'s beauty and tranquility.\r\n\r\n🌳 Natural Beauty: Immerse yourself in the untouched natural beauty of this land, where sprawling meadows, lush forests, and scenic vistas create a serene and picturesque setting for your dreams to take root.\r\n\r\n🌄 Scenic Views: Enjoy breathtaking views of the surrounding landscape from every corner of this expansive land, where panoramic vistas of rolling hills, majestic mountains, or tranquil water bodies inspire a sense of awe and wonder.\r\n\r\n🌿 Potential for Development: Unlock the full potential of this land with its versatility and flexibility for development, whether for residential, commercial, agricultural, or recreational purposes, offering endless opportunities to bring your vision to life.\r\n\r\n🏡 Home Site: Discover the perfect spot to build your dream home amidst the natural splendor of this land, where ample space, privacy, and serenity create an ideal setting for creating lasting memories with family and friends.\r\n\r\n🌱 Agricultural Opportunities: Harness the fertile soil and abundant sunlight of this land for agricultural endeavors, whether for farming, gardening, or cultivating crops, providing a sustainable source of nourishment and connection to the land.\r\n\r\n🚣 Recreational Activities: Embrace the great outdoors with a variety of recreational activities on this land, from hiking, camping, and horseback riding to fishing, boating, and birdwatching, offering endless opportunities for adventure and exploration.\r\n\r\n🛤️ Accessibility: Enjoy convenient access to nearby amenities, services, and transportation routes, ensuring ease of travel and connectivity while still maintaining a sense of seclusion and privacy on this expansive parcel of land.\r\n\r\n🔒 Security: Rest assured knowing that your investment is protected with secure boundaries, monitoring systems, and access control measures in place to safeguard the integrity and value of this land.\r\n\r\n🌍 Location: Nestled in a coveted location, this land offers the perfect blend of natural beauty, accessibility, and potential for development, providing a rare opportunity to own a piece of paradise in an idyllic setting.', 'fr', 4, '2024-04-29 12:14:51', '2024-04-29 12:14:51'),
(20, 5, 'Land', '🏞️ Land Description:\r\n\r\nWelcome to this pristine piece of land, offering endless possibilities for development and enjoyment amidst nature\'s beauty and tranquility.\r\n\r\n🌳 Natural Beauty: Immerse yourself in the untouched natural beauty of this land, where sprawling meadows, lush forests, and scenic vistas create a serene and picturesque setting for your dreams to take root.\r\n\r\n🌄 Scenic Views: Enjoy breathtaking views of the surrounding landscape from every corner of this expansive land, where panoramic vistas of rolling hills, majestic mountains, or tranquil water bodies inspire a sense of awe and wonder.\r\n\r\n🌿 Potential for Development: Unlock the full potential of this land with its versatility and flexibility for development, whether for residential, commercial, agricultural, or recreational purposes, offering endless opportunities to bring your vision to life.\r\n\r\n🏡 Home Site: Discover the perfect spot to build your dream home amidst the natural splendor of this land, where ample space, privacy, and serenity create an ideal setting for creating lasting memories with family and friends.\r\n\r\n🌱 Agricultural Opportunities: Harness the fertile soil and abundant sunlight of this land for agricultural endeavors, whether for farming, gardening, or cultivating crops, providing a sustainable source of nourishment and connection to the land.\r\n\r\n🚣 Recreational Activities: Embrace the great outdoors with a variety of recreational activities on this land, from hiking, camping, and horseback riding to fishing, boating, and birdwatching, offering endless opportunities for adventure and exploration.\r\n\r\n🛤️ Accessibility: Enjoy convenient access to nearby amenities, services, and transportation routes, ensuring ease of travel and connectivity while still maintaining a sense of seclusion and privacy on this expansive parcel of land.\r\n\r\n🔒 Security: Rest assured knowing that your investment is protected with secure boundaries, monitoring systems, and access control measures in place to safeguard the integrity and value of this land.\r\n\r\n🌍 Location: Nestled in a coveted location, this land offers the perfect blend of natural beauty, accessibility, and potential for development, providing a rare opportunity to own a piece of paradise in an idyllic setting.', 'tr', 8, '2024-04-29 12:14:51', '2024-04-29 12:14:51');

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

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `title`, `longitude`, `latitude`, `city_id`, `town_id`, `status`, `create_date`) VALUES
(1, 'Green Town', '74.195900', '32.166351', 2, 2, 1, '2024-05-07 13:52:36'),
(2, 'PIA Town', '74.195900', '31.716661', 1, 1, 1, '2024-05-07 13:53:06');

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

--
-- Dumping data for table `dynamic_form`
--

INSERT INTO `dynamic_form` (`id`, `property_type_id`, `label`, `type`, `placeholder`, `position`, `create_date`) VALUES
(1, 1, 'testing', 'select', '0-1-2-3', 1, '2024-05-17 11:32:34'),
(2, 2, 'xxx', 'select', 'aaa-bbb-ccc', 1, '2024-05-20 06:38:38'),
(3, 2, 'xxx', 'select', 'bbb-ccc-ddd', 2, '2024-05-20 06:38:38'),
(4, 2, 'xxx', 'select', 'ccc-ddd-eee', 3, '2024-05-20 06:38:38'),
(5, 3, 'Mouse', 'select', 'Mouse', 1, '2024-05-20 10:32:51'),
(6, 1, 'Keyboard', 'select', 'Typing-Gaming-Colorful', 0, '2024-05-23 11:55:47');

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

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `feature_category_id`, `title`, `status`) VALUES
(1, 2, 'Air Conditioner', 1),
(6, 2, 'Fireplace', 1),
(7, 2, 'Dressing room', 1),
(8, 2, 'American Kitchen', 1),
(9, 2, 'Whirlpool', 1),
(11, 5, 'Swimming pool', 1),
(12, 5, 'Security Cameras', 1),
(13, 5, 'Garden', 1);

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

--
-- Dumping data for table `features_category`
--

INSERT INTO `features_category` (`id`, `property_type_id`, `title`, `status`) VALUES
(2, 3, 'Interior', 1),
(5, 3, 'External', 1);

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

--
-- Dumping data for table `features_category_details`
--

INSERT INTO `features_category_details` (`id`, `feature_category_id`, `title`, `lang`) VALUES
(5, 2, 'Interior', 'en'),
(6, 2, 'الداخلية', 'ar'),
(7, 2, 'Intérieure', 'fr'),
(8, 2, 'İç mekan', 'tr'),
(29, 5, 'External', 'en'),
(30, 5, 'External', 'ar'),
(31, 5, 'External', 'fr'),
(32, 5, 'External', 'tr');

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

--
-- Dumping data for table `features_details`
--

INSERT INTO `features_details` (`id`, `feature_id`, `title`, `lang`) VALUES
(37, 1, 'Air Conditioner', 'en'),
(38, 1, 'صناعي', 'ar'),
(39, 1, 'Industriel', 'fr'),
(40, 1, 'Sanayi', 'tr'),
(41, 6, 'Fireplace', 'en'),
(42, 6, 'Fireplace', 'ar'),
(43, 6, 'Fireplace', 'fr'),
(44, 6, 'Fireplace', 'tr'),
(45, 7, 'Dressing room', 'en'),
(46, 7, 'Dressing room', 'ar'),
(47, 7, 'Dressing room', 'fr'),
(48, 7, 'Dressing room', 'tr'),
(49, 8, 'American Kitchen', 'en'),
(50, 8, 'American Kitchen', 'ar'),
(51, 8, 'American Kitchen', 'fr'),
(52, 8, 'American Kitchen', 'tr'),
(53, 9, 'Whirlpool', 'en'),
(54, 9, 'Whirlpool', 'ar'),
(55, 9, 'Whirlpool', 'fr'),
(56, 9, 'Whirlpool', 'tr'),
(65, 11, 'Swimming pool', 'en'),
(66, 11, 'Swimming pool', 'ar'),
(67, 11, 'Swimming pool', 'fr'),
(68, 11, 'Swimming pool', 'tr'),
(69, 12, 'Security Cameras', 'en'),
(70, 12, 'Security Cameras', 'ar'),
(71, 12, 'Security Cameras', 'fr'),
(72, 12, 'Security Cameras', 'tr'),
(73, 13, 'Garden', 'en'),
(74, 13, 'Garden', 'ar'),
(75, 13, 'Garden', 'fr'),
(76, 13, 'Garden', 'tr');

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

--
-- Dumping data for table `house_attribute`
--

INSERT INTO `house_attribute` (`id`, `property_type_id`, `property_id`, `price`, `conditionp`, `grossm2`, `netm2`, `landm2`, `bed_rooms`, `living_rooms`, `bath_rooms`, `age`, `floors`, `garden`, `create_date`) VALUES
(1, 3, 3, '100,000', 'very good', 88, 6, 98, 9, 5, 2, '3 - 5 years old', 5, 'yes', '22-06-2024');

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
  `title` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `mandatory`, `title`, `status`) VALUES
(1, 'false', 'Mall', 1),
(2, 'false', 'Hospital', 1),
(3, 'true', 'yyyy', 1),
(4, 'true', 'Location form the sea', 1);

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

--
-- Dumping data for table `location_details`
--

INSERT INTO `location_details` (`id`, `location_id`, `title`, `answer`, `lang`) VALUES
(25, 1, 'Mall', 'less than 50m-100m-200m-500m-1km-2km-5km-10km-25km-more than 25km', 'en'),
(26, 1, 'المسافة إلى البحر', 'أقل من 50 م - 100 م - 200 م - 500 م - 1 كم - 2 كم - 5 كم - 10 كم - 25 كم - أكثر من 25 كم', 'ar'),
(27, 1, 'Distance à la mer', 'moins de 50m-100m-200m-500m-1km-2km-5km-10km-25km-plus de 25km', 'fr'),
(28, 1, 'Denize uzaklık', '50m\'den az-100m-200m-500m-1km-2km-5km-10km-25km-25km\'den fazla', 'tr'),
(29, 2, 'Hospital', '100m-500m-1km-2km-3km-more then 3km', 'en'),
(30, 2, 'المسافة من وسط المدينة.', '1 كم - 2 كم - 3 كم - أكثر من 3 كم', 'ar'),
(31, 2, 'Distance du centre ville.', '1km-2km-3km-plus de 3km', 'fr'),
(32, 2, 'Şehir merkezine uzaklık.', '1km-2km-3km-3km\'den fazla', 'tr'),
(37, 4, 'Location form the sea', '1-2-3-4', 'en'),
(38, 4, 'Location form the sea', '1-2-3-4', 'ar'),
(39, 4, 'Location form the sea', '1-2-3-4', 'fr'),
(40, 4, 'Location form the sea', '1-2-3-4', 'tr'),
(45, 3, 'yyyy', '1-2-3-4-5-6-7-8-9-0', 'en'),
(46, 3, 'blablabla', '1-2-3-4-5-6-7-8-9-0', 'ar'),
(47, 3, 'blablabla', '1-2-3-4-5-6-7-8-9-0', 'fr'),
(48, 3, 'blablabla', '1-2-3-4-5-6-7-8-9-0', 'tr');

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

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`id`, `title`, `image_path`, `create_date`, `status`) VALUES
(1, '', 'uploads/propertyType/1715089709_city-listing-4.jpg', NULL, 1),
(2, '', 'uploads/propertyType/1715089722_city-listing-6.png', NULL, 1),
(3, '', 'uploads/propertyType/1715089771_g1-5.jpg', NULL, 1),
(4, '', 'uploads/propertyType/1715089791_city-listing-6.jpg', NULL, 1),
(5, '', 'uploads/propertyType/1715089807_city-listing-9.png', NULL, 1);

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

--
-- Dumping data for table `property_types_details`
--

INSERT INTO `property_types_details` (`id`, `property_type_id`, `title`, `lang`) VALUES
(21, 1, 'Apartment', 'en'),
(22, 1, 'Apartment', 'ar'),
(23, 1, 'Apartment', 'fr'),
(24, 1, 'Apartment', 'tr'),
(25, 2, 'Villa', 'en'),
(26, 2, 'Villa', 'ar'),
(27, 2, 'Villa', 'fr'),
(28, 2, 'Villa', 'tr'),
(29, 3, 'House', 'en'),
(30, 3, 'House', 'ar'),
(31, 3, 'House', 'fr'),
(32, 3, 'House', 'tr'),
(33, 4, 'Building', 'en'),
(34, 4, 'Building', 'ar'),
(35, 4, 'Building', 'fr'),
(36, 4, 'Building', 'tr'),
(37, 5, 'Land', 'en'),
(38, 5, 'Land', 'ar'),
(39, 5, 'Land', 'fr'),
(40, 5, 'Land', 'tr');

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

--
-- Dumping data for table `social_media_links`
--

INSERT INTO `social_media_links` (`id`, `type`, `user_id`, `facebook`, `instagram`, `twitter`, `linkedin`, `create_date`) VALUES
(1, 'agent', 1, NULL, NULL, NULL, NULL, '2024-05-07 13:56:07'),
(2, 'website', 1, 'https://www.facebook.com/', 'https://www.instagram.com/', 'https://www.twitter.com/', 'https://www.linkedin.com/', '2024-05-07 14:02:48'),
(3, 'agent', 26, '', '', '', '', '2024-05-22 16:21:02');

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

--
-- Dumping data for table `town`
--

INSERT INTO `town` (`id`, `city_id`, `title`, `status`) VALUES
(1, 1, 'Garden town', 1),
(2, 2, 'Wapda town', 1),
(4, 2, 'Master City', 1);

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
(1, 138, 1, 1, 1, 1, 'Usama', 'swrer', 'admin@gmail.com', '03421674008', '+923421674008', NULL, 'uploads/profile/1717682280_2345.jpg', '2024-03-19 08:02:32', '$2y$12$KToZboBoxlfqIijcqHOY7.v99c8/qm3LYYvhdPlhiSRUT8ZtnPAE6', 'ifQuW0orh3oIiJqqkYF0tmZvDuleNcO2Xs0tzB7npvb4ca5i2e4Qa18hWTQo', NULL, '2024-06-06 13:58:00'),
(26, 0, 0, 1, 1, 2, 'Cisu', 'Cisu', 'cisu20@web.de', NULL, NULL, NULL, NULL, NULL, '$2y$12$RRLHiEk/zpHcmr/MicKeueyxdaM.bALB/oa.tCstrnTfbj.XP.xby', 'ppqMu62Jt3vvwpcMtmBI2D10h7IUt8cfpvTrbRaKo4VYck3PKQMHtMJ9B5uT', '2024-05-22 16:21:02', '2024-05-23 12:58:17'),
(28, 100, 0, 1, 0, NULL, 'usama', 'usama', 'ur123meo@gmail.com', NULL, NULL, NULL, NULL, '2024-06-19 12:55:53', '$2y$12$g24JB50MSF14ZmixKwDNN.IstPQQjlxHp0MqSCQstrBMDB6XRwTG.', NULL, '2024-06-22 07:55:11', '2024-06-22 07:55:11');

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
-- Dumping data for table `villa_attribute`
--

INSERT INTO `villa_attribute` (`id`, `property_type_id`, `property_id`, `price`, `conditionp`, `grossm2`, `netm2`, `landm2`, `bed_rooms`, `living_rooms`, `bath_rooms`, `age`, `floors`, `garden`, `create_date`) VALUES
(1, 2, 1, '1,000', 'very good', 46, 32, 78, 16, 6, 4, '6 - 10 years old', 5, 'No', '22-06-2024'),
(2, 2, 2, '10.000', 'need of renovation', 2, 6, 33, 18, 1, 3, '3 - 5 years old', 1, 'No', '22-06-2024');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blog_details`
--
ALTER TABLE `blog_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `broker_offices`
--
ALTER TABLE `broker_offices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `credit_packages`
--
ALTER TABLE `credit_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `credit_package_details`
--
ALTER TABLE `credit_package_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `description_templates`
--
ALTER TABLE `description_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dynamic_form`
--
ALTER TABLE `dynamic_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `features_category`
--
ALTER TABLE `features_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `features_category_details`
--
ALTER TABLE `features_category_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `features_details`
--
ALTER TABLE `features_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `filled_dynamic_form`
--
ALTER TABLE `filled_dynamic_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `house_attribute`
--
ALTER TABLE `house_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `location_details`
--
ALTER TABLE `location_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `property_types_details`
--
ALTER TABLE `property_types_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media_links`
--
ALTER TABLE `social_media_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `town`
--
ALTER TABLE `town`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
