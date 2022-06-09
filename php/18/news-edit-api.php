<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

header('Content-Type: application/json');


$folder = dirname(dirname(__DIR__, 1)) . '/images/18/';


// $extMap = [
//     'image/jpeg'=>'.jpg',
//     'image/png'=>'.png',
//     'image/gif'=>'.gif',
// ];

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
    'filename'=>''
];



// $ext = $extMap[$_FILES['news_img']['type']];
$news_sid = isset($_POST['news_sid']) ? intval($_POST['news_sid']) : 0;
$news_title = $_POST['news_title'] ?? '';
$news_class_sid = $_POST['news_class_sid'] ?? '';
$news_start_date = $_POST['news_start_date'] ?? '';
$news_end_date = $_POST['news_end_date'] ?? '';
$news_content = $_POST['news_content'] ?? '';
$news_img = $_FILES['news_img']['name'];


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


$sql = "UPDATE `lastest_news` 
SET`news_title`=?,`news_class_sid`=?,`news_start_date`=?,`news_end_date`=?,`news_content`=?,`news_img`=? WHERE `news_sid`=$news_sid";

$stmt = $pdo->prepare($sql);
$stmt->execute([   
    $news_title,
    $news_class_sid,
    $news_start_date,
    $news_end_date,
    $news_content,
    $news_img,
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
