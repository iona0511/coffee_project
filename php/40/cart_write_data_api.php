<?php
    include dirname(dirname(__DIR__,1)) . "/parts/connect_db.php";
    session_start();
    // $output["order_pay"] = $_POST["order_pay"];
    // $output["bankNumber"] = $_POST["bankNumber"];
    // $output["bankAccount"] = $_POST["bankAccount"];
    // $output["order_deliver"] = $_POST["order_deliver"];
    // $output["order_address"] = $_POST["order_address"];
    // echo json_encode($output, JSON_UNESCAPED_UNICODE);
    $payInfo = $_POST["bankNumber"] . $_POST["bankAccount"];
    $decodeCoupon = json_decode($_SESSION["rawCoupon"],true);
    if($decodeCoupon == -1) {
        $decodeCoupon = NULL;
    }
    $price = $_SESSION["displayTotal"];
    $now = new DateTime();
    $now = $now -> getTimestamp();

    $sql = "INSERT INTO `order`(
        `order_time`, `order_pay`, `order_pay_info`,
        `order_deliver`, `order_address`, `order_member_id`,
        `order_coupon_id`, `order_price`, `order_id`
    ) VALUES (
        NOW(), ?, ?,
        ?, ?, ?,
        ?, ?, ?
    )";

    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([
        $_POST["order_pay"],
        $payInfo,
        $_POST["order_deliver"],
        $_POST["order_address"],
        $_SESSION["user"]["member_sid"],
        $decodeCoupon,
        $price,
        $now
    ]);
    if($stmt -> rowCount() == 1) {
        $output["success"] = true;
        //最近新增資料的 primary key
    } else {
        $output["error"] = "資料沒有修改";
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>