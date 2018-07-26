-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2018 at 04:28 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_slug` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `updated_at`, `category_slug`) VALUES
(1, 'hair', '2018-06-23 19:58:47', '2018-06-23 19:58:47', 'hair'),
(2, 'makeup', '2018-06-23 19:59:03', '2018-06-23 19:59:03', 'makeup'),
(3, 'nail', '2018-06-23 19:59:15', '2018-06-23 19:59:15', 'nail'),
(4, 'skin', '2018-06-23 19:59:27', '2018-06-23 19:59:27', 'skin'),
(6, 'product reviews', '2018-06-23 21:50:38', '2018-06-23 21:50:38', 'product-reviews');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 14, 27, 'Nice post!', '2018-07-22 10:37:59', '2018-07-22 10:37:59'),
(2, 14, 27, 'Very nice!', '2018-07-24 07:39:16', '2018-07-24 07:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `isLiked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id`, `user_id`, `post_id`, `isLiked`) VALUES
(1, 27, 8, 1),
(2, 27, 14, 1),
(3, 28, 14, 1);

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
(3, '2018_06_01_115941_create_posts_table', 2),
(4, '2018_06_02_124830_create_comments_table', 2),
(5, '2018_06_15_141840_create_like_table', 2),
(6, '2018_06_23_180200_create_categories_table', 2),
(7, '2018_06_23_212553_update_categories_table', 3),
(8, '2018_07_20_122532_create_user_verifications_table', 4),
(9, '2018_07_20_122743_update_users_table', 4);

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
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `title_slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `category_id`, `title`, `description`, `title_slug`, `image`, `created_at`, `updated_at`) VALUES
(8, 27, 1, '5 Powerful Face Masks That’ll Mattify Your Skin All Summer Long', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique tempore, inventore quos! Explicabo repudiandae accusamus maiores dolore ullam, tempora dolores corrupti et similique architecto incidunt voluptate molestiae asperiores delectus reiciendis.', '5-powerful-face-masks-thatll-mattify-your-skin-all-summer-long', '2018-07-21_11.jpg', '2018-07-21 16:24:34', '2018-07-21 16:24:34'),
(14, 28, 1, 'Everything You Need To Know Before You Get Hair Extensions', 'If you’ve ever drooled over celebrities full AF, never-ending locks, chances are you’re getting hair envy over fake hair – well, hair extensions. They’re THE secret weapon in every hair stylist’s kit because you can transform a bob into mermaid hair in minutes. And let’s be real, the more hair on your head, the more fun you have to play around with different styles. So, to get all the deets on everything to do with hair extensions, we spoke to founder and SHE-O of one of our fav hair brands, Leyla Milani, for how to get the best, most natural hair transformation. Don’t worry, even if you’re a complete newbie to the world of hair extensions, after reading this, you’ll be able to have a hair as full as Gretchen Weeners, but your only secret will be your clip-ins! Here’s everything you need to know.', 'everything-you-need-to-know-before-you-get-hair-extensions', '2018-07-21_10.jpg', '2018-07-21 17:40:48', '2018-07-21 17:40:48'),
(15, 27, 3, 'Why This Is The Sexiest And Easiest Nail Trend For Summer', 'If there’s one place we can get away with rocking trends, it’s on our nails, and our latest nail trend obsession is definitely a bold one; neon nails! We’re already planning our smug IG pic with coconut in hand while we bask on the beach! And, ever since we saw the glowing shades all over the catwalks at Jeremy Scott and Christian Siriano, we can’t deny that we may have spent a bit too much time planning how we can match fluorescent nail polish shades with our sandals. Plus, it’s probably the easiest trend to wear – it looks amazing on all skin tones and takes absolutely no effort!', 'why-this-is-the-sexiest-and-easiest-nail-trend-for-summer', '2018-07-24_13.jpg', '2018-07-24 07:41:35', '2018-07-24 07:41:35'),
(16, 27, 3, 'Nailed It: 5 Fresh Mani Looks You Need To Try for Spring', 'Spring is finally in full bloom (okurrrr), and one of our favorite ways to embrace the warmer weather is by switching up our mani game to try some of the season’s hottest new shades and nail art trends. And while we’re all about “doing you” when it comes to nails and not letting trends dictate our digits, it’s important to remember that polish isn’t permanent – although it may feel that way when you’re choosing a color at the salon! He’re are five looks we’re loving right now:', 'nailed-it-5-fresh-mani-looks-you-need-to-try-for-spring', '2018-07-24_6.jpg', '2018-07-24 07:44:15', '2018-07-24 07:44:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `isVerified`) VALUES
(27, 'senem', 'senemgenberova@gmail.com', '$2y$10$tMARlFjX57ny2vQUhYY3lekEoRKwVb5YKkMbedzKbtcV94Ec8XT/i', 'S6X5O4R1PTpzciG8ga54TS7x30BGjow9NQMO7areZ0pckWiUYj2NiR5USyRw', '2018-07-21 16:16:48', '2018-07-21 16:23:29', 1),
(28, 'ferid', 'ferid@gmail.com', '$2y$10$ZkdQoUWBZx0G4Rc1DMk/K.Xvm9Zv6UZTLB1GH4TxVR4oAYsF4ZbXu', 'MVzwqgFvz95OoIOuV3AQ6XYbEvZ9pcJLh3dEl7HrjmN1Opot6ivYhUEhoelP', '2018-07-21 16:25:30', '2018-07-21 16:26:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_verifications`
--

CREATE TABLE `user_verifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_verifications`
--

INSERT INTO `user_verifications` (`id`, `user_id`, `token`, `created_at`, `updated_at`) VALUES
(16, 27, '9PP4FJ85deQ1im6gGXbp', '2018-07-21 16:16:48', '2018-07-21 16:16:48'),
(17, 28, 'kw3mNiZJwHHm4SPd7OGK', '2018-07-21 16:25:30', '2018-07-21 16:25:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
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
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_verifications`
--
ALTER TABLE `user_verifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_verifications`
--
ALTER TABLE `user_verifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
