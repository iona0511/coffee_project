-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-11 10:30:20
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
-- 資料表結構 `points_user`
--

CREATE TABLE `points_user` (
  `sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `total_points` int(255) DEFAULT NULL,
  `voucher_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `points_user`
--

INSERT INTO `points_user` (`sid`, `member_sid`, `total_points`, `voucher_amount`) VALUES
(1, 1, 800, 1),
(2, 2, 0, 2),
(3, 3, 700, 5),
(4, 4, 2000, 3),
(5, 5, 0, 0),
(6, 6, 500, 10),
(7, 7, 600, 14),
(666, 666, 0, 0),
(1001, 1001, 0, 0),
(1006, 1005, 0, 11),
(1042, 1042, 0, 2),
(1408, 1408, 0, 12),
(1409, 1409, 0, 3),
(1412, 1412, 0, 2),
(1413, 1413, 0, 0),
(1414, 1414, 0, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `points_user`
--
ALTER TABLE `points_user`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `points_user`
--
ALTER TABLE `points_user`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1415;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
