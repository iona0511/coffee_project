<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';


$data = json_decode(file_get_contents('php://input'), true);
$mb_sid = isset($_SESSION['user']['member_sid']) ? $_SESSION['user']['member_sid'] : 0;
$pid = !empty($data['pid']) ? $data['pid'] : 0;

$op_msg = [
    'member' => $mb_sid,
    'isLike' => false,
    'likes' => 0,
    'isLog' => true
];

// 先檔沒登入的
if (empty($mb_sid)) {
    $op_msg['isLog'] = false;
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
}

//判斷會員有沒有按過此篇文章讚
$sql = sprintf("SELECT * FROM `member_likes` WHERE `member_sid` = '%s' AND `post_sid`= '%s'", $mb_sid, $pid);
$row = $pdo->query($sql)->fetch();

if ($data['getlike'] = 'yes') {
    $op_msg['isLike'] = !empty($row);
} else {
    // 如果會員沒按過讚 讚++
    if (empty($row)) {
        $sql = sprintf("UPDATE post set likes = likes + 1 WHERE `sid` = %s", $pid);
        $pdo->prepare($sql)->execute();

        $sql = sprintf("INSERT INTO `member_likes` (`member_sid`, `post_sid`) VALUES ('%s', '%s')", $mb_sid, $pid);
        $pdo->prepare($sql)->execute();

        $op_msg['isLike'] = true;
    } else {
        // 按過讚 取消讚--
        $sql = sprintf("UPDATE post set likes = likes - 1 WHERE `sid` = %s", $pid);
        $pdo->prepare($sql)->execute();

        $sql = sprintf("DELETE FROM member_likes WHERE `member_sid` = %s AND `post_sid` = %s", $mb_sid, $pid);
        $pdo->prepare($sql)->execute();


        $op_msg['isLike'] = false;
    }
}


// 讀db現在有幾個讚
$sql = sprintf("SELECT `likes` FROM `post` WHERE `sid` = %s", $pid);
$row = $pdo->query($sql)->fetch();

$op_msg['likes'] = $row['likes'];




echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
exit;
