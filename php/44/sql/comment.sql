-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-12 19:43:05
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
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `sid` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `replies` int(11) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL,
  `post_sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `comment`
--

INSERT INTO `comment` (`sid`, `content`, `replies`, `created_at`, `post_sid`, `member_sid`) VALUES
(1, '挖~課程看起來很讚耶 不知道適不適合新手?', 1, '2022-06-03', 1, 1005),
(15, '我也覺得', 0, '2022-06-13', 161, 886),
(16, '可愛', 0, '2022-06-13', 2, 886),
(17, '看起來好讚我也想參加!', 0, '2022-06-13', 1, 886),
(18, '我喜歡粗好粗的', 0, '2022-06-13', 150, 1001),
(19, '推推', 0, '2022-06-13', 147, 666),
(20, '拍的好看喔', 0, '2022-06-13', 150, 666),
(21, '餓了', 0, '2022-06-13', 144, 666);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment`
--
ALTER TABLE `comment`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
