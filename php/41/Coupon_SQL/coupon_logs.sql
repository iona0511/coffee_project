-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-11 03:44:53
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
-- 資料表結構 `coupon_logs`
--

CREATE TABLE `coupon_logs` (
  `sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `coupon_receive_sid` int(11) NOT NULL,
  `order_sid` int(11) NOT NULL,
  `used_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `coupon_logs`
--

INSERT INTO `coupon_logs` (`sid`, `member_sid`, `coupon_receive_sid`, `order_sid`, `used_time`) VALUES
(1, 1, 2, 1, '2022-05-31 14:29:48'),
(2, 2, 4, 3, '2022-05-31 14:50:43'),
(3, 3, 6, 0, '0000-00-00 00:00:00'),
(4, 5, 8, 0, '0000-00-00 00:00:00'),
(5, 1, 3, 20, '2022-06-08 13:14:45');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `coupon_logs`
--
ALTER TABLE `coupon_logs`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon_logs`
--
ALTER TABLE `coupon_logs`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
