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


if (empty($_POST['admin_account'])) {
    $output['error'] = '沒有';
    $output['code'] = 405;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$admin_account = $_POST['admin_account'];
$admin_password = $_POST['admin_password'];


$sql = "SELECT * FROM `admin` WHERE 1;";

$rrr = $pdo->query($sql)->fetchAll();


foreach( $rrr as $k => $v){

    if (isset($_POST['admin_account'])) {

        if (!empty($_POST['admin_account']) and !empty($_POST['admin_password'])) {
            
            if (!empty($rrr[$k])) {
    
                if ($_POST['admin_password'] ===  $rrr[$k]['admin_password']) {
                    
                    $output['success'] = true;
                    $_SESSION['user'] = [
                        'admin_account' => $_POST['admin_account'],
                        
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


