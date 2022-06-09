<?php
    if(!session_id()) {
        session_start();
    }
    $output["product"] = json_decode($_SESSION["productJSON"], true);
    $output["food"] = json_decode($_SESSION["foodJSON"], true);
    $output["couponId"] = json_decode($_SESSION["couponJSON"], true);
    $output["displayTotal"] = json_decode($_SESSION["displayTotal"], true);
    $output["user"] = $_SESSION["user"];
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>