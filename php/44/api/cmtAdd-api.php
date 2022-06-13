<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';


$data = json_decode(file_get_contents('php://input'), true);

$op_msg = [
    'success' => false,
    'postMsg' => $data['msg'],
    'error' => '',
    'comment_id' => '',
    'poster' => ''
];

$m_nickname = isset($_SESSION['user']['member_nickname']) ? $_SESSION['user']['member_nickname'] : '';
$m_sid = isset($_SESSION['user']['member_sid']) ? intval($_SESSION['user']['member_sid']) : '';



if (empty($m_sid)) {
    $op_msg['error'] = '請先登入';
    $op_msg['code'] = 300;
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
} elseif (empty($data['msg'])) {
    $op_msg['error'] = '沒有內文';
    $op_msg['code'] = 400;
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
}



$sql = "INSERT INTO `comment` (`content`, `created_at`, `post_sid`, `member_sid`) 
VALUES (?, NOW(), ?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $data['msg'], $data['pid'], $m_sid
]);


if ($stmt->rowCount() == 1) {
    $op_msg['success'] = true;
    $op_msg['comment_id'] = $pdo->lastInsertId();
    $op_msg['poster'] = $m_sid;

    $sql = sprintf("UPDATE post set comments = comments + 1 WHERE `sid` = %s", $data['pid']);
    $pdo->prepare($sql)->execute();
}

echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
