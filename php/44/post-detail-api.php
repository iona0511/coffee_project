<?php
require __DIR__ . '/part/connect_db.php';

$data = json_decode(file_get_contents('php://input'), true);



$sql = sprintf("SELECT * FROM `post_img` WHERE `post_sid` = '%s'", $data["pid"]);

$rows = $pdo->query($sql)->fetchAll();

echo json_encode($rows, JSON_UNESCAPED_UNICODE);
