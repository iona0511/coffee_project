<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';

$topic = '1';

$search = isset($_POST['search']) ? $_POST['search'] : '';
$by = isset($_POST['by']) ? intval($_POST['by']) : '1';


if ($by == 1 and isset($search)) {
    $sql = sprintf("SELECT p.*,pi.img_name FROM `post` p JOIN `post_img` pi ON p.sid = pi.post_sid WHERE `delete_state`='0' AND pi.sort = 1 AND `topic_sid` LIKE '%%%s' AND `title` LIKE'%%%s%%'", $topic, $search);
} elseif ($by == 2 and isset($search)) {
    $search = intval($_POST['search']);
    
    $sql = sprintf("SELECT p.*,pi.img_name FROM `post` p JOIN `post_img` pi ON p.sid = pi.post_sid WHERE `delete_state`='0' AND pi.sort = 1 AND `topic_sid` LIKE '%%%s' AND `member_sid` LIKE'%%%s%%' ORDER BY p.`member_sid` ASC", $topic, $search);

}

$rows = $pdo->query($sql)->fetchAll();

echo json_encode($rows, JSON_UNESCAPED_UNICODE);
