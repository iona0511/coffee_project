<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';


$folder = dirname(dirname(__FILE__)) . '/uploaded/';

$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

$op_msg = [
    'success' => false,
    'filenames' => [],
    'src' => [],
    'error' => ''
];

if (empty($_FILES['photos'])) {
    $op_msg['error'] = '沒有上傳檔案';
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
} elseif (!is_array($_FILES['photos']['name'])) {
    $op_msg['error'] = '沒有上傳檔案2';
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
} elseif (count($_FILES['photos']['name']) > 5) {
    $op_msg['error'] = '上傳數量超過5張';
    echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
    exit;
}

foreach ($_FILES['photos']['name'] as $k => $v) {
    $ext = $extMap[$_FILES['photos']['type'][$k]]; // 副檔名
    $filename = date("Ymd_H_") .  substr(md5($v . rand()), -6) . $ext; //加好附檔名
    $op_msg['filenames'][] = $filename;
 

    // 把上傳的檔案搬移到指定的位置
    move_uploaded_file($_FILES['photos']['tmp_name'][$k], $folder . $filename);
}

$op_msg['success'] = true;
echo json_encode($op_msg, JSON_UNESCAPED_UNICODE);
