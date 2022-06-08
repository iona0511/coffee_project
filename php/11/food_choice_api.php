<?php
require dirname(__DIR__, 2) . '/parts/connect_db.php';
header('Content-Type: application/json');

// 把要傳給前端的結果用陣列包起來
$output = [
    'success' => false,
    'postData' => $_POST,
    'error' => '新增成功'
];
$data = json_decode(file_get_contents('php://input'));







$questionMark = array();
$insert_values = array();
foreach($data as $d){
    $questionMark[] = '(?,?,?,?,?,NOW())';
    $item = [
        $d->menu_name,
        $d->menu_price_m,
        $d->food_choice_ice,
        $d->food_choice_sugar,
        $d->food_choice_count,
    ];
    // var_dump($item);
    // var_dump(array_values($item));
    $insert_values = array_merge($insert_values, $item);
}

// array(array(newData));
// array(array(newData), array(newData));

$sql = "INSERT INTO `food_choice`(`menu_name`, `menu_price_m`, `food_choice_ice`,`food_choice_sugar`,`food_choice_count`,`created_at`) VALUES ".implode(",", $questionMark);

$stmt = $pdo->prepare($sql);

$stmt->execute($insert_values);

if ($stmt->rowCount() >= 1) {
    $output['success'] = true;
    // 最近新增資料的 primery key
    $output['lastInsertId'] = $pdo->lastInsertId();
} else {
    $output['error'] = '新增失敗';
}

// 回應前端一律用JSON
echo json_encode($output, JSON_UNESCAPED_UNICODE);
