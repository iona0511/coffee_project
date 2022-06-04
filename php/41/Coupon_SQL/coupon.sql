-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-04 16:02:36
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
-- 資料庫: `mydb`
--

-- --------------------------------------------------------

--
-- 資料表結構 `coupon`
--

CREATE TABLE `coupon` (
  `sid` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_send_type` int(11) NOT NULL,
  `coupon_setting_type` int(11) NOT NULL,
  `coupon_money` int(255) NOT NULL,
  `menu_sid` int(11) DEFAULT NULL,
  `products_sid` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL,
  `coupon_validity_period` int(11) NOT NULL,
  `coupon_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `coupon`
--

INSERT INTO `coupon` (`sid`, `coupon_name`, `coupon_send_type`, `coupon_setting_type`, `coupon_money`, `menu_sid`, `products_sid`, `type`, `coupon_validity_period`, `coupon_status`) VALUES
(1, '生日優惠券', 1, 1, 100, 0, 0, 3, 12, 1),
(2, '註冊優惠券', 2, 1, 100, 0, 0, 3, 12, 1),
(3, '遊戲_轉盤_優惠券', 3, 2, 1, 1, 0, 1, 6, 1),
(4, '遊戲_轉盤_優惠券', 3, 2, 1, 3, 0, 1, 6, 1),
(5, '遊戲_轉盤_優惠券', 3, 2, 1, 9, 0, 1, 6, 1),
(6, '遊戲_轉盤_優惠券', 3, 2, 1, 16, 0, 1, 6, 1),
(7, '遊戲_轉盤_優惠券', 3, 2, 1, 19, 0, 1, 6, 1),
(8, '遊戲_轉盤_優惠券', 3, 2, 1, 0, 1, 2, 6, 1),
(9, '遊戲_轉盤_優惠券', 3, 2, 1, 0, 3, 2, 6, 1),
(10, '購物優惠券', 4, 2, 1, 0, 0, 3, 6, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon`
--
ALTER TABLE `coupon`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
