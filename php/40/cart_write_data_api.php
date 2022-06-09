<?php
    include dirname(dirname(__DIR__,1)) . "/parts/connect_db.php";
    if(!session_id()) {
        session_start();
    }
    // $output["order_pay"] = $_POST["order_pay"];
    // $output["bankNumber"] = $_POST["bankNumber"];
    // $output["bankAccount"] = $_POST["bankAccount"];
    // $output["order_deliver"] = $_POST["order_deliver"];
    // $output["order_address"] = $_POST["order_address"];
    // echo json_encode($output, JSON_UNESCAPED_UNICODE);
    $output = [
        "success" => false,
        "message" => ""
    ];

    //檢查付款方式
    if(isset($_POST["order_pay"])) {
        if(empty($_POST["order_pay"])) {
            $output["success"] = false;
            $output["message"] = "沒有付款方式";
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
    } else {
        $output["success"] = false;
        $output["message"] = "未選擇付款方式";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    //若銀行欄位有一欄空就寫入NULL
    if(isset($_POST["bankNumber"]) and isset($_POST["bankAccount"])) {
        if(!empty($_POST["bankNumber"]) and !empty($_POST["bankAccount"])) {
            $payInfo = $_POST["bankNumber"] . "-" . $_POST["bankAccount"];
        } else {
            $payInfo = NULL;
        }
    } else {
        $output["success"] = false;
        $output["message"] = "沒有接收到銀行帳號";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    //檢查寄送方式
    if(isset($_POST["order_deliver"])) {
        if(empty($_POST["order_deliver"])) {
            $output["success"] = false;
            $output["message"] = "沒有收貨方式";
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
    } else {
        $output["success"] = false;
        $output["message"] = "未選擇收貨方式";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    //檢查地址
    if(isset($_POST["order_address"])) {
        if(empty($_POST["order_address"])) {
            $output["success"] = false;
            $output["message"] = "沒有地址";
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
    } else {
        $output["success"] = false;
        $output["message"] = "未填寫地址";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    //檢查會員
    if(isset($_SESSION["user"]["member_sid"])) {
        if(empty($_SESSION["user"]["member_sid"])) {
            $output["success"] = false;
            $output["message"] = "沒會員";
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            exit;
        }
    } else {
        $output["success"] = false;
        $output["message"] = "沒會員";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    //檢查優惠卷
    if(isset($_SESSION["couponJSON"])) {
        //因為不用優惠卷 優惠卷欄位是undefined 而undefined無法以json格式傳送 因此以id -1 傳送 php判斷若優惠卷id為-1則寫入NULL
        $decodeCoupon = json_decode($_SESSION["couponJSON"],true);
        if($decodeCoupon == -1) {
            $decodeCoupon = NULL;
        }
    } else {
        $output["success"] = false;
        $output["message"] = "無法辨識優惠卷";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    if(isset($_SESSION["displayTotal"])) {
        $price = json_decode($_SESSION["displayTotal"], true);
    } else {
        $output["success"] = false;
        $output["message"] = "訂單價格遺失";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
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
        $_SESSION["newestOrder"] = $pdo -> lastInsertId();
    } else {
        $output["success"] = false;
        $output["message"] = "系統繁忙";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    //寫入coupon_logs
    if($decodeCoupon === NULL) {
        unset($_SESSION["couponJSON"]);
    } else {
        $sql = "INSERT INTO `coupon_logs`(
            `member_sid`, `coupon_receive_sid`, `order_sid`, `used_time`
        ) VALUES (
            ?, ?, ?, NOW()
        )";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([
            $_SESSION["user"]["member_sid"],
            $decodeCoupon,
            $_SESSION["newestOrder"]
        ]);
        if($stmt -> rowCount() == 1) {
            $output["success"] = true;
        } else {
            $output["success"] = false;
            $output["message"] = "系統繁忙2";
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
        }
    
        //寫入coupon_receive
        $sql = sprintf("UPDATE `coupon_receive` SET `status`= 1 WHERE `sid` = %s;", $decodeCoupon);
        $stmt = $pdo -> prepare($sql) -> execute();
    }

    //寫入order
    $products = json_decode($_SESSION["productJSON"], true);
    foreach($products as $v) {
        $sql = "INSERT INTO `cart`(
            `cart_product_id`, `cart_price`, `cart_quantity`, `cart_member_id`, `cart_order_id`
        ) VALUES (
            ?,?,?,?,?
        )";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([
            $v["id"],
            $v["price"],
            $v["quantity"],
            $_SESSION["user"]["member_sid"],
            $_SESSION["newestOrder"]
        ]);
    }
    foreach($products as $v) {
        $sql = sprintf("UPDATE `products` SET `products_stocks`= `products_stocks` - '%s' WHERE `products_sid` = '%s'", $v["quantity"], $v["id"]);
        $stmt = $pdo -> prepare($sql) -> execute();
    }

    //寫入food_choice
    $foods = json_decode($_SESSION["foodJSON"], true);
    foreach($foods as $v) {
        $sql = "INSERT INTO `food_choice`(
            `food_id`, `food_price`, `food_ice`, `food_sugar`, `food_quantity`, `food_member_id`, `food_order_id`
        ) VALUES (
            ?,?,?,?,?,?,?
        )";
        $stmt = $pdo -> prepare($sql);
        $stmt -> execute([
            $v["id"],
            $v["price"],
            $v["ice"],
            $v["sugar"],
            $v["quantity"],
            $_SESSION["user"]["member_sid"],
            $_SESSION["newestOrder"]
        ]);
    }

    //unset所有有關購物車的session
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>