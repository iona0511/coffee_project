<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';


$data = json_decode(file_get_contents('php://input'), true);

$op_msg = [
    'success' => false,
    'postMsg' => $data['msg'],
    'error' => '',
    'reply_id' => '',
    'poster' => ''
];

$m_nickname = isset($_SESSION['user']['member_nickname']) ? $_SESSION['user']['member_nickname'] : '';
$m_sid = isset($_SESSION['user']['member_sid']) ? intval($_SESSION['user']['member_sid']) : '';

if (empty($data['msg'])) {
    $op_msg['error'] = '沒有內文';
    $op_msg['code'] = 400;
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
} elseif (empty($m_sid)) {
    $op_msg['error'] = '請先登入';
    $op_msg['code'] = 300;
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
}

$sql = "INSERT INTO `reply` (`content`, `comment_sid`,`created_at`, `member_sid`) 
VALUES (?, ?, NOW(), ?)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $data['msg'], $data['cid'], $m_sid
]);

if ($stmt->rowCount() == 1) {
    $op_msg['success'] = true;
    $op_msg['reply_id'] = $pdo->lastInsertId();
    $op_msg['poster'] = $m_sid;
}

echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
