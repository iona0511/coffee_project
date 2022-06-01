<?php
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];


$products_sid = isset($_POST['products_sid']) ? intval($_POST['products_sid']) : 0;

if (empty($products_sid) or empty($_POST['products_name'])) {
    $output['error'] = '沒有商品名稱';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

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


if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
    $output['code'] = 211;
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
