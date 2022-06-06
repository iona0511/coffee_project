<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

$sid = isset($_GET['member_sid']) ? intval($_GET['member_sid']) : 0;
if (!empty($sid)) {                                          
    $pdo->query("DELETE FROM `member` WHERE `member_sid`=$sid");
}

$come_from = 'user_list.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}
header("Location: $come_from");


