<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';


$sql = "SELECT * FROM `tag` ORDER BY times DESC";

$rows = $pdo->query($sql)->fetchAll();

echo json_encode($rows, JSON_UNESCAPED_UNICODE);
