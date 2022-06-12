<?php
    if(!session_id()) {
        session_start();
    }
    $_SESSION["productJSON"] =  $_POST["product"];
    $_SESSION["foodJSON"] = $_POST["food"];
    $_SESSION["couponJSON"] = $_POST["selectedCoupon"];
    $_SESSION["displayTotal"] = $_POST["displayTotal"];

    $pData = json_decode($_POST["product"], true);
    $productArray = [];
    foreach($_SESSION["products_order"] as $v) {
        foreach($pData as $p) {
            if($p["id"] == $v["products_sid"]) {
                $v["products_buy_count"] = $p["quantity"];
                $productArray[] = $v;
            }
        }
    }

    $foodArray = [];
    $foodIce = [];
    $foodSugar = [];
    $fData = json_decode($_POST["food"], true);
    $foodJSON = json_decode($_SESSION["food_order"], true);
    foreach($foodJSON as $v) {
        if($v["food_choice_ice"] == 1) {
            $foodIce["ice"] = "正常冰";
        } else if($v["food_choice_ice"] == 2) {
            $foodIce["ice"] = "少冰";
        } else if($v["food_choice_ice"] == 3) {
            $foodIce["ice"] = "去冰";
        } else if($v["food_choice_ice"] == 4) {
            $foodIce["ice"] = "常溫";
        } else if($v["food_choice_ice"] == 5) {
            $foodIce["ice"] = "熱";
        }

        if($v["food_choice_sugar"] == 1) {
            $foodSugar["sugar"] = "無糖";
        } else if($v["food_choice_sugar"] == 2) {
            $foodSugar["sugar"] = "微糖";
        } else if($v["food_choice_sugar"] == 3) {
            $foodSugar["sugar"] = "半糖";
        } else if($v["food_choice_sugar"] == 4) {
            $foodSugar["sugar"] = "全糖";
        }
        foreach($fData as $f) {
            if($f["id"] == $v["menu_sid"] && $f["ice"] == $foodIce["ice"] && $f["sugar"] == $foodSugar["sugar"]) {
                $v["food_choice_count"] = $f["quantity"];
                $foodArray[] = $v;
            }
        }
    }
    $_SESSION["products_order"] = $productArray;
    $_SESSION["food_order"] = json_encode($foodArray, JSON_UNESCAPED_UNICODE);
    echo json_encode(true, JSON_UNESCAPED_UNICODE);
?>