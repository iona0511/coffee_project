<?php
    require dirname(__DIR__,2) . '/parts/connect_db.php';
    if(!session_id()) {
        session_start();
    }

    if (!isset($_SESSION['food_order'])){
        echo json_encode("nofood", JSON_UNESCAPED_UNICODE);
        exit;
    }

    $foods = json_decode($_SESSION['food_order'], true);
    $output = [];
    foreach($foods as $food) {
        $sql = sprintf("SELECT `menu_sid`, `menu_photo` FROM `menu` WHERE `menu_name` = '%s';",$food["menu_name"]);
        $result = $pdo -> query($sql) -> fetch();
        $obj = [];
        $obj["cartSid"] = $result["menu_sid"];
        $obj["display"] = 1;
        $obj["productName"] = $food["menu_name"];
        $obj["productPrice"] = $food["menu_price_m"];
        $obj["quantity"] = $food["food_choice_count"];
        $obj["src"] = "../../images/11/" . $result["menu_photo"];
        $output[] = $obj;
    }
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
?>