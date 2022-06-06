<?php
    session_start();
    $_SESSION["rawJSON"] =  $_POST["fakeData"];
    $_SESSION["rawCoupon"] = $_POST["couponSelect"];
    $_SESSION["displayTotal"] = $_POST["displayTotal"];
?>