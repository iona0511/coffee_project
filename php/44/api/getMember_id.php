<?php
require  dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';

$mid = isset($_SESSION['user']['member_sid']) ? intval($_SESSION['user']['member_sid']) : 'false';

$r = [
    'mid' => $mid,
];



echo json_encode($r, JSON_UNESCAPED_UNICODE);
