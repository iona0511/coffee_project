<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';


// 排序為 熱門指數為comments*2+like,降冪排序,再排序文章創建時間,編輯時間
$sql = "SELECT p.*,pi.img_name,pi.sort FROM `post` p 
JOIN `post_img` pi ON p.sid = pi.post_sid
WHERE pi.sort=1 AND p.delete_state = 0
ORDER BY `likes` +`comments`*2 DESC,`created_at` DESC,`updated_at` DESC";



$rows = $pdo->query($sql)->fetchAll();

echo json_encode($rows, JSON_UNESCAPED_UNICODE);
