<?php
require dirname(__DIR__).'/connect_db.php';
isset($_SESSION) OR session_start();
header('Content-Type: application/json');



$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

// TODO: 欄位檢查, 後端的檢查
if (empty($_POST['member_account'])) {
    $output['error'] = '沒有';
    $output['code'] = 405;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


if (isset($_POST['member_account'])) {

    if (!empty($_POST['member_account']) and !empty($_POST['member_password'])) {
        $account = $_POST['member_account'];
        $password = $_POST['member_password'];

        // 有填帳號密碼且不是空值在搜尋table:Member 有沒有欄位`member_account`為你輸入帳號的資料
        $sql = sprintf("SELECT * FROM `member` WHERE `member_account` = '%s'", $account);
        $row = $pdo->query($sql)->fetch();


        if (!empty($row)) {
            // echo json_encode($rrr[1]['member_password'], JSON_UNESCAPED_UNICODE);
        

            if ($password ==  $row['member_password']) {
                // 登入成功
                // 把資料設定到 session 裡 
                
                $output['success'] = true;
               

                $_SESSION['user'] = [
                    'member_account' => $account,
                    'member_sid' => $row['member_sid'],
                    'member_name' => $row['member_name'],
                    'member_nickname' => $row['member_nickname'],
                    'member_birthday' => $row['member_birthday'],
                    'member_mobile' => $row['member_mobile'],
                    'member_mail' => $row['member_mail'],
                    'member_level' => $row['member_level'],
                ];

                $output['session'] = $_SESSION['user'];
            }
        } else {
            $output['error'] = '資料庫無此帳號';
        }
    } else {
        $output['error'] = '有一格你沒輸入';
    }
}




echo json_encode($output, JSON_UNESCAPED_UNICODE);
