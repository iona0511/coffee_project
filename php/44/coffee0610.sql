-- Adminer 4.8.1 MySQL 10.4.24-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `admin_sid` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin` (`admin_sid`, `admin_name`, `admin_account`, `admin_password`) VALUES
(1,	'chia',	'chia',	'chia123'),
(2,	'black',	'black',	'black'),
(3,	'管理子揚',	'tommyad',	'1234');

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `cart_sid` int(10) NOT NULL AUTO_INCREMENT,
  `cart_product_id` int(255) NOT NULL DEFAULT 0,
  `cart_food_id` int(10) NOT NULL DEFAULT 0,
  `cart_price` int(10) NOT NULL,
  `cart_quantity` int(10) NOT NULL,
  `cart_member_id` int(10) NOT NULL,
  `cart_order_id` int(10) NOT NULL DEFAULT 0,
  `cart_delete` int(10) NOT NULL DEFAULT 0,
  PRIMARY KEY (`cart_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `cart` (`cart_sid`, `cart_product_id`, `cart_food_id`, `cart_price`, `cart_quantity`, `cart_member_id`, `cart_order_id`, `cart_delete`) VALUES
(1,	1,	0,	310,	1,	1,	1,	0),
(2,	2,	0,	320,	2,	1,	1,	0),
(3,	5,	0,	150,	2,	1,	1,	0),
(4,	3,	0,	470,	2,	3,	2,	0),
(5,	4,	0,	150,	1,	3,	2,	0),
(6,	1,	0,	310,	1,	2,	0,	0),
(7,	2,	0,	320,	1,	2,	0,	0),
(8,	3,	0,	470,	1,	2,	0,	0),
(9,	4,	0,	150,	2,	2,	0,	0),
(10,	1,	0,	310,	1,	4,	0,	0),
(11,	5,	0,	150,	1,	4,	0,	0),
(12,	5,	0,	150,	1,	2,	0,	1),
(13,	2,	0,	320,	2,	5,	0,	0),
(14,	4,	0,	150,	2,	5,	0,	0),
(15,	3,	0,	470,	1,	5,	0,	1);

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `replies` int(11) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL,
  `post_sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `comment` (`sid`, `content`, `replies`, `created_at`, `post_sid`, `member_sid`) VALUES
(1,	'挖~課程看起來很讚耶 不知道適不適合新手?',	1,	'2022-06-03',	1,	1005),
(3,	'感覺讚讚',	0,	'2022-06-05',	1,	1005),
(7,	'aaa',	0,	'2022-06-05',	1,	1001),
(8,	'bcd',	0,	'2022-06-05',	1,	1001),
(9,	'1234',	0,	'2022-06-06',	1,	1005),
(10,	'123445',	0,	'2022-06-06',	1,	1005),
(12,	'123',	0,	'2022-06-09',	1,	666);

DROP TABLE IF EXISTS `coupon`;
CREATE TABLE `coupon` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_send_type` varchar(11) DEFAULT NULL,
  `coupon_setting_type` varchar(11) DEFAULT NULL,
  `coupon_money` varchar(255) NOT NULL,
  `menu_sid` int(11) DEFAULT NULL,
  `products_sid` int(11) DEFAULT NULL,
  `type` varchar(11) NOT NULL,
  `coupon_validity_period` varchar(11) NOT NULL,
  `coupon_status` varchar(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `coupon` (`sid`, `coupon_name`, `coupon_send_type`, `coupon_setting_type`, `coupon_money`, `menu_sid`, `products_sid`, `type`, `coupon_validity_period`, `coupon_status`) VALUES
(2,	'註冊優惠券$100',	'2 註冊時發送',	'1 折扣金額',	'100',	0,	0,	'3 全品項',	'12個月',	'1開放'),
(3,	'咖啡拿鐵5折',	'3 玩遊戲時發送',	'2 打折',	'0.5',	1,	0,	'1餐點類',	'6個月',	'1開放'),
(4,	'卡布奇諾 5折',	'3 玩遊戲時發送',	'2 打折',	'0.5',	3,	0,	'1餐點類',	'6個月',	'1開放'),
(5,	'義式摩卡75折',	'3 玩遊戲時發送',	'2 打折',	'0.75',	9,	0,	'1餐點類',	'6個月',	'1開放'),
(6,	'耶加雪菲75折',	'3 玩遊戲時發送',	'2 打折',	'0.75',	17,	0,	'1餐點類',	'6個月',	'1開放'),
(7,	'宇治奶茶8折',	'3 玩遊戲時發送',	'2 打折',	'0.8',	20,	0,	'1餐點類',	'6個月',	'1開放'),
(8,	'精選曼巴咖啡組8折',	'3 玩遊戲時發送',	'2 打折',	'0.8',	0,	1,	'2 商品類',	'6個月',	'1開放'),
(9,	'黃金曼特寧組9折',	'3 玩遊戲時發送',	'2 打折',	'0.8',	0,	3,	'2 商品類',	'6個月',	'1開放');

DROP TABLE IF EXISTS `coupon_logs`;
CREATE TABLE `coupon_logs` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `member_sid` int(11) NOT NULL,
  `coupon_receive_sid` int(11) NOT NULL,
  `order_sid` int(11) NOT NULL,
  `used_time` datetime DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `coupon_logs` (`sid`, `member_sid`, `coupon_receive_sid`, `order_sid`, `used_time`) VALUES
(1,	1,	2,	0,	NULL),
(2,	2,	4,	0,	'2022-06-01 00:00:00'),
(23,	1,	3,	20,	'2022-06-08 13:14:45');

DROP TABLE IF EXISTS `coupon_receive`;
CREATE TABLE `coupon_receive` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `member_sid` int(11) NOT NULL,
  `coupon_sid` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `coupon_receive` (`sid`, `member_sid`, `coupon_sid`, `create_time`, `end_time`, `status`) VALUES
(1,	1,	1,	'2021-03-24 00:00:00',	'2022-03-24 00:00:00',	0),
(2,	1,	2,	'2022-03-31 00:00:00',	'2023-03-31 00:00:00',	0),
(3,	1,	3,	'2022-05-07 00:00:00',	'2023-11-07 00:00:00',	0),
(4,	2,	4,	'2022-05-07 00:00:00',	'2023-11-07 00:00:00',	0),
(5,	2,	4,	'2022-05-08 00:00:00',	'2022-11-08 00:00:00',	0),
(6,	3,	5,	'2022-05-09 00:00:00',	'2022-11-09 00:00:00',	0),
(7,	4,	7,	'2022-05-19 00:00:00',	'2022-11-19 00:00:00',	0),
(8,	5,	8,	'2022-05-28 00:00:00',	'2022-11-28 00:00:00',	0),
(9,	6,	9,	'2022-05-30 00:00:00',	'2022-11-30 00:00:00',	0),
(10,	7,	10,	'2022-06-01 00:00:00',	'2022-11-01 00:00:00',	0);

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `course_sid` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_level` int(11) NOT NULL,
  `course_img_s` varchar(255) NOT NULL,
  `course_content` varchar(255) NOT NULL,
  `course_people` varchar(255) NOT NULL,
  `course_material` varchar(255) NOT NULL,
  PRIMARY KEY (`course_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `course` (`course_sid`, `course_name`, `course_price`, `course_level`, `course_img_s`, `course_content`, `course_people`, `course_material`) VALUES
(82,	'麻雀拉花',	2999,	3,	'217a87c655ab64e3f4c61e041ece6b32.jpg',	'專業教師手把手教學.',	'喜歡麻雀的人',	'杯子.牛奶.咖啡豆(廠商提供)'),
(83,	'皮卡丘拉花',	2499,	2,	'2c0a2a3b5f7b841c9c2db4ad1b3f5e0d.jpg',	'專業的師資,充實的教學內容.',	'喜歡寶可夢的人',	'杯子.牛奶.咖啡豆(廠商提供)'),
(84,	'貓咪澡堂拉花',	2666,	2,	'6bc7f448bddf07025e83c5c805e0b9b7.jpg',	'一起來幫貓咪準備澡堂吧!',	'喜愛貓咪的人',	'杯子.牛奶.咖啡豆(廠商提供)'),
(85,	'快樂星球拉花',	2350,	2,	'ed40f965554712e6be07285aef954cd8.jpg',	'一起來製造快樂星球吧!',	'普遍級',	'杯子.牛奶.咖啡豆(廠商提供)'),
(86,	'屁柴拉花',	2450,	3,	'2421496a84b1b5134a89744e09a85c83.jpg',	'專業級的老師,手把手教學.',	'喜愛狗狗的人士',	'杯子.牛奶.咖啡豆(廠商提供)'),
(87,	'聖誕樹拉花',	1499,	1,	'69edea94a5e887354543de3a970faa17.png',	'非常適合初學者唷.',	'適合所有人',	'杯子.牛奶.咖啡豆(廠商提供)'),
(88,	'蝸牛拉花',	1999,	1,	'1e053eda4a8d7bf8af800511caa49e80.jpg',	'非常可愛的小蝸牛,很適合入門的課程.',	'適合所有人',	'杯子.牛奶.咖啡豆(廠商提供)'),
(89,	'手沖咖啡基礎班',	3777,	1,	'73c9ba4ec7f6c5af179f5fc994057424.jpg',	'體驗手沖咖啡的樂趣!',	'喜愛咖啡的大家',	'杯子.咖啡豆.手沖器具(廠商提供)'),
(90,	'咖啡豆介紹',	2000,	1,	'38aecb3ddaaf82eb59cda7acde393780.jpg',	'專業的講師,講解各類咖啡豆.',	'對認識咖啡豆有興趣的人',	'無'),
(91,	'獨角獸拉花',	2680,	1,	'1049cbdcbc3a9df37e78ab21d357a04c.jpg',	'教您拉出奇幻獨角獸.',	'適合所有人',	'杯子.牛奶.咖啡豆(廠商提供)'),
(92,	'小熊拉花',	1299,	1,	'97c2a51dca024b36bb2fc5f93fdfc1cb.png',	'一起來學習小熊拉花吧!',	'適合所有人',	'杯子.牛奶.咖啡豆(廠商提供)'),
(93,	'愛心拉花',	1199,	1,	'f83c89cb0f3f09a323f1e3fae18f9d6d.jpg',	'初學者非常好上手的一門課.',	'適合所有人',	'杯子.牛奶.咖啡豆(廠商提供)'),
(94,	'拿鐵沖調班',	3333,	1,	'43f80f6e4c0675fd0dde0def963a0f3b.jpg',	'沖調拿鐵的基本介紹',	'喜愛拿鐵的人',	'杯子.牛奶.咖啡豆.沖調器具(廠商提供)'),
(95,	'幽靈拉花',	1499,	1,	'2ea7ad4897288dc11dd147ac61e4adac.jpg',	'非常適合初學者的課程',	'適合所有人',	'杯子.牛奶.咖啡豆(廠商提供)');

DROP TABLE IF EXISTS `course_backup`;
CREATE TABLE `course_backup` (
  `course_sid` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) NOT NULL,
  `course_price` int(11) NOT NULL,
  `course_level` int(11) NOT NULL,
  `course_img_s` varchar(255) NOT NULL,
  `course_content` varchar(255) NOT NULL,
  `course_people` varchar(255) NOT NULL,
  `course_material` varchar(255) NOT NULL,
  PRIMARY KEY (`course_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `course_backup` (`course_sid`, `course_name`, `course_price`, `course_level`, `course_img_s`, `course_content`, `course_people`, `course_material`) VALUES
(1,	'測試',	123,	1,	'93583e83c60b1594e60f6d4728187c60.jpg',	'221',	'212',	'11'),
(2,	'12',	121,	1,	'd89814e1706d044b7e474815c54909c2.jpg',	'21',	'21',	'12'),
(3,	'咖啡烘焙',	2000,	2,	'img',	'體驗自己親手烘焙咖啡豆的樂趣',	'想體驗自己烘咖啡豆的人',	'咖啡豆.相關沖煮器材設備(課程提供)'),
(4,	'咖啡生豆認識及風味鑑嘗學',	3000,	3,	'img',	'認識不同咖啡產地及品種，加強自己品嚐咖啡思維',	'對咖啡豆有濃厚興趣及對咖啡烘焙有興趣朋友參加',	'咖啡豆.相關沖煮器材設備(課程提供)'),
(5,	'手沖咖啡基礎訓練班',	1500,	1,	'img',	'學會從風味中了解自己沖煮手法',	'適合初學者或希望了解自己沖煮技巧缺點人士',	'咖啡豆.相關沖煮器材設備(課程提供)');

DROP TABLE IF EXISTS `course_related`;
CREATE TABLE `course_related` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `course_sid` int(11) NOT NULL,
  `course_date` date NOT NULL,
  `course_time` varchar(255) NOT NULL,
  `course_img_l` varchar(255) NOT NULL,
  `course_number_people` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `course_related` (`sid`, `course_sid`, `course_date`, `course_time`, `course_img_l`, `course_number_people`) VALUES
(1,	1,	'2022-09-01',	'AM-10',	'img',	0),
(2,	1,	'2022-09-25',	'PM-02',	'img',	0),
(3,	1,	'2022-08-30',	'PM-03',	'img',	0);

DROP TABLE IF EXISTS `food_choice`;
CREATE TABLE `food_choice` (
  `food_choice_sid` int(11) NOT NULL AUTO_INCREMENT,
  `menu_sid` varchar(255) NOT NULL,
  `menu_photo` varchar(255) NOT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_price_m` varchar(255) NOT NULL,
  `food_choice_ice` varchar(255) NOT NULL,
  `food_choice_sugar` varchar(255) NOT NULL,
  `food_choice_count` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`food_choice_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='food_choice';

INSERT INTO `food_choice` (`food_choice_sid`, `menu_sid`, `menu_photo`, `menu_name`, `menu_price_m`, `food_choice_ice`, `food_choice_sugar`, `food_choice_count`, `created_at`) VALUES
(150,	'',	'',	'莊園級拿鐵 ',	'80',	'1',	'2',	'4',	'2022-06-09 11:32:21'),
(151,	'',	'',	'咖啡拿鐵',	'70',	'1',	'1',	'5',	'2022-06-09 11:32:22'),
(152,	'',	'',	'莊園級拿鐵 ',	'80',	'1',	'2',	'4',	'2022-06-09 11:32:22'),
(153,	'',	'',	'莊園級拿鐵 ',	'80',	'1',	'1',	'4',	'2022-06-09 11:34:23'),
(154,	'',	'',	'莊園級拿鐵 ',	'80',	'1',	'1',	'4',	'2022-06-09 11:43:26'),
(155,	'192',	'f7051d3f87bcc0c79dbf9a837388d7f9.png',	'義式摩卡 ',	'80',	'1',	'1',	'4',	'2022-06-09 12:01:39'),
(156,	'192',	'f7051d3f87bcc0c79dbf9a837388d7f9.png',	'義式摩卡 ',	'80',	'1',	'1',	'4',	'2022-06-09 12:03:11'),
(157,	'190',	'792fa71cf16327b18c713b8744215ec0.jpg',	'美式黑咖啡',	'50',	'1',	'1',	'4',	'2022-06-09 12:03:11'),
(158,	'189',	'c92e70256fb8cf814daa982af0664bc9.jpg',	'莊園級拿鐵 ',	'80',	'1',	'1',	'5',	'2022-06-09 14:28:42'),
(159,	'189',	'c92e70256fb8cf814daa982af0664bc9.jpg',	'莊園級拿鐵 ',	'80',	'1',	'1',	'5',	'2022-06-09 14:30:23'),
(160,	'193',	'8d7e9afe5978766f19b3279389b1c467.jpg',	'宇治奶茶',	'50',	'1',	'1',	'4',	'2022-06-09 14:30:23'),
(161,	'188',	'd1eb9c095ac94e523067f2a167b322e1.jpg',	'咖啡拿鐵',	'70',	'1',	'1',	'1',	'2022-06-10 13:10:22'),
(162,	'188',	'd1eb9c095ac94e523067f2a167b322e1.jpg',	'咖啡拿鐵',	'70',	'1',	'1',	'1',	'2022-06-10 13:10:23'),
(163,	'1',	'',	'咖啡拿鐵',	'70',	'1',	'1',	'1',	'2022-06-10 13:40:00');

DROP TABLE IF EXISTS `lastest_news`;
CREATE TABLE `lastest_news` (
  `news_sid` int(11) NOT NULL AUTO_INCREMENT,
  `news_img` varchar(255) NOT NULL,
  `news_title` varchar(255) NOT NULL,
  `news_class_sid` int(11) NOT NULL,
  `news_start_date` date NOT NULL,
  `news_end_date` date NOT NULL,
  `news_content` varchar(255) NOT NULL,
  `news_create_time` datetime NOT NULL,
  `news_status` int(11) NOT NULL,
  PRIMARY KEY (`news_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `lastest_news` (`news_sid`, `news_img`, `news_title`, `news_class_sid`, `news_start_date`, `news_end_date`, `news_content`, `news_create_time`, `news_status`) VALUES
(1,	'123.jpg',	'精選好好喝咖啡豆即日起購買任兩件，第二件即可打七折呦，分享優惠再送濾掛式咖啡一包。',	1,	'2017-08-10',	'2018-08-10',	'快來揪朋友做分享拿好禮喔',	'2022-05-31 11:14:27',	5),
(2,	'123.jpg',	'行動預點專屬 – 週一週二星禮遇',	2,	'2022-01-01',	'2022-06-30',	'一般會員於週一或週二購買輕食即可享8折優惠',	'2022-05-31 11:23:10',	1),
(4,	'Array',	'123',	1,	'2022-06-08',	'2022-06-22',	'233',	'2022-06-08 15:15:55',	0),
(5,	'Array',	'123',	1,	'2022-06-08',	'2022-06-22',	'233',	'2022-06-08 15:16:45',	0),
(7,	'fcff46c1a3b853ca23247d1ecf12b1a7.jpg',	'df',	1,	'2022-06-01',	'2022-06-24',	'123',	'2022-06-08 16:09:18',	0),
(8,	'3ac88f41b776445cac1a48d5724c8aac.jpg',	'123',	1,	'2022-05-31',	'2022-06-06',	'123',	'2022-06-08 16:22:09',	0),
(9,	'fc7cc7f44845b508ca502fd1b13d3c72.jpg',	'fd',	1,	'2022-06-01',	'2022-06-17',	'123',	'2022-06-08 16:39:23',	0),
(10,	'546b3dd7fa855777231606b81cbb19f9.jpg',	'0609 0932',	2,	'2022-06-01',	'2022-06-30',	'1345',	'2022-06-09 09:33:12',	0),
(11,	'f05ce206b9f735a5b0fe3982778f7fb7.jpg',	'0609 0932',	3,	'2022-06-01',	'2022-06-30',	'1345',	'2022-06-09 10:03:17',	0),
(12,	'95d9ed6c4c364113a9b76cebac567f9c.jpg',	'0609 1444',	2,	'2022-06-01',	'2022-06-02',	'1231234534',	'2022-06-09 14:45:01',	0);

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `member_sid` int(11) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_account` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_birthday` date DEFAULT NULL,
  `member_mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'missing-image.jpg',
  PRIMARY KEY (`member_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `member` (`member_sid`, `member_name`, `member_nickname`, `member_account`, `member_password`, `member_birthday`, `member_mobile`, `member_address`, `member_mail`, `member_level`, `avatar`) VALUES
(1,	'王曉明',	'阿明',	'ming',	'ming',	'2022-05-30',	'0911222333',	'台北市大安區',	'ming@test.com',	'800',	'missing-image.jpg'),
(2,	'小黑',	'black',	'black',	'black',	'2022-05-12',	'0912345678',	'新北市',	'black@test.com',	'0',	'1539960.gif'),
(4,	'小白',	'white',	'white',	'white',	'2022-06-08',	'0911123456',	'台北市',	'white@test.com',	'2000',	'missing-image.jpg'),
(7,	'123',	'睡覺了',	'123',	'123',	NULL,	'123',	'123',	'123',	'',	'1539960.gif'),
(14,	'123',	'1234',	'1234',	'1234',	NULL,	'123',	'123',	'123@test123',	'',	'31Xj7BP6MCTmxwUJ972W89EBE1HSoAlRJIcJtZIB.jpg'),
(666,	'子揚',	'Tommy',	'tommy',	'1234',	NULL,	'0975072579',	'台北市',	'sky003428@gmail.com',	'0',	'missing-image.jpg'),
(1001,	'王小明',	'帥氣a小明',	'ming1',	'1234',	NULL,	'0975123456',	'新北市',	'ming1234@gmail.com',	'0',	'missing-image.jpg'),
(1005,	'陳大圓',	'新手大圓',	'yuan',	'1234',	NULL,	'0975123456',	'新北市',	'yuan1234@gmail.com',	'0',	'missing-image.jpg'),
(1041,	'1111',	'1111',	'1111',	'1111',	NULL,	'',	'1111',	'',	'0',	'missing-image.jpg');

DROP TABLE IF EXISTS `member_likes`;
CREATE TABLE `member_likes` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `member_sid` varchar(255) NOT NULL,
  `post_sid` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `member_likes` (`sid`, `member_sid`, `post_sid`) VALUES
(116,	'1001',	2),
(135,	'000666',	2),
(136,	'000666',	1);

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_sid` int(11) NOT NULL AUTO_INCREMENT,
  `menu_categories` varchar(255) NOT NULL,
  `menu_photo` varchar(255) DEFAULT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_kcal` float DEFAULT NULL,
  `menu_price_m` varchar(5) DEFAULT NULL,
  `menu_nutrition` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`menu_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `menu` (`menu_sid`, `menu_categories`, `menu_photo`, `menu_name`, `menu_kcal`, `menu_price_m`, `menu_nutrition`, `created_at`) VALUES
(1,	'經典義式系列',	'',	'咖啡拿鐵',	381.4,	'70',	'咖啡因含量:黃101-200mg/杯',	'2022-06-10 00:00:00'),
(2,	'經典義式系列',	'',	'焦糖瑪奇朵',	275.4,	'80',	'咖啡因含量:黃101-200mg/杯',	'2022-06-11 00:00:00'),
(3,	'經典義式系列',	'',	'卡布奇諾',	260.5,	'70',	'咖啡因含量:黃101-200mg/杯',	'2022-06-12 00:00:00'),
(4,	'經典義式系列',	'',	'美式黑咖啡',	23.4,	'50',	'咖啡因含量:黃101-200mg/杯',	'2022-06-13 00:00:00'),
(5,	'經典義式系列',	'',	'黑糖風味拿鐵',	375.2,	'80',	'咖啡因含量:黃101-200mg/杯',	'2022-06-14 00:00:00'),
(6,	'經典義式系列',	'',	'鴛鴦咖啡',	231.3,	'70',	'咖啡因含量:綠100mg/杯',	'2022-06-15 00:00:00'),
(7,	'經典義式系列',	'',	'香草風味拿鐵',	240.5,	'90',	'咖啡因含量:黃101-200mg/杯',	'2022-06-16 00:00:00'),
(8,	'經典義式系列',	'',	'拿鐵歐蕾',	197.5,	'75',	'咖啡因含量:綠100mg以下/杯',	'2022-06-17 00:00:00'),
(9,	'經典義式系列',	'',	'義式摩卡',	368,	'80',	'咖啡因含量:黃101-200mg/杯',	'2022-06-18 00:00:00'),
(10,	'精品咖啡',	'',	'莊園級美式',	15.5,	'60',	'咖啡因含量:紅201mg/杯',	'2022-06-19 00:00:00'),
(11,	'精品咖啡',	'',	'莊園級拿鐵',	267.7,	'80',	'咖啡因含量:紅201mg/杯',	'2022-06-20 00:00:00'),
(12,	'精品咖啡',	'',	'哥倫比亞',	4,	'95',	'咖啡因含量:黃101-200mg/杯',	'2022-06-21 00:00:00'),
(13,	'精品咖啡',	'',	'曼巴',	4,	'95',	'咖啡因含量:黃101-200mg/杯',	'2022-06-22 00:00:00'),
(14,	'精品咖啡',	'',	'黃金曼特寧',	4,	'95',	'咖啡因含量:黃101-200mg/杯',	'2022-06-23 00:00:00'),
(15,	'精品咖啡',	'',	'肯亞 精選小農',	4,	'95',	'咖啡因含量:黃101-200mg/杯',	'2022-06-24 00:00:00'),
(16,	'精品咖啡',	'',	'莊園老饕深焙',	4,	'95',	'咖啡因含量:黃101-200mg/杯',	'2022-06-25 00:00:00'),
(17,	'精品咖啡',	'',	'耶加雪菲',	4,	'100',	'咖啡因含量:黃101-200mg/杯',	'2022-06-26 00:00:00'),
(18,	'其他飲品',	'',	'義式巧克力',	378,	'60',	'總糖量:64.1公克',	'2022-06-27 00:00:00'),
(19,	'其他飲品',	'',	'愛丁堡女王紅茶',	50,	'40',	'茶葉產地:印度、斯里蘭卡、尼泊爾、台灣、越南',	'2022-06-28 00:00:00'),
(20,	'其他飲品',	'',	'宇治奶茶',	345,	'50',	'茶葉產地:日本京都府',	'2022-06-29 00:00:00');

DROP TABLE IF EXISTS `menu1`;
CREATE TABLE `menu1` (
  `menu_sid` int(11) NOT NULL AUTO_INCREMENT,
  `menu_categories` varchar(255) NOT NULL,
  `menu_photo` varchar(255) DEFAULT NULL,
  `menu_name` varchar(255) NOT NULL,
  `menu_kcal` float DEFAULT NULL,
  `menu_price_m` varchar(5) DEFAULT NULL,
  `menu_price_l` varchar(5) DEFAULT NULL,
  `menu_nutrition` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`menu_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `menu1` (`menu_sid`, `menu_categories`, `menu_photo`, `menu_name`, `menu_kcal`, `menu_price_m`, `menu_price_l`, `menu_nutrition`, `created_at`) VALUES
(1,	'經典義式系列',	NULL,	'咖啡拿鐵 (冰)',	381.4,	'70',	'90',	NULL,	'2022-05-28 00:00:00'),
(3,	'經典義式系列',	NULL,	'卡布奇諾 (冰)',	266.7,	'70',	'90',	NULL,	'2022-05-30 00:00:00'),
(4,	'經典義式系列',	NULL,	'卡布奇諾 (熱)',	260.5,	'70',	'90',	NULL,	'2022-05-31 00:00:00'),
(5,	'經典義式系列',	NULL,	'美式黑咖啡 (冰)',	23.4,	'50',	'65',	NULL,	'2022-06-01 00:00:00'),
(7,	'經典義式系列',	NULL,	'焦糖瑪奇朵 (冰)',	371.3,	'80',	'100',	NULL,	'2022-06-03 00:00:00'),
(8,	'經典義式系列',	NULL,	'焦糖瑪奇朵 (熱)',	275.4,	'80',	'100',	NULL,	'2022-06-04 00:00:00'),
(9,	'經典義式系列',	NULL,	'義式摩卡 (冰)',	368,	'80',	'100',	NULL,	'2022-06-05 00:00:00'),
(10,	'經典義式系列',	NULL,	'義式摩卡 (熱)',	289.6,	'80',	'100',	NULL,	'2022-06-06 00:00:00'),
(11,	'經典義式系列',	NULL,	'黑糖風味拿鐵 (冰)',	375.2,	'80',	'100',	NULL,	'2022-06-07 00:00:00'),
(12,	'經典義式系列',	NULL,	'黑糖風味拿鐵 (熱)',	299,	'80',	'100',	NULL,	'2022-06-08 00:00:00'),
(13,	'精品咖啡',	NULL,	'莊園級美式 (冰)',	15.5,	'60',	'80',	NULL,	'2022-06-09 00:00:00'),
(14,	'精品咖啡',	NULL,	'莊園級美式 (熱)',	15.5,	'60',	'80',	NULL,	'2022-06-10 00:00:00'),
(15,	'精品咖啡',	NULL,	'莊園級拿鐵 (冰)',	267.7,	'80',	'100',	NULL,	'2022-06-11 00:00:00'),
(16,	'精品咖啡',	NULL,	'莊園級拿鐵 (熱)',	214.3,	'80',	'100',	NULL,	'2022-06-12 00:00:00'),
(17,	'精品咖啡',	NULL,	'耶加雪菲 (冰)',	4,	'100',	NULL,	NULL,	'2022-06-13 00:00:00'),
(18,	'精品咖啡',	NULL,	'耶加雪菲 (熱)',	7.2,	'100',	NULL,	NULL,	'2022-06-14 00:00:00'),
(19,	'其他飲品',	NULL,	'愛丁堡女王紅茶',	50,	'40',	NULL,	NULL,	'2022-06-15 00:00:00'),
(20,	'其他飲品',	NULL,	'宇治奶茶',	345,	'50',	NULL,	NULL,	'2022-06-16 00:00:00'),
(21,	'其他飲品',	NULL,	'義式巧克力',	378,	'60',	NULL,	NULL,	'2022-06-17 00:00:00'),
(22,	'其他飲品',	NULL,	'紅翠青檸茶',	187.5,	'50',	NULL,	NULL,	'2022-06-18 00:00:00'),
(23,	'其他飲品',	NULL,	'紅蜜鮮奶茶',	456.2,	'60',	NULL,	NULL,	'2022-06-19 00:00:00'),
(24,	'其他飲品',	NULL,	'水蜜桃蘋果茶',	345.1,	'50',	NULL,	NULL,	'2022-06-20 00:00:00'),
(25,	'貝果',	NULL,	'火腿貝果',	399.6,	'60',	NULL,	NULL,	'2022-06-21 00:00:00'),
(26,	'貝果',	NULL,	'蔬菜貝果',	356.2,	'60',	NULL,	NULL,	'2022-06-22 00:00:00'),
(27,	'貝果',	NULL,	'鮪魚貝果',	422.6,	'60',	NULL,	NULL,	'2022-06-23 00:00:00'),
(28,	'貝果',	NULL,	'牛肉貝果',	400.3,	'70',	NULL,	NULL,	'2022-06-24 00:00:00'),
(29,	'瑪芬堡',	NULL,	'豬肉起司瑪芬堡',	358.7,	'55',	NULL,	NULL,	'2022-06-25 00:00:00'),
(30,	'瑪芬堡',	NULL,	'豬肉瑪芬堡',	400,	'55',	NULL,	NULL,	'2022-06-26 00:00:00'),
(31,	'瑪芬堡',	NULL,	'雙層豬肉瑪芬堡',	516.9,	'75',	NULL,	NULL,	'2022-06-27 00:00:00'),
(33,	'三明治',	NULL,	'火腿三明治',	312.7,	'45',	NULL,	NULL,	'2022-06-29 00:00:00'),
(36,	'口袋歐姆蛋',	NULL,	'起司歐姆蛋',	270,	'50',	NULL,	NULL,	'2022-07-02 00:00:00'),
(37,	'口袋歐姆蛋',	NULL,	'培根歐姆蛋',	295.2,	'60',	NULL,	NULL,	'2022-07-03 00:00:00'),
(38,	'口袋歐姆蛋',	NULL,	'鮪魚歐姆蛋',	296.9,	'60',	NULL,	NULL,	'2022-07-04 00:00:00'),
(39,	'口袋歐姆蛋',	NULL,	'蔬菜歐姆蛋',	260.5,	'60',	NULL,	NULL,	'2022-07-05 00:00:00'),
(53,	'經典義式系列3',	NULL,	'咖啡拿鐵 (冰)',	381.4,	'70',	'90',	NULL,	'2022-05-28 20:48:19'),
(54,	'咖啡',	NULL,	'義式拿鐵',	183,	'0',	'120',	'09605',	'2022-05-28 20:48:54'),
(55,	'咖啡',	NULL,	'義式咖啡',	122,	'1',	'120',	'09426',	'2022-05-28 20:48:54'),
(56,	'咖啡',	NULL,	'義式拿鐵',	129,	'2',	'120',	'09857',	'2022-05-28 20:48:54'),
(57,	'咖啡',	NULL,	'美式拿鐵',	166,	'3',	'120',	'09600',	'2022-05-28 20:48:54'),
(58,	'咖啡',	NULL,	'義式拿鐵',	127,	'4',	'120',	'09475',	'2022-05-28 20:48:54'),
(59,	'咖啡',	NULL,	'美式拿鐵',	194,	'5',	'120',	'09992',	'2022-05-28 20:48:54'),
(60,	'咖啡',	NULL,	'美式咖啡',	173,	'6',	'120',	'09506',	'2022-05-28 20:48:54'),
(61,	'咖啡',	NULL,	'義式拿鐵',	165,	'7',	'120',	'09553',	'2022-05-28 20:48:54'),
(62,	'咖啡',	NULL,	'精品拿鐵',	174,	'8',	'120',	'09910',	'2022-05-28 20:48:54'),
(63,	'咖啡',	NULL,	'義式咖啡',	175,	'9',	'120',	'09663',	'2022-05-28 20:48:54'),
(65,	'哈哈哈哈哈哈',	'哈哈哈哈哈哈',	'哈哈哈哈哈哈',	77,	'111',	'1111',	'1111',	'2022-05-29 02:56:09'),
(66,	'哈哈哈哈哈哈',	'哈哈哈哈哈哈',	'哈哈哈哈哈哈',	77,	'111',	'1111',	'1111',	'2022-05-29 02:57:31'),
(67,	'經典義式系列',	'1111',	'咖啡拿鐵 (冰)',	381.4,	'70',	'90',	'11111',	'2022-05-30 01:31:53'),
(69,	'2',	NULL,	'14324',	4342,	'4324',	'4234',	'42342',	'2022-05-31 20:43:31'),
(70,	'2',	NULL,	'14324',	4342,	'4324',	'4234',	'42342',	'2022-05-31 20:45:32'),
(71,	'其他飲品',	NULL,	'3423',	4324,	'4234',	'432',	'342',	'2022-05-31 20:45:53'),
(72,	'精品咖啡',	NULL,	'tttt',	543534,	'54353',	'5345',	'5435',	'2022-05-31 23:47:36'),
(73,	'其他飲品',	NULL,	'哈哈哈哈哈哈',	4324,	'42342',	'43242',	'4324324',	'2022-06-01 00:08:25'),
(74,	'貝果',	NULL,	'34324',	324,	'324',	'4234',	'43242',	'2022-06-01 00:43:17'),
(75,	'其他飲品',	NULL,	'43423',	6765,	'6576',	'76575',	'7567',	'2022-06-01 09:20:57'),
(76,	'其他飲品',	NULL,	'43423',	6765,	'6576',	'76575',	'7567',	'2022-06-01 09:20:59'),
(77,	'其他飲品',	NULL,	'43423',	6765,	'6576',	'76575',	'7567',	'2022-06-01 09:21:01'),
(78,	'其他飲品',	NULL,	'43423',	6765,	'6576',	'76575',	'7567',	'2022-06-01 09:21:27'),
(79,	'其他飲品',	NULL,	'43423',	6765,	'6576',	'76575',	'7567',	'2022-06-01 09:21:42'),
(80,	'貝果',	NULL,	'4534',	5435,	'5435',	'54353',	'4353',	'2022-06-01 09:22:39'),
(81,	'貝果',	NULL,	'4534',	5435,	'5435',	'54353',	'4353',	'2022-06-01 09:23:14'),
(82,	'精品咖啡',	'',	't544234',	3423,	'43242',	'43243',	'43242',	'2022-06-01 10:28:25');

DROP TABLE IF EXISTS `news_class`;
CREATE TABLE `news_class` (
  `class_sid` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `news_class` (`class_sid`, `class_name`) VALUES
(1,	'商品'),
(2,	'美食'),
(3,	'課程');

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_sid` int(11) NOT NULL AUTO_INCREMENT,
  `order_time` datetime NOT NULL,
  `order_pay` char(255) CHARACTER SET utf8mb4 NOT NULL,
  `order_pay_info` char(255) CHARACTER SET utf8mb4 DEFAULT NULL,
  `order_deliver` char(255) CHARACTER SET utf8mb4 NOT NULL,
  `order_address` char(255) CHARACTER SET utf8mb4 NOT NULL,
  `order_member_id` int(11) NOT NULL,
  `order_coupon_id` int(11) DEFAULT NULL,
  `order_price` int(11) NOT NULL,
  `order_id` char(255) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`order_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `order` (`order_sid`, `order_time`, `order_pay`, `order_pay_info`, `order_deliver`, `order_address`, `order_member_id`, `order_coupon_id`, `order_price`, `order_id`) VALUES
(1,	'2022-05-31 14:29:48',	'店內取貨付款',	'店內取貨付款',	'店內取貨',	'本店',	1,	2,	1160,	'531142948'),
(2,	'2022-05-31 14:50:43',	'ATM轉帳',	'700-24416794519754',	'郵寄',	'655 雲林縣元長鄉子茂33號',	3,	7,	872,	'531145043'),
(20,	'2022-06-08 13:14:45',	'ATM轉帳',	'700-561356135614',	'郵寄',	'932 屏東縣新園鄉仙鯉路19號',	1,	3,	412,	'1654665285');

DROP TABLE IF EXISTS `points_record`;
CREATE TABLE `points_record` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `member_sid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `points_get` int(255) DEFAULT NULL,
  `create_at` date NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `points_record` (`sid`, `member_sid`, `type`, `points_get`, `create_at`) VALUES
(1,	1,	1,	10,	'2022-06-02'),
(2,	2,	2,	-300,	'2022-06-03'),
(3,	1,	1,	300,	'2022-06-06');

DROP TABLE IF EXISTS `points_user`;
CREATE TABLE `points_user` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `member_sid` int(11) NOT NULL,
  `total_points` int(255) DEFAULT NULL,
  `voucher_amount` int(11) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `points_user` (`sid`, `member_sid`, `total_points`, `voucher_amount`) VALUES
(1,	1,	200,	1),
(2,	2,	340,	2),
(3,	3,	700,	5),
(4,	4,	1200,	3),
(5,	5,	0,	0);

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `member_nickname` varchar(255) NOT NULL,
  `member_sid` int(11) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0,
  `comments` int(11) NOT NULL DEFAULT 0,
  `topic_sid` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `delete_state` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `post` (`sid`, `title`, `content`, `member_nickname`, `member_sid`, `likes`, `comments`, `topic_sid`, `created_at`, `updated_at`, `delete_state`) VALUES
(1,	'體驗拉花課程分享',	'每次看到咖啡師的拉花作品，再看看咖啡師拉花的動作看似簡單，胃痛一直很想要體驗拉花，想不到自己實際操作一遍，操作起來還真的不簡單啊。',	'帥氣a小明',	1001,	3,	2,	1,	'2022-05-31 04:35:39',	'2022-06-10 10:05:20',	0),
(2,	'好喝環境',	'深入的探討咖啡，是釐清一切的關鍵。咖啡，到底應該如何實現。若無法徹底理解咖啡，恐怕會是人類的一大遺憾。儘管如此，我們仍然需要對咖啡保持懷疑的態度。徐志摩在不經意間這樣說過，由於我們過於習慣在別人面前戴面具，因此最後導致在自己面前偽裝自己。強烈建議大家把這段話牢牢記住。\r\n    ',	'小明',	1011,	1,	0,	1,	'2022-01-25 07:01:45',	NULL,	0),
(3,	'超讚體驗咖啡課程',	'車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。',	'小美',	1410,	3,	0,	1,	'2022-05-05 07:05:40',	NULL,	0),
(4,	'超讚體驗馬克杯',	' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。',	'小明',	1011,	4,	0,	1,	'2022-05-30 01:05:12',	NULL,	0),
(5,	'好玩的咖啡課程',	'儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。',	'bill',	1978,	5,	0,	2,	'2022-01-31 11:01:25',	NULL,	0),
(6,	'超讚體驗咖啡課程',	' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。',	'小明',	1011,	3,	0,	2,	'2022-04-28 10:04:03',	NULL,	0),
(7,	'好喝拉花課程',	' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。',	'阿肥',	1812,	3,	0,	2,	'2022-05-27 12:05:07',	NULL,	0),
(8,	'新奇的咖啡課程',	'儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。',	'小明',	1011,	0,	0,	1,	'2022-04-19 05:04:12',	NULL,	0),
(9,	'有趣的拉花課程',	' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。',	'小明',	1011,	2,	0,	1,	'2022-02-12 11:02:00',	NULL,	0),
(10,	'好玩的拉花課程',	'車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。',	'小明',	1011,	4,	0,	3,	'2022-04-20 06:04:12',	NULL,	0),
(11,	'超讚體驗馬克杯',	' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。',	'jack',	1503,	4,	0,	3,	'2022-05-28 07:05:50',	NULL,	0),
(12,	'有趣的咖啡課程',	'儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。',	'大胖',	1842,	0,	0,	3,	'2022-02-24 10:02:52',	NULL,	0),
(13,	'好喝馬克杯',	'車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。',	'小明',	1011,	3,	0,	2,	'2022-03-04 11:03:01',	NULL,	1),
(14,	'爛芭樂',	'這間店有夠爛',	'小肥豬',	1995,	0,	0,	3,	'2022-03-04 11:03:01',	NULL,	0),
(15,	'爛爛芭樂',	'這間店有夠爛',	'小肥豬',	1995,	0,	0,	3,	'2022-03-04 11:03:01',	NULL,	1),
(16,	'爛爛爛芭樂',	'這間店有夠爛!!',	'小肥豬',	1995,	0,	0,	3,	'2022-03-04 11:03:01',	NULL,	1),
(17,	'爛爛爛芭樂',	'這間店有夠爛!!!',	'小肥豬',	1995,	0,	0,	3,	'2022-03-04 11:03:01',	NULL,	0),
(18,	'好玩的咖啡課',	' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。',	'Lebron James',	1357,	4,	0,	2,	'2022-03-15 09:03:20',	NULL,	0),
(19,	'超讚體驗馬克杯',	'深入的探討咖啡，是釐清一切的關鍵。咖啡，到底應該如何實現。若無法徹底理解咖啡，恐怕會是人類的一大遺憾。儘管如此，我們仍然需要對咖啡保持懷疑的態度。徐志摩在不經意間這樣說過，由於我們過於習慣在別人面前戴面具，因此最後導致在自己面前偽裝自己。強烈建議大家把這段話牢牢記住。\r\n    ',	'Hank',	1455,	2,	0,	3,	'2022-03-01 11:03:37',	NULL,	1),
(20,	'超讚體驗拉花課程',	'車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。',	'Hank',	1992,	2,	0,	1,	'2022-05-25 06:05:21',	NULL,	0),
(21,	'超讚體驗環境',	' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。',	'Allan',	1930,	1,	0,	1,	'2022-03-05 11:03:18',	NULL,	1),
(22,	'好玩的馬克杯',	'儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。',	'Hank',	1336,	4,	0,	3,	'2022-02-21 07:02:27',	NULL,	0),
(23,	'超讚體驗環境',	'儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。',	'大胖',	1312,	5,	0,	3,	'2022-02-06 11:02:51',	NULL,	0),
(24,	'有趣的拉花課程',	'儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。',	'阿肥',	1209,	0,	0,	3,	'2022-04-25 08:04:09',	NULL,	0),
(25,	'新奇的咖啡課',	'深入的探討咖啡，是釐清一切的關鍵。咖啡，到底應該如何實現。若無法徹底理解咖啡，恐怕會是人類的一大遺憾。儘管如此，我們仍然需要對咖啡保持懷疑的態度。徐志摩在不經意間這樣說過，由於我們過於習慣在別人面前戴面具，因此最後導致在自己面前偽裝自己。強烈建議大家把這段話牢牢記住。\r\n    ',	'Jefffff',	1069,	0,	0,	2,	'2022-05-07 06:05:49',	NULL,	0),
(26,	'好喝馬克杯',	'儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。',	'Allan',	1286,	4,	0,	2,	'2022-05-06 03:05:07',	NULL,	0),
(27,	'超讚體驗環境',	'儘管如此，別人往往卻不這麼想。我想，把商品的意義想清楚，對各位來說並不是一件壞事。我們要從本質思考，從根本解決問題。傅雷說過一句發人省思的話，人一輩子都在高潮——低潮中浮沉，唯有庸碌的人，生活才如死水一般。這段話看似複雜，其中的邏輯思路卻清晰可見。',	'Hank',	1768,	5,	0,	1,	'2022-01-16 03:01:12',	NULL,	0),
(28,	'有趣的咖啡課',	'深入的探討咖啡，是釐清一切的關鍵。咖啡，到底應該如何實現。若無法徹底理解咖啡，恐怕會是人類的一大遺憾。儘管如此，我們仍然需要對咖啡保持懷疑的態度。徐志摩在不經意間這樣說過，由於我們過於習慣在別人面前戴面具，因此最後導致在自己面前偽裝自己。強烈建議大家把這段話牢牢記住。\r\n    ',	'阿肥',	1018,	1,	0,	2,	'2022-05-18 09:05:30',	NULL,	0),
(29,	'新奇的拉花課程',	'車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。',	'Lebron James',	1216,	0,	0,	3,	'2022-04-18 08:04:58',	NULL,	1),
(30,	'有趣的環境',	'車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。',	'Hank',	1408,	5,	0,	2,	'2022-03-08 03:03:08',	NULL,	0),
(31,	'超讚體驗拉花課程',	'車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。',	'Allan',	1362,	3,	0,	1,	'2022-05-23 05:05:06',	NULL,	1),
(32,	'好玩的馬克杯',	'車爾尼雪夫斯基在不經意間這樣說過，一個沒有受到獻身的熱情所鼓舞的人，永遠不會做出什麼偉大的事情來。這是撼動人心的。烏納穆諾曾經認為，在科學裡，嘲笑腐儒，也就類似宗。這似乎解答了我的疑惑。那麼，廢文絕對是史無前例的。',	'阿肥',	1207,	3,	0,	2,	'2022-05-19 02:05:03',	NULL,	0),
(33,	'好喝馬克杯',	' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。',	'大胖',	1340,	1,	0,	1,	'2022-02-18 10:02:10',	NULL,	1),
(34,	'好喝環境',	' 這必定是個前衛大膽的想法。拉花課程勢必能夠左右未來。面對如此難題，我們必須設想周全。問題的核心究竟是什麼？在人類的歷史中，我們總是盡了一切努力想搞懂拉花課程。而這些並不是完全重要，更加重要的問題是，拉花課程，發生了會如何，不發生又會如何。',	'Allan',	1655,	2,	0,	2,	'2022-05-08 10:05:41',	NULL,	1),
(35,	'爛芭樂',	'好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛',	'小豬頭',	1981,	1,	0,	2,	'2022-04-22 08:04:56',	NULL,	0),
(36,	'爛芭樂大芭樂',	'嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿',	'來亂的',	1982,	1,	0,	3,	'2022-04-07 10:04:47',	NULL,	1),
(37,	'爛芭樂芭樂',	'好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛',	'小豬頭',	1984,	0,	0,	1,	'2022-04-07 01:04:15',	NULL,	0),
(38,	'爛爛大香蕉',	'好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛',	'大豬頭',	1986,	1,	0,	1,	'2022-05-12 03:05:45',	NULL,	1),
(39,	'爛爛大香蕉',	'嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿',	'小豬頭',	1985,	1,	0,	2,	'2022-05-28 12:05:29',	NULL,	0),
(40,	'爛香蕉',	'嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿',	'大豬頭',	1983,	1,	0,	1,	'2022-01-10 01:01:40',	NULL,	0),
(41,	'爛爛芭樂',	'嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿',	'小豬頭',	1987,	0,	0,	2,	'2022-03-19 05:03:11',	NULL,	0),
(42,	'爛香蕉',	'好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛好爛',	'大豬頭',	1984,	0,	0,	2,	'2022-01-10 11:01:23',	NULL,	0),
(43,	'爛大芭樂',	'嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿',	'大豬頭',	1988,	0,	0,	1,	'2022-05-05 03:05:17',	NULL,	0),
(44,	'爛爛大香蕉',	'嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿嘿',	'來亂的',	1983,	0,	0,	3,	'2022-03-02 04:03:45',	NULL,	0),
(45,	'hello',	'你好嗎',	'tommy',	666,	0,	0,	1,	'2022-06-02 04:54:49',	NULL,	0),
(46,	'hello',	'我是羊羊',	'Tommy',	666,	0,	0,	1,	'2022-06-02 10:56:29',	NULL,	0),
(47,	'12',	'123',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:02:49',	NULL,	0),
(48,	'543',	'543',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:04:03',	NULL,	1),
(49,	'123',	'453',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:05:37',	NULL,	0),
(50,	'1434',	'5753',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:42:15',	NULL,	0),
(51,	'1434',	'5753',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:53:58',	NULL,	0),
(52,	'1434',	'5753',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:54:28',	NULL,	0),
(53,	'453',	'73',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:55:26',	NULL,	0),
(54,	'453',	'73',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:55:32',	NULL,	0),
(55,	'453',	'73',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:55:42',	NULL,	0),
(56,	'1322',	'1245',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:56:24',	NULL,	0),
(57,	'1322',	'1245',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:56:45',	NULL,	0),
(58,	'1322',	'1245',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:56:57',	NULL,	0),
(59,	'1322',	'1245',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:57:40',	NULL,	0),
(60,	'1322',	'1245',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:58:58',	NULL,	0),
(61,	'1322',	'1245',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:58:59',	NULL,	0),
(62,	'1322',	'1245',	'Tommy',	666,	0,	0,	1,	'2022-06-02 11:59:16',	NULL,	0),
(63,	'1322',	'1245',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:00:46',	NULL,	0),
(64,	'1322',	'1245',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:00:47',	NULL,	0),
(65,	'1322',	'1245',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:00:56',	NULL,	0),
(66,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:01:02',	NULL,	0),
(67,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:03:40',	NULL,	0),
(68,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:04:38',	NULL,	0),
(69,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:04:40',	NULL,	0),
(70,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:04:53',	NULL,	0),
(71,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:05:33',	NULL,	0),
(72,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:05:34',	NULL,	0),
(73,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:10:22',	NULL,	0),
(74,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:10:41',	NULL,	0),
(75,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:10:52',	NULL,	0),
(76,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:11:38',	NULL,	0),
(77,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:12:02',	NULL,	0),
(78,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:12:36',	NULL,	0),
(79,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:12:48',	NULL,	0),
(80,	'4274',	'7272',	'Tommy',	666,	0,	0,	1,	'2022-06-02 12:13:34',	NULL,	0),
(133,	'123',	'123',	'帥氣a小明',	1001,	0,	0,	1,	'2022-06-09 10:16:33',	NULL,	0),
(134,	'123',	'123',	'帥氣a小明',	1001,	0,	0,	1,	'2022-06-09 10:16:52',	NULL,	0),
(135,	'123',	'453',	'帥氣a小明',	1001,	0,	0,	3,	'2022-06-09 10:21:12',	NULL,	0);

DROP TABLE IF EXISTS `post_img`;
CREATE TABLE `post_img` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(255) NOT NULL,
  `post_sid` int(11) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `post_img` (`sid`, `img_name`, `post_sid`, `sort`) VALUES
(0,	'default_pic.jpg',	0,	1),
(1,	'dog.jpg',	1,	1),
(2,	'cat.jpg',	1,	2),
(3,	'default_pic.jpg',	2,	1),
(4,	'default_pic.jpg',	3,	1),
(5,	'default_pic.jpg',	4,	1),
(6,	'default_pic.jpg',	5,	1),
(7,	'default_pic.jpg',	6,	1),
(8,	'default_pic.jpg',	7,	1),
(9,	'default_pic.jpg',	8,	1),
(10,	'default_pic.jpg',	9,	1),
(11,	'default_pic.jpg',	10,	1),
(12,	'default_pic.jpg',	11,	1),
(13,	'default_pic.jpg',	12,	1),
(14,	'default_pic.jpg',	13,	1),
(15,	'default_pic.jpg',	14,	1),
(16,	'default_pic.jpg',	15,	1),
(17,	'default_pic.jpg',	16,	1),
(18,	'default_pic.jpg',	17,	1),
(19,	'default_pic.jpg',	18,	1),
(20,	'default_pic.jpg',	19,	1),
(21,	'default_pic.jpg',	20,	1),
(22,	'default_pic.jpg',	21,	1),
(23,	'default_pic.jpg',	22,	1),
(24,	'default_pic.jpg',	23,	1),
(25,	'default_pic.jpg',	24,	1),
(26,	'default_pic.jpg',	25,	1),
(27,	'default_pic.jpg',	26,	1),
(28,	'default_pic.jpg',	27,	1),
(29,	'default_pic.jpg',	28,	1),
(30,	'default_pic.jpg',	29,	1),
(31,	'default_pic.jpg',	30,	1),
(32,	'default_pic.jpg',	31,	1),
(33,	'default_pic.jpg',	32,	1),
(34,	'default_pic.jpg',	33,	1),
(35,	'default_pic.jpg',	34,	1),
(36,	'default_pic.jpg',	35,	1),
(37,	'default_pic.jpg',	36,	1),
(38,	'default_pic.jpg',	37,	1),
(39,	'default_pic.jpg',	38,	1),
(40,	'default_pic.jpg',	39,	1),
(41,	'default_pic.jpg',	40,	1),
(42,	'default_pic.jpg',	41,	1),
(43,	'default_pic.jpg',	42,	1),
(44,	'default_pic.jpg',	43,	1),
(45,	'default_pic.jpg',	44,	1),
(46,	'default_pic.jpg',	45,	1),
(47,	'default_pic.jpg',	46,	1),
(48,	'default_pic.jpg',	47,	1),
(49,	'default_pic.jpg',	48,	1),
(50,	'default_pic.jpg',	49,	1),
(51,	'default_pic.jpg',	50,	1),
(52,	'default_pic.jpg',	51,	1),
(53,	'default_pic.jpg',	52,	1),
(54,	'default_pic.jpg',	53,	1),
(55,	'default_pic.jpg',	54,	1),
(56,	'default_pic.jpg',	55,	1),
(57,	'default_pic.jpg',	56,	1),
(58,	'default_pic.jpg',	57,	1),
(59,	'default_pic.jpg',	58,	1),
(60,	'default_pic.jpg',	59,	1),
(61,	'default_pic.jpg',	60,	1),
(62,	'default_pic.jpg',	61,	1),
(63,	'default_pic.jpg',	62,	1),
(64,	'default_pic.jpg',	63,	1),
(65,	'default_pic.jpg',	64,	1),
(66,	'default_pic.jpg',	65,	1),
(67,	'default_pic.jpg',	66,	1),
(68,	'default_pic.jpg',	67,	1),
(69,	'default_pic.jpg',	68,	1),
(70,	'default_pic.jpg',	69,	1),
(71,	'default_pic.jpg',	70,	1),
(72,	'default_pic.jpg',	71,	1),
(73,	'default_pic.jpg',	72,	1),
(74,	'default_pic.jpg',	73,	1),
(75,	'default_pic.jpg',	74,	1),
(76,	'default_pic.jpg',	75,	1),
(77,	'default_pic.jpg',	76,	1),
(78,	'default_pic.jpg',	77,	1),
(79,	'default_pic.jpg',	78,	1),
(80,	'default_pic.jpg',	79,	1),
(81,	'default_pic.jpg',	80,	1),
(677,	'20220609_04_a5540f.jpg',	133,	1),
(678,	'20220609_04_a5540f.jpg',	134,	1),
(679,	'20220609_04_d9094e.jpg',	135,	1),
(695,	'20220609_08_51bbaf.jpg',	136,	1);

DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE `post_tag` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `post_sid` int(11) NOT NULL,
  `tag_sid` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `post_tag` (`sid`, `post_sid`, `tag_sid`) VALUES
(1,	1,	2),
(2,	1,	3),
(3,	1,	4),
(5,	133,	2),
(6,	134,	2),
(7,	136,	2),
(8,	136,	4);

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `products_sid` int(11) NOT NULL AUTO_INCREMENT,
  `products_number` varchar(255) DEFAULT 'UNIX_TIMESTAMP()',
  `products_name` varchar(255) NOT NULL,
  `products_introduction` varchar(255) DEFAULT NULL,
  `products_detail_introduction` varchar(511) DEFAULT NULL,
  `products_price` int(11) DEFAULT NULL,
  `products_forsale` int(11) DEFAULT NULL,
  `products_onsale` int(11) DEFAULT NULL,
  `products_stocks` int(11) DEFAULT NULL,
  `products_with_products_categroies_sid` int(11) DEFAULT NULL,
  `products_with_products_style_filter_sid` int(11) DEFAULT NULL,
  PRIMARY KEY (`products_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products` (`products_sid`, `products_number`, `products_name`, `products_introduction`, `products_detail_introduction`, `products_price`, `products_forsale`, `products_onsale`, `products_stocks`, `products_with_products_categroies_sid`, `products_with_products_style_filter_sid`) VALUES
(1,	'1653962198',	'曼巴咖啡(一包十入)',	'精選曼巴咖啡, 一包十入',	'溫順的曼巴，散發出自然甘甜氣味，集清爽與強勁香醇於一體。',	320,	0,	0,	3300,	0,	0),
(2,	'1653962417',	'曼特寧咖啡(一包十入)',	'精選曼特寧咖啡, 一包十入',	'香濃甘苦的滋味，不帶酸味順口香醇。',	320,	1,	0,	3400,	2,	2),
(3,	'1653969575',	'黃金曼特寧(半磅)',	'曼特寧咖啡豆, 半磅包裝',	'曼特寧咖啡豆',	470,	1,	0,	4100,	2,	2),
(4,	'1653972891',	'濾紙(大)',	'大片綠紙, 一包100張',	'簡易方便, 100%天然紙漿製成, 保留咖啡原味',	150,	0,	0,	4400,	4,	4),
(5,	'1653972907',	'濾紙(小)',	'小片綠紙, 一包100張',	'簡易方便, 100%天然紙漿製成, 保留咖啡原味',	150,	1,	0,	4400,	4,	4),
(6,	'1654050346',	'巴西咖啡',	'巴西咖啡',	'巴西咖啡',	320,	1,	0,	3300,	3,	2),
(7,	'1654050441',	'巴西咖啡2',	'巴西咖啡2',	'巴西咖啡2',	320,	1,	0,	3300,	3,	2),
(8,	'1654050701',	'巴西咖啡(一包十入)5',	'精選巴西咖啡5',	'11',	320,	1,	0,	2600,	2,	2),
(9,	'1654589950',	'AA咖啡(一包十入)',	'精緻AA咖啡',	'精緻AA咖啡',	320,	1,	0,	5500,	2,	2),
(10,	'1654590367',	'BB咖啡(一包十入)',	'精緻BB咖啡',	'精緻BB咖啡',	120,	1,	0,	300,	2,	2),
(11,	'1654757377',	'CC咖啡(一包十入)',	'精緻CC咖啡',	'精緻CC咖啡',	320,	1,	0,	3300,	2,	1);

DROP TABLE IF EXISTS `products_categroies`;
CREATE TABLE `products_categroies` (
  `products_categroies_sid` int(11) NOT NULL AUTO_INCREMENT,
  `products_categroies_name` varchar(255) NOT NULL,
  PRIMARY KEY (`products_categroies_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products_categroies` (`products_categroies_sid`, `products_categroies_name`) VALUES
(1,	'未確定分類'),
(2,	'濾掛式咖啡'),
(3,	'咖啡豆'),
(4,	'咖啡周邊器具'),
(5,	'禮盒'),
(6,	'電子禮物卡');

DROP TABLE IF EXISTS `products_pic`;
CREATE TABLE `products_pic` (
  `products_pic_sid` int(11) NOT NULL AUTO_INCREMENT,
  `products_pic_one` varchar(255) DEFAULT NULL,
  `products_pic_multi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`products_pic_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products_pic` (`products_pic_sid`, `products_pic_one`, `products_pic_multi`) VALUES
(1,	'',	''),
(2,	'bag-coffee2.jpg',	'bag-coffee.jpg,bag-coffee2.jpg,black-g0ea50eca3_1280.png'),
(3,	'manba_bean.jfif',	'caffeine-gf6a927184_1920.jpg,cappuccino-g6d10d7112_1920.jpg,coffee-g3b12ecac6_1920.jpg'),
(4,	'filter.jpg',	'filter.jpg,filter2.jpg,filter3.jpg'),
(5,	'filter.jpg',	'coffee-g44d7e5c82_1920.jpg,filter2.jpg,filter3.jpg'),
(6,	'bag-coffee.jpg',	'bag-coffee2.jpg,coffee-g8ca4ec8b4_1920.jpg,coffee-g138b683d2_1920.jpg'),
(7,	'bag-coffee.jpg',	'bag-coffee2.jpg,coffee-g8ca4ec8b4_1920.jpg,coffee-g94f7ab5a8_1920.jpg'),
(8,	'manba_bean.jfif',	'black-g0ea50eca3_1280.png,coffee-gb0b4b4db0_1920.jpg,drip-bag.jpg'),
(9,	'manba_bean.jfif',	'coffee-g75832e31d_1920.jpg,coffee-gede84c1ac_1280.png,drip-bag.jpg'),
(10,	'manba_bean.jfif',	'coffee-gede84c1ac_1280.png,drip-bag.jpg,fresh-g771eed6be_1920.jpg'),
(11,	'bread-g643eb7d6e_1920.jpg',	'bag-coffee2.jpg,black-g0ea50eca3_1280.png,bread-g89f67674b_1920.jpg');

DROP TABLE IF EXISTS `products_style_filter`;
CREATE TABLE `products_style_filter` (
  `products_style_filter_sid` int(11) NOT NULL AUTO_INCREMENT,
  `products_style_filter_categroies` varchar(255) NOT NULL,
  PRIMARY KEY (`products_style_filter_sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `products_style_filter` (`products_style_filter_sid`, `products_style_filter_categroies`) VALUES
(1,	'偏酸'),
(2,	'偏苦'),
(3,	'器材'),
(4,	'耗材'),
(5,	'咖啡禮盒'),
(6,	'食品禮盒'),
(7,	'電子卡');

DROP TABLE IF EXISTS `reply`;
CREATE TABLE `reply` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `comment_sid` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `member_sid` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `reply` (`sid`, `content`, `comment_sid`, `created_at`, `member_sid`) VALUES
(1,	'這邊的老師都很會教，別擔心',	1,	'2022-06-04',	1001),
(2,	'那是肯定阿!',	2,	'2022-06-04',	1001),
(3,	'讚讚',	0,	'2022-06-05',	1001),
(4,	'讚讚',	0,	'2022-06-05',	1001),
(5,	'7373',	0,	'2022-06-05',	1001),
(6,	'7373',	1,	'2022-06-05',	1001);

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `score` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `likes` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `uploaded_at` date DEFAULT NULL,
  `member_sid` int(11) NOT NULL,
  `member_nickname` varchar(255) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `review_likes`;
CREATE TABLE `review_likes` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `review_sid` int(11) NOT NULL,
  `member_sid` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `times` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tag` (`sid`, `name`, `times`) VALUES
(1,	'拿鐵',	0),
(2,	'拉花',	7),
(3,	'好有趣阿',	1),
(4,	'拉花好好玩',	1),
(5,	'拉',	2),
(6,	'拉aa',	5),
(8,	'123',	2);

-- 2022-06-10 06:55:19