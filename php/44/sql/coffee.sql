-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-12 19:41:26
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
(2, 'black', 'black', 'black'),
(3, '管理子揚', 'tommyad', '1234');

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
(15, 3, 0, 470, 1, 5, 0, 1),
(16, 1, 0, 320, 1, 1, 21, 0),
(17, 2, 0, 320, 1, 1, 21, 0),
(18, 3, 0, 470, 1, 1, 21, 0);

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

-- --------------------------------------------------------

--
-- 資料表結構 `coupon`
--

CREATE TABLE `coupon` (
  `sid` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_send_type` varchar(11) DEFAULT NULL,
  `coupon_setting_type` varchar(11) DEFAULT NULL,
  `coupon_money` varchar(255) NOT NULL,
  `menu_sid` int(11) DEFAULT NULL,
  `products_sid` int(11) DEFAULT NULL,
  `type` varchar(11) NOT NULL,
  `coupon_validity_period` varchar(11) NOT NULL,
  `coupon_status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `coupon`
--

INSERT INTO `coupon` (`sid`, `coupon_name`, `coupon_send_type`, `coupon_setting_type`, `coupon_money`, `menu_sid`, `products_sid`, `type`, `coupon_validity_period`, `coupon_status`) VALUES
(2, '註冊優惠券$100', '2 註冊時發送', '1 折扣金額', '100', 0, 0, '3 全品項', '12個月', '1開放'),
(3, '咖啡拿鐵5折', '3 玩遊戲時發送', '2 打折', '0.5', 1, 0, '1餐點類', '6個月', '1開放'),
(4, '卡布奇諾 5折', '3 玩遊戲時發送', '2 打折', '0.5', 3, 0, '1餐點類', '6個月', '1開放'),
(5, '義式摩卡75折', '3 玩遊戲時發送', '2 打折', '0.75', 9, 0, '1餐點類', '6個月', '1開放'),
(6, '耶加雪菲75折', '3 玩遊戲時發送', '2 打折', '0.75', 17, 0, '1餐點類', '6個月', '1開放'),
(7, '宇治奶茶8折', '3 玩遊戲時發送', '2 打折', '0.8', 20, 0, '1餐點類', '6個月', '1開放'),
(8, '精選曼巴咖啡組8折', '3 玩遊戲時發送', '2 打折', '0.8', 0, 1, '2 商品類', '6個月', '1開放'),
(9, '黃金曼特寧組9折', '3 玩遊戲時發送', '2 打折', '0.8', 0, 3, '2 商品類', '6個月', '1開放');

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
(2, 2, 4, 0, '2022-06-01 00:00:00'),
(23, 1, 3, 20, '2022-06-08 13:14:45');

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
(82, '麻雀拉花', 2999, 3, '217a87c655ab64e3f4c61e041ece6b32.jpg', '專業教師手把手教學.', '喜歡麻雀的人', '杯子.牛奶.咖啡豆(廠商提供)'),
(83, '皮卡丘拉花', 2499, 2, '2c0a2a3b5f7b841c9c2db4ad1b3f5e0d.jpg', '專業的師資,充實的教學內容.', '喜歡寶可夢的人', '杯子.牛奶.咖啡豆(廠商提供)'),
(84, '貓咪澡堂拉花', 2666, 2, '6bc7f448bddf07025e83c5c805e0b9b7.jpg', '一起來幫貓咪準備澡堂吧!', '喜愛貓咪的人', '杯子.牛奶.咖啡豆(廠商提供)'),
(85, '快樂星球拉花', 2350, 2, 'ed40f965554712e6be07285aef954cd8.jpg', '一起來製造快樂星球吧!', '普遍級', '杯子.牛奶.咖啡豆(廠商提供)'),
(86, '屁柴拉花', 2450, 3, '2421496a84b1b5134a89744e09a85c83.jpg', '專業級的老師,手把手教學.', '喜愛狗狗的人士', '杯子.牛奶.咖啡豆(廠商提供)'),
(87, '聖誕樹拉花', 1499, 1, '69edea94a5e887354543de3a970faa17.png', '非常適合初學者唷.', '適合所有人', '杯子.牛奶.咖啡豆(廠商提供)'),
(88, '蝸牛拉花', 1999, 1, '1e053eda4a8d7bf8af800511caa49e80.jpg', '非常可愛的小蝸牛,很適合入門的課程.', '適合所有人', '杯子.牛奶.咖啡豆(廠商提供)'),
(89, '手沖咖啡基礎班', 3777, 1, '73c9ba4ec7f6c5af179f5fc994057424.jpg', '體驗手沖咖啡的樂趣!', '喜愛咖啡的大家', '杯子.咖啡豆.手沖器具(廠商提供)'),
(90, '咖啡豆介紹', 2000, 1, '38aecb3ddaaf82eb59cda7acde393780.jpg', '專業的講師,講解各類咖啡豆.', '對認識咖啡豆有興趣的人', '無'),
(91, '獨角獸拉花', 2680, 1, '1049cbdcbc3a9df37e78ab21d357a04c.jpg', '教您拉出奇幻獨角獸.', '適合所有人', '杯子.牛奶.咖啡豆(廠商提供)'),
(92, '小熊拉花', 1299, 1, '97c2a51dca024b36bb2fc5f93fdfc1cb.png', '一起來學習小熊拉花吧!', '適合所有人', '杯子.牛奶.咖啡豆(廠商提供)'),
(93, '愛心拉花', 1199, 1, 'f83c89cb0f3f09a323f1e3fae18f9d6d.jpg', '初學者非常好上手的一門課.', '適合所有人', '杯子.牛奶.咖啡豆(廠商提供)'),
(94, '拿鐵沖調班', 3333, 1, '43f80f6e4c0675fd0dde0def963a0f3b.jpg', '沖調拿鐵的基本介紹', '喜愛拿鐵的人', '杯子.牛奶.咖啡豆.沖調器具(廠商提供)'),
(95, '幽靈拉花', 1499, 1, '2ea7ad4897288dc11dd147ac61e4adac.jpg', '非常適合初學者的課程', '適合所有人', '杯子.牛奶.咖啡豆(廠商提供)');

-- --------------------------------------------------------

--
-- 資料表結構 `course_backup`
--

CREATE TABLE `course_backup` (
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
-- 傾印資料表的資料 `course_backup`
--

INSERT INTO `course_backup` (`course_sid`, `course_name`, `course_price`, `course_level`, `course_img_s`, `course_content`, `course_people`, `course_material`) VALUES
(1, '測試', 123, 1, '93583e83c60b1594e60f6d4728187c60.jpg', '221', '212', '11'),
(2, '12', 121, 1, 'd89814e1706d044b7e474815c54909c2.jpg', '21', '21', '12'),
(3, '咖啡烘焙', 2000, 2, 'img', '體驗自己親手烘焙咖啡豆的樂趣', '想體驗自己烘咖啡豆的人', '咖啡豆.相關沖煮器材設備(課程提供)'),
(4, '咖啡生豆認識及風味鑑嘗學', 3000, 3, 'img', '認識不同咖啡產地及品種，加強自己品嚐咖啡思維', '對咖啡豆有濃厚興趣及對咖啡烘焙有興趣朋友參加', '咖啡豆.相關沖煮器材設備(課程提供)'),
(5, '手沖咖啡基礎訓練班', 1500, 1, 'img', '學會從風味中了解自己沖煮手法', '適合初學者或希望了解自己沖煮技巧缺點人士', '咖啡豆.相關沖煮器材設備(課程提供)');

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
-- 資料表結構 `food_choice`
--

CREATE TABLE `food_choice` (
  `food_choice_sid` int(11) NOT NULL,
  `menu_sid` varchar(255) NOT NULL,
  `menu_photo` varchar(255) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_price_m` varchar(255) NOT NULL,
  `food_choice_ice` varchar(255) NOT NULL,
  `food_choice_sugar` varchar(255) NOT NULL,
  `food_choice_count` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='food_choice';

--
-- 傾印資料表的資料 `food_choice`
--

INSERT INTO `food_choice` (`food_choice_sid`, `menu_sid`, `menu_photo`, `menu_name`, `menu_price_m`, `food_choice_ice`, `food_choice_sugar`, `food_choice_count`, `created_at`) VALUES
(150, '', '', '莊園級拿鐵 ', '80', '1', '2', '4', '2022-06-09 11:32:21'),
(151, '', '', '咖啡拿鐵', '70', '1', '1', '5', '2022-06-09 11:32:22'),
(152, '', '', '莊園級拿鐵 ', '80', '1', '2', '4', '2022-06-09 11:32:22'),
(153, '', '', '莊園級拿鐵 ', '80', '1', '1', '4', '2022-06-09 11:34:23'),
(154, '', '', '莊園級拿鐵 ', '80', '1', '1', '4', '2022-06-09 11:43:26'),
(155, '192', 'f7051d3f87bcc0c79dbf9a837388d7f9.png', '義式摩卡 ', '80', '1', '1', '4', '2022-06-09 12:01:39'),
(156, '192', 'f7051d3f87bcc0c79dbf9a837388d7f9.png', '義式摩卡 ', '80', '1', '1', '4', '2022-06-09 12:03:11'),
(157, '190', '792fa71cf16327b18c713b8744215ec0.jpg', '美式黑咖啡', '50', '1', '1', '4', '2022-06-09 12:03:11'),
(158, '189', 'c92e70256fb8cf814daa982af0664bc9.jpg', '莊園級拿鐵 ', '80', '1', '1', '5', '2022-06-09 14:28:42'),
(159, '189', 'c92e70256fb8cf814daa982af0664bc9.jpg', '莊園級拿鐵 ', '80', '1', '1', '5', '2022-06-09 14:30:23'),
(160, '193', '8d7e9afe5978766f19b3279389b1c467.jpg', '宇治奶茶', '50', '1', '1', '4', '2022-06-09 14:30:23'),
(161, '188', 'd1eb9c095ac94e523067f2a167b322e1.jpg', '咖啡拿鐵', '70', '1', '1', '1', '2022-06-10 13:10:22'),
(162, '188', 'd1eb9c095ac94e523067f2a167b322e1.jpg', '咖啡拿鐵', '70', '1', '1', '1', '2022-06-10 13:10:23'),
(163, '1', '', '咖啡拿鐵', '70', '1', '1', '1', '2022-06-10 13:40:00'),
(164, '1', '', '咖啡拿鐵', '70', '3', '2', '1', '2022-06-10 15:56:53'),
(165, '2', '', '焦糖瑪奇朵', '80', '1', '3', '1', '2022-06-10 15:57:05'),
(166, '4', '', '美式黑咖啡', '50', '3', '1', '1', '2022-06-10 15:58:21'),
(167, '6', '', '鴛鴦咖啡', '70', '1', '1', '1', '2022-06-10 15:58:48'),
(168, '1', '7344cd11fafd4f28e83bf91c25f13468.jpg', '咖啡拿鐵', '70', '1', '2', '1', '2022-06-10 16:13:52'),
(169, '1', '7344cd11fafd4f28e83bf91c25f13468.jpg', '咖啡拿鐵', '70', '1', '1', '3', '2022-06-10 16:24:15'),
(170, '1', '7344cd11fafd4f28e83bf91c25f13468.jpg', '咖啡拿鐵', '70', '3', '2', '1', '2022-06-10 16:24:58'),
(171, '2', '06d9ab3a8927b95a122ccbbe921b5d11.jpg', '焦糖瑪奇朵', '80', '1', '1', '1', '2022-06-10 16:25:06'),
(172, '2', '06d9ab3a8927b95a122ccbbe921b5d11.jpg', '焦糖瑪奇朵', '80', '1', '2', '1', '2022-06-10 16:30:05'),
(173, '1', 'fc033062ba74ce77a607c86eb0ae169a.jpg', '咖啡拿鐵', '70', '5', '2', '1', '2022-06-10 16:37:18'),
(174, '2', '06d9ab3a8927b95a122ccbbe921b5d11.jpg', '焦糖瑪奇朵', '80', '4', '2', '1', '2022-06-10 16:37:18'),
(175, '2', '06d9ab3a8927b95a122ccbbe921b5d11.jpg', '焦糖瑪奇朵', '80', '1', '2', '1', '2022-06-10 16:38:03'),
(176, '1', 'fc033062ba74ce77a607c86eb0ae169a.jpg', '咖啡拿鐵', '70', '1', '1', '1', '2022-06-10 16:48:34'),
(177, '1', 'fc033062ba74ce77a607c86eb0ae169a.jpg', '咖啡拿鐵', '70', '1', '3', '1', '2022-06-10 17:12:20'),
(178, '6', '95b4eaef32ae64728737e570c5ae0625.jpg', '鴛鴦咖啡', '70', '2', '2', '1', '2022-06-10 17:12:20'),
(179, '1', 'fc033062ba74ce77a607c86eb0ae169a.jpg', '咖啡拿鐵', '70', '1', '4', '1', '2022-06-10 17:19:52'),
(180, '1', 'fc033062ba74ce77a607c86eb0ae169a.jpg', '咖啡拿鐵', '70', '1', '4', '1', '2022-06-10 17:24:22'),
(181, '1', 'fc033062ba74ce77a607c86eb0ae169a.jpg', '咖啡拿鐵', '70', '1', '1', '1', '2022-06-10 17:24:22'),
(182, '1', 'fc033062ba74ce77a607c86eb0ae169a.jpg', '咖啡拿鐵', '70', '1', '4', '1', '2022-06-10 17:24:37'),
(183, '1', 'fc033062ba74ce77a607c86eb0ae169a.jpg', '咖啡拿鐵', '70', '1', '1', '1', '2022-06-10 17:24:37'),
(184, '2', '06d9ab3a8927b95a122ccbbe921b5d11.jpg', '焦糖瑪奇朵', '80', '2', '1', '1', '2022-06-10 17:24:37'),
(185, '3', 'fce27a17509b9661faea67672060790c.jpg', '卡布奇諾', '70', '1', '4', '1', '2022-06-10 17:24:37');

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
(1, 'coffee_class 1.jpg', '精選好好喝咖啡豆即日起購買任兩件，第二件即可打七折呦，分享優惠再送濾掛式咖啡一包。', 1, '2017-08-10', '2018-08-10', '快來揪朋友做分享拿好禮喔', '2022-05-31 11:14:27', 5),
(2, 'coffee_class 1.jpg', '行動預點專屬 – 週一週二星禮遇', 2, '2022-01-01', '2022-06-30', '一般會員於週一或週二購買輕食即可享8折優惠', '2022-05-31 11:23:10', 1),
(7, 'coffee_class 1.jpg', 'df', 1, '2022-06-01', '2022-06-24', '123', '2022-06-08 16:09:18', 0),
(8, '3ac88f41b776445cac1a48d5724c8aac.jpg', '123', 1, '2022-05-31', '2022-06-06', '123', '2022-06-08 16:22:09', 0),
(9, 'fc7cc7f44845b508ca502fd1b13d3c72.jpg', 'fd', 1, '2022-06-01', '2022-06-17', '123', '2022-06-08 16:39:23', 0),
(10, '546b3dd7fa855777231606b81cbb19f9.jpg', '0609 0932', 2, '2022-06-01', '2022-06-30', '1345', '2022-06-09 09:33:12', 0),
(11, 'f05ce206b9f735a5b0fe3982778f7fb7.jpg', '0609 0932', 3, '2022-06-01', '2022-06-30', '1345', '2022-06-09 10:03:17', 0),
(12, '4faead6129e09dfe5f9ee7409e9daee6.jpg', '0609 1444', 2, '2022-06-01', '2022-06-02', '123123453', '2022-06-09 14:45:01', 0);

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
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'missing-image.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`member_sid`, `member_name`, `member_nickname`, `member_account`, `member_password`, `member_birthday`, `member_mobile`, `member_address`, `member_mail`, `member_level`, `avatar`) VALUES
(1, '王曉明', '阿明', 'ming', 'ming', '2022-05-30', '0911222333', '台北市大安區', 'ming@test.com', '800', 'missing-image.jpg'),
(4, '小白', 'white', 'white', 'white', '2022-06-08', '0911123456', '台北市', 'white@test.com', '2000', 'missing-image.jpg'),
(7, '123', '睡覺了', '123', '123', NULL, '123', '123', '123', '', '1539960.gif'),
(14, '123', '1234', '1234', '1234', NULL, '123', '123', '123@test123', '', '31Xj7BP6MCTmxwUJ972W89EBE1HSoAlRJIcJtZIB.jpg'),
(666, '子揚', 'Tommy', 'tommy', '1234', NULL, '0975072579', '台北市', 'sky003428@gmail.com', '0', 'tommy.jpg'),
(886, '黃老皮', '老皮', 'pi1234', '1234', NULL, '0975072579', '台北市', 'sky003428@gmail.com', '0', 'lao_pi.png'),
(999, '來亂的', '來亂的', 'li1234', '1234', NULL, '0975072579', '台北市', 'sky003428@gmail.com', '0', 'missing-image.jpg'),
(1001, '王小明', '帥氣a小明', 'ming1', '1234', NULL, '0975123456', '新北市', 'ming1234@gmail.com', '0', 'ming.jpg'),
(1005, '陳大圓', '新手大圓', 'yuan', '1234', NULL, '0975123456', '新北市', 'yuan1234@gmail.com', '0', 'missing-image.jpg'),
(1042, '222', '222', '222', '222', NULL, '', '222', '', '0', 'missing-image.jpg'),
(1408, '漢克', 'Hank', 'hank1234', '1234', NULL, '0977123456', '台北', 'abc@mail', '0', 'missing-image.jpg'),
(1409, 'Amy', 'AAAAAAAAA', '0610', '0610', '2022-06-10', '0977888999', '新竹市', 'amy@mail.com', '0', 'qZqZo6SVk6ecq6Y.jpg'),
(1412, 'ming', 'ming', 'ming3', 'ming', NULL, '', 'ming', '', '0', 'missing-image.jpg'),
(1413, 'ming4', 'ming4', 'ming4', 'ming4', NULL, '', 'ming4', '', '0', 'missing-image.jpg'),
(1414, 'ming4', 'ming4', 'ming5', 'ming4', NULL, '', 'ming4', '', '0', 'missing-image.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `member_likes`
--

CREATE TABLE `member_likes` (
  `sid` int(11) NOT NULL,
  `member_sid` varchar(255) NOT NULL,
  `post_sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member_likes`
--

INSERT INTO `member_likes` (`sid`, `member_sid`, `post_sid`) VALUES
(116, '1001', 2),
(135, '000666', 2),
(137, '000004', 7),
(139, '000004', 1),
(140, '000001', 1),
(152, '001001', 1001),
(153, '001001', 0),
(154, '001411', 27),
(209, '666', 0),
(334, '666', 72),
(374, '666', 15),
(375, '666', 42),
(419, '1001', 5),
(420, '1001', 4),
(422, '000666', 137),
(423, '1001', 1),
(424, '1001', 27),
(428, '000666', 1),
(429, '001408', 144),
(430, '001408', 146),
(431, '001408', 145),
(432, '001005', 150),
(433, '000886', 144),
(434, '000886', 150),
(435, '000886', 167),
(436, '000886', 157),
(437, '000886', 168),
(438, '000886', 145),
(439, '000886', 147),
(440, '000886', 166),
(441, '000886', 153),
(442, '000886', 161),
(443, '000666', 145),
(444, '000666', 150),
(445, '000666', 147),
(446, '000666', 167),
(447, '000666', 146),
(448, '000666', 153),
(449, '000666', 168),
(450, '000666', 166),
(451, '000666', 154),
(452, '000666', 155);

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
(1, '經典義式系列', 'fc033062ba74ce77a607c86eb0ae169a.jpg', '咖啡拿鐵', 381.4, '70', '咖啡因含量:黃101-200mg/杯', '2022-06-10 00:00:00'),
(2, '經典義式系列', '06d9ab3a8927b95a122ccbbe921b5d11.jpg', '焦糖瑪奇朵', 275.4, '80', '咖啡因含量:黃101-200mg/杯', '2022-06-11 00:00:00'),
(3, '經典義式系列', 'fce27a17509b9661faea67672060790c.jpg', '卡布奇諾', 260.5, '70', '咖啡因含量:黃101-200mg/杯', '2022-06-12 00:00:00'),
(4, '經典義式系列', '2bc4ad5f136d9bddd94def6ead5051fa.jpg', '美式黑咖啡', 23.4, '50', '咖啡因含量:黃101-200mg/杯', '2022-06-13 00:00:00'),
(5, '經典義式系列', 'c02cf3d08a79e90d5c94ddcfa38b54ff.jpg', '黑糖風味拿鐵', 375.2, '80', '咖啡因含量:黃101-200mg/杯', '2022-06-14 00:00:00'),
(6, '經典義式系列', '95b4eaef32ae64728737e570c5ae0625.jpg', '鴛鴦咖啡', 231.3, '70', '咖啡因含量:綠100mg/杯', '2022-06-15 00:00:00'),
(7, '經典義式系列', '7344cd11fafd4f28e83bf91c25f13468.jpg', '香草風味拿鐵', 240.5, '90', '咖啡因含量:黃101-200mg/杯', '2022-06-16 00:00:00'),
(8, '經典義式系列', 'fcab1487d7bcb7748ad656fc0c718186.jpg', '拿鐵歐蕾', 197.5, '75', '咖啡因含量:綠100mg以下/杯', '2022-06-17 00:00:00'),
(9, '經典義式系列', 'fcb757f3fb568f15732945d69a7bcd86.png', '義式摩卡', 368, '80', '咖啡因含量:黃101-200mg/杯', '2022-06-18 00:00:00'),
(10, '精品咖啡', 'ef7cf4d26f30d37c21eb371b41750dc2.jpg', '莊園級美式', 15.5, '60', '咖啡因含量:紅201mg/杯', '2022-06-19 00:00:00'),
(11, '精品咖啡', 'f5006e8c6b69456ee69937ce7907842e.jpg', '莊園級拿鐵', 267.7, '80', '咖啡因含量:紅201mg/杯', '2022-06-20 00:00:00'),
(12, '精品咖啡', '4b283af4f7b3b5b54f14a38d351bdf22.jpg', '哥倫比亞', 4, '95', '咖啡因含量:黃101-200mg/杯', '2022-06-21 00:00:00'),
(13, '精品咖啡', 'f20e6ecd30f045cc5cc6559ace330b54.jpg', '曼巴', 4, '95', '咖啡因含量:黃101-200mg/杯', '2022-06-22 00:00:00'),
(14, '精品咖啡', 'd51a9066b9c546130b8d7061725bdeb9.jpg', '黃金曼特寧', 4, '95', '咖啡因含量:黃101-200mg/杯', '2022-06-23 00:00:00'),
(15, '精品咖啡', 'd85d68ae5743fbfca13454474f801d50.jpg', '肯亞 精選小農', 4, '95', '咖啡因含量:黃101-200mg/杯', '2022-06-24 00:00:00'),
(16, '精品咖啡', '0be476a58dd4f86a22117bd31b0ce468.jpg', '莊園老饕深焙', 4, '95', '咖啡因含量:黃101-200mg/杯', '2022-06-25 00:00:00'),
(17, '精品咖啡', '7344cd11fafd4f28e83bf91c25f13468.jpg', '耶加雪菲', 4, '100', '咖啡因含量:黃101-200mg/杯', '2022-06-26 00:00:00'),
(18, '其他飲品', '4a9510778ff1c96b4908c1a7295310e6.jpg', '義式巧克力', 378, '60', '總糖量:64.1公克', '2022-06-27 00:00:00'),
(19, '其他飲品', '03f885f221affdaa7ecc1a2c5202fdca.jpg', '愛丁堡女王紅茶', 50, '40', '茶葉產地:印度、斯里蘭卡、尼泊爾、台灣、越南', '2022-06-28 00:00:00'),
(20, '其他飲品', '03f885f221affdaa7ecc1a2c5202fdca.jpg', '宇治奶茶', 345, '50', '茶葉產地:日本京都府', '2022-06-29 00:00:00');

-- --------------------------------------------------------

--
-- 資料表結構 `menu1`
--

CREATE TABLE `menu1` (
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
-- 傾印資料表的資料 `menu1`
--

INSERT INTO `menu1` (`menu_sid`, `menu_categories`, `menu_photo`, `menu_name`, `menu_kcal`, `menu_price_m`, `menu_price_l`, `menu_nutrition`, `created_at`) VALUES
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
-- 資料表結構 `news_class`
--

CREATE TABLE `news_class` (
  `class_sid` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `news_class`
--

INSERT INTO `news_class` (`class_sid`, `class_name`) VALUES
(1, '商品'),
(2, '美食'),
(3, '課程');

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
(2, '2022-05-31 14:50:43', 'ATM轉帳', '700-24416794519754', '郵寄', '655 雲林縣元長鄉子茂33號', 3, 7, 872, '531145043'),
(20, '2022-06-08 13:14:45', 'ATM轉帳', '700-561356135614', '郵寄', '932 屏東縣新園鄉仙鯉路19號', 1, 3, 412, '1654665285'),
(21, '2022-06-10 17:29:37', 'ATM轉帳', '700-561356135614', '郵寄', '932 屏東縣新園鄉仙鯉路19號', 1, NULL, 1110, '1654853377');

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
(2, 2, 2, -300, '2022-06-03'),
(3, 1, 1, 300, '2022-06-06');

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
(1, '體驗拉花課程分享', '每次看到咖啡師的拉花作品，再看看咖啡師拉花的動作看似簡單，胃痛一直很想要體驗拉花，想不到自己實際操作一遍，操作起來還真的不簡單啊。', '帥氣a小明', 1001, 12, 2, 1, '2022-05-31 04:35:39', '2022-06-10 10:05:20', 0),
(2, '狗狗拉花課程', '每次看到咖啡師的拉花作品，再看看咖啡師拉花的動作看似簡單，胃痛一直很想要體驗拉花，想不到自己實際操作一遍，操作起來還真的不簡單啊。', '帥氣a小明', 1001, 3, 2, 1, '2022-05-31 04:35:39', '2022-06-10 10:05:20', 0),
(143, '分享好喝咖啡豆', '這種事實對本人來說意義重大，相信對這個世界也是有一定意義的。蘇霍姆林斯基深信，愛，首先意味著奉獻，意味著把自己心靈的力量獻給所愛的人，為所愛的人創造幸福。這影響了我的價值觀。一般來說，列寧曾說過，患難識朋友。這句話看似簡單，卻埋藏了深遠的意義。看看別人，再想想自己，會發現問題的核心其實就在你身旁。當前最急迫的事，想必就是釐清疑惑了。在這種不可避免的衝突下，我們必須解決這個問題。咖啡豆似乎是一種巧合，但如果我們從一個更大的角度看待問題，這似乎是一種不可避免的事實。', 'Hank', 1408, 0, 0, 2, '2022-06-13 00:13:33', NULL, 0),
(144, '分享她們家的土司 超好吃的拉', ' 加里寧講過一句值得人反覆尋思的話，無論哪個時代，青年的特點總是懷抱著各種理想和幻想。這並不是什麼毛病，而是一種寶貴的品質。這影響了我的價值觀。我們不得不相信，齊秦曾經提過，令人不能自拔的，除了牙齒還有愛情。這激勵了我。想必大家都能了解吐司的重要性。回過神才發現，思考吐司的存在意義，已讓我廢寢忘食。需要考慮周詳吐司的影響及因應對策。伏契克曾講過，英雄就是這樣一個人，他在決定性關頭做了為人類社會的利益所需要的事。請諸位將這段話在心中默念三遍。', 'Hank', 1408, 2, 1, 2, '2022-06-13 00:14:52', NULL, 0),
(145, '可愛貓咪會翻跟斗', '可愛貓咪會翻跟斗', 'Hank', 1408, 3, 0, 3, '2022-06-13 00:16:19', NULL, 0),
(146, '手沖基礎班上完心得', '逸經告訴我們，不要對每一個故事都信以為真。這激勵了我。每個人都不得不面對這些問題。在面對這種問題時，務必詳細考慮手沖的各種可能。馮學峰說過一句富有哲理的話，當一個人用工作去迎接光明，光明很快就會來照耀著他。這段話對世界的改變有著深遠的影響。拉蒙納斯說過一句著名的話，良心是公正廉潔的法官。這句話幾乎解讀出了問題的根本。', 'Hank', 1408, 2, 0, 1, '2022-06-13 00:17:56', NULL, 0),
(147, '手沖基礎班讚讚', '逸經告訴我們，不要對每一個故事都信以為真。這激勵了我。每個人都不得不面對這些問題。在面對這種問題時，務必詳細考慮手沖的各種可能。馮學峰說過一句富有哲理的話，當一個人用工作去迎接光明，光明很快就會來照耀著他。這段話對世界的改變有著深遠的影響。拉蒙納斯說過一句著名的話，良心是公正廉潔的法官。這句話幾乎解讀出了問題的根本。', '新手大圓', 1005, 3, 1, 1, '2022-06-13 00:17:56', NULL, 0),
(148, '基礎班課程', '逸經告訴我們，不要對每一個故事都信以為真。這激勵了我。每個人都不得不面對這些問題。在面對這種問題時，務必詳細考慮手沖的各種可能。馮學峰說過一句富有哲理的話，當一個人用工作去迎接光明，光明很快就會來照耀著他。這段話對世界的改變有著深遠的影響。拉蒙納斯說過一句著名的話，良心是公正廉潔的法官。這句話幾乎解讀出了問題的根本。', '新手大圓', 1005, 1, 0, 1, '2022-06-13 00:17:56', NULL, 0),
(149, '拉花課程很有趣欸', '拉花課程很有趣欸', 'Hank', 1408, 0, 0, 1, '2022-06-13 00:23:26', NULL, 0),
(150, '薯條粗的不好粗 不粗的好粗', '薯條粗的不好粗 不粗的好粗<br/>好粗好粗', 'Hank', 1408, 3, 2, 2, '2022-06-13 00:31:50', NULL, 0),
(151, '跟大家分享一個很酷的東西', '我也不知道是甚麼', '新手大圓', 1005, 0, 0, 3, '2022-06-13 00:36:56', NULL, 0),
(152, '大隻法國麵包', '大隻法國麵包', '新手大圓', 1005, 0, 0, 2, '2022-06-13 00:37:27', NULL, 0),
(153, '我的拉花 就問你贊不贊', '讚嗎?', '新手大圓', 1005, 2, 0, 1, '2022-06-13 00:38:12', NULL, 0),
(154, '分享店內環境-台北店', '讚', '新手大圓', 1005, 1, 0, 3, '2022-06-13 00:41:30', NULL, 0),
(155, '分享天母店環境', '分享天母店環境', '新手大圓', 1005, 1, 0, 3, '2022-06-13 00:42:19', NULL, 0),
(156, '拿鐵拉花', '拿鐵拉花', '新手大圓', 1005, 0, 0, 1, '2022-06-13 00:43:44', NULL, 0),
(157, '第一次拉花就上手', '第一次拉花就上手', '新手大圓', 1005, 1, 0, 1, '2022-06-13 00:44:17', NULL, 0),
(158, '拉花爛', '爛', '來亂的', 999, 0, 0, 1, '2022-06-13 00:44:17', NULL, 0),
(159, '爛芭樂', '爛', '來亂的', 999, 0, 0, 1, '2022-06-13 00:44:17', NULL, 0),
(160, '爛芭樂爛爛爛', '爛', '來亂的', 999, 0, 0, 1, '2022-06-13 00:44:17', NULL, 0),
(161, '拉花好無聊', '爛', '來亂的', 999, 1, 1, 1, '2022-06-13 00:44:17', '2022-06-13 01:08:05', 0),
(162, '貓咪狗狗拉花', '貓咪狗狗拉花', '老皮', 886, 0, 0, 1, '2022-06-13 01:10:33', NULL, 0),
(164, '幽靈拉花課程', '幽靈拉花課程', '老皮', 886, 0, 0, 1, '2022-06-13 01:12:02', NULL, 0),
(165, '咖發豆課程', '咖發豆課程', '老皮', 886, 0, 0, 1, '2022-06-13 01:12:49', NULL, 0),
(166, '厲害的麵包', '厲害的麵包', '老皮', 886, 2, 0, 2, '2022-06-13 01:13:29', NULL, 0),
(167, '分享台中店環境', '分享台中店環境', '老皮', 886, 2, 0, 3, '2022-06-13 01:14:20', NULL, 0),
(168, '分享我家的可愛狗溝', '分享我家的可愛狗溝', '老皮', 886, 2, 0, 1, '2022-06-13 01:16:13', NULL, 0),
(169, '你分得出咖啡豆嗎', '分不出', '帥氣a小明', 1001, 0, 0, 1, '2022-06-13 01:29:19', NULL, 0),
(170, '拿鐵好喝的秘訣', '拿鐵好喝的秘訣', '帥氣a小明', 1001, 0, 0, 1, '2022-06-13 01:30:20', NULL, 0),
(171, '好吃的可頌值得一吃再吃', '好吃的可頌值得一吃再吃', 'Tommy', 666, 0, 0, 2, '2022-06-13 01:33:38', NULL, 0),
(172, '震驚!!', '震驚!!', '帥氣a小明', 1001, 0, 0, 2, '2022-06-13 01:35:20', NULL, 0),
(173, '看起來很好吃喔', '123', '帥氣a小明', 1001, 0, 0, 1, '2022-06-13 01:36:22', NULL, 0),
(174, '歪國人煮咖啡', '歪國人', '帥氣a小明', 1001, 0, 0, 3, '2022-06-13 01:37:06', NULL, 0),
(175, '我上一堂課就拉成這樣是不是天才', '我上一堂課就拉成這樣是不是天才', '帥氣a小明', 1001, 0, 0, 1, '2022-06-13 01:37:57', NULL, 0),
(176, '濾掛咖啡分享', '濾掛咖啡分享', 'Tommy', 666, 0, 0, 1, '2022-06-13 01:40:39', NULL, 0);

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
(38, 143, 16),
(39, 143, 1),
(40, 145, 17),
(41, 146, 18),
(42, 149, 4),
(43, 149, 2),
(44, 149, 19),
(45, 149, 3),
(46, 150, 20),
(47, 150, 21),
(48, 150, 22),
(49, 152, 23),
(50, 153, 2),
(51, 154, 24),
(52, 154, 25),
(53, 155, 24),
(54, 156, 1),
(55, 156, 2),
(56, 157, 2),
(57, 161, 26),
(58, 162, 27),
(59, 162, 2),
(60, 163, 27),
(61, 163, 2),
(62, 164, 27),
(63, 167, 24),
(64, 168, 17),
(65, 169, 16),
(66, 169, 28),
(67, 170, 1),
(68, 171, 22),
(69, 171, 29),
(70, 175, 18),
(71, 175, 2),
(72, 175, 27),
(73, 176, 16);

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
  `products_with_products_style_filter_sid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products`
--

INSERT INTO `products` (`products_sid`, `products_number`, `products_name`, `products_introduction`, `products_detail_introduction`, `products_price`, `products_forsale`, `products_onsale`, `products_stocks`, `products_with_products_categroies_sid`, `products_with_products_style_filter_sid`) VALUES
(1, '1653962198', '曼巴咖啡(一包十入)', '精選曼巴咖啡, 一包十入', '溫順的曼巴，散發出自然甘甜氣味，集清爽與強勁香醇於一體。', 320, 1, 0, 3299, 2, 1),
(2, '1653962417', '曼特寧咖啡(一包十入)', '精選曼特寧咖啡, 一包十入', '香濃甘苦的滋味，不帶酸味順口香醇。', 320, 1, 0, 3399, 2, 2),
(3, '1653969575', '黃金曼特寧(半磅)', '曼特寧咖啡豆, 半磅包裝', '曼特寧咖啡豆', 470, 1, 0, 4099, 2, 2),
(4, '1653972891', '濾紙(大)', '大片綠紙, 一包100張', '簡易方便, 100%天然紙漿製成, 保留咖啡原味', 150, 0, 0, 4400, 4, 4),
(5, '1653972907', '濾紙(小)', '小片綠紙, 一包100張', '簡易方便, 100%天然紙漿製成, 保留咖啡原味', 150, 1, 0, 4400, 4, 4),
(6, '1654050346', '巴西咖啡', '巴西咖啡', '巴西咖啡', 320, 1, 0, 3300, 3, 2),
(7, '1654050441', '巴西咖啡2', '巴西咖啡2', '巴西咖啡2', 320, 1, 0, 3300, 3, 2),
(8, '1654050701', '巴西咖啡(一包十入)5', '精選巴西咖啡5', '11', 320, 1, 0, 2600, 2, 2),
(9, '1654589950', 'AA咖啡(一包十入)', '精緻AA咖啡', '精緻AA咖啡', 320, 1, 0, 5500, 2, 2),
(10, '1654590367', 'BB咖啡(一包十入)', '精緻BB咖啡', '精緻BB咖啡', 120, 1, 0, 300, 2, 2),
(11, '1654757377', 'CC咖啡(一包十入)', '精緻CC咖啡', '精緻CC咖啡', 320, 1, 0, 3300, 2, 1),
(12, '1654845189', 'AA咖啡(半磅)', '精選AA咖啡豆', '精選AA咖啡豆', 320, 1, 0, 5000, 3, 1);

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
(1, '未確定分類'),
(2, '濾掛式咖啡'),
(3, '咖啡豆'),
(4, '咖啡周邊器具'),
(5, '禮盒'),
(6, '電子禮物卡');

-- --------------------------------------------------------

--
-- 資料表結構 `products_pic`
--

CREATE TABLE `products_pic` (
  `products_pic_sid` int(11) NOT NULL,
  `products_pic_one` varchar(255) DEFAULT NULL,
  `products_pic_multi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `products_pic`
--

INSERT INTO `products_pic` (`products_pic_sid`, `products_pic_one`, `products_pic_multi`) VALUES
(1, 'manba_bean.jfif', 'coffee-beans-ge63dc538f_1280.png,coffee-cup-g7ca2c646b_1920.jpg,coffee-g0d5529a14_1920.jpg'),
(2, 'bag-coffee.jpg', 'caffeine-gf6a927184_1920.jpg,cappuccino-g6d10d7112_1920.jpg,caviar-sandwich-gf30000537_1920.jpg'),
(3, 'manba_bean.jfif', 'caffeine-gf6a927184_1920.jpg,cappuccino-g6d10d7112_1920.jpg,coffee-g3b12ecac6_1920.jpg'),
(4, 'filter.jpg', 'filter.jpg,filter2.jpg,filter3.jpg'),
(5, 'filter.jpg', 'coffee-g44d7e5c82_1920.jpg,filter2.jpg,filter3.jpg'),
(6, 'bag-coffee.jpg', 'bag-coffee2.jpg,coffee-g8ca4ec8b4_1920.jpg,coffee-g138b683d2_1920.jpg'),
(7, 'bag-coffee.jpg', 'bag-coffee2.jpg,coffee-g8ca4ec8b4_1920.jpg,coffee-g94f7ab5a8_1920.jpg'),
(8, 'manba_bean.jfif', 'black-g0ea50eca3_1280.png,coffee-gb0b4b4db0_1920.jpg,drip-bag.jpg'),
(9, 'manba_bean.jfif', 'coffee-g75832e31d_1920.jpg,coffee-gede84c1ac_1280.png,drip-bag.jpg'),
(10, 'manba_bean.jfif', 'coffee-gede84c1ac_1280.png,drip-bag.jpg,fresh-g771eed6be_1920.jpg'),
(11, 'bread-g643eb7d6e_1920.jpg', 'bag-coffee2.jpg,black-g0ea50eca3_1280.png,bread-g89f67674b_1920.jpg'),
(12, 'coffee-beans-g9399da144_1920.jpg', 'coffee-g3b12ecac6_1920.jpg,coffee-g4c1b28f2f_1920.jpg,coffee-g7a056ccf3_1920.jpg');

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
  `comment_sid` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `member_sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `reply`
--

INSERT INTO `reply` (`sid`, `content`, `comment_sid`, `created_at`, `member_sid`) VALUES
(1, '這邊的老師都很會教，別擔心', 1, '2022-06-04', 1001);

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
  `times` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `tag`
--

INSERT INTO `tag` (`sid`, `name`, `times`) VALUES
(1, '拿鐵', 3),
(2, '拉花', 8),
(3, '好有趣阿', 2),
(4, '拉花好好玩', 2),
(16, '咖啡', 3),
(17, '可愛', 2),
(18, '課程', 2),
(19, '有趣', 1),
(20, '漢堡', 1),
(21, '薯條', 1),
(22, '好粗', 2),
(23, '法棍', 1),
(24, '環境', 3),
(25, '超美', 1),
(26, '拉花好無聊', 1),
(27, '拉花課程', 4),
(28, '咖啡豆', 1),
(29, 'cp值', 1);

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
-- 資料表索引 `course_backup`
--
ALTER TABLE `course_backup`
  ADD PRIMARY KEY (`course_sid`);

--
-- 資料表索引 `course_related`
--
ALTER TABLE `course_related`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `food_choice`
--
ALTER TABLE `food_choice`
  ADD PRIMARY KEY (`food_choice_sid`);

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
-- 資料表索引 `menu1`
--
ALTER TABLE `menu1`
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
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_sid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment`
--
ALTER TABLE `comment`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon`
--
ALTER TABLE `coupon`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon_logs`
--
ALTER TABLE `coupon_logs`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `coupon_receive`
--
ALTER TABLE `coupon_receive`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course`
--
ALTER TABLE `course`
  MODIFY `course_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_backup`
--
ALTER TABLE `course_backup`
  MODIFY `course_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `course_related`
--
ALTER TABLE `course_related`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `food_choice`
--
ALTER TABLE `food_choice`
  MODIFY `food_choice_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lastest_news`
--
ALTER TABLE `lastest_news`
  MODIFY `news_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `member_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1415;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_likes`
--
ALTER TABLE `member_likes`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=453;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `menu1`
--
ALTER TABLE `menu1`
  MODIFY `menu_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order`
--
ALTER TABLE `order`
  MODIFY `order_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `points_record`
--
ALTER TABLE `points_record`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `points_user`
--
ALTER TABLE `points_user`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post`
--
ALTER TABLE `post`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_img`
--
ALTER TABLE `post_img`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=746;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products`
--
ALTER TABLE `products`
  MODIFY `products_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products_categroies`
--
ALTER TABLE `products_categroies`
  MODIFY `products_categroies_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products_pic`
--
ALTER TABLE `products_pic`
  MODIFY `products_pic_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `products_style_filter`
--
ALTER TABLE `products_style_filter`
  MODIFY `products_style_filter_sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reply`
--
ALTER TABLE `reply`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
