<?php
    session_start();
    // echo $_SESSION["rawJSON"];
    echo json_encode($_SESSION, JSON_UNESCAPED_UNICODE);
?>