<?php
// session_start();
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
header('Content-Type: application/json');



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


// $sql = "SELECT * FROM `member` WHERE 1;";
// $stmt = $pdo->query($sql)->fetchAll();



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



// foreach( $stmt as $k => $v){
            
//     if (isset($_POST['member_account'])) {
    
//         if (!empty($_POST['member_account']) and !empty($_POST['member_password'])) {
            
//             if (!empty($stmt[$k])) {
    
//                 if ( $_POST['member_account'] && $_POST['member_password'] ===  $stmt[$k]['member_password']) {
//                     // 登入成功
//                     // 把資料設定到 session 裡 
//                     $output['success'] = true;
                    
//                     $_SESSION['user'] = [
//                         'member_account' => $_POST['member_account'],
//                         'member_sid' => $v['member_sid'],
//                         'member_name' => $v['member_name'],
//                         'member_nickname' => $v['member_nickname'],
//                         'member_birthday' => $v['member_birthday'],
//                         'member_mobile' => $v['member_mobile'],
//                         'member_mail' => $v['member_mail'],
//                         'member_level' => $v['member_level'],
//                         'avatar' => $v['avatar'],
//                     ];

//                     $output['session'] = $_SESSION['user'] ;
//                 }
//             }
//         }
//         if (!isset($_SESSION['user'])) {
//             $error_msg = '帳號或密碼錯誤';
//         }
    
//     }

//         }

echo json_encode($output, JSON_UNESCAPED_UNICODE);