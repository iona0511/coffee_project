<?php
// session_start();
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
header('Content-Type: application/json');

if(!session_id()) {
    session_start();
}

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

// TODO: 欄位檢查, 後端的檢查
if (empty($_POST['member_account'])) {
    $output['error'] = '沒有帳號';
    $output['code'] = 405;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$member_account = $_POST['member_account'];
$member_password = $_POST['member_password'];


if (isset($_POST['member_account'])){
    if (!empty($_POST['member_account']) and !empty($_POST['member_password'])){

        $sql = sprintf("SELECT * FROM `member` WHERE `member_account` = '%s'", $member_account);
        $row = $pdo->query($sql)->fetch();

        if($row){
            if($member_password == $row['member_password']){
                $output['success'] = true;
                $_SESSION['user'] = [
                        'member_account' => $_POST['member_account'],
                        'member_sid' => $row['member_sid'],
                        'member_name' => $row['member_name'],
                        'member_nickname' => $row['member_nickname'],
                        'member_birthday' => $row['member_birthday'],
                        'member_mobile' => $row['member_mobile'],
                        'member_mail' => $row['member_mail'],
                        'member_level' => $row['member_level'],
                        'avatar' => $row['avatar'],
                    ];
            }else{
                $error_msg = '帳號或密碼錯誤';
            }

        }
    }
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);