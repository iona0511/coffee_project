<?php
require __DIR__ . '/parts/connect_db.php';
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
$date = $_POST['date'];

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

// $sql_member_sid = sprintf("SELECT `points_record`.`type`,`points_record`.`points_get`,`points_record`.`create_at`,`member`.`member_account` FROM`points_record`JOIN`member`ON`points_record`.`member_sid`=`member`.`member_sid` WHERE`member`.`member_account`= '%s' ",$member_account) ;

$sql_member_sid = sprintf("SELECT `member_sid` FROM `member` WHERE`member`.`member_account`= '%s'",$member_account);

// SELECT`member`.`member_sid`


// $sql_member_sid = sprintf("SELECT `points_record`.`type`,`points_record`.`points_get`,`points_record`.`create_at`,`member`.`member_account` FROM`points_record`JOIN`member`ON`points_record`.`member_sid`=`member`.`member_sid` WHERE`member`.`member_account`= '%s' LIMIT %s, %s", ($page - 1) * $perPage, $perPage);


$t_member_sid = $pdo->query($sql_member_sid)->fetchAll();

$a =$t_member_sid[0];
print_r($a);

// $sql_points = sprintf("SELECT `points_user`.`total_points`,`member`.`member_sid`FROM`points_user`JOIN`member`ON`points_user`.`member_sid`=`member`.`member_sid`WHERE`points_user`.`member_sid`=1 ");
// $t_points = $pdo->query($sql_points)->fetchAll();
// $a = $t_points[0];  找acco = ?

// 找不到怎麼辦

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
