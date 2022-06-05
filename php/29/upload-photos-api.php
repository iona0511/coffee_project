<?php
header('Content-Type: application/json');

$folder = __DIR__ . '/uploaded/';

// 用來篩選檔案, 用來決定副檔名
$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

$output = [
    'success' => false,
    'filename' => [],
    'error' => '',
];

if (empty($_FILES['avatar'])) {
    $output['error'] = '沒有上傳檔案';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (!is_array($_FILES['avatar']['name'])) {
    $output['error'] = '沒有上傳檔案2';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// $k是索引
foreach ($_FILES['avatar']['name'] as $k => $f) {

    $ext = $extMap[$_FILES['avatar']['type'][$k]]; // 副檔名

    $filename = md5($f . rand()) . $ext;
    $output['filename'][] = $filename;

    // 把上傳的檔案搬移到指定的位置
    move_uploaded_file($_FILES['avatar']['tmp_name'][$k], $folder . $filename);
    $output['success'] = true;
}



echo json_encode($output);
