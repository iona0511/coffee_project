<?php
    if(!session_id()) {
        session_start();
    }
    if(isset($_SESSION["rawCoupon"])) {
        echo $_SESSION["rawCoupon"];
    } else {
        echo json_encode(false, JSON_UNESCAPED_UNICODE);
    }
?>