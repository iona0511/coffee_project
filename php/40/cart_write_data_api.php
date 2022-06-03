<?php
    include dirname(dirname(__DIR__,1)) . "/parts/connect_db.php";
    session_start();
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
    if(isset($_SESSION["rawCoupon"])) {
        //因為不用優惠卷 優惠卷欄位是undefined 而undefined無法以json格式傳送 因此以id -1 傳送 php判斷若優惠卷id為-1則寫入NULL
        $decodeCoupon = json_decode($_SESSION["rawCoupon"],true);
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
        $price = $_SESSION["displayTotal"];
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
        //$pdo -> lastInsertId();
    } else {
        $output["success"] = false;
        $output["message"] = "系統繁忙";
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>