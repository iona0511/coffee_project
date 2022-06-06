<?php require __DIR__ . '/parts/connect_db.php';
header('Content-Type: application/json');
if (! isset($_SESSION)) {
    session_start();
}

$output = [
    'success' => false,
    'postData' => $_POST,
    'filename' => '',
    'code' => 0,
    'error' => ''
];

$sid = isset($_SESSION['user']['member_sid']) ? intval($_SESSION['user']['member_sid']) : 0;


$row = $pdo->query("SELECT * FROM `member` WHERE `member_sid`= $sid")->fetch();

$output['postData'] = $row ;
$output['filename'] = $row[10];

if(!empty('filename') and !empty('postData')){
    $output['success'] = true;
}

echo json_encode($output);
