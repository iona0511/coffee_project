-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-03 21:26:26
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
  `member_adress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(122, '783', '4353 asd<br/>3273 16<br/>abc<br/><br/>abba', 'Tommy', 666, 0, 0, 1, '2022-06-04 03:24:19', NULL, 0);

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
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`sid`);

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
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment`
--
ALTER TABLE `comment`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `member_sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_likes`
--
ALTER TABLE `member_likes`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post`
--
ALTER TABLE `post`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

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
