<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';


$op_msg = [
    'success' => false,
    'postData' => $_POST,
    'error' => '',
    'postId' => 0,
    'poster' => '',
];



$m_sid = isset($_SESSION['user']['member_sid']) ? intval($_SESSION['user']['member_sid']) : '';



if (empty($_POST['pid'])) {
    $op_msg['error'] = '找不到此文章';
    $op_msg['code'] = 400;
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
}


if (empty($_POST['title'])) {
    $op_msg['error'] = '沒有文章標題';
    $op_msg['code'] = 400;
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
} elseif (empty($_POST['topic'])) {
    $op_msg['error'] = '沒有類別';
    $op_msg['code'] = 400;
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
} elseif (empty($_POST['content'])) {
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


$title = $_POST['title'];
$topic = $_POST['topic'];
$pid = $_POST['pid'];
$tags =  json_decode($_POST['tags'], true);

// 處理textarea儲存換行為\r\n或\r,存進db轉br
$pattern = '/\r\n|\r|\n/';
$replace = "<br/>";
$content = preg_replace($pattern, $replace, $_POST['content']);



$sql = "UPDATE `post` SET `title`=?,`topic_sid`=?, `content`=?,`updated_at`=NOW() WHERE `sid`= $pid";


$stmt = $pdo->prepare($sql);
$stmt->execute([
    $title, $topic, $content
]);


$postSid = $pdo->lastInsertId();


if (!empty($tags)) {
    $pdo->prepare("DELETE FROM post_tag WHERE `post_sid` = $pid")->execute([]);
    foreach ($tags as $k => $tag_name) {
        $sql = sprintf("SELECT * FROM `tag` WHERE `name` = '%s'", $tag_name);
        $tag_in_sql = $pdo->query($sql)->fetch();

        // 找tag表內有沒有名稱一樣的tag

        if (!empty($tag_in_sql)) {
            // 如果有times ++
            $tagSid = $tag_in_sql['sid'];
            $sql = sprintf("UPDATE `tag` SET `times` = `times` +1 WHERE `name` = '%s'", $tag_name);
            $pdo->query($sql);
        } else {
            //沒有insert into
            $sql = "INSERT INTO `tag` (`name`) VALUES (?)";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([$tag_name]);
            $tagSid = $pdo->lastInsertId();
        }
        //刪除原本的post_tag關聯

        //新增post_tag關聯
        $sql = "INSERT INTO `post_tag` (`post_sid`, `tag_sid`) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$pid, $tagSid]);
    }
}


if ($stmt->rowCount() == 1) {
    $op_msg['success'] = true;
    $op_msg['postId'] = $pid;
    $op_msg['poster'] = $m_sid;
}


echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
