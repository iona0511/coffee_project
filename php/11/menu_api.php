<?php 
require dirname(__DIR__, 2) . '/connect_db.php';

header('Content-Type:apllication/json');

$menu_sql ="SELECT `menu_sid`, `menu_categories`, `menu_photo`, `menu_name`, `menu_kcal`, `menu_price_m`, `menu_nutrition` FROM `menu`";

$totalRows = $pdo->query($menu_sql)->fetchAll(); 

echo json_encode($totalRows,JSON_UNESCAPED_UNICODE);
