<?php
require __DIR__ . '/connect_db.php';
header('Content-Type: application/json');



$output = [
    'success' => false,
    'postData' => $_POST,
    'error' => '修改成功'
];

$sid = isset($_POST['course_sid']) ? intval($_POST['course_sid']) : 0;






if (empty($sid)) {
    $output['error'] = '失敗';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

$name = $_POST['course_name'];
$price = $_POST['course_price'];
$level = $_POST['course_level'];
$img = $_POST['course_img_s'];
$course_content = $_POST['course_content'];
$course_people = $_POST['course_people'];
$course_material = $_POST['course_material'];



$sql = "UPDATE `course` SET `course_name`=?, `course_price`=?, `course_level`=?, `course_img_s`=?, `course_content`=?, `course_people`=?, `course_material`=? WHERE `course_sid`=$sid";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $name,
    $price,
    $level,
    $img,
    $course_content,
    $course_people,
    $course_material

]);



if ($stmt->rowCount() == 1) {
    if ($img == '') {
        $output['success'] = false;
        $output['error'] = '不能沒有照片';
    } else {
        $output['success'] = true;
    }
} else {
    $output['error'] = '資料沒有修改';
}



echo json_encode($output, JSON_UNESCAPED_UNICODE);
