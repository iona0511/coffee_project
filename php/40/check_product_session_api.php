<?php
    session_start();
    if(isset($_SESSION["rawJSON"])) {
        echo $_SESSION["rawJSON"];
    } else {
        echo json_encode(false, JSON_UNESCAPED_UNICODE);
    }
?>