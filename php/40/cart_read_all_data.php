<?php
    require dirname(__DIR__,2) . '/parts/connect_db.php';
    if(!session_id()) {
        session_start();
    }
    if (!isset($_SESSION['user']['member_account'])){
        echo json_encode("login", JSON_UNESCAPED_UNICODE);
        exit;
    }
    $output = [];

    $memId = $_SESSION["user"]["member_sid"];
    $sql = sprintf("SELECT `coupon_receive`.`sid`, `coupon`.`coupon_name`, `coupon`.`coupon_money`, `coupon`.`menu_sid`, `coupon`.`products_sid`, `coupon`.`type` FROM `coupon_receive` JOIN `coupon` ON `coupon_receive`.`coupon_sid`=`coupon`.`sid` WHERE `end_time` > NOW() AND `status` = 0 AND `member_sid` = %s;", $memId);
    $arr = $pdo -> query($sql) -> fetchAll();
    $output["coupon"] = [];
    foreach($arr as $v) {
        $objCoupon = [];
        $objCoupon["id"] = intval($v["sid"]);
        $objCoupon["name"] = $v["coupon_name"];
        $objCoupon["money"] = floatval($v["coupon_money"]);
        $objCoupon["menu_id"] = intval($v["menu_sid"]);
        $objCoupon["products_id"] = intval($v["products_sid"]);
        $objCoupon["type"] = intval($v["type"]);
        $output["coupon"][] = $objCoupon;
    }

    $output["product"] = [];
    foreach($_SESSION["products_order"] as $v) {
        $objProduct["id"] = $v["products_sid"];
        $objProduct["name"] = $v["products_name"];
        $objProduct["price"] = $v["products_price"];
        $objProduct["quantity"] = $v["products_buy_count"];
        $objProduct["stock"] = $v["products_stocks"];
        $objProduct["src"] = "../../images/35/" . $v["products_pic_one"];
        $objProduct["display"] = 1;
        $output["product"][] = $objProduct;
    }

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
