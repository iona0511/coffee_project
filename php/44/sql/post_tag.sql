-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-12 19:43:30
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `coffee`
--

-- --------------------------------------------------------

--
-- 資料表結構 `post_tag`
--

CREATE TABLE `post_tag` (
  `sid` int(11) NOT NULL,
  `post_sid` int(11) NOT NULL,
  `tag_sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `post_tag`
--

INSERT INTO `post_tag` (`sid`, `post_sid`, `tag_sid`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 4),
(38, 143, 16),
(39, 143, 1),
(40, 145, 17),
(41, 146, 18),
(42, 149, 4),
(43, 149, 2),
(44, 149, 19),
(45, 149, 3),
(46, 150, 20),
(47, 150, 21),
(48, 150, 22),
(49, 152, 23),
(50, 153, 2),
(51, 154, 24),
(52, 154, 25),
(53, 155, 24),
(54, 156, 1),
(55, 156, 2),
(56, 157, 2),
(57, 161, 26),
(58, 162, 27),
(59, 162, 2),
(60, 163, 27),
(61, 163, 2),
(62, 164, 27),
(63, 167, 24),
(64, 168, 17),
(65, 169, 16),
(66, 169, 28),
(67, 170, 1),
(68, 171, 22),
(69, 171, 29),
(70, 175, 18),
(71, 175, 2),
(72, 175, 27),
(73, 176, 16);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
