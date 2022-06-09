<?php
require __DIR__ . '/parts/connect_db.php';


if (!isset($_SESSION['user']['admin_account'])) {
    header('Location:/coffee_project/php/09/admin-login.html');
    exit;
}

header('Content-Type: application/json');

$output = [
    'success' => false,
    'postData' => $_POST,
    'code' => 0,
    'error' => ''
];


$sid = isset($_POST['sid']) ? intval($_POST['sid']) : 0;

if (empty($sid) or empty($_POST['coupon_name'])) {
    $output['error'] = '沒有優惠券資料';
    $output['code'] = 400;
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

// ============

$coupon_name = $_POST['coupon_name'];
$coupon_send_type = $_POST['cst_type'] ?? '';
$coupon_setting_type = $_POST['cstt_type'] ?? '';
$coupon_money = $_POST['number'] ?? '';

$menu_sid = $_POST['m_sid'] ?? 0;
$products_sid = $_POST['p_sid'] ?? 0;

$type = $_POST['t_type'] ?? '';
$coupon_validity_period = $_POST['coupon_validity_period'] ?? '';
$coupon_status = $_POST['coupon_status'] ?? '';
// ====================

// $sql = "UPDATE `coupon` SET `coupon_name`=?, `coupon_send_type`=?, `coupon_setting_type`=?, `coupon_money`=?, `menu_sid`=?, `products_sid`=?, `type`=?, `coupon_validity_period`=?, `coupon_status`=? WHERE `sid`='$sid'";

$sql = "INSERT INTO `coupon`(
    `coupon_name`, `coupon_send_type`, `coupon_setting_type`,`coupon_money`,`menu_sid`, `products_sid`, `type`, `coupon_validity_period`,`coupon_status`
    ) VALUES (
        ?, ?, ?, ?, ?, ?, ?, ?, ?
    )";

// =============================
$stmt = $pdo->prepare($sql);

$stmt->execute([
    $coupon_name,
    $coupon_send_type,
    $coupon_setting_type,
    $coupon_money,
    $menu_sid,
    $products_sid,
    $type,
    $coupon_validity_period,
    $coupon_status
]);

if ($stmt->rowCount() == 1) {
    $output['success'] = true;
} else {
    $output['error'] = '資料沒有修改';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
