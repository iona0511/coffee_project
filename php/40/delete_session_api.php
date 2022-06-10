<?php
    if(!session_id()) {
        session_start();
    }
    $output = [];
    $product = json_decode($_POST["product"], true);
    $food = json_decode($_POST["food"], true);
    // $output[] = $product;
    // $output[] = $food;
    $productArray = [];
    if(isset($_SESSION["products_order"])) {
        foreach($_SESSION["products_order"] as $v) {
            $check = false;
            foreach($product as $p) {
                if($p["id"] == $v["products_sid"]) {
                    $check = true;
                }
            }
            if($check) {
                $productArray[] = $v;
            }
        }
    } else {
        $_SESSION["products_order"] = [];
    }

    $foodArray = [];
    if(isset($_SESSION["food_order"])) {
        $foodJSON = json_decode($_SESSION["food_order"], true);
        foreach($foodJSON as $v) {
            $check = false;
            foreach($food as $f) {
                if($f["id"] == $v["menu_sid"]) {
                    $check = true;
                }
            }
            if($check) {
                $foodArray[] = $v;
            }
        }
    } else {
        $_SESSION["food_order"] = [];
    }

    $_SESSION["products_order"] = $productArray;
    $_SESSION["food_order"] = json_encode($foodArray, JSON_UNESCAPED_UNICODE);


    //檢查用
    $output[] = $productArray;
    $output[] = $foodArray;

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
?>