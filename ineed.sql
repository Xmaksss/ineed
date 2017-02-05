-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Фев 05 2017 г., 20:17
-- Версия сервера: 10.1.19-MariaDB
-- Версия PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ineed`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bodies`
--

CREATE TABLE `bodies` (
  `id` int(10) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `bodies`
--

INSERT INTO `bodies` (`id`, `order`, `title_en`, `title_ru`, `created_at`, `updated_at`) VALUES
(1, 0, 'Cover', 'Cover', '2017-02-04 13:20:36', '2017-02-04 13:20:36'),
(2, 0, 'Skin', 'Skin', '2017-02-04 13:20:54', '2017-02-04 13:20:54'),
(3, 0, 'Case', 'Case', '2017-02-04 13:21:09', '2017-02-04 13:21:09'),
(4, 0, 'Bag', 'Bag', '2017-02-04 13:21:19', '2017-02-04 13:21:19');

-- --------------------------------------------------------

--
-- Структура таблицы `borders`
--

CREATE TABLE `borders` (
  `id` int(10) UNSIGNED NOT NULL,
  `body_id` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `color` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `borders`
--

INSERT INTO `borders` (`id`, `body_id`, `order`, `color`, `created_at`, `updated_at`) VALUES
(1, 3, 0, 'white', '2017-02-04 13:25:24', '2017-02-04 13:25:24'),
(2, 3, 0, 'black', '2017-02-04 13:25:29', '2017-02-04 13:25:29');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `public` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `sort`, `title_en`, `title_ru`, `public`, `created_at`, `updated_at`) VALUES
(1, 1, 'iPhone', 'iPhone', 1, '2017-02-04 09:58:20', '2017-02-04 12:41:38'),
(2, 3, 'iWatch', 'iWatch', 1, '2017-02-04 09:59:49', '2017-02-04 12:42:43'),
(3, 0, 'MacBook', 'MacBook', 1, '2017-02-04 12:41:20', '2017-02-04 12:41:20'),
(4, 2, 'iPad', 'iPad', 0, '2017-02-04 12:42:36', '2017-02-04 12:42:36'),
(5, 4, 'Exclusive', 'Exclusive', 0, '2017-02-04 12:42:56', '2017-02-04 12:42:56');

-- --------------------------------------------------------

--
-- Структура таблицы `category_descriptions`
--

CREATE TABLE `category_descriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `lang` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `colors`
--

CREATE TABLE `colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title_ru` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `colors`
--

INSERT INTO `colors` (`id`, `title_en`, `title_ru`, `order`, `color`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Black', 'Черный', 0, 'black', '', '2017-02-04 13:03:35', '2017-02-04 16:35:30'),
(2, 'Brown', 'Коричневый', 1, 'brown', '', '2017-02-04 13:03:45', '2017-02-04 16:35:51'),
(3, 'White', 'Белый', 2, 'white', '', '2017-02-04 13:04:08', '2017-02-04 16:36:09'),
(4, 'Red', 'Крассный', 3, 'red', '', '2017-02-04 13:04:14', '2017-02-04 16:36:35'),
(5, 'Grey', 'Серый', 5, 'grey', '', '2017-02-04 13:04:37', '2017-02-04 16:37:00'),
(6, 'Python', 'Питон', 5, '', 'images/uploads/14e9e9403d44354b57f31668ee2a1ee6.jpg', '2017-02-04 13:16:36', '2017-02-04 16:37:18');

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE `materials` (
  `id` int(10) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`id`, `order`, `title_en`, `title_ru`, `created_at`, `updated_at`) VALUES
(1, 0, 'Leather', 'Кожа', '2017-02-04 12:55:52', '2017-02-04 12:55:52'),
(2, 1, 'Fur', 'Мех', '2017-02-04 12:56:17', '2017-02-04 12:56:17'),
(3, 2, 'Wood', 'Дерево', '2017-02-04 12:56:44', '2017-02-04 12:56:44');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2017_02_04_112148_create_categories_table', 2),
(9, '2017_02_04_121246_create_products_table', 3),
(10, '2017_02_04_133631_create_sizes_table', 4),
(11, '2017_02_04_133638_create_materials_table', 4),
(12, '2017_02_04_133648_create_types_table', 4),
(13, '2017_02_04_133656_create_colors_table', 4),
(14, '2017_02_04_133709_create_bodies_table', 4),
(15, '2017_02_04_133722_create_borders_table', 4),
(16, '2017_02_05_163041_create_sliders_table', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `price_new` int(11) DEFAULT '0',
  `public` tinyint(4) NOT NULL DEFAULT '0',
  `image_main` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_3` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_4` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_5` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_6` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `size_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `type_id` int(11) DEFAULT '0',
  `color_id` int(11) NOT NULL,
  `body_id` int(11) NOT NULL,
  `border_id` int(11) DEFAULT '0',
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_en` text COLLATE utf8_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description_ru` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `category_id`, `slug`, `price`, `price_new`, `public`, `image_main`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`, `image_6`, `size_id`, `material_id`, `type_id`, `color_id`, `body_id`, `border_id`, `title_en`, `description_en`, `title_ru`, `description_ru`, `created_at`, `updated_at`) VALUES
(1, 3, 'macbook1', 100, NULL, 1, 'images/uploads/461c030b3ab6016eb08832ce61ea7c65.jpg', 'images/uploads/852584af89f22a5e638a6f656ef7d606.jpg', '', '', '', '', '', 2, 2, NULL, 1, 4, NULL, 'MacBook', 'MacBook', 'MacBook', 'MacBook', '2017-02-04 16:51:49', '2017-02-04 16:52:51'),
(2, 3, 'macbook2', 200, NULL, 1, 'images/uploads/461c030b3ab6016eb08832ce61ea7c65.jpg', 'images/uploads/852584af89f22a5e638a6f656ef7d606.jpg', '', '', '', '', '', 1, 2, NULL, 1, 1, NULL, 'MacBook2', 'MacBook2', 'MacBook2', 'MacBook2', '2017-02-04 16:51:49', '2017-02-04 17:12:05'),
(3, 3, 'macbook3', 1001, NULL, 1, 'images/uploads/461c030b3ab6016eb08832ce61ea7c65.jpg', 'images/uploads/852584af89f22a5e638a6f656ef7d606.jpg', '', '', '', '', '', 3, 2, NULL, 1, 1, NULL, 'MacBook3', 'MacBook3', 'MacBook3', 'MacBook3', '2017-02-04 16:51:49', '2017-02-04 17:12:17'),
(4, 3, 'macbook4', 100, NULL, 1, 'images/uploads/461c030b3ab6016eb08832ce61ea7c65.jpg', 'images/uploads/852584af89f22a5e638a6f656ef7d606.jpg', '', '', '', '', '', 1, 1, 1, 1, 3, 1, 'MacBook4', 'MacBook4', 'MacBook4', 'MacBook4', '2017-02-04 16:51:49', '2017-02-04 17:12:28'),
(5, 3, 'macbook4', 100, 60, 1, 'images/uploads/461c030b3ab6016eb08832ce61ea7c65.jpg', 'images/uploads/852584af89f22a5e638a6f656ef7d606.jpg', '', '', '', '', '', 3, 1, 2, 1, 3, 2, 'MacBook5', 'MacBook5', 'MacBook5', 'MacBook5', '2017-02-04 16:51:49', '2017-02-04 17:12:44'),
(6, 3, 'macbook5', 500, NULL, 1, 'images/uploads/461c030b3ab6016eb08832ce61ea7c65.jpg', 'images/uploads/852584af89f22a5e638a6f656ef7d606.jpg', '', '', '', '', '', 3, 3, NULL, 6, 3, 2, 'MacBook6', 'MacBook6', 'MacBook6', 'MacBook6', '2017-02-04 16:51:49', '2017-02-04 17:12:55'),
(7, 3, 'macbook7', 100, NULL, 1, 'images/uploads/461c030b3ab6016eb08832ce61ea7c65.jpg', 'images/uploads/852584af89f22a5e638a6f656ef7d606.jpg', '', '', '', '', '', 1, 1, 1, 5, 3, 1, 'MacBook7', 'MacBook7', 'MacBook7', 'MacBook7', '2017-02-04 16:51:49', '2017-02-04 17:12:28'),
(8, 3, 'macbook8', 200, NULL, 1, 'images/uploads/461c030b3ab6016eb08832ce61ea7c65.jpg', 'images/uploads/852584af89f22a5e638a6f656ef7d606.jpg', '', '', '', '', '', 1, 2, NULL, 3, 2, NULL, 'MacBook8', 'MacBook8', 'MacBook8', 'MacBook8', '2017-02-04 16:51:49', '2017-02-04 17:12:05');

-- --------------------------------------------------------

--
-- Структура таблицы `sizes`
--

CREATE TABLE `sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `sizes`
--

INSERT INTO `sizes` (`id`, `order`, `title_en`, `title_ru`, `created_at`, `updated_at`) VALUES
(1, 0, 'MacBook 12', 'MacBook 12', '2017-02-04 12:44:39', '2017-02-04 12:44:39'),
(2, 1, 'Air 12', 'Air 12', '2017-02-04 12:45:10', '2017-02-04 12:45:10'),
(3, 2, 'Air 13', 'Air 13', '2017-02-04 12:45:32', '2017-02-04 12:45:32'),
(4, 3, 'Pro Retina 13', 'Pro Retina 13', '2017-02-04 12:45:49', '2017-02-04 12:45:49'),
(5, 4, 'Pro Retina 15', 'Pro Retina 15', '2017-02-04 12:45:59', '2017-02-04 12:45:59'),
(6, 5, 'New MacBook Pro 13', 'New MacBook Pro 13', '2017-02-04 12:46:20', '2017-02-04 12:46:20'),
(7, 6, 'New MacBook Pro 15', 'New MacBook Pro 15', '2017-02-04 12:46:34', '2017-02-04 12:46:34'),
(8, 0, 'iPhone 6/6S', 'iPhone 6/6S', '2017-02-04 12:48:29', '2017-02-04 12:48:29'),
(9, 1, 'iPhone 6/6S plus', 'iPhone 6/6S plus', '2017-02-04 12:49:05', '2017-02-04 12:49:05'),
(10, 2, 'iPhone 7', 'iPhone 7', '2017-02-04 12:49:17', '2017-02-04 12:49:17'),
(11, 2, 'iPhone 7 plus', 'iPhone 7 plus', '2017-02-04 12:49:27', '2017-02-04 12:49:27'),
(12, 0, 'iWatch 38mm', 'iWatch 38mm', '2017-02-04 12:50:07', '2017-02-04 12:50:07'),
(13, 1, 'iWatch 42mm', 'iWatch 42mm', '2017-02-04 12:50:17', '2017-02-04 12:50:17');

-- --------------------------------------------------------

--
-- Структура таблицы `sliders`
--

CREATE TABLE `sliders` (
  `id` int(10) UNSIGNED NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(10) DEFAULT NULL,
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `button_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_title_ru` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `button_ru` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `sliders`
--

INSERT INTO `sliders` (`id`, `link`, `image`, `sort`, `title_en`, `sub_title_en`, `button_en`, `title_ru`, `sub_title_ru`, `button_ru`, `created_at`, `updated_at`) VALUES
(1, '#', 'images/uploads/c4f2590281f54c8c26629cbbc6b02b3c.jpg', 0, 'Meet your leather IPhone 7 case', 'Designed to hold your essential cards.', 'Shop our collection', 'Meet your leather IPhone 7 case', 'Designed to hold your essential cards.', 'Shop our collection', '2017-02-05 15:00:00', '2017-02-05 15:00:40'),
(2, '#', 'images/uploads/8d5c0d167fc8a930e8feff493db03b24.jpg', 1, 'Designed to hold your essential cards. en', 'Meet your leather IPhone 7 case en', 'Shop our collection en', 'Designed to hold your essential cards. ru', 'Meet your leather IPhone 7 case ru', 'Shop our collection ru', '2017-02-05 15:02:16', '2017-02-05 15:02:16'),
(3, '', 'images/uploads/3e2e835f95c866355e4d3b44f97b11c4.jpg', 3, 'Without button en', 'Meet your leather IPhone 7 case en', '', 'Without button ru', 'Meet your leather IPhone 7 case ru', '', '2017-02-05 15:03:17', '2017-02-05 15:03:17');

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `material_id` int(11) NOT NULL,
  `order` int(11) NOT NULL DEFAULT '0',
  `title_en` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title_ru` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `types`
--

INSERT INTO `types` (`id`, `material_id`, `order`, `title_en`, `title_ru`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Python', 'Питоновый', '2017-02-04 12:57:15', '2017-02-04 12:58:56'),
(2, 1, 1, 'Croco', 'Крокодиловый', '2017-02-04 12:58:03', '2017-02-04 12:58:03'),
(3, 1, 2, 'Ostrich', 'Страусиный', '2017-02-04 12:58:40', '2017-02-04 12:58:40');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Maks', 'maks.shikanov@gmail.com', '$2y$10$dHkFxkqtMTDR7fUK1t1rs.imf0FMboj5a24sQmdy.ayTQx4feB3Im', 1, '4AIkm0yP5pNT8nCWj2RI5hjfYEjxb4zURaaa2RazP4FBQMflQW1W1ow2C0WF', '2017-02-04 06:34:20', '2017-02-04 08:37:01'),
(4, 'User4', 'user4@gmail.com', '$2y$10$4RdI2biiK.uJQ7Qg2aRE5OlsECtcYm9Wxm1wQEuUSpZk8QRKGY9ey', 0, NULL, '2017-02-04 09:20:41', '2017-02-04 09:20:41');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bodies`
--
ALTER TABLE `bodies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `borders`
--
ALTER TABLE `borders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category_descriptions`
--
ALTER TABLE `category_descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bodies`
--
ALTER TABLE `bodies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `borders`
--
ALTER TABLE `borders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `category_descriptions`
--
ALTER TABLE `category_descriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT для таблицы `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
