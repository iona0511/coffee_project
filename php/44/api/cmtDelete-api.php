<?php require __DIR__ . '/part/connect_db.php';

$sid = isset($_GET['cid']) ? intval($_GET['cid']) : '0';

if (!empty($sid)) {
    $row = $pdo->query("SELECT * FROM comment WHERE `sid`= $sid")->fetch();
    $pdo->query("DELETE FROM comment WHERE `comment`.`sid` = $sid");

    $sql = sprintf("UPDATE post set comments = comments - 1 WHERE `sid` = %s", $row['post_sid']);
    $pdo->prepare($sql)->execute();
}

if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_form = $_SERVER['HTTP_REFERER'];
}

echo json_encode($sid . "刪除成功", JSON_UNESCAPED_UNICODE);
header("Location:$come_form");
