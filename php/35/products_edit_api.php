<?php
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'filenames' => [],
    'error' => '',
    'testtext' => []
];


$products_sid = isset($_POST['products_sid']) ? intval($_POST['products_sid']) : 0;

if (empty($products_sid) or empty($_POST['products_name'])) {
    $output['error'] = '沒有商品名稱';
    $output['code'] = 101;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($products_sid) or empty($_POST['products_introduction'])) {
    $output['error'] = '缺少商品簡介';
    $output['code'] = 102;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


if (empty($products_sid) or empty($_POST['products_detail_introduction'])) {
    $output['error'] = '沒有商品介紹';
    $output['code'] = 103;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


if (empty($products_sid) or empty($_POST['products_price'])) {
    $output['error'] = '請輸入價錢';
    $output['code'] = 104;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}


if (empty($products_sid) or empty($_POST['products_stocks'])) {
    $output['error'] = '請輸入庫存';
    $output['code'] = 106;
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
    $output['code'] = 102;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (!is_array($_FILES['products_pic_one']['name'])) {
    $output['error'] = '沒有上傳檔案2';
    $output['code'] = 103;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$singlepic = [];
foreach ($_FILES['products_pic_one']['name'] as $k => $f) {

    $filename = $f;
    $output['filenames'][] = $filename;
    array_push($singlepic, $filename);
    move_uploaded_file($_FILES['products_pic_one']['tmp_name'][$k], $folder . $filename);
}
$singleNameStr = implode(",", $singlepic);

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

    $filename = $f;
    $output['filenames'][] = $filename;
    array_push($multiName, $filename);
    // 把上傳的檔案搬移到指定的位置
    move_uploaded_file($_FILES['products_pic_multi']['tmp_name'][$k], $folder . $filename);
}
$multiNameStr = implode(",", $multiName);

// 圖片區結束


$products_sid = $_POST['products_sid'];
$products_name = $_POST['products_name'];
$products_introduction = $_POST['products_introduction'] ?? '';
$products_detail_introduction = $_POST['products_detail_introduction'] ?? '';
$products_price = $_POST['products_price'] ?? '';
$products_forsale = $_POST['products_forsale'] ?? '';
$products_onsale = $_POST['products_onsale'] ?? '';
$products_stocks = $_POST['products_stocks'] ?? '';
$products_with_products_categories_sid = $_POST['products_with_products_categories_sid'] ?? '';
$products_with_products_style_filter_sid = $_POST['products_with_products_style_filter_sid'] ?? '';

// TODO 其他欄位檢查

$sql = "UPDATE `products`
JOIN `products_pic`
    ON `products_pic`.`products_pic_sid` = `products`.`products_sid`
SET
`products_name`=?, 
`products_introduction`=?,
`products_detail_introduction`=?,
`products_price`=?,
`products_forsale`=?,
`products_onsale`=?,
`products_stocks`=?,
`products_with_products_categories_sid`=?,
`products_pic_one`=?,
`products_pic_multi`=?,
`products_with_products_style_filter_sid`=?
WHERE `products_sid`=$products_sid ";

$stmt = $pdo->prepare($sql);

$output['testtext'][0] = $products_name;
$output['testtext'][1] = $products_introduction;
$output['testtext'][2] = $products_detail_introduction;
$output['testtext'][3] = $products_price;
$output['testtext'][4] = $products_forsale;
$output['testtext'][5] = $products_onsale;
$output['testtext'][6] = $products_stocks;
$output['testtext'][7] = $products_with_products_categories_sid;
$output['testtext'][8] = $singleNameStr;
$output['testtext'][9] = $multiNameStr;
$output['testtext'][10] = $products_with_products_style_filter_sid;



$stmt->execute([
    $products_name,
    $products_introduction,
    $products_detail_introduction,
    $products_price,
    $products_forsale,
    $products_onsale,
    $products_stocks,
    $products_with_products_categories_sid,
    $singleNameStr,
    $multiNameStr,
    $products_with_products_style_filter_sid
]);



if ($stmt->rowCount() >= 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改或圖片沒有修改';
    $output['code'] = 211;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
