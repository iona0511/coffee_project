<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

header('Content-Type: application/json');


$folder = __DIR__ . '/news_images/';

$extMap = [
    'image/jpeg'=>'.jpg',
    'image/png'=>'.png',
    'image/gif'=>'.gif',
];

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];

// TODO: 欄位檢查, 後端的檢查
// if (empty($_POST['name'])) {
//     $output['error'] = '沒有姓名資料';
//     $output['code'] = 400;
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }

$ext = $extMap[$_FILES['news_img']['type']];
$news_img = $_POST['news_img'];
$news_title = $_POST['news_title'] ?? '';
$news_class_sid = $_POST['news_class_sid'] ?? '';
$news_start_date = $_POST['news_start_date'] ?? '';
$news_end_date = $_POST['news_end_date'] ?? '';
$news_content = $_POST['news_content'] ?? '';


// TODO: 其他欄位檢查
// $ext = $extMap[$_FILES['news_img']['type']];
// $news_title = $_POST['news_title'];
// $news_class = $_POST['news_class'];
// $news_start_date = $_POST['news_start_date'];
// $news_end_date = $_POST['news_end_date'];
// $news_content = $_POST['news_content'];
// $news_img = $_POST['news_img'];

if(move_uploaded_file($_FILES['news_img']['tmp_name'],$folder.$news_img)){
    $output['success']=true;
}

$output['filename'] = $news_img;


$sql = "INSERT INTO `lastest_news`(
    `news_title`, `news_class_sid`, `news_start_date`, 
    `news_end_date`, `news_content`,`news_create_time`	
    ) VALUES (
        ?,?,?,
        ?,?,NOW()
    )";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    $news_title,
    $news_class_sid,
    $news_start_date,
    $news_end_date,
    $news_content,
]);


if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    // 最近新增資料的 primery key
    $output['lastInsertId'] = $pdo->lastInsertId();
} else {
    $output['error'] = '資料無法新增';
}
// isset() vs empty()


echo json_encode($output, JSON_UNESCAPED_UNICODE);
