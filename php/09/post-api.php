<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
header('Content-Type: application/json');
if (! isset($_SESSION)) {
    session_start();
}


$output = [
    'postData' => '',
];

$sid = isset($_SESSION['user']['member_sid']) ? intval($_SESSION['user']['member_sid']) : 0;
$sql = "SELECT `title`, `content`,`sid` FROM `post` WHERE `member_sid` = $sid";
$post = $pdo->query($sql)->fetchAll();

$output['postData'] = $post;


echo json_encode($output, JSON_UNESCAPED_UNICODE);