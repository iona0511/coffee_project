<?php
    session_start();
    $rawJSON = $_POST["fakeData"];
    $rawCoupon = $_POST["couponSelect"];
    $_SESSION["rawJSON"] = $rawJSON;
    $_SESSION["rawCoupon"] = $rawCoupon;
    $rawData = json_decode($rawCoupon,true);
    echo json_encode($rawData, JSON_UNESCAPED_UNICODE);
?>