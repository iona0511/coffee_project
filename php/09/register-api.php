<?php
require __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

// TODO: 欄位檢查, 後端的檢查
if (empty($_POST['member_name'])) {
    $output['error'] = '沒有姓名資料';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$member_name = $_POST['member_name'];
$member_nickname = $_POST['member_nickname'];
$member_account = $_POST['member_account'];
$member_password = $_POST['member_password'];
$member_birthday = empty($_POST['member_birthday']) ? NULL : $_POST['member_birthday'];
$member_mobile = $_POST['member_mobile'] ?? '';
$member_address = $_POST['member_address'] ?? '';
$member_mail = $_POST['member_mail'] ?? '';


// if (!empty($member_mail) and filter_var($member_mail, FILTER_VALIDATE_EMAIL) === false) {
//     $output['error'] = '信箱 格式錯誤';
//     $output['code'] = 405;
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }


$sql = "INSERT INTO `member` ( 
    `member_name`, `member_nickname`, `member_account`, `member_password`,
    `member_birthday`, `member_mobile`, `member_address`, `member_mail`
    ) VALUES (
        ?, ?, ?, ?,
        ?, ?, ?, ? 
    );";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $member_name,
    $member_nickname,
    $member_account,
    $member_password,
    $member_birthday,
    $member_mobile,
    $member_address,
    $member_mail
]);


if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    // 最近新增資料的 primery key
    // $output['lastInsertId'] = $pdo->lastInsertId();
} else {
    $output['error'] = '資料無法新增';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
