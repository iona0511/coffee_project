<?php
    if(!session_id()) {
        session_start();
    }
    $_SESSION["productJSON"] =  $_POST["product"];
    $_SESSION["foodJSON"] = $_POST["food"];
    $_SESSION["couponJSON"] = $_POST["selectedCoupon"];
    $_SESSION["displayTotal"] = $_POST["displayTotal"];
    echo json_encode(true, JSON_UNESCAPED_UNICODE);
?>