<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';


if (empty($_POST)) exit;

// 次數排序
$tag_sql = sprintf("SELECT name FROM `tag` WHERE name REGEXP '^%s' ORDER BY `times`", $_POST['tag']);

$op_msg = $pdo->query($tag_sql)->fetchAll();

echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
