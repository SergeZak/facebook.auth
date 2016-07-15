-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u1build0.15.04.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 15 2016 г., 10:46
-- Версия сервера: 5.6.28-0ubuntu0.15.04.1
-- Версия PHP: 5.6.4-4ubuntu6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `facebook.auth`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(10) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `user_id` bigint(30) NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `user_id`, `body`, `date_created`, `date_updated`) VALUES
(26, 0, 1090497200998668, 'comment 1', '2016-07-14 09:21:29', '2016-07-14 09:21:29'),
(27, 0, 1090497200998668, 'comment 2', '2016-07-14 09:21:52', '2016-07-14 09:21:52'),
(28, 0, 1090497200998668, 'comment 31', '2016-07-14 13:25:48', '2016-07-14 13:25:48'),
(29, 26, 1090497200998668, '123', '2016-07-14 09:28:46', '2016-07-14 09:28:18'),
(30, 26, 1090497200998668, '123 ', '2016-07-14 09:28:49', '2016-07-14 09:28:20'),
(31, 26, 1090497200998668, '312', '2016-07-14 09:30:00', '2016-07-14 09:29:09'),
(32, 26, 1090497200998668, '456', '2016-07-14 09:30:03', '2016-07-14 09:29:11'),
(33, 31, 1090497200998668, 'comment 4', '2016-07-14 09:34:43', '2016-07-14 09:34:22'),
(34, 31, 1090497200998668, 'comment 5', '2016-07-14 09:35:39', '2016-07-14 09:35:06'),
(35, 28, 1090497200998668, 'sub comment 3', '2016-07-14 13:23:52', '2016-07-14 13:23:52'),
(36, 35, 1090497200998668, 'sub 1sub 1comment 3111', '2016-07-14 13:20:45', '2016-07-14 13:20:45'),
(37, 27, 1090497200998668, 'sub comment 2', '2016-07-14 11:26:37', '2016-07-14 11:26:37'),
(38, 28, 1090497200998668, 'more sub comment 37', '2016-07-14 13:22:53', '2016-07-14 13:22:53'),
(39, 0, 210921452642150, 'new comment', '2016-07-14 12:21:40', '2016-07-14 12:21:40'),
(40, 28, 210921452642150, 'edit comment 31111', '2016-07-14 12:22:13', '2016-07-14 12:22:13'),
(41, 36, 210921452642150, 'sub sub sub comment 3', '2016-07-14 12:22:29', '2016-07-14 12:22:29'),
(42, 0, 1090497200998668, 'fifth 12377777\r\n', '2016-07-14 13:26:08', '2016-07-14 16:36:36'),
(43, 42, 1090497200998668, 'fifth', '2016-07-14 13:42:30', '2016-07-14 13:42:30'),
(44, 42, 1090497200998668, 'more comment 77', '2016-07-14 13:35:06', '2016-07-14 13:47:24'),
(45, 0, 1090497200998668, 'new mess', '2016-07-14 16:36:45', '2016-07-14 16:36:45'),
(46, 45, 1090497200998668, '123', '2016-07-14 16:36:55', '2016-07-14 16:36:55'),
(47, 45, 1090497200998668, '456', '2016-07-14 16:37:01', '2016-07-14 16:37:01'),
(48, 45, 1090497200998668, '578', '2016-07-14 16:37:10', '2016-07-14 16:37:10');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(20) NOT NULL,
  `fb_id` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `picture` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fb_id`, `email`, `name`, `picture`) VALUES
(7, 1090497200998668, 'sergezak9@gmail.com', 'Sergey Zakhartchenko', 'https://scontent.xx.fbcdn.net/v/t1.0-1/c15.0.50.50/p50x50/10354686_10150004552801856_220367501106153455_n.jpg?oh=5c43cf5cfa35da8de30688b57a56d839&oe=5824062F'),
(8, 210921452642150, 'test.iwriter.com@gmail.com', 'TestIwriter TestIwriter', 'https://scontent.xx.fbcdn.net/v/t1.0-1/c15.0.50.50/p50x50/10354686_10150004552801856_220367501106153455_n.jpg?oh=5c43cf5cfa35da8de30688b57a56d839&oe=5824062F');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD KEY `fb_id` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
MODIFY `id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
