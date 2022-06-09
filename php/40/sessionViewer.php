<?php
    if(!session_id()) {
        session_start();
    }
    if(isset($_SESSION["productJSON"])) {
        $output["product"] = json_decode($_SESSION["productJSON"], true);
    }
    if(isset($_SESSION["foodJSON"])) {
        $output["food"] = json_decode($_SESSION["foodJSON"], true);
    }
    if(isset($_SESSION["couponJSON"])) {
        $output["couponId"] = json_decode($_SESSION["couponJSON"], true);
    }
    if(isset($_SESSION["displayTotal"])) {
        $output["displayTotal"] = json_decode($_SESSION["displayTotal"], true);
    }
    if(isset($_SESSION["newestOrder"])) {
        $output["newestOrder"] = json_decode($_SESSION["newestOrder"], true);
    }
    if(isset($_SESSION["user"])) {
        $output["user"] = $_SESSION["user"];
    }
    
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>