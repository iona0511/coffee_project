<?php
require __DIR__ . '/connect_db.php';

$sid = isset($_POST['course_sid']) ? intval($_POST['course_sid']) : 0;

if (!empty($sid)) {
    $pdo->query("DELETE FROM `course` WHERE `course`.`course_sid` = $sid");
}
