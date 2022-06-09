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
    $productKey = 1;
    foreach($_SESSION["products_order"] as $v) {
        $objProduct["id"] = intval($v["products_sid"]);
        $objProduct["name"] = $v["products_name"];
        $objProduct["price"] = intval($v["products_price"]);
        $objProduct["quantity"] = intval($v["products_buy_count"]);
        $objProduct["stock"] = intval($v["products_stocks"]);
        $objProduct["src"] = "../../images/35/" . $v["products_pic_one"];
        $objProduct["display"] = 1;
        $objProduct["key"] = $productKey;
        $output["product"][] = $objProduct;
        $productKey++;
    }

    //讀food
    $foodKey = 1;
    $foodJSON = json_decode($_SESSION["food_order"],true);
    $output["food"] = [];
    foreach($foodJSON as $v) {
        $objFood["id"] = intval($v["menu_sid"]);
        $objFood["name"] = $v["menu_name"];
        $objFood["price"] = intval($v["menu_price_m"]);
        $objFood["quantity"] = intval($v["food_choice_count"]);
        $objFood["stock"] = 999999;
        $sql = sprintf("SELECT `menu_photo` FROM `menu` WHERE `menu_sid` = %s", $v["menu_sid"]);
        $arr = $pdo -> query($sql) -> fetch();
        $objFood["src"] = "../../images/11/" . $arr["menu_photo"];
        $objFood["display"] = 1;
        if($v["food_choice_ice"] == 1) {
            $objFood["ice"] = "正常冰";
        } else if($v["food_choice_ice"] == 2) {
            $objFood["ice"] = "少冰";
        } else if($v["food_choice_ice"] == 3) {
            $objFood["ice"] = "去冰";
        } else if($v["food_choice_ice"] == 4) {
            $objFood["ice"] = "常溫";
        } else if($v["food_choice_ice"] == 5) {
            $objFood["ice"] = "熱";
        }
        
        if($v["food_choice_sugar"] == 1) {
            $objFood["sugar"] = "無糖";
        } else if($v["food_choice_sugar"] == 2) {
            $objFood["sugar"] = "微糖";
        } else if($v["food_choice_sugar"] == 3) {
            $objFood["sugar"] = "半糖";
        } else if($v["food_choice_sugar"] == 4) {
            $objFood["sugar"] = "全糖";
        }
        $objFood["key"] = $foodKey;
        $output["food"][] = $objFood;
        $foodKey++;
    }

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
