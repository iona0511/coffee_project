<?php
require __DIR__ . '/parts/connect_db.php';

session_start();

if (!isset($_SESSION['user']['admin_account'])){
    header('Location:/coffee_project/php/09/admin-login.html');
    exit;
}

header('Content-Type: application/json'); 

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

if (empty($_POST['member_account'])) {
    $output['error'] = '沒有會員帳號資料';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// $member_sid = $_POST['member_sid'];
$member_account = $_POST['member_account'];
$number = $_POST['number'];
$score = $_POST['score'];
// $date = $_POST['date'];

if (!empty($number) and filter_var($number, FILTER_VALIDATE_INT) === false) {

    $output['error'] = '格式錯誤，請輸入數字';
    $output['code'] = 405;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if (!empty($score) and filter_var($score, FILTER_VALIDATE_INT) === false) {
    $output['error'] = '格式錯誤，請輸入數字';
    $output['code'] = 405;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `points_record`(
    `member_sid`, `type`, `points_get`,`create_at`
    ) VALUES (
        ?, ?, ?, NOW()
    )";


$sql_member_sid = sprintf("SELECT `member_sid` FROM `member` WHERE`member`.`member_account`= '%s'",$member_account);


$t_member_sid = $pdo->query($sql_member_sid)->fetchAll();

$a =$t_member_sid[0];
$stmt = $pdo->prepare($sql);

$stmt->execute([
    $a['member_sid'],
    $number,
    $score
]);

if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    $output['lastInsertId'] = $pdo->lastInsertId();
} else {
    $output['error'] = '資料無法新增';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
