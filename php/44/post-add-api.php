<?php
require __DIR__ . '/part/connect_db.php';



$op_msg = [
    'success' => false,
    'postData' => $_POST,
    'error' => '',
    'postId' => 0,
    'tag' => '',
    'poster' => ''
];

$m_nickname = isset($_SESSION['user']['member_nickname']) ? $_SESSION['user']['member_nickname'] : '';
$m_sid = isset($_SESSION['user']['member_sid']) ? $_SESSION['user']['member_nickname'] : '';


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

// 處理textarea儲存換行為\r\n或\r,存進db轉br
$pattern = '/\r\n|\r|\n/';
$replace = "<br/>";
$content = preg_replace($pattern, $replace, $_POST['content']);

$tag = $_POST['tag'] ?? '';


$sql = "INSERT INTO `post`(
    `title`, `topic_sid`, `content`,
    `member_nickname`, `member_sid`, `created_at`
    ) VALUES (
        ?, ?, ?,
        ?, ?, NOW()
    )";




$stmt = $pdo->prepare($sql);

// $stmt->execute([
//     $title, $topic, $content,
//     'Tommy', '666'
// ]);

//用session 的member發文
$stmt->execute([
    $title, $topic, $content,
    $m_nickname, $m_sid
]);


if ($stmt->rowCount() == 1) {
    $op_msg['success'] = true;
    $postSid = $pdo->lastInsertId();
    $op_msg['postId'] = $postSid;
    $op_msg['poster'] = $m_sid;

    if (!empty($tag)) {
        // Table Tag處理 //
        $search_tag_sql = sprintf("SELECT * FROM `tag` WHERE `name` = '%s'", $tag);
        $tag_in_sql = $pdo->query($search_tag_sql)->fetch();
        // 找tag表內有沒有名稱一樣的tag
        if (!empty($tag_in_sql)) {
            $tagTimes = $tag_in_sql['times'] + 1;
            //紀錄tagSid
            $tagSid = $tag_in_sql['sid'];

            // 若有此tag tag使用次數+1
            $sql = sprintf("UPDATE `tag` SET `times` = '%s' WHERE `name` = '%s'", $tagTimes, $tag);
            $pdo->query($sql);
            $op_msg['tag'] = "標籤使用${tagTimes}次";
        } else {
            $sql = "INSERT INTO `tag` (`name`) VALUES (?)";
            $stmt = $pdo->prepare($sql);

            $stmt->execute([$tag]);
            //紀錄tagSid
            $tagSid = $pdo->lastInsertId();
            $op_msg['tag'] = "新增標籤${tag}";
        }

        //Table Post_tag處理
        //新增post_tag關聯
        $sql = "INSERT INTO `post_tag` (`post_sid`, `tag_sid`) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$postSid, $tagSid]);
    }
}


echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
