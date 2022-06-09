<?php
    require dirname(__DIR__,2) . '/parts/connect_db.php';
    if(!session_id()) {
        session_start();
    }

    $output = [];
    if(isset($_SESSION["newestOrder"])) {
        $sql = sprintf("SELECT `order`.`order_time`, `order`.`order_pay`, `order`.`order_deliver`, `order`.`order_address`, `order_price`, `order_id`, `member`.`member_name` FROM `order` JOIN `member` on `order`.`order_member_id` = `member`.`member_sid` WHERE `order`.`order_sid` = '%s';", $_SESSION["newestOrder"]);
        $arr = $pdo -> query($sql) -> fetch();
        $obj["time"] = $arr["order_time"];
        $obj["payWay"] = $arr["order_pay"];
        $obj["deliverWay"] = $arr["order_deliver"];
        $obj["address"] = $arr["order_address"];
        $obj["price"] = $arr["order_price"];
        $obj["orderNumber"] = $arr["order_id"];
        $obj["name"] = $arr["member_name"];
        $output[] = $obj;
    } else {
        echo json_encode(false, JSON_UNESCAPED_UNICODE);
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>