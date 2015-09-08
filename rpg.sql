
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 08 2015 г., 17:56
-- Версия сервера: 10.0.20-MariaDB
-- Версия PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `u850336151_rpg`
--

-- --------------------------------------------------------

--
-- Структура таблицы `experience`
--

CREATE TABLE IF NOT EXISTS `experience` (
  `exp_id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`exp_id`),
  UNIQUE KEY `exp_name` (`exp_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `experience`
--

INSERT INTO `experience` (`exp_id`, `exp_name`) VALUES
(1, 'arpegio'),
(2, 'chords knowledge'),
(5, 'java script'),
(6, 'jquery'),
(7, 'pencil'),
(4, 'php'),
(3, 'rythm');

-- --------------------------------------------------------

--
-- Структура таблицы `mapping`
--

CREATE TABLE IF NOT EXISTS `mapping` (
  `user_id` int(11) NOT NULL COMMENT 'для какого юзера улучшаем скилл',
  `skill_id` int(11) NOT NULL COMMENT 'какой именно скилл улучшаем',
  `exp_id` int(11) NOT NULL COMMENT 'этот показатель экспы влияет на определенный показатель скилла определенного юзера',
  `exp_value` float NOT NULL COMMENT 'этот показатель экспы влияет на определенный показатель скилла определенного юзера'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `mapping`
--

INSERT INTO `mapping` (`user_id`, `skill_id`, `exp_id`, `exp_value`) VALUES
(1, 1, 1, 115),
(1, 1, 2, 262),
(1, 1, 3, 123),
(1, 2, 4, 114),
(1, 2, 5, 195),
(1, 2, 6, 206),
(1, 3, 7, 307),
(1, 1, 1, 115),
(1, 2, 4, 0),
(1, 2, 4, 0),
(0, 2, 4, 0),
(0, 2, 4, 0),
(0, 2, 4, 0),
(0, 2, 4, 0),
(0, 2, 4, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `skill_id` int(10) NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `skill_picture` varchar(40) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`skill_id`),
  UNIQUE KEY `skill_name` (`skill_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `skills`
--

INSERT INTO `skills` (`skill_id`, `skill_name`, `skill_picture`) VALUES
(1, 'Guitar', 'guitar-skill.jpg'),
(2, 'Programming', 'programmer-skill.jpg'),
(3, 'Drawing', 'draw-skill.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_desciption` text COLLATE utf8_unicode_ci NOT NULL,
  `task_status` tinyint(1) NOT NULL,
  `task_importance` int(2) NOT NULL,
  `task_difficult` int(2) NOT NULL,
  `exp_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=58 ;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`task_id`, `task_desciption`, `task_status`, `task_importance`, `task_difficult`, `exp_id`, `user_id`, `task_date`) VALUES
(2, 'fsdfsdfsdf', 1, 1, 1, 2, 1, '2015-06-05 07:21:46'),
(3, 'asdasdwefwef', 1, 1, 1, 1, 1, '2015-05-24 10:46:18'),
(15, 'EKLMN', 1, 1, 1, 4, 1, '2015-06-02 10:35:07'),
(16, 'EKLMN', 1, 1, 1, 5, 1, '2015-06-02 10:47:14'),
(17, 'EKLMN', 1, 1, 1, 1, 1, '2015-05-24 10:46:18'),
(19, 'EKLMN', 1, 1, 1, 1, 1, '2015-06-05 07:21:22'),
(21, 'Ð·Ð°Ð´Ð°Ñ‡Ð° â„–1', 1, 1, 1, 1, 1, '2015-06-05 07:21:46'),
(39, 'kill all humans', 1, 2, 2, 2, 1, '2015-06-02 04:47:38'),
(52, 'Выучить ария - закат', 1, 1, 2, 1, 1, '2015-06-26 20:00:01'),
(51, 'ркывавпывапывапва', 1, 1, 1, 3, 1, '2015-06-26 18:47:51'),
(53, 'ipiopiop', 1, 3, 2, 2, 1, '2015-07-24 08:52:50'),
(54, '12345678', 1, 1, 1, 3, 1, '2015-08-10 11:09:55'),
(55, '12345678', 0, 1, 1, 3, 1, '2015-07-24 10:27:25'),
(56, '12345678', 1, 1, 1, 3, 1, '2015-08-10 11:09:55'),
(57, 'asdasdasd', 0, 1, 1, 3, 1, '2015-08-10 11:10:22');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) CHARACTER SET latin1 NOT NULL,
  `email` varchar(40) CHARACTER SET latin1 NOT NULL,
  `pass` varchar(40) CHARACTER SET latin1 NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avatar` varchar(40) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `user_id_2` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `login`, `email`, `pass`, `join_date`, `avatar`) VALUES
(1, 'AtNovember', 'girl-tlt@mail.ru', '202cb962ac59075b964b07152d234b70', '2015-06-03 08:08:21', ''),
(2, '', 'i-strider@yandex.ru', 'b6d767d2f8ed5d21a44b0e5886680cb9', '2015-06-16 13:21:05', ''),
(3, '', 'suvorov63ru@yandex.ru', '7e26ede707bcbcaa19ced1cb2739d658', '2015-07-02 17:15:13', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
