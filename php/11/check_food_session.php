<?php
    require dirname(__DIR__,2) . '/parts/connect_db.php';
    if(!session_id()) {
        session_start();
    }
    // echo json_encode(true, JSON_UNESCAPED_UNICODE);
    // exit;
    if(isset($_SESSION["food_order"])) {
        $food = json_decode($_SESSION["food_order"], true);
        echo json_encode($food, JSON_UNESCAPED_UNICODE);
    }
    else {
        echo json_encode(false, JSON_UNESCAPED_UNICODE);
    }
?>