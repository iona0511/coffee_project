<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

// 判斷如果有設定的話就會轉換成整數，如果沒有的話給預設值為0
// isset() 函数用于判斷變數是否已被設定並且非 NULL。
$news_sid = isset($_GET['news_sid']) ? intval($_GET['news_sid']) : 0;

//如果sid不是空字串或者是0才會$pdo->query(執行sql語法)
if (! empty($news_sid)) {
    $pdo->query("DELETE FROM `lastest_news` WHERE news_sid = $news_sid");
}


$come_from = 'lastest-news.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}

header("Location: $come_from");

