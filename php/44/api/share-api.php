<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';

$sql = "SELECT * FROM `post_img`";


$rows = $pdo->query($sql)->fetchAll();

echo json_encode($rows, JSON_UNESCAPED_UNICODE);
