<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

header('Content-Type: application/json');


$folder = dirname(dirname(__DIR__, 1)) . '/images/18/';


$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
    'filename' => '',
    'photosuccess' => false,
    'state' => []
];



// $ext = $extMap[$_FILES['news_img']['type']];

// echo $ext;

$ext = $extMap[$_FILES['news_img']['type']];
$filename = md5($_FILES['news_img']['name'] . rand()) . $ext;

// echo $filename;
// exit;

$news_sid = isset($_POST['news_sid']) ? intval($_POST['news_sid']) : 0;
$news_title = $_POST['news_title'] ?? '';
$news_class_sid = $_POST['news_class_sid'] ?? '';
$news_start_date = $_POST['news_start_date'] ?? '';
$news_end_date = $_POST['news_end_date'] ?? '';
$news_content = $_POST['news_content'] ?? '';
$news_img = $_FILES['news_img']['tmp_name'];


// TODO: 其他欄位檢查
// $ext = $extMap[$_FILES['news_img']['type']];
// $news_title = $_POST['news_title'];
// $news_class = $_POST['news_class'];
// $news_start_date = $_POST['news_start_date'];
// $news_end_date = $_POST['news_end_date'];
// $news_content = $_POST['news_content'];
// $news_img = $_POST['news_img'];

if(move_uploaded_file($_FILES['news_img']['tmp_name'],$folder.$filename)) {
    $output['photosuccess']=true;
}else {
    $output['error'] = '搬移檔案失敗';
    $output['code'] = 301;
}

$output['filename'] = $news_img;

// $sql="UPDATE `lastest_news` 
// SET `news_title`='456456',
// `news_class_sid`='2',
// `news_start_date`='2022-11-10',
// `news_end_date`='2022-12-24',
// `news_content`='abababab' 
// WHERE `news_sid`=15;";

// $sql = "UPDATE `lastest_news` 
// SET
// `news_title`=`454555`,
// `news_class_sid`=`2`,
// `news_start_date`=`2022-11-21`,
// `news_end_date`=`2022-12-22`,
// `news_content`=`abababab`,
// -- `news_img`=? 
// WHERE `news_sid`=1";


$sql = "UPDATE `lastest_news` SET `news_title`= ?, `news_class_sid`=?, `news_start_date`=?, `news_end_date`=?, `news_content`=?, `news_img`=? WHERE `news_sid` = $news_sid";

$stmt = $pdo->prepare($sql);

$output['state'][0] = $news_title;
$output['state'][1] = $news_class_sid;
$output['state'][2] = $news_start_date;
$output['state'][3] = $news_end_date;
$output['state'][4] = $news_content;
$output['state'][5] = $filename;

$stmt->execute([   
    $news_title,
    $news_class_sid,
    $news_start_date,
    $news_end_date,
    $news_content,
    $filename
]);



if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
    $output['code'] = 302;
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);
