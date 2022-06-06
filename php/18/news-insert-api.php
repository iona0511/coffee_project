<?php require dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';

header('Content-Type: application/json');
// echo json_encode($_POST, JSON_UNESCAPED_UNICODE);
// exit;

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

$news_img = $_POST['news_img'];
$news_title = $_POST['news_title'] ?? '';
$news_class_sid = $_POST['news_class_sid'] ?? '';
$news_start_date = empty($_POST['news_start_date']) ?? '';
$news_end_date = $_POST['news_end_date'] ?? '';
$news_content = $_POST['news_content'] ?? '';

// if (!empty($email) and filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
//     $output['error'] = 'email 格式錯誤';
//     $output['code'] = 405;
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }
// TODO: 其他欄位檢查

$news_title = $_POST['news_title'];
$news_class_sid = $_POST['news_class_sid'] ?? '';
$news_start_date = $_POST['news_start_date'] ?? '';
$news_end_date = $_POST['news_end_date'] ?? '';
$news_content = $_POST['news_content'] ?? '';


$sql = "INSERT INTO `lastest_news`(
    `news_title`, `news_class_sid`, `news_start_date`, 
    `news_end_date`, `news_content`,`news_create_time`	
    ) VALUES (
        ?,?,?,
        ?,?,NOW()
    )";

// $sql = "INSERT INTO `lastest_news` ( `news_img`, `news_title`, `news_class_sid`, `news_start_date`, `news_end_date`, `news_content`, `news_create_time`, `news_status`) VALUES ( 'dfg', 'dfg', '1', '2022-06-02', '2022-06-25', 'fg', '2022-06-01 17:08:00.000000', NULL)";

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
