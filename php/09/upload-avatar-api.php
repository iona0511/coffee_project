<?php
header('Content-Type: application/json');
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
if (! isset($_SESSION)) {
    session_start();
}

$folder = __DIR__ . '/uploaded/';

// 篩選檔案的副檔名
$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

$output = [
    'success' => false,
    'filename' => '',
    'error' => '',
];

if(empty($_FILES['avatar'])){
    $output['error'] = '沒有上傳檔案';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($extMap[$_FILES['avatar']['type']])) {
    $output['error'] = '檔案類型錯誤';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


$filename = $_FILES['avatar']['name'];
$output['filename'] = $filename;


if(move_uploaded_file($_FILES['avatar']['tmp_name'], $folder . $filename)){
    $output['success'] = true;
}else {
    $output['error'] = '檔案搬移失敗';
}

$avatar = $_FILES['avatar']['name']?? '';
$sid = isset($_SESSION['user']['member_sid']) ? intval($_SESSION['user']['member_sid']) : 0;

$sql = "UPDATE `member` SET `avatar`=? WHERE `member_sid`=$sid";
$stmt = $pdo->prepare($sql);
$stmt->execute([$avatar]);

if ($stmt->rowCount() == 1) {
    $output['success'] = '照片成功上傳';
} else {
    $output['error'] = '照片沒有上傳';
}


echo json_encode($output, JSON_UNESCAPED_UNICODE);

