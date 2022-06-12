-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2022 年 06 月 12 日 05:57
-- 伺服器版本： 10.4.21-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `coffee_project`
--

-- --------------------------------------------------------

--
-- 資料表結構 `menu`
--

CREATE TABLE `menu` (
  `menu_sid` int(11) NOT NULL,
  `menu_categories` varchar(255) NOT NULL,
  `menu_photo` varchar(255) DEFAULT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_kcal` float DEFAULT NULL,
  `menu_price_m` varchar(5) DEFAULT NULL,
  `menu_nutrition` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `menu`
--

INSERT INTO `menu` (`menu_sid`, `menu_categories`, `menu_photo`, `menu_name`, `menu_kcal`, `menu_price_m`, `menu_nutrition`, `created_at`) VALUES
(1, '經典義式系列', '001.jpg', '咖啡拿鐵', 381.4, '70', '咖啡因含量:黃101-200mg/杯', '2022-06-10 00:00:00'),
(2, '經典義式系列', '55edc48f0c7d0f600811a35b18af1c92.jpg', '焦糖瑪奇朵', 275.4, '80', '咖啡因含量:黃101-200mg/杯', '2022-06-11 00:00:00'),
(3, '經典義式系列', 'c67ac0f4450dfa854ad1262d418b8ee5.jpg', '卡布奇諾', 260.5, '70', '咖啡因含量:黃101-200mg/杯', '2022-06-12 00:00:00'),
(4, '經典義式系列', '0013bda9329f787150f1ec871c451ff3.jpg', '美式黑咖啡', 23.4, '50', '咖啡因含量:黃101-200mg/杯', '2022-06-13 00:00:00'),
(5, '經典義式系列', '1bc549de4d520b1e765047a986212ae5.jpg', '黑糖風味拿鐵', 375.2, '80', '咖啡因含量:黃101-200mg/杯', '2022-06-14 00:00:00'),
(6, '經典義式系列', 'fbad8476a0efa16d294b7084b91f2d52.jpg', '鴛鴦咖啡', 231.3, '70', '咖啡因含量:綠100mg/杯', '2022-06-15 00:00:00'),
(7, '經典義式系列', '2eb04c346d2d656371f2ebef258723e5.jpg', '香草風味拿鐵', 240.5, '90', '咖啡因含量:黃101-200mg/杯', '2022-06-16 00:00:00'),
(8, '經典義式系列', '9d8671c15bb0b49dee3efb42a3069ed8.jpg', '拿鐵歐蕾', 197.5, '75', '咖啡因含量:綠100mg以下/杯', '2022-06-17 00:00:00'),
(9, '經典義式系列', 'd2d87c13394493eabdd11b103eb064f3.png', '義式摩卡', 368, '80', '咖啡因含量:黃101-200mg/杯', '2022-06-18 00:00:00'),
(10, '精品咖啡', 'd9a76cfe99cf192d735c9c9cb70d4448.jpg', '莊園級美式', 15.5, '60', '咖啡因含量:紅201mg/杯', '2022-06-19 00:00:00'),
(11, '精品咖啡', 'b3d11ac20f069a07f15bd5c498335555.jpg', '莊園級拿鐵', 267.7, '80', '咖啡因含量:紅201mg/杯', '2022-06-20 00:00:00'),
(12, '精品咖啡', '75e5cbe6cc51ad01657f623c0d099b1e.jpg', '哥倫比亞', 4, '95', '咖啡因含量:黃101-200mg/杯', '2022-06-21 00:00:00'),
(13, '精品咖啡', '6e21e68eb8f62bcc4246bc62dcd0d4ae.jpg', '曼巴', 4, '95', '咖啡因含量:黃101-200mg/杯', '2022-06-22 00:00:00'),
(14, '精品咖啡', '4131a52558bd761115c72d8bf080fe27.jpg', '黃金曼特寧', 4, '95', '咖啡因含量:黃101-200mg/杯', '2022-06-23 00:00:00'),
(15, '精品咖啡', '733bae90259eeca1be4e770face3928d.jpg', '肯亞 精選小農', 4, '95', '咖啡因含量:黃101-200mg/杯', '2022-06-24 00:00:00'),
(16, '精品咖啡', 'd70f655a4d141c7f8d350dfdab6a149d.jpg', '莊園老饕深焙', 4, '95', '咖啡因含量:黃101-200mg/杯', '2022-06-25 00:00:00'),
(17, '精品咖啡', '5c12bdc581899e387e4b30759fef309a.jpg', '耶加雪菲', 4, '100', '咖啡因含量:黃101-200mg/杯', '2022-06-26 00:00:00'),
(18, '其他飲品', 'b1c356819ea30ce2ab7cce65ada72a0d.png', '義式巧克力', 378, '60', '總糖量:64.1公克', '2022-06-27 00:00:00'),
(19, '其他飲品', 'aed82eb7f25076a5759aba638a9ef9cd.jpg', '愛丁堡女王紅茶', 50, '40', '茶葉產地:印度、斯里蘭卡、尼泊爾、台灣、越南', '2022-06-28 00:00:00'),
(20, '其他飲品', '2cd478061562819a23f4e0b50c8a1950.jpg', '宇治奶茶', 345, '50', '茶葉產地:日本京都府', '2022-06-29 00:00:00'),
(33, '其他飲品', '20210217_025217.jpeg', '英國百年茶莊紅茶冰沙', 475, '50', '紅茶產地：英國', '2022-06-12 00:04:21');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
