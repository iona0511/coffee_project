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

    //讀coupon
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

    //讀product
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

    //讀food
    $foodJSON = json_decode($_SESSION["food_order"],true);
    $output["food"] = [];
    foreach($foodJSON as $v) {
        $objFood["id"] = $v["menu_sid"];
        $objFood["name"] = $v["menu_name"];
        $objFood["price"] = $v["menu_price_m"];
        $objFood["quantity"] = $v["food_choice_count"];
        $sql = sprintf("SELECT `menu_photo` FROM `menu` WHERE `menu_sid` = %s", $v["menu_sid"]);
        $arr = $pdo -> query($sql) -> fetch();
        $objFood["src"] = "../../images/11/" . $arr["menu_photo"];
        $objFood["display"] = 1;
        $objFood["ice"] = $v["food_choice_ice"];
        $objFood["sugar"] = $v["food_choice_sugar"];
        $output["food"][] = $objFood;
    }

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
