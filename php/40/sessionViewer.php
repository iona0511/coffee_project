<?php
    session_start();
    $output["rawJSON"] = json_decode($_SESSION["rawJSON"], true);
    $output["rawCoupon"] = json_decode($_SESSION["rawCoupon"], true);
    $output["user"] = $_SESSION["user"];
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>