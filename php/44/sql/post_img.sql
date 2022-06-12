-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-12 19:43:19
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
-- 資料表結構 `post_img`
--

CREATE TABLE `post_img` (
  `sid` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `post_sid` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `post_img`
--

INSERT INTO `post_img` (`sid`, `img_name`, `post_sid`, `sort`) VALUES
(0, 'default_pic.jpg', 0, 1),
(1, 'flower2.jpg', 1, 1),
(2, 'flower1.jpg', 1, 2),
(3, 'default_pic.jpg', 2, 1),
(4, 'flower4.jpg', 1, 2),
(5, 'flower3.jpg', 1, 3),
(710, '20220612_18_e05d65.jpg', 143, 1),
(711, '20220612_18_dd3783.jpg', 144, 1),
(712, '20220612_18_5b1c83.jpg', 145, 1),
(713, '20220612_18_971a6d.jpg', 146, 1),
(714, 'coffee_.jpg', 147, 1),
(715, '20220612_18_b884ba.jpg', 149, 1),
(716, '20220612_18_c7414c.jpg', 150, 1),
(717, '20220612_18_2f107d.jpg', 151, 1),
(718, '20220612_18_4afe78.png', 152, 1),
(719, '20220612_18_f4cd37.jpg', 153, 1),
(720, '20220612_18_cfa2df.jpg', 154, 1),
(721, '20220612_18_fa4998.jpg', 154, 2),
(722, '20220612_18_e3223b.jpg', 155, 1),
(723, '20220612_18_11202e.jpg', 156, 1),
(724, '20220612_18_b058f2.jpg', 157, 1),
(725, 'sss.jpg', 158, 1),
(726, 'sss.jpg', 159, 1),
(727, 'sss.jpg', 160, 1),
(728, 'sss.jpg', 161, 1),
(729, '20220612_19_15a0d5.jpg', 162, 1),
(730, '20220612_19_15a0d5.jpg', 163, 1),
(731, '20220612_19_af0abe.jpg', 164, 1),
(732, '20220612_19_3610a3.jpg', 165, 1),
(733, '20220612_19_6e9ff1.jpg', 166, 1),
(734, '20220612_19_fed80e.jpg', 167, 1),
(735, '20220612_19_ec5a18.jpg', 168, 1),
(738, '20220612_19_28ce2e.jpg', 169, 1),
(739, '20220612_19_af195a.jpg', 170, 1),
(740, '20220612_19_bb7904.jpg', 171, 1),
(741, '20220612_19_b51e8e.jpg', 172, 1),
(742, '20220612_19_998a77.jpg', 173, 1),
(743, '20220612_19_4a3ede.jpg', 174, 1),
(744, '20220612_19_cc8797.png', 175, 1),
(745, '20220612_19_779248.jpg', 176, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `post_img`
--
ALTER TABLE `post_img`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_img`
--
ALTER TABLE `post_img`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=746;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
