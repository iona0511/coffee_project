-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-06 07:31:37
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
(1, 1, 200, 1),
(2, 2, 340, 2),
(3, 3, 700, 5),
(4, 4, 1200, 3),
(5, 5, 0, 0);

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
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
