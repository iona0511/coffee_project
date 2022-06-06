<?php 
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

header('Content-Type:apllication/json');

$menu_sql ="SELECT `menu_sid`, `menu_categories`, `menu_photo`, `menu_name`, `menu_kcal`, `menu_price_m`, `menu_price_l`, `menu_nutrition` FROM `menu`";

$totalRows = $pdo->query($menu_sql)->fetchAll(); 

echo json_encode($totalRows,JSON_UNESCAPED_UNICODE);
