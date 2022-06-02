<?php
require __DIR__ . '/connect_db.php';

$topic='';

$search = isset($_POST['search']) ? $_POST['search'] : '';
$by = isset($_POST['by']) ? intval($_POST['by']) : '1';


if ($by == 1 and isset($search)) {
    $sql = sprintf("SELECT * FROM post WHERE `delete_state`='0' AND `topic_sid` LIKE '%%%s' AND `title` LIKE'%%%s%%'", $topic, $search);
 
} elseif ($by == 2 and isset($search)) {
    $sql = sprintf("SELECT * FROM post WHERE `delete_state`='0' AND `topic_sid` LIKE '%%%s' AND `member_sid` LIKE'%%%s%%' ORDER BY `post`.`member_sid` ASC", $topic, $search);
}

$rows = $pdo->query($sql)->fetchAll();

echo json_encode($rows,JSON_UNESCAPED_UNICODE);