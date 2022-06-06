<?php
header('Content-Type: application/json');

$folder = dirname(dirname(__DIR__, 1)) . '/images/35';
// 把上傳的檔案搬移到指定的位置
move_uploaded_file($_FILES['products_pic_one']['tmp_name'], $folder . $_FILES['products_pic_one']['name']);

echo json_encode($_FILES);
