-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-11 03:45:04
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
-- 資料表結構 `coupon_receive`
--

CREATE TABLE `coupon_receive` (
  `sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `coupon_sid` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `coupon_receive`
--

INSERT INTO `coupon_receive` (`sid`, `member_sid`, `coupon_sid`, `create_time`, `end_time`, `status`) VALUES
(1, 1, 1, '2022-03-28 00:00:00', '2023-03-28 00:00:00', 0),
(2, 1, 2, '2022-03-31 00:00:00', '2023-03-31 00:00:00', 1),
(3, 1, 3, '2022-05-07 00:00:00', '2023-11-07 00:00:00', 1),
(4, 2, 4, '2022-05-07 00:00:00', '2023-11-07 00:00:00', 1),
(5, 2, 4, '2022-05-08 00:00:00', '2022-11-08 00:00:00', 0),
(6, 3, 5, '2022-05-09 00:00:00', '2022-11-09 00:00:00', 1),
(7, 4, 7, '2022-05-19 00:00:00', '2022-11-19 00:00:00', 0),
(8, 5, 8, '2022-05-28 00:00:00', '2022-11-28 00:00:00', 1),
(9, 6, 9, '2022-05-30 00:00:00', '2022-11-30 00:00:00', 0),
(10, 7, 10, '2022-06-01 00:00:00', '2022-11-01 00:00:00', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `coupon_receive`
--
ALTER TABLE `coupon_receive`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon_receive`
--
ALTER TABLE `coupon_receive`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
