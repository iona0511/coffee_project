<?php
    session_start();
    $rawJSON = $_POST["fakeData"];
    $_SESSION["rawJSON"] = $rawJSON;
    $rawData = json_decode($rawJSON,true);
    echo json_encode($rawData, JSON_UNESCAPED_UNICODE);
?>