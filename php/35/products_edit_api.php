<?php
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'filenames' => [],
    'error' => ''
];


$products_sid = isset($_POST['products_sid']) ? intval($_POST['products_sid']) : 0;

if (empty($products_sid) or empty($_POST['products_name'])) {
    $output['error'] = '沒有商品名稱';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

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

foreach ($_FILES['products_pic_one']['name'] as $k => $f) {

    $ext = $extMap[$_FILES['products_pic_one']['type'][$k]]; // 副檔名
    // $filename = md5($f . rand()) . $ext; 檔案名稱md5化
    $filename = $f;
    $output['filenames'][] = $filename;
    $sqlpic = "UPDATE `products_pic`JOIN `products`ON `products_pic`.`products_pic_sid` = `products`.`products_sid`SET `products_pic_one`=? WHERE `products_sid`=$products_sid";
    $stmtpic = $pdo->prepare($sqlpic);
    $stmtpic->execute([$filename]);
    // 把上傳的檔案搬移到指定的位置
    move_uploaded_file($_FILES['products_pic_one']['tmp_name'][$k], $folder . $filename);
}

// 圖片區結束

// 複數圖片區

$folder = dirname(dirname(__DIR__, 1)) . '/images/35/';

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

$multiName = [];
foreach ($_FILES['products_pic_multi']['name'] as $k => $f) {

    // $ext = $extMap[$_FILES['products_pic_multi']['type'][$k]]; // 副檔名
    // $filename = md5($f . rand()) . $ext; 檔案名稱md5化
    $filename = $f;
    $output['filenames'][] = $filename;
    array_push($multiName, $filename);
    // 把上傳的檔案搬移到指定的位置
    move_uploaded_file($_FILES['products_pic_multi']['tmp_name'][$k], $folder . $filename);
}
$multiNameStr = implode(",", $multiName);
$sqlmulti = "UPDATE `products_pic`JOIN `products`ON `products_pic`.`products_pic_sid` = `products`.`products_sid`SET `products_pic_multi`=? WHERE `products_sid`=$products_sid";
$stmtmulti = $pdo->prepare($sqlmulti);
$stmtmulti->execute([$multiNameStr]);

// 複數圖片區結束

$products_sid = $_POST['products_sid'];
$products_name = $_POST['products_name'];
$products_introduction = $_POST['products_introduction'] ?? '';
$products_detail_introduction = $_POST['products_detail_introduction'] ?? '';
$products_price = $_POST['products_price'] ?? '';
$products_forsale = $_POST['products_forsale'] ?? '';
$products_onsale = $_POST['products_onsale'] ?? '';
$products_stocks = $_POST['products_stocks'] ?? '';
$products_with_products_categroies_sid = $_POST['products_with_products_categroies_sid'] ?? '';
// $products_pic_one = $_POST['products_pic_one'] ?? '';
// $products_pic_multi = $_POST['products_pic_multi'] ?? '';
$products_with_products_style_filter_sid = $_POST['products_with_products_style_filter_sid'] ?? '';

// TODO 其他欄位檢查

$sql = "UPDATE `products`
SET
`products_name`=?, 
`products_introduction`=?,
`products_detail_introduction`=?,
`products_price`=?,
`products_forsale`=?,
`products_onsale`=?,
`products_stocks`=?,
`products_with_products_categroies_sid`=?,
-- `products_pic_one`=?,
-- `products_pic_multi`=?,
`products_with_products_style_filter_sid`=?
WHERE `products_sid`=$products_sid ";

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
    // $products_pic_one,
    // $products_pic_multi,
    $products_with_products_style_filter_sid
]);

// echo $stmt->rowCount();
// echo json_encode($output, JSON_UNESCAPED_UNICODE);
// exit;



if ($stmt->rowCount() == 1 || $stmtmulti->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改或圖片沒有修改';
    $output['code'] = 211;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
