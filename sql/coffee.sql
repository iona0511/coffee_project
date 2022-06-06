-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-05 06:21:31
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
-- 資料表結構 `admin`
--

CREATE TABLE `admin` (
  `admin_sid` int(11) NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `admin`
--

INSERT INTO `admin` (`admin_sid`, `admin_name`, `admin_account`, `admin_password`) VALUES
(1, 'chia', 'chia', 'chia123'),
(2, 'black', 'black', 'black');

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `cart_sid` int(10) NOT NULL,
  `cart_product_id` int(255) NOT NULL DEFAULT 0,
  `cart_food_id` int(10) NOT NULL DEFAULT 0,
  `cart_price` int(10) NOT NULL,
  `cart_quantity` int(10) NOT NULL,
  `cart_member_id` int(10) NOT NULL,
  `cart_order_id` int(10) NOT NULL DEFAULT 0,
  `cart_delete` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `cart`
--

INSERT INTO `cart` (`cart_sid`, `cart_product_id`, `cart_food_id`, `cart_price`, `cart_quantity`, `cart_member_id`, `cart_order_id`, `cart_delete`) VALUES
(1, 1, 0, 310, 1, 1, 1, 0),
(2, 2, 0, 320, 2, 1, 1, 0),
(3, 5, 0, 150, 2, 1, 1, 0),
(4, 3, 0, 470, 2, 3, 2, 0),
(5, 4, 0, 150, 1, 3, 2, 0),
(6, 1, 0, 310, 1, 2, 0, 0),
(7, 2, 0, 320, 1, 2, 0, 0),
(8, 3, 0, 470, 1, 2, 0, 0),
(9, 4, 0, 150, 2, 2, 0, 0),
(10, 1, 0, 310, 1, 4, 0, 0),
(11, 5, 0, 150, 1, 4, 0, 0),
(12, 5, 0, 150, 1, 2, 0, 1),
(13, 2, 0, 320, 2, 5, 0, 0),
(14, 4, 0, 150, 2, 5, 0, 0),
(15, 3, 0, 470, 1, 5, 0, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `sid` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `replies` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `post_sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `member_nickname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `comment`
--

INSERT INTO `comment` (`sid`, `content`, `replies`, `created_at`, `post_sid`, `member_sid`, `member_nickname`) VALUES
(1, '挖~課程看起來很讚耶char<br>不知道適不適合新手?', 1, '2022-06-03', 1, 1005, '123');

-- --------------------------------------------------------

--
-- 資料表結構 `coupon`
--

CREATE TABLE `coupon` (
  `sid` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_send_type` int(11) NOT NULL,
  `coupon_setting_type` int(11) NOT NULL,
  `coupon_money` varchar(255) NOT NULL,
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
(1, '生日優惠券$100', 1, 1, '100', 0, 0, 3, 12, 1),
(2, '註冊優惠券$100', 2, 1, '100', 0, 0, 3, 12, 1),
(3, '咖啡拿鐵5折', 3, 2, '0.5', 1, 0, 1, 6, 1),
(4, '卡布奇諾5折', 3, 2, '0.5', 3, 0, 1, 6, 1),
(5, '義式摩卡75折', 3, 2, '0.75', 9, 0, 1, 6, 1),
(6, '耶加雪菲75折', 3, 2, '0.75', 16, 0, 1, 6, 1),
(7, '宇治奶茶8折', 3, 2, '0.8', 19, 0, 1, 6, 1),
(8, '精選曼巴咖啡組8折', 3, 2, '0.8', 0, 1, 2, 6, 1),
(9, '黃金曼特寧組9折', 3, 2, '0.8', 0, 3, 2, 6, 1),
(10, '購物優惠券9折', 4, 2, '0.9', 0, 0, 3, 6, 1);

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
(1, 1, 2, 0, NULL),
(2, 2, 4, 0, '2022-06-01 00:00:00');

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
(1, 1, 1, '2021-03-24 00:00:00', '2022-03-24 00:00:00', 0),
(2, 1, 2, '2022-03-31 00:00:00', '2023-03-31 00:00:00', 0),
(3, 1, 3, '2022-05-07 00:00:00', '2023-11-07 00:00:00', 0),
(4, 2, 4, '2022-05-07 00:00:00', '2023-11-07 00:00:00', 0),
(5, 2, 4, '2022-05-08 00:00:00', '2022-11-08 00:00:00', 0),
(6, 3, 5, '2022-05-09 00:00:00', '2022-11-09 00:00:00', 0),
(7, 4, 7, '2022-05-19 00:00:00', '2022-11-19 00:00:00', 0),
(8, 5, 8, '2022-05-28 00:00:00', '2022-11-28 00:00:00', 0),
(9, 6, 9, '2022-05-30 00:00:00', '2022-11-30 00:00:00', 0),
(10, 7, 10, '2022-06-01 00:00:00', '2022-11-01 00:00:00', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `course`
--

CREATE TABLE `course` (
  `course_sid` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_level` int(11) NOT NULL,
  `course_img_s` varchar(255) NOT NULL,
  `course_content` varchar(255) NOT NULL,
  `course_people` varchar(255) NOT NULL,
  `course_material` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `course`
--

INSERT INTO `course` (`course_sid`, `course_name`, `course_price`, `course_level`, `course_img_s`, `course_content`, `course_people`, `course_material`) VALUES
(1, '愛心拉花', 1000, 1, 'img', '拉花基礎課程、親子同樂好選擇', '適合所有人', '牛奶.咖啡豆(課程提供)'),
(2, '花型拉花', 1000, 1, 'img', '拉花基礎課程、親子同樂好選擇', '適合所有人', '牛奶.咖啡豆(課程提供)'),
(3, '咖啡烘焙', 2000, 2, 'img', '體驗自己親手烘焙咖啡豆的樂趣', '想體驗自己烘咖啡豆的人', '咖啡豆.相關沖煮器材設備(課程提供)'),
(4, '咖啡生豆認識及風味鑑嘗學', 3000, 3, 'img', '認識不同咖啡產地及品種，加強自己品嚐咖啡思維', '對咖啡豆有濃厚興趣及對咖啡烘焙有興趣朋友參加', '咖啡豆.相關沖煮器材設備(課程提供)'),
(5, '手沖咖啡基礎訓練班', 1500, 1, 'img', '學會從風味中了解自己沖煮手法', '適合初學者或希望了解自己沖煮技巧缺點人士', '咖啡豆.相關沖煮器材設備(課程提供)'),
(6, '聖誕樹拉花', 1500, 2, 'img', '拉花中級課程、親子同樂好選擇', '適合所有人', '牛奶.咖啡豆(課程提供)');

-- --------------------------------------------------------

--
-- 資料表結構 `course_related`
--

CREATE TABLE `course_related` (
  `sid` int(11) NOT NULL,
  `course_sid` int(11) NOT NULL,
  `course_date` date NOT NULL,
  `course_time` varchar(255) NOT NULL,
  `course_img_l` varchar(255) NOT NULL,
  `course_number_people` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `course_related`
--

INSERT INTO `course_related` (`sid`, `course_sid`, `course_date`, `course_time`, `course_img_l`, `course_number_people`) VALUES
(1, 1, '2022-09-01', 'AM-10', 'img', 0),
(2, 1, '2022-09-25', 'PM-02', 'img', 0),
(3, 1, '2022-08-30', 'PM-03', 'img', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `lastest_news`
--

CREATE TABLE `lastest_news` (
  `news_sid` int(11) NOT NULL,
  `news_img` varchar(255) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_class_sid` int(11) NOT NULL,
  `news_start_date` date NOT NULL,
  `news_end_date` date NOT NULL,
  `news_content` varchar(255) NOT NULL,
  `news_create_time` datetime NOT NULL,
  `news_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `lastest_news`
--

INSERT INTO `lastest_news` (`news_sid`, `news_img`, `news_title`, `news_class_sid`, `news_start_date`, `news_end_date`, `news_content`, `news_create_time`, `news_status`) VALUES
(1, '123.jpg', '精選好好喝咖啡豆即日起購買任兩件，第二件即可打七折呦，分享優惠再送濾掛式咖啡一包。', 1, '2017-08-10', '2018-08-10', '快來揪朋友做分享拿好禮喔', '2022-05-31 11:14:27', 5),
(2, '123.jpg', '行動預點專屬 – 週一週二星禮遇', 2, '2022-01-01', '2022-06-30', '一般會員於週一或週二購買輕食即可享8折優惠', '2022-05-31 11:23:10', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `member_sid` int(11) NOT NULL,
  `member_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_birthday` date DEFAULT NULL,
  `member_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`member_sid`, `member_name`, `member_nickname`, `member_account`, `member_password`, `member_birthday`, `member_mobile`, `member_address`, `member_mail`, `member_level`, `avatar`) VALUES
(1, '王曉明', '阿明', 'ming', 'ming', '2022-05-30', '0911222333', '台北市大安區', 'ming@test.com', '800', ''),
(2, '小黑', 'black', 'black', 'black', '2022-05-12', '0912345678', '新北市', 'black@test.com', '0', '1539960.gif'),
(4, '小白', 'white', 'white', 'white', '2022-06-08', '0911123456', '台北市', 'white@test.com', '2000', ''),
(7, '123', '睡覺了', '123', '123', NULL, '123', '123456789', '123@test123', '', '1539960.gif'),
(14, '123', '123', '123', '123', NULL, '123', '123', '123@test123', '0', ''),
(17, '測試', '小白', '123', '12345', NULL, '123', '新北市', '123@test123', '', '31Xj7BP6MCTmxwUJ972W89EBE1HSoAlRJIcJtZIB.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `member_likes`
--

CREATE TABLE `member_likes` (
  `sid` int(11) NOT NULL,
  `member_sid` varchar(255) NOT NULL,
  `post_name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `menu_price_l` varchar(5) DEFAULT NULL,
  `menu_nutrition` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `menu`
--

INSERT INTO `menu` (`menu_sid`, `menu_categories`, `menu_photo`, `menu_name`, `menu_kcal`, `menu_price_m`, `menu_price_l`, `menu_nutrition`, `created_at`) VALUES
(1, '經典義式系列', NULL, '咖啡拿鐵 (冰)', 381.4, '70', '90', NULL, '2022-05-28 00:00:00'),
(3, '經典義式系列', NULL, '卡布奇諾 (冰)', 266.7, '70', '90', NULL, '2022-05-30 00:00:00'),
(4, '經典義式系列', NULL, '卡布奇諾 (熱)', 260.5, '70', '90', NULL, '2022-05-31 00:00:00'),
(5, '經典義式系列', NULL, '美式黑咖啡 (冰)', 23.4, '50', '65', NULL, '2022-06-01 00:00:00'),
(7, '經典義式系列', NULL, '焦糖瑪奇朵 (冰)', 371.3, '80', '100', NULL, '2022-06-03 00:00:00'),
(8, '經典義式系列', NULL, '焦糖瑪奇朵 (熱)', 275.4, '80', '100', NULL, '2022-06-04 00:00:00'),
(9, '經典義式系列', NULL, '義式摩卡 (冰)', 368, '80', '100', NULL, '2022-06-05 00:00:00'),
(10, '經典義式系列', NULL, '義式摩卡 (熱)', 289.6, '80', '100', NULL, '2022-06-06 00:00:00'),
(11, '經典義式系列', NULL, '黑糖風味拿鐵 (冰)', 375.2, '80', '100', NULL, '2022-06-07 00:00:00'),
(12, '經典義式系列', NULL, '黑糖風味拿鐵 (熱)', 299, '80', '100', NULL, '2022-06-08 00:00:00'),
(13, '精品咖啡', NULL, '莊園級美式 (冰)', 15.5, '60', '80', NULL, '2022-06-09 00:00:00'),
(14, '精品咖啡', NULL, '莊園級美式 (熱)', 15.5, '60', '80', NULL, '2022-06-10 00:00:00'),
(15, '精品咖啡', NULL, '莊園級拿鐵 (冰)', 267.7, '80', '100', NULL, '2022-06-11 00:00:00'),
(16, '精品咖啡', NULL, '莊園級拿鐵 (熱)', 214.3, '80', '100', NULL, '2022-06-12 00:00:00'),
(17, '精品咖啡', NULL, '耶加雪菲 (冰)', 4, '100', NULL, NULL, '2022-06-13 00:00:00'),
(18, '精品咖啡', NULL, '耶加雪菲 (熱)', 7.2, '100', NULL, NULL, '2022-06-14 00:00:00'),
(19, '其他飲品', NULL, '愛丁堡女王紅茶', 50, '40', NULL, NULL, '2022-06-15 00:00:00'),
(20, '其他飲品', NULL, '宇治奶茶', 345, '50', NULL, NULL, '2022-06-16 00:00:00'),
(21, '其他飲品', NULL, '義式巧克力', 378, '60', NULL, NULL, '2022-06-17 00:00:00'),
(22, '其他飲品', NULL, '紅翠青檸茶', 187.5, '50', NULL, NULL, '2022-06-18 00:00:00'),
(23, '其他飲品', NULL, '紅蜜鮮奶茶', 456.2, '60', NULL, NULL, '2022-06-19 00:00:00'),
(24, '其他飲品', NULL, '水蜜桃蘋果茶', 345.1, '50', NULL, NULL, '2022-06-20 00:00:00'),
(25, '貝果', NULL, '火腿貝果', 399.6, '60', NULL, NULL, '2022-06-21 00:00:00'),
(26, '貝果', NULL, '蔬菜貝果', 356.2, '60', NULL, NULL, '2022-06-22 00:00:00'),
(27, '貝果', NULL, '鮪魚貝果', 422.6, '60', NULL, NULL, '2022-06-23 00:00:00'),
(28, '貝果', NULL, '牛肉貝果', 400.3, '70', NULL, NULL, '2022-06-24 00:00:00'),
(29, '瑪芬堡', NULL, '豬肉起司瑪芬堡', 358.7, '55', NULL, NULL, '2022-06-25 00:00:00'),
(30, '瑪芬堡', NULL, '豬肉瑪芬堡', 400, '55', NULL, NULL, '2022-06-26 00:00:00'),
(31, '瑪芬堡', NULL, '雙層豬肉瑪芬堡', 516.9, '75', NULL, NULL, '2022-06-27 00:00:00'),
(33, '三明治', NULL, '火腿三明治', 312.7, '45', NULL, NULL, '2022-06-29 00:00:00'),
(34, '三明治', NULL, '鮪魚三明治', 315.6, '45', NULL, NULL, '2022-06-30 00:00:00'),
(35, '三明治', NULL, '牛肉三明治', 300.8, '55', NULL, NULL, '2022-07-01 00:00:00'),
(36, '口袋歐姆蛋', NULL, '起司歐姆蛋', 270, '50', NULL, NULL, '2022-07-02 00:00:00'),
(37, '口袋歐姆蛋', NULL, '培根歐姆蛋', 295.2, '60', NULL, NULL, '2022-07-03 00:00:00'),
(38, '口袋歐姆蛋', NULL, '鮪魚歐姆蛋', 296.9, '60', NULL, NULL, '2022-07-04 00:00:00'),
(39, '口袋歐姆蛋', NULL, '蔬菜歐姆蛋', 260.5, '60', NULL, NULL, '2022-07-05 00:00:00'),
(53, '經典義式系列3', NULL, '咖啡拿鐵 (冰)', 381.4, '70', '90', NULL, '2022-05-28 20:48:19'),
(54, '咖啡', NULL, '義式拿鐵', 183, '0', '120', '09605', '2022-05-28 20:48:54'),
(55, '咖啡', NULL, '義式咖啡', 122, '1', '120', '09426', '2022-05-28 20:48:54'),
(56, '咖啡', NULL, '義式拿鐵', 129, '2', '120', '09857', '2022-05-28 20:48:54'),
(57, '咖啡', NULL, '美式拿鐵', 166, '3', '120', '09600', '2022-05-28 20:48:54'),
(58, '咖啡', NULL, '義式拿鐵', 127, '4', '120', '09475', '2022-05-28 20:48:54'),
(59, '咖啡', NULL, '美式拿鐵', 194, '5', '120', '09992', '2022-05-28 20:48:54'),
(60, '咖啡', NULL, '美式咖啡', 173, '6', '120', '09506', '2022-05-28 20:48:54'),
(61, '咖啡', NULL, '義式拿鐵', 165, '7', '120', '09553', '2022-05-28 20:48:54'),
(62, '咖啡', NULL, '精品拿鐵', 174, '8', '120', '09910', '2022-05-28 20:48:54'),
(63, '咖啡', NULL, '義式咖啡', 175, '9', '120', '09663', '2022-05-28 20:48:54'),
(65, '哈哈哈哈哈哈', '哈哈哈哈哈哈', '哈哈哈哈哈哈', 77, '111', '1111', '1111', '2022-05-29 02:56:09'),
(66, '哈哈哈哈哈哈', '哈哈哈哈哈哈', '哈哈哈哈哈哈', 77, '111', '1111', '1111', '2022-05-29 02:57:31'),
(67, '經典義式系列', '1111', '咖啡拿鐵 (冰)', 381.4, '70', '90', '11111', '2022-05-30 01:31:53'),
(69, '2', NULL, '14324', 4342, '4324', '4234', '42342', '2022-05-31 20:43:31'),
(70, '2', NULL, '14324', 4342, '4324', '4234', '42342', '2022-05-31 20:45:32'),
(71, '其他飲品', NULL, '3423', 4324, '4234', '432', '342', '2022-05-31 20:45:53'),
(72, '精品咖啡', NULL, 'tttt', 543534, '54353', '5345', '5435', '2022-05-31 23:47:36'),
(73, '其他飲品', NULL, '哈哈哈哈哈哈', 4324, '42342', '43242', '4324324', '2022-06-01 00:08:25'),
(74, '貝果', NULL, '34324', 324, '324', '4234', '43242', '2022-06-01 00:43:17'),
(75, '其他飲品', NULL, '43423', 6765, '6576', '76575', '7567', '2022-06-01 09:20:57'),
(76, '其他飲品', NULL, '43423', 6765, '6576', '76575', '7567', '2022-06-01 09:20:59'),
(77, '其他飲品', NULL, '43423', 6765, '6576', '76575', '7567', '2022-06-01 09:21:01'),
(78, '其他飲品', NULL, '43423', 6765, '6576', '76575', '7567', '2022-06-01 09:21:27'),
(79, '其他飲品', NULL, '43423', 6765, '6576', '76575', '7567', '2022-06-01 09:21:42'),
(80, '貝果', NULL, '4534', 5435, '5435', '54353', '4353', '2022-06-01 09:22:39'),
(81, '貝果', NULL, '4534', 5435, '5435', '54353', '4353', '2022-06-01 09:23:14'),
(82, '精品咖啡', '', 't544234', 3423, '43242', '43243', '43242', '2022-06-01 10:28:25');

-- --------------------------------------------------------

--
-- 資料表結構 `order`
--

CREATE TABLE `order` (
  `order_sid` int(11) NOT NULL,
  `order_time` datetime NOT NULL,
  `order_pay` char(255) CHARACTER SET utf8mb4 NOT NULL,
  `order_pay_info` char(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `order_deliver` char(255) CHARACTER SET utf8mb4 NOT NULL,
  `order_address` char(255) CHARACTER SET utf8mb4 NOT NULL,
  `order_member_id` int(11) NOT NULL,
  `order_coupon_id` int(11) DEFAULT NULL,
  `order_price` int(11) NOT NULL,
  `order_id` char(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `order`
--

INSERT INTO `order` (`order_sid`, `order_time`, `order_pay`, `order_pay_info`, `order_deliver`, `order_address`, `order_member_id`, `order_coupon_id`, `order_price`, `order_id`) VALUES
(1, '2022-05-31 14:29:48', '店內取貨付款', '店內取貨付款', '店內取貨', '本店', 1, 2, 1160, '531142948'),
(2, '2022-05-31 14:50:43', 'ATM轉帳', '700-24416794519754', '郵寄', '655 雲林縣元長鄉子茂33號', 3, 7, 872, '531145043');

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
(2, 2, 2, -300, '2022-06-03');

-- --------------------------------------------------------

--
-- 資料表結構 `points_user`
--

CREATE TABLE `points_user` (
  `sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `total_points` int(255) NOT NULL,
  `voucher_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `points_user`
--

INSERT INTO `points_user` (`sid`, `member_sid`, `total_points`, `voucher_amount`) VALUES
(1, 1, 200, 1),
(2, 2, 340, 2);

-- --------------------------------------------------------

--
-- 資料表結構 `post`
--

CREATE TABLE `post` (
  `sid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `member_nickname` varchar(255) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `comments` int(11) NOT NULL DEFAULT 0,
  `topic_sid` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `delete_state` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `post`
--

INSERT INTO `post` (`sid`, `title`, `content`, `member_nickname`, `member_sid`, `likes`, `comments`, `topic_sid`, `created_at`, `updated_at`, `delete_state`) VALUES
(1, '體驗拉花課程分享', '每次看到咖啡師的拉花作品，再看看咖啡師拉花的動作看似簡單，胃痛一直很想要體驗拉花，想不到自己實際操作一遍，操作起來還真的不簡單啊。', '帥氣a小明', 1001, 2, 1, 1, '2022-05-31 04:35:39', NULL, 0),
(2, '好喝環境', '深入的探討咖啡，是釐清一切的關鍵。咖啡，到底應該如何實現。若無法徹底理解咖啡，恐怕會是人類的一大遺憾。儘管如此，我們仍然需要對咖啡保持懷疑的態度。徐志摩在不經意間這樣說過，由於我們過於習慣在別人面前戴面具，因此最後導致在自己面前偽裝自己。強烈建議大家把這段話牢牢記住。\r\n    ', '小明', 1011, 0, 0, 1, '2022-01-25 07:01:45', NULL, 0),
(3, '超讚體驗咖啡課程', '車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。', '小美', 1410, 3, 4, 1, '2022-05-05 07:05:40', NULL, 0),
(4, '超讚體驗馬克杯', ' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。', '小明', 1011, 4, 0, 1, '2022-05-30 01:05:12', NULL, 0),
(5, '好玩的咖啡課程', '儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。', 'bill', 1978, 5, 1, 2, '2022-01-31 11:01:25', NULL, 0),
(6, '超讚體驗咖啡課程', ' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。', '小明', 1011, 3, 4, 2, '2022-04-28 10:04:03', NULL, 0),
(7, '好喝拉花課程', ' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。', '阿肥', 1812, 3, 1, 2, '2022-05-27 12:05:07', NULL, 0),
(8, '新奇的咖啡課程', '儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。', '小明', 1011, 0, 4, 1, '2022-04-19 05:04:12', NULL, 0),
(9, '有趣的拉花課程', ' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。', '小明', 1011, 2, 2, 1, '2022-02-12 11:02:00', NULL, 0),
(10, '好玩的拉花課程', '車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。', '小明', 1011, 4, 4, 3, '2022-04-20 06:04:12', NULL, 0),
(11, '超讚體驗馬克杯', ' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。', 'jack', 1503, 4, 4, 3, '2022-05-28 07:05:50', NULL, 0),
(12, '有趣的咖啡課程', '儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。', '大胖', 1842, 0, 1, 3, '2022-02-24 10:02:52', NULL, 0),
(13, '好喝馬克杯', '車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。', '小明', 1011, 3, 1, 2, '2022-03-04 11:03:01', NULL, 1),
(14, '爛芭樂', '這間店有夠爛', '小肥豬', 1995, 0, 0, 3, '2022-03-04 11:03:01', NULL, 0),
(15, '爛爛芭樂', '這間店有夠爛', '小肥豬', 1995, 0, 0, 3, '2022-03-04 11:03:01', NULL, 1),
(16, '爛爛爛芭樂', '這間店有夠爛!!', '小肥豬', 1995, 0, 0, 3, '2022-03-04 11:03:01', NULL, 1),
(17, '爛爛爛芭樂', '這間店有夠爛!!!', '小肥豬', 1995, 0, 0, 3, '2022-03-04 11:03:01', NULL, 0),
(18, '好玩的咖啡課', ' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。', 'Lebron James', 1357, 4, 4, 2, '2022-03-15 09:03:20', NULL, 0),
(19, '超讚體驗馬克杯', '深入的探討咖啡，是釐清一切的關鍵。咖啡，到底應該如何實現。若無法徹底理解咖啡，恐怕會是人類的一大遺憾。儘管如此，我們仍然需要對咖啡保持懷疑的態度。徐志摩在不經意間這樣說過，由於我們過於習慣在別人面前戴面具，因此最後導致在自己面前偽裝自己。強烈建議大家把這段話牢牢記住。\r\n    ', 'Hank', 1455, 2, 0, 3, '2022-03-01 11:03:37', NULL, 1),
(20, '超讚體驗拉花課程', '車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。', 'Hank', 1992, 2, 4, 1, '2022-05-25 06:05:21', NULL, 0),
(21, '超讚體驗環境', ' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。', 'Allan', 1930, 1, 4, 1, '2022-03-05 11:03:18', NULL, 1),
(22, '好玩的馬克杯', '儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。', 'Hank', 1336, 4, 2, 3, '2022-02-21 07:02:27', NULL, 0),
(23, '超讚體驗環境', '儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。', '大胖', 1312, 5, 0, 3, '2022-02-06 11:02:51', NULL, 0),
(24, '有趣的拉花課程', '儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。', '阿肥', 1209, 0, 2, 3, '2022-04-25 08:04:09', NULL, 0),
(25, '新奇的咖啡課', '深入的探討咖啡，是釐清一切的關鍵。咖啡，到底應該如何實現。若無法徹底理解咖啡，恐怕會是人類的一大遺憾。儘管如此，我們仍然需要對咖啡保持懷疑的態度。徐志摩在不經意間這樣說過，由於我們過於習慣在別人面前戴面具，因此最後導致在自己面前偽裝自己。強烈建議大家把這段話牢牢記住。\r\n    ', 'Jefffff', 1069, 0, 0, 2, '2022-05-07 06:05:49', NULL, 0),
(26, '好喝馬克杯', '儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。', 'Allan', 1286, 4, 1, 2, '2022-05-06 03:05:07', NULL, 0),
(27, '超讚體驗環境', '儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。', 'Hank', 1768, 5, 4, 1, '2022-01-16 03:01:12', NULL, 0),
(28, '有趣的咖啡課', '深入的探討咖啡，是釐清一切的關鍵。咖啡，到底應該如何實現。若無法徹底理解咖啡，恐怕會是人類的一大遺憾。儘管如此，我們仍然需要對咖啡保持懷疑的態度。徐志摩在不經意間這樣說過，由於我們過於習慣在別人面前戴面具，因此最後導致在自己面前偽裝自己。強烈建議大家把這段話牢牢記住。\r\n    ', '阿肥', 1018, 1, 0, 2, '2022-05-18 09:05:30', NULL, 0),
(29, '新奇的拉花課程', '車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。', 'Lebron James', 1216, 0, 1, 3, '2022-04-18 08:04:58', NULL, 1),
(30, '有趣的環境', '車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。', 'Hank', 1408, 5, 0, 2, '2022-03-08 03:03:08', NULL, 0),
(31, '超讚體驗拉花課程', '車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。', 'Allan', 1362, 3, 2, 1, '2022-05-23 05:05:06', NULL, 1),
(32, '好玩的馬克杯', '車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。', '阿肥', 1207, 3, 4, 2, '2022-05-19 02:05:03', NULL, 0),
(33, '好喝馬克杯', ' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。', '大胖', 1340, 1, 2, 1, '2022-02-18 10:02:10', NULL, 1),
(34, '好喝環境', ' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。', 'Allan', 1655, 2, 3, 2, '2022-05-08 10:05:41', NULL, 1),
(35, '爛芭樂', '好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛', '小豬頭', 1981, 1, 0, 2, '2022-04-22 08:04:56', NULL, 0),
(36, '爛芭樂大芭樂', '嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿', '來亂的', 1982, 1, 0, 3, '2022-04-07 10:04:47', NULL, 1),
(37, '爛芭樂芭樂', '好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛', '小豬頭', 1984, 0, 0, 1, '2022-04-07 01:04:15', NULL, 0),
(38, '爛爛大香蕉', '好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛', '大豬頭', 1986, 1, 0, 1, '2022-05-12 03:05:45', NULL, 1),
(39, '爛爛大香蕉', '嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿', '小豬頭', 1985, 1, 0, 2, '2022-05-28 12:05:29', NULL, 0),
(40, '爛香蕉', '嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿', '大豬頭', 1983, 1, 0, 1, '2022-01-10 01:01:40', NULL, 0),
(41, '爛爛芭樂', '嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿', '小豬頭', 1987, 0, 0, 2, '2022-03-19 05:03:11', NULL, 0),
(42, '爛香蕉', '好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛', '大豬頭', 1984, 0, 0, 2, '2022-01-10 11:01:23', NULL, 0),
(43, '爛大芭樂', '嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿', '大豬頭', 1988, 0, 0, 1, '2022-05-05 03:05:17', NULL, 0),
(44, '爛爛大香蕉', '嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿', '來亂的', 1983, 0, 0, 3, '2022-03-02 04:03:45', NULL, 0),
(45, 'hello', '你好嗎', 'tommy', 666, 0, 0, 1, '2022-06-02 04:54:49', NULL, 0),
(46, 'hello', '我是羊羊', 'Tommy', 666, 0, 0, 1, '2022-06-02 10:56:29', NULL, 0),
(47, '12', '123', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:02:49', NULL, 0),
(48, '543', '543', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:04:03', NULL, 0),
(49, '123', '453', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:05:37', NULL, 0),
(50, '1434', '5753', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:42:15', NULL, 0),
(51, '1434', '5753', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:53:58', NULL, 0),
(52, '1434', '5753', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:54:28', NULL, 0),
(53, '453', '73', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:55:26', NULL, 0),
(54, '453', '73', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:55:32', NULL, 0),
(55, '453', '73', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:55:42', NULL, 0),
(56, '1322', '1245', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:56:24', NULL, 0),
(57, '1322', '1245', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:56:45', NULL, 0),
(58, '1322', '1245', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:56:57', NULL, 0),
(59, '1322', '1245', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:57:40', NULL, 0),
(60, '1322', '1245', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:58:58', NULL, 0),
(61, '1322', '1245', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:58:59', NULL, 0),
(62, '1322', '1245', 'Tommy', 666, 0, 0, 1, '2022-06-02 11:59:16', NULL, 0),
(63, '1322', '1245', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:00:46', NULL, 0),
(64, '1322', '1245', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:00:47', NULL, 0),
(65, '1322', '1245', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:00:56', NULL, 0),
(66, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:01:02', NULL, 0),
(67, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:03:40', NULL, 0),
(68, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:04:38', NULL, 0),
(69, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:04:40', NULL, 0),
(70, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:04:53', NULL, 0),
(71, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:05:33', NULL, 0),
(72, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:05:34', NULL, 0),
(73, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:10:22', NULL, 0),
(74, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:10:41', NULL, 0),
(75, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:10:52', NULL, 0),
(76, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:11:38', NULL, 0),
(77, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:12:02', NULL, 0),
(78, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:12:36', NULL, 0),
(79, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:12:48', NULL, 0),
(80, '4274', '7272', 'Tommy', 666, 0, 0, 1, '2022-06-02 12:13:34', NULL, 0),
(106, 'abc', '123\r\n456\r\n789', 'Tommy', 666, 0, 0, 1, '2022-06-04 02:45:46', NULL, 0),
(107, 'abc', '123', 'Tommy', 666, 0, 0, 1, '2022-06-04 02:45:56', NULL, 0),
(108, 'abc', '123', 'Tommy', 666, 0, 0, 1, '2022-06-04 02:46:00', NULL, 0),
(109, 'abc', '123', 'Tommy', 666, 0, 0, 2, '2022-06-04 02:47:09', NULL, 0),
(110, '123', '123', 'Tommy', 666, 0, 0, 1, '2022-06-04 02:48:04', NULL, 0),
(111, 'abc', '123\r\n456\r\n78', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:02:59', NULL, 0),
(112, '123', '453', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:05:59', NULL, 0),
(113, '783', '4353', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:06:07', NULL, 0),
(114, '783', '4353', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:07:03', NULL, 0),
(115, '783', '4353', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:07:21', NULL, 0),
(116, '783', '4353', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:07:38', NULL, 0),
(117, '783', '4353', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:09:54', NULL, 0),
(118, '783', '4353', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:10:05', NULL, 0),
(119, '783', '4353', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:12:13', NULL, 0),
(120, '783', '4353\r\n3273', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:12:50', NULL, 0),
(121, '783', '4353<br/>3273<br/>abc', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:17:06', NULL, 0),
(122, '783', '4353 asd<br/>3273 16<br/>abc<br/><br/>abba', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:24:19', NULL, 0),
(123, 'abc', '453453', '帥氣a小明', 1001, 0, 0, 1, '2022-06-04 14:21:45', NULL, 0),
(124, 'abc', '453453', '帥氣a小明', 1001, 0, 0, 1, '2022-06-04 14:22:06', NULL, 0),
(125, '134', '456', '帥氣a小明', 1001, 0, 0, 1, '2022-06-04 14:22:29', NULL, 0),
(126, '134', '456', '帥氣a小明', 1001, 0, 0, 1, '2022-06-04 14:23:25', NULL, 0),
(127, '134', '456', '帥氣a小明', 1001, 0, 0, 1, '2022-06-04 14:23:46', NULL, 0),
(128, '123', '453', '帥氣a小明', 0, 0, 0, 1, '2022-06-04 15:46:02', NULL, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `post_img`
--

CREATE TABLE `post_img` (
  `sid` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `img_src` varchar(255) NOT NULL,
  `post_sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `post_img`
--

INSERT INTO `post_img` (`sid`, `img_name`, `img_src`, `post_sid`) VALUES
(1, 'dog.jpg', 'uploaded/dog.jpg', 1);

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
(4, 105, 6);

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `products_sid` int(11) NOT NULL,
  `products_number` varchar(255) DEFAULT 'UNIX_TIMESTAMP()',
  `products_name` varchar(255) NOT NULL,
  `products_introduction` varchar(255) DEFAULT NULL,
  `products_detail_introduction` varchar(511) DEFAULT NULL,
  `products_price` int(11) DEFAULT NULL,
  `products_forsale` int(11) DEFAULT NULL,
  `products_onsale` int(11) DEFAULT NULL,
  `products_stocks` int(11) DEFAULT NULL,
  `products_with_products_categroies_sid` int(11) DEFAULT NULL,
  `products_with_products_pic` int(11) DEFAULT NULL,
  `products_with_products_style_filter_sid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`products_sid`, `products_number`, `products_name`, `products_introduction`, `products_detail_introduction`, `products_price`, `products_forsale`, `products_onsale`, `products_stocks`, `products_with_products_categroies_sid`, `products_with_products_pic`, `products_with_products_style_filter_sid`) VALUES
(1, '1653962198', '曼巴咖啡(一包十入)400', '精選曼巴咖啡, 一包十入', '溫順的曼巴，散發出自然甘甜氣味，集清爽與強勁香醇於一體。', 310, 1, 0, 2800, 1, 1, 1),
(2, '1653962417', '曼特寧咖啡(一包十入)', '精選曼特寧咖啡, 一包十入', '香濃甘苦的滋味，不帶酸味順口香醇。', 320, 1, 0, 3200, 1, 2, 2),
(3, '1653969575', '黃金曼特寧(半磅)', '曼特寧咖啡豆, 半磅包裝', '曼特寧咖啡豆', 470, 1, 0, 4000, 2, 3, 2),
(4, '1653972891', '濾紙(大)', '大片綠紙, 一包100張', '簡易方便, 100%天然紙漿製成, 保留咖啡原味', 150, 1, 0, 5000, 3, 4, 4),
(5, '1653972907', '濾紙(小)', '小片綠紙, 一包100張', '簡易方便, 100%天然紙漿製成, 保留咖啡原味', 150, 1, 0, 5000, 3, 4, 4),
(6, '1654050346', '巴西咖啡', '巴西咖啡', '巴西咖啡', 320, 1, 0, 3200, 1, NULL, 1),
(7, '1654050441', '巴西咖啡2', '巴西咖啡2', '巴西咖啡2', 320, 1, 0, 3200, 1, NULL, 1),
(8, '1654050701', '巴西咖啡(一包十入)5', '精選巴西咖啡5', '11', 320, 1, 0, 2500, 1, NULL, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `products_categroies`
--

CREATE TABLE `products_categroies` (
  `products_categroies_sid` int(11) NOT NULL,
  `products_categroies_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products_categroies`
--

INSERT INTO `products_categroies` (`products_categroies_sid`, `products_categroies_name`) VALUES
(1, '濾掛式咖啡'),
(2, '咖啡豆'),
(3, '咖啡周邊器具'),
(4, '禮盒'),
(5, '電子禮物卡');

-- --------------------------------------------------------

--
-- 資料表結構 `products_pic`
--

CREATE TABLE `products_pic` (
  `products_pic_sid` int(11) NOT NULL,
  `products_pic_one` varchar(255) NOT NULL,
  `products_pic_multi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products_pic`
--

INSERT INTO `products_pic` (`products_pic_sid`, `products_pic_one`, `products_pic_multi`) VALUES
(1, 'ATT00018.gif', '[\"ATT00033.gif\",\"ATT00036.gif\",\"ATT00039.gif\"]'),
(2, 'products_mandheling_01.png', 'detail_mandheling_01.png, detail_mandheling_02.png, detail_mandheling_03.png, detail_mandheling_04.png'),
(3, 'products_mandheling_bean_01.png', 'details_mandheling_bean_01.png, details_mandheling_bean_02.png, details_mandheling_bean_03.png, details_mandheling_bean_04.png'),
(4, 'products_filter_01.png', 'details_filter_01.png, details_filter_02.png, details_filter_03.png, details_filter_04.png');

-- --------------------------------------------------------

--
-- 資料表結構 `products_style_filter`
--

CREATE TABLE `products_style_filter` (
  `products_style_filter_sid` int(11) NOT NULL,
  `products_style_filter_categroies` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products_style_filter`
--

INSERT INTO `products_style_filter` (`products_style_filter_sid`, `products_style_filter_categroies`) VALUES
(1, '偏酸'),
(2, '偏苦'),
(3, '器材'),
(4, '耗材'),
(5, '咖啡禮盒'),
(6, '食品禮盒'),
(7, '電子卡');

-- --------------------------------------------------------

--
-- 資料表結構 `reply`
--

CREATE TABLE `reply` (
  `sid` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `reply_sid` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `post_sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `member_nickname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `review`
--

CREATE TABLE `review` (
  `sid` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `uploaded_at` date DEFAULT NULL,
  `member_sid` int(11) NOT NULL,
  `member_nickname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 資料表結構 `review_likes`
--

CREATE TABLE `review_likes` (
  `sid` int(11) NOT NULL,
  `review_sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `tag`
--

CREATE TABLE `tag` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `times` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `tag`
--

INSERT INTO `tag` (`sid`, `name`, `times`) VALUES
(1, '拿鐵', 0),
(2, '拉花', 7),
(3, '好有趣阿', 1),
(4, '拉花好好玩', 1),
(5, '拉', 2),
(6, '拉aa', 5);

-- --------------------------------------------------------

--
-- 資料表結構 `topic`
--

CREATE TABLE `topic` (
  `sid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `topic`
--

INSERT INTO `topic` (`sid`, `title`) VALUES
(1, 'course'),
(2, 'products'),
(3, 'others');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_sid`);

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_sid`);

--
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `coupon_logs`
--
ALTER TABLE `coupon_logs`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `coupon_receive`
--
ALTER TABLE `coupon_receive`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_sid`);

--
-- 資料表索引 `course_related`
--
ALTER TABLE `course_related`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `lastest_news`
--
ALTER TABLE `lastest_news`
  ADD PRIMARY KEY (`news_sid`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_sid`);

--
-- 資料表索引 `member_likes`
--
ALTER TABLE `member_likes`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_sid`);

--
-- 資料表索引 `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_sid`);

--
-- 資料表索引 `points_record`
--
ALTER TABLE `points_record`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `points_user`
--
ALTER TABLE `points_user`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `post_img`
--
ALTER TABLE `post_img`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`products_sid`);

--
-- 資料表索引 `products_categroies`
--
ALTER TABLE `products_categroies`
  ADD PRIMARY KEY (`products_categroies_sid`);

--
-- 資料表索引 `products_pic`
--
ALTER TABLE `products_pic`
  ADD PRIMARY KEY (`products_pic_sid`);

--
-- 資料表索引 `products_style_filter`
--
ALTER TABLE `products_style_filter`
  ADD PRIMARY KEY (`products_style_filter_sid`);

--
-- 資料表索引 `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `review_likes`
--
ALTER TABLE `review_likes`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_sid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment`
--
ALTER TABLE `comment`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon`
--
ALTER TABLE `coupon`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon_logs`
--
ALTER TABLE `coupon_logs`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon_receive`
--
ALTER TABLE `coupon_receive`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course`
--
ALTER TABLE `course`
  MODIFY `course_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_related`
--
ALTER TABLE `course_related`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lastest_news`
--
ALTER TABLE `lastest_news`
  MODIFY `news_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `member_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_likes`
--
ALTER TABLE `member_likes`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order`
--
ALTER TABLE `order`
  MODIFY `order_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `points_record`
--
ALTER TABLE `points_record`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `points_user`
--
ALTER TABLE `points_user`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post`
--
ALTER TABLE `post`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_img`
--
ALTER TABLE `post_img`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `products_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products_categroies`
--
ALTER TABLE `products_categroies`
  MODIFY `products_categroies_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products_pic`
--
ALTER TABLE `products_pic`
  MODIFY `products_pic_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products_style_filter`
--
ALTER TABLE `products_style_filter`
  MODIFY `products_style_filter_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reply`
--
ALTER TABLE `reply`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `review`
--
ALTER TABLE `review`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `review_likes`
--
ALTER TABLE `review_likes`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `tag`
--
ALTER TABLE `tag`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `topic`
--
ALTER TABLE `topic`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
