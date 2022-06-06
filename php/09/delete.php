<?php require __DIR__ . '/parts/connect_db.php';

$sid = isset($_GET['member_sid']) ? intval($_GET['member_sid']) : 0;
if (!empty($sid)) { 
    // echo 'abc';
    // echo $sid ;                                           
    $pdo->query("DELETE FROM `member` WHERE `member_sid`=$sid");
}
// echo $sid ;

$come_from = 'user_list.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}
header("Location: $come_from");


