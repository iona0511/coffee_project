-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-12 19:43:11
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

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`sid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `post`
--
ALTER TABLE `post`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
