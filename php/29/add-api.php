<?php
require __DIR__ . '/connect_db.php';

$output = [
    'success' => false,
    'postData' => $_POST,
    'error' => '新增成功'
];

if (empty($_POST['course_img_s'])) {
    $output['error'] = '請選擇照片';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($_POST['course_name'])) {
    $output['error'] = '請輸入課程名稱';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}
if (empty($_POST['course_price'])) {
    $output['error'] = '請輸入課程價格';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

if (empty($_POST['course_level']) || $_POST['course_level'] == '課程分級') {
    $output['error'] = '請選擇課程分級';
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}



$sql = "INSERT INTO `course`( `course_name`, `course_price`, `course_level`, `course_img_s`, `course_content`,`course_people` ,`course_material`) VALUES (
    ?,?,?,?,?,?,?
)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    $_POST['course_name'],
    $_POST['course_price'],
    $_POST['course_level'],
    $_POST['course_img_s'],
    $_POST['course_content'],
    $_POST['course_people'],
    $_POST['course_material'],
]);

if ($stmt->rowCount() == 1) {
    $output['success'] = true;
    // 最近新增資料的 primery key
    $output['lastInsertId'] = $pdo->lastInsertId();
} else {
    $output['error'] = '新增失敗';
}





echo json_encode($output, JSON_UNESCAPED_UNICODE);
