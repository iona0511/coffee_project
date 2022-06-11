<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';



$op_msg = [
    'success' => false,
    'postData' => $_POST,
    'error' => '',
    'postId' => 0,
    'poster' => '',
    'pics' => 0
];

$m_nickname = isset($_SESSION['user']['member_nickname']) ? $_SESSION['user']['member_nickname'] : '';
$m_sid = isset($_SESSION['user']['member_sid']) ? $_SESSION['user']['member_sid'] : '';
$photos = json_decode($_POST['photos'], true);



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

if (count($photos) < 1) {
    $op_msg['error'] = '沒有上傳圖片';
    $op_msg['code'] = 400;
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
} elseif (count($photos) > 5) {
    $op_msg['error'] = '圖片超過規定上傳數量';
    $op_msg['code'] = 400;
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
}

$title = $_POST['title'];
$topic = $_POST['topic'];
$tags =  json_decode($_POST['tags'], true);

// 處理textarea儲存換行為\r\n或\r,存進db轉br
$pattern = '/\r\n|\r|\n/';
$replace = "<br/>";
$content = preg_replace($pattern, $replace, $_POST['content']);




$sql = "INSERT INTO `post`(
    `title`, `topic_sid`, `content`,
    `member_nickname`, `member_sid`, `created_at`
    ) VALUES (
        ?, ?, ?,
        ?, ?, NOW()
    )";


$stmt = $pdo->prepare($sql);

$stmt->execute([
    $title, $topic, $content,
    $m_nickname, $m_sid
]);


$postSid = $pdo->lastInsertId();

// 新增row進Post_pic 
foreach ($photos as $ind => $f_name) {
    $sort = $ind + 1;
    $sql = "INSERT INTO `post_img`(`img_name`, `post_sid`, `sort`) 
    VALUES (?, ?,?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$f_name, $postSid, $sort]);
    $op_msg['pics']++;
}




if (!empty($tags)) {
    foreach ($tags as $k => $tag_name) {
        $sql = sprintf("SELECT * FROM `tag` WHERE `name` = '%s'", $tag_name);
        $tag_in_sql = $pdo->query($sql)->fetch();

        // 找tag表內有沒有名稱一樣的tag
        // echo json_encode($tag_in_sql, JSON_UNESCAPED_UNICODE);
        // exit;
        if (!empty($tag_in_sql)) {
            $tagSid = $tag_in_sql['sid'];
            $sql = sprintf("UPDATE `tag` SET `times` = `times` +1 WHERE `name` = '%s'", $tag_name);
            $pdo->query($sql);
        } else {
            $sql = "INSERT INTO `tag` (`name`) VALUES (?)";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([$tag_name]);
            $tagSid = $pdo->lastInsertId();
        }

        //新增post_tag關聯
        $sql = "INSERT INTO `post_tag` (`post_sid`, `tag_sid`) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$postSid, $tagSid]);
    }
}


if ($stmt->rowCount() == 1) {
    $op_msg['success'] = true;
    $op_msg['postId'] = $postSid;
    $op_msg['poster'] = $m_sid;


}


echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
