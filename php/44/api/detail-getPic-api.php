<?php
require dirname(dirname(__FILE__)) . '/part/connect_db.php';

$data = json_decode(file_get_contents('php://input'), true);
$m_nickname = isset($_SESSION['user']['member_nickname']) ? $_SESSION['user']['member_nickname'] : '';
$m_sid = isset($_SESSION['user']['member_sid']) ? $_SESSION['user']['member_sid'] : '';



$sql = sprintf("SELECT * FROM `post_img` WHERE `post_sid` = '%s'", $data["pid"]);

$rows = $pdo->query($sql)->fetchAll();

if (empty($rows)) {
    $rows = $pdo->query("SELECT * FROM `post_img` WHERE `post_sid` = 0")->fetchAll();
}

$memberInfo = [
    'm_sid' => "$m_sid",
    'm_nickname' => "$m_nickname"
];
$rows[0] = array_merge($rows[0], $memberInfo);

echo json_encode($rows, JSON_UNESCAPED_UNICODE);
