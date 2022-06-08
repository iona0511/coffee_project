<?php
require dirname(dirname(__FILE__)) . '/part/connect_db.php';

$data = json_decode(file_get_contents('php://input'), true);
$mb_nickname = isset($_SESSION['user']['member_nickname']) ? $_SESSION['user']['member_nickname'] : '';
$mb_sid = isset($_SESSION['user']['member_sid']) ? $_SESSION['user']['member_sid'] : 0;

// 讀照片表
$sql = sprintf("SELECT * FROM `post_img` WHERE `post_sid` = '%s'", $data["pid"]);
$rows = $pdo->query($sql)->fetchAll();
// 預設照片
if (empty($rows)) {
    $rows = $pdo->query("SELECT * FROM `post_img` WHERE `post_sid` = 0")->fetchAll();
}

$sql = sprintf("SELECT * FROM `member_likes` WHERE `member_sid` = '%s' AND `post_sid`= '%s'", $mb_sid,  $data["pid"]);
$like = $pdo->query($sql)->fetch();
$isLike = !empty($like);

$memberInfo = [
    'm_sid' => $mb_sid,
    'm_nickname' => $mb_nickname,
    'isLike' => $isLike 
];
$rows[0] = array_merge($rows[0], $memberInfo);

echo json_encode($rows, JSON_UNESCAPED_UNICODE);
