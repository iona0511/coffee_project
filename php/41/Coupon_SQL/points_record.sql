-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-11 03:45:20
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
-- 資料表結構 `points_record`
--

CREATE TABLE `points_record` (
  `sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `points_get` int(255) DEFAULT NULL,
  `create_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `points_record`
--

INSERT INTO `points_record` (`sid`, `member_sid`, `type`, `points_get`, `create_at`) VALUES
(1, 1, 1, 10, '2022-06-02'),
(2, 2, 2, -300, '2022-06-03'),
(3, 3, 1, 10, '2022-06-03'),
(4, 1, 1, 10, '2022-06-04'),
(5, 1, 1, 10, '2022-06-05'),
(6, 3, 2, -300, '2022-06-05'),
(7, 4, 1, 10, '2022-06-03'),
(8, 4, 1, 10, '2022-06-04'),
(9, 4, 1, 10, '2022-06-05'),
(10, 7, 1, 10, '2022-06-03'),
(11, 7, 1, 10, '2022-06-04'),
(12, 7, 1, 10, '2022-06-05');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `points_record`
--
ALTER TABLE `points_record`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `points_record`
--
ALTER TABLE `points_record`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
