<?php
    session_start();
    // echo $_SESSION["rawJSON"];
    echo json_encode($_SESSION, JSON_UNESCAPED_UNICODE);
    // $now = new DateTime();
    // $now = $now -> getTimestamp();
    // echo json_encode($now, JSON_UNESCAPED_UNICODE);
?>