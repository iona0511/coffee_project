<?php
session_start();
require __DIR__ . '/parts/connect_db.php';
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

$member_account = $_POST['member_account'];
$member_password = $_POST['member_password'];


$sql = "SELECT `member_account`, `member_password` FROM `member` WHERE 1;";

$stmt = $pdo->query($sql);

$rrr = $pdo->query($sql)->fetchAll();
// echo json_encode($rrr, JSON_UNESCAPED_UNICODE);



foreach( $rrr as $k => $v){
            
    if (isset($_POST['member_account'])) {
    
        if (!empty($_POST['member_account']) and !empty($_POST['member_password'])) {
            
    
            
    
    
            if (!empty($rrr[$k])) {
                // echo json_encode($rrr[1]['member_password'], JSON_UNESCAPED_UNICODE);
    
                if ($_POST['member_password'] ===  $rrr[$k]['member_password']) {
                    // 登入成功
                    // 把資料設定到 session 裡 
                    $output['success'] = true;
                    $_SESSION['user'] = [
                        'member_account' => $_POST['member_account'],
                        
                    ];
                }
            }
        }
        if (!isset($_SESSION['user'])) {
            $error_msg = '帳號或密碼錯誤';
        }
    
    }


        }






echo json_encode($output, JSON_UNESCAPED_UNICODE);