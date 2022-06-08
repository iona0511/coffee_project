<?php
    require dirname(__DIR__,2) . '/parts/connect_db.php';
    if(!session_id()) {
        session_start();
    }

    if (!isset($_SESSION['user']['member_account'])){
        echo json_encode("login", JSON_UNESCAPED_UNICODE);
        exit;
    }

    $memId = $_SESSION["user"]["member_sid"];
    $sql = sprintf("SELECT `coupon_receive`.`sid`, `coupon`.`coupon_name`, `coupon`.`coupon_money`, `coupon`.`menu_sid`, `coupon`.`products_sid`, `coupon`.`type` FROM `coupon_receive` JOIN `coupon` ON `coupon_receive`.`coupon_sid`=`coupon`.`sid` WHERE `end_time` > NOW() AND `status` = 0 AND `member_sid` = %s;", $memId);
    $arr = $pdo -> query($sql) -> fetchAll();
    // echo json_encode($arr, JSON_UNESCAPED_UNICODE);
    // exit;
    
    $output = [];
    foreach($arr as $v) {
        $obj = [];
        $obj["id"] = intval($v["sid"]);
        $obj["name"] = $v["coupon_name"];
        $obj["money"] = floatval($v["coupon_money"]);
        $obj["menu_id"] = intval($v["menu_sid"]);
        $obj["products_id"] = intval($v["products_sid"]);
        $obj["type"] = intval($v["type"]);
        $output[] = $obj;
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
?>