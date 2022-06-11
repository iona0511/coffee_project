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
    $foodIce = [];
    $foodSugar = [];
    if(isset($_SESSION["food_order"])) {
        $foodJSON = json_decode($_SESSION["food_order"], true);
        foreach($foodJSON as $v) {
            $check = false;
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
            foreach($food as $f) {
                if($f["id"] == $v["menu_sid"] && $f["ice"] == $foodIce["ice"] && $f["sugar"] == $foodSugar["sugar"]) {
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
    // $output[] = $productArray;
    // $output[] = $foodArray;

    // echo json_encode($output, JSON_UNESCAPED_UNICODE);
    // exit;
?>