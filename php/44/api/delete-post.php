<?php 
require  dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';


$sid = isset($_GET['sid']) ? intval($_GET['sid']) : '0';

if (!empty($sid)) {
    $pdo->query("UPDATE `post` SET `delete_state` = '1' WHERE `post`.`sid` = $sid");
}

if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_form = $_SERVER['HTTP_REFERER'];
}

echo json_encode($sid."刪除成功",JSON_UNESCAPED_UNICODE);
header("Location:$come_form");
