<?php
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
header('Content-Type: application/json');


$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => '',
    'fileSingleNames' => '',
    'fileMultiNames' => [],
];

// TODO 

// if (empty($_POST['products_name'])) {
//     $output['error'] = '沒有姓名資料';
//     $output['code'] = 400; // 自己定的規則, 這邊是沒有資料
//     echo json_encode($output, JSON_UNESCAPED_UNICODE);
//     exit;
// }

// 圖片區

$folder = dirname(dirname(__DIR__, 1)) . '/images/35/';

$extMap = [
    'image/jpeg' => '.jpg',
    'image/png' => '.png',
    'image/gif' => '.gif',
];

if (empty($_FILES['products_pic_one'])) {
    $output['error'] = '沒有上傳檔案';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (!is_array($_FILES['products_pic_one']['name'])) {
    $output['error'] = '沒有上傳檔案2';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($_FILES['products_pic_multi'])) {
    $output['error'] = '沒有上傳檔案';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (!is_array($_FILES['products_pic_multi']['name'])) {
    $output['error'] = '沒有上傳檔案2';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


$singleName = [];
foreach ($_FILES['products_pic_one']['name'] as $k => $f) {
    $fileSingle = $f;
    $output['fileSingleNames'] = $fileSingle;
    // 把上傳的檔案搬移到指定的位置
    array_push($singleName, $fileSingle);
    // 把上傳的檔案搬移到指定的位置
    move_uploaded_file($_FILES['products_pic_one']['tmp_name'][$k], $folder . $fileSingle);
}

$multiName = [];
foreach ($_FILES['products_pic_multi']['name'] as $k => $f) {
    $fileMultiName = $f;
    $output['fileMultiNames'][] = $fileMultiName;
    array_push($multiName, $fileMultiName);
    // 把上傳的檔案搬移到指定的位置
    move_uploaded_file($_FILES['products_pic_multi']['tmp_name'][$k], $folder . $fileMultiName);
}

$singleNameStr = implode(",", $singleName);
$multiNameStr = implode(",", $multiName);
$sqlmulti = "INSERT INTO `products_pic` (    
    `products_pic_sid`,
    `products_pic_one`,
    `products_pic_multi`
    ) 
    VALUES (
        NULL,
        ?,
        ?
        );";
$stmtmulti = $pdo->prepare($sqlmulti);
$stmtmulti->execute([
    $singleNameStr,
    $multiNameStr
]);

// 複數圖片區結束


// $products_sid = $_POST['products_sid'];
$products_name = $_POST['products_name'];
$products_introduction = $_POST['products_introduction'];
$products_detail_introduction = $_POST['products_detail_introduction'];
$products_price = $_POST['products_price'];
$products_forsale = $_POST['products_forsale'];
$products_onsale = $_POST['products_onsale'];
$products_stocks = $_POST['products_stocks'];
$products_with_products_categroies_sid = $_POST['products_with_products_categroies_sid'];
// $products_pic_one = $_POST['products_pic_one'];
// $products_pic_multi = $_POST['products_pic_multi'];
$products_with_products_style_filter_sid = $_POST['products_with_products_style_filter_sid'];


$sql = "INSERT INTO `products` (
    `products_sid`, 
    `products_number`, 
    `products_name`, 
    `products_introduction`, 
    `products_detail_introduction`, 
    `products_price`, 
    `products_forsale`, 
    `products_onsale`, 
    `products_stocks`,
    `products_with_products_categroies_sid`, 
    `products_with_products_style_filter_sid`) 
    VALUES (
        NULL, 
        UNIX_TIMESTAMP(), 
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?, 
        ?);";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $products_name,
    $products_introduction,
    $products_detail_introduction,
    $products_price,
    $products_forsale,
    $products_onsale,
    $products_stocks,
    $products_with_products_categroies_sid,
    $products_with_products_style_filter_sid,
]);

// 一個輸出看有沒有成功
// $output['success'] = $stmt->rowCount() == 1;
// $output['success'] = $stmt->rowCount();

if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料無法新增';
    $output['code'] = 432;
    // echo $stmt->rowCount();
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
