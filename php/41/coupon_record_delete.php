<?php
require dirname(__DIR__, 2) . '/parts/connect_db.php';
// session_start();

if (!isset($_SESSION['user']['admin_account'])) {
    header('Location:/coffee_project/php/09/admin-login.html');
    exit;
}
$pageName = 'coupon_record_delete';
$title = '優惠券刪除';
// ===============================
$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (!empty($sid)) {
    $pdo->query("DELETE FROM `coupon` WHERE sid=$sid");
}
$come_from = 'coupon_record_list.php';  

if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}  //REFERER 會帶參數 page=5 回到第五頁
//如果不是空的，就把他設定進來，如果是空的，回到ab-list.php首頁

header("Location: $come_from");