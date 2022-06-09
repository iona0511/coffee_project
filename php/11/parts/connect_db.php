<?php

// $db_host = '192.168.24.24'; // 主機名稱 可以是domain name可以是ip
// $db_user = 'coffee'; // 資料庫連線的用戶
// $db_pass = 'coffee'; // 連線用戶的密碼
// $db_name = 'coffee'; //資料庫名稱, 所選定的資料庫

$db_host = 'localhost';// 設定主機名稱
$db_user = 'root';// 資料庫連線的用戶帳號
$db_pass = '';// 連線用戶的密碼，如果是用root就沒有密碼，用空字串''
$db_name = 'coffee_project';// 資料庫名稱,如果給空字串，代表沒有選定特定的資料庫


// $db_host = 'localhost';// 設定主機名稱
// $db_user = 'root';// 資料庫連線的用戶帳號
// $db_pass = '';// 連線用戶的密碼，如果是用root就沒有密碼，用空字串''
// $db_name = 'book_menu';// 資料庫名稱,如果給空字串，代表沒有選定特定的資料庫
                    
$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";
// 
$pdo_options =[
    // 錯誤的模式=>設定值
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // 取出來的資料會變成關聯式資料，如果未設定就會有索引式陣列
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
];

try{
    $pdo = new PDO($dsn, $db_user, $db_pass, $pdo_options);
}catch(PDOException $ex){
    echo $ex->getMessage();
};


