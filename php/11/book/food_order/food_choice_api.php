<?php 
require __DIR__ . '/connect_db.php';

header('Content-Type:apllication/json');

$food_choice_size = $_POST ['food_choice_size'];
$food_choice_ice = $_POST['food_choice_ice'];
$food_choice_sugar = $_POST['food_choice_sugar'];



$sql = "INSERT INTO `food_choice`(`food_choice_size`, `food_choice_ice`, `food_choice_sugar`) VALUES (?,?,?)";

$stmt =$pdo->prepare($sql);
$stmt->execute([$food_choice_size,$food_choice_ice,$food_choice_sugar]);

if($stmt->rowCount()==1){
    $output['success'] = true;
    // 最近新增資料的primary key
    $output['lastInsertId'] = $pdo->lastInsertId();
    }else{
        $output['error'] = '資料無法新增';
    };

echo json_encode($output,JSON_UNESCAPED_UNICODE);


