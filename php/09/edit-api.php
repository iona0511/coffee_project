<?php
require __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

$sid = isset($_POST['member_sid']) ? intval($_POST['member_sid']) : 0;

$member_name = $_POST['member_name'];
$member_nickname = $_POST['member_nickname'] ?? '';
$member_account = $_POST['member_account'] ?? '';
$member_password = $_POST['member_password'] ?? '';
$birthday = empty($_POST['birthday']) ? NULL : $_POST['birthday'];
$member_account = $_POST['member_account'] ?? '';

$address = $_POST['address'] ?? '';