-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-11-17 09:45:55
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `promo_code`
--

-- --------------------------------------------------------

--
-- 資料表結構 `promo`
--

CREATE TABLE `promo` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `promo_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valid` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `promo`
--

INSERT INTO `promo` (`id`, `name`, `class`, `date`, `date_end`, `promo_id`, `valid`) VALUES
(1, 'PHP崩潰禮卷', '777', '2020-11-09', '2020-11-19', '6', '1'),
(2, '雙十一禮卷', '111', '2020-11-11', '2020-11-12', '7', '1'),
(3, '聖誕禮卷', '200', '2020-11-25', '2021-01-01', '8', '1'),
(4, '88優惠禮卷', '88', '2020-11-11', '2020-11-20', '4', '1'),
(5, '99優惠禮卷', '99', '2020-11-19', '2020-12-19', '5', '1'),
(6, 'sql崩潰中', '888', '2020-11-09', '2020-11-19', '6', '1'),
(7, '光棍節禮卷', '1111', '2020-11-10', '2020-11-12', '7', '1'),
(8, '黑色星期五', '555', '2020-11-20', '2021-11-30', '8', '1'),
(9, '100優惠禮卷', '100', '2020-11-11', '2020-11-20', '4', '1'),
(10, '150優惠禮卷', '150', '2020-11-19', '2020-12-19', '5', '1'),
(11, '神奇海螺', '666', '2020-11-06', '2020-12-04', '22', '1'),
(12, '小智大師', '8787', '2020-11-15', '2020-11-22', '87', '1');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `promo`
--
ALTER TABLE `promo`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
