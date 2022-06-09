<?php
    if(!session_id()) {
        session_start();
    }
    $output["product"] = json_decode($_SESSION["productJSON"], true);
    $output["food"] = json_decode($_SESSION["foodJSON"], true);
    $output["couponId"] = json_decode($_SESSION["couponJSON"], true);
    $output["user"] = $_SESSION["user"];
    if(isset($_SESSION["products_order"])) {
        $output["product"] = $_SESSION["products_order"];
    }
    if(isset($_SESSION["food_order"])) {
        $output["food"] = json_decode($_SESSION["food_order"],true);
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>