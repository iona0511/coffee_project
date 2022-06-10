<?php
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
header('Content-Type: application/json');
if (! isset($_SESSION)) {
    session_start();
}

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];



$sid = isset($_SESSION['user']['member_sid']) ? intval($_SESSION['user']['member_sid']) : 0;

$member_name = $_POST['member_name']?? '';
$member_nickname = $_POST['member_nickname'] ?? '';
$member_password =  $_POST['member_password'];
$member_birthday = empty($_POST['member_birthday']) ? NULL : $_POST['member_birthday'];
$member_mobile = $_POST['member_mobile'] ?? '';
$member_address = $_POST['member_address'] ?? '';
$member_mail = $_POST['member_mail'] ?? '';
$member_level = $_POST['member_level'] ?? '';


$sql = "UPDATE `member` SET `member_name`=?,`member_nickname`=?,`member_password`=?,`member_birthday`=?,`member_mobile`=?,`member_address`=?,`member_mail`=? WHERE `member_sid`=$sid";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $member_name,
    $member_nickname,
    $member_password,
    $member_birthday,
    $member_mobile,
    $member_address,
    $member_mail,
]);


$stmtpic = $pdo->query("SELECT `avatar` FROM `member` WHERE `member_sid`= $sid")->fetch();

if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    //重新設定SESSION
    $_SESSION['user']['member_name'] = $_POST['member_name']; 
} else{
    $output['success'] = false;
    $output['error'] = '資料沒有修改';
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);

