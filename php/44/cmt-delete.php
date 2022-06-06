<?php require __DIR__ . '/part/connect_db.php';


$sid = isset($_GET['cid']) ? intval($_GET['cid']) : '0';
if (!empty($sid)) {
    $pdo->query("DELETE FROM comment WHERE `comment`.`sid` = $sid");
}

if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_form = $_SERVER['HTTP_REFERER'];
}

echo json_encode($sid."刪除成功",JSON_UNESCAPED_UNICODE);
header("Location:$come_form");
