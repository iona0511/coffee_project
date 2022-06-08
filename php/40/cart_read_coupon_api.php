<?php
    require dirname(__DIR__,2) . '/parts/connect_db.php';
    session_start();

    if (!isset($_SESSION['user']['member_account'])){
        echo json_encode("login", JSON_UNESCAPED_UNICODE);
        exit;
    }

    $memId = $_SESSION["user"]["member_sid"];
    $sql = sprintf("SELECT `coupon_receive`.`sid`, `coupon`.`coupon_name`, `coupon`.`coupon_money`, `coupon`.`menu_sid`, `coupon`.`products_sid`, `coupon`.`type` FROM `coupon_receive` JOIN `coupon` ON `coupon_receive`.`coupon_sid`=`coupon`.`sid` WHERE `end_time` > NOW() AND `status` = 0 AND `member_sid` = %s;", $memId);
    $arr = $pdo -> query($sql) -> fetchAll();
    $output = [];
    foreach($arr as $v) {
        $obj = [];
        $obj["id"] = intval($v["0"]);
        $obj["name"] = $v["1"];
        $obj["money"] = floatval($v["2"]);
        $obj["menu_id"] = intval($v["3"]);
        $obj["products_id"] = intval($v["4"]);
        $obj["type"] = intval($v["5"]);
        $output[] = $obj;
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
?>