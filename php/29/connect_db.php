
<?php

// $db_host = '192.168.24.24'; // 主機名稱
// $db_user = 'coffee'; // 資料庫連線的用戶
// $db_pass = 'coffee'; // 連線用戶的密碼
// $db_name = 'coffee';  // 資料庫名稱


$db_host = 'localhost'; // 主機名稱
$db_user = 'root'; // 資料庫連線的用戶
$db_pass = ''; // 連線用戶的密碼
$db_name = 'coffee_course';  // 資料庫名稱

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$pdo_options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
];

try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
