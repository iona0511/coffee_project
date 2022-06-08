<?php
require dirname(__DIR__, 2) . '/parts/connect_db.php';
header('Content-Type: application/json');
if (!isset($_SESSION)) {
    session_start();
};

// 把要傳給前端的結果用陣列包起來
$output = [
    'success' => false,
    'postData' => $_POST,
    'error' => '新增成功'
];

// $jsonPost = json_encode($_POST, JSON_UNESCAPED_UNICODE);

// echo implode(",",$_POST);

$_SESSION['products_order'][] = $_POST;

// array_push($_SESSION['products_order'], $_POST);

$json = json_encode($_SESSION, JSON_UNESCAPED_UNICODE);

echo $json;

exit;
