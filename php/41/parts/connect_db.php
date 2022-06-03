<?php

$db_host = '192.168.24.24'; 
$db_user = 'coffee'; 
$db_pass = 'coffee';
$db_name = 'coffee';  

// $db_host = 'localhost'; 
// $db_user = 'Trista'; 
// $db_pass = 'admin';
// $db_name = 'mydb';  



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
