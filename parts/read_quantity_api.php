<?php
    require './connect_db.php';
    if(!session_id()) {
        session_start();
    }
    $output = [];

    //讀product
    if(isset($_SESSION["products_order"])) {
        $output["product"] = [];
        $productKey = 1;
        foreach($_SESSION["products_order"] as $v) {
            $objProduct["id"] = intval($v["products_sid"]);
            $objProduct["name"] = $v["products_name"];
            $objProduct["price"] = intval($v["products_price"]);
            $objProduct["quantity"] = intval($v["products_buy_count"]);
            $objProduct["stock"] = intval($v["products_stocks"]);
            $objProduct["src"] = "../../images/35/" . $v["products_pic_one"];
            $objProduct["display"] = 1;
            $objProduct["key"] = $productKey;
            $output["product"][] = $objProduct;
            $productKey++;
        }
    } else {
        $output["product"] = [];
    }

    //讀food
    if (isset($_SESSION["food_order"])) {
        $foodKey = 1;
        $foodJSON = json_decode($_SESSION["food_order"],true);
        $output["food"] = [];
        foreach($foodJSON as $v) {
            $objFood["id"] = intval($v["menu_sid"]);
            $objFood["name"] = $v["menu_name"];
            $objFood["price"] = intval($v["menu_price_m"]);
            $objFood["quantity"] = intval($v["food_choice_count"]);
            $objFood["stock"] = 999999;
            $sql = sprintf("SELECT `menu_photo` FROM `menu` WHERE `menu_sid` = %s", $v["menu_sid"]);
            $arr = $pdo -> query($sql) -> fetch();
            $objFood["src"] = "../../images/11/" . $arr["menu_photo"];
            $objFood["display"] = 1;
            if($v["food_choice_ice"] == 1) {
                $objFood["ice"] = "正常冰";
            } else if($v["food_choice_ice"] == 2) {
                $objFood["ice"] = "少冰";
            } else if($v["food_choice_ice"] == 3) {
                $objFood["ice"] = "去冰";
            } else if($v["food_choice_ice"] == 4) {
                $objFood["ice"] = "常溫";
            } else if($v["food_choice_ice"] == 5) {
                $objFood["ice"] = "熱";
            }
            
            if($v["food_choice_sugar"] == 1) {
                $objFood["sugar"] = "無糖";
            } else if($v["food_choice_sugar"] == 2) {
                $objFood["sugar"] = "微糖";
            } else if($v["food_choice_sugar"] == 3) {
                $objFood["sugar"] = "半糖";
            } else if($v["food_choice_sugar"] == 4) {
                $objFood["sugar"] = "全糖";
            }
            $objFood["key"] = $foodKey;
            $output["food"][] = $objFood;
            $foodKey++;
        }
    } else {
        $output["food"] = [];
    }

    echo json_encode($output, JSON_UNESCAPED_UNICODE);
