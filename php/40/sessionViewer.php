<?php
    if(!session_id()) {
        session_start();
    }
    $output["rawJSON"] = json_decode($_SESSION["rawJSON"], true);
    $output["rawCoupon"] = json_decode($_SESSION["rawCoupon"], true);
    $output["user"] = $_SESSION["user"];
    $output["product"] = $_SESSION["products_order"];
    if(isset($_SESSION["food_order"])) {
        $output["food"] = json_decode($_SESSION["food_order"],true);
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>