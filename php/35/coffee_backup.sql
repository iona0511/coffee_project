-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-02 04:25:44
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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
(2, 'min', 'min', 'min123');

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
-- 資料表結構 `coupon`
--

CREATE TABLE `coupon` (
  `sid` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_send_type` int(11) NOT NULL,
  `coupon_setting_type` int(11) NOT NULL,
  `coupon_money` int(255) NOT NULL,
  `menu_sid` int(11) NOT NULL,
  `products_sid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `coupon_validity_period` int(11) NOT NULL,
  `coupon_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `coupon_logs`
--

CREATE TABLE `coupon_logs` (
  `sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `coupon_receive_sid` int(11) NOT NULL,
  `order_sid` int(11) NOT NULL,
  `used_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `member_birthday` datetime DEFAULT NULL,
  `member_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`member_sid`, `member_name`, `member_nickname`, `member_account`, `member_password`, `member_birthday`, `member_mobile`, `member_address`, `member_mail`, `member_level`) VALUES
(1, '王曉明', '阿明', 'ming', 'ming', '2022-05-30 10:14:19', '0911222333', '台北市大安區', 'ming@test.com', '銅'),
(2, '小黑', 'black', 'black', 'black', '2022-05-11 10:20:06', '0912345678', '新北市', 'black@test.com', '銀'),
(3, '768', '648', '468468468', '468468648', '2022-06-09 10:22:54', '468468468', '468468', '34658468486468', '664468468468'),
(4, '768', '648', '468468468', '468468648', '2022-06-09 10:22:54', '468468468', '468468', '34658468486468', '664468468468'),
(5, '1', '1', '1', '135353', NULL, '13531515', '1', '1@test1', '0'),
(6, '1', '1', '1', '135353', NULL, '13531515', '1', '1@test1', '0'),
(8, '123', '123', '123', '123', NULL, '123', '123', '123', '0'),
(9, '1234', '1234', '1234', '123', NULL, '1234', '1234', '1234', '0');

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
  `order_pay_info` char(255) CHARACTER SET utf8mb4 NOT NULL,
  `order_deliver` char(255) CHARACTER SET utf8mb4 NOT NULL,
  `order_address` char(255) CHARACTER SET utf8mb4 NOT NULL,
  `order_member_id` int(11) NOT NULL,
  `order_coupon_id` int(11) NOT NULL,
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
(1, 1, 1, 10, '2022-05-03'),
(2, 2, 2, -300, '2022-05-05');

-- --------------------------------------------------------

--
-- 資料表結構 `points_user`
--

CREATE TABLE `points_user` (
  `sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `total_points` int(255) DEFAULT NULL,
  `voucher_amount` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `points_user`
--

INSERT INTO `points_user` (`sid`, `member_sid`, `total_points`, `voucher_amount`) VALUES
(1, 1, 200, 1),
(2, 2, 340, 2);

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
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon`
--
ALTER TABLE `coupon`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon_logs`
--
ALTER TABLE `coupon_logs`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon_receive`
--
ALTER TABLE `coupon_receive`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `member_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
COMMIT;
