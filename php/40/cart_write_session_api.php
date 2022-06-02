<?php
    session_start();
    $rawJSON = $_POST["fakeData"];
    $rawCoupon = $_POST["couponSelect"];
    $displayTotal = $_POST["displayTotal"];
    $_SESSION["rawJSON"] = $rawJSON;
    $_SESSION["rawCoupon"] = $rawCoupon;
    $_SESSION["displayTotal"] = $displayTotal;
    // $rawData = json_decode($rawCoupon,true);
    // echo json_encode($rawData, JSON_UNESCAPED_UNICODE);
?>