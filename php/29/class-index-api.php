<?php
require dirname(__DIR__, 2) . '/parts/connect_db.php';
// require __DIR__ . '/connect_db.php';



// $perpage = 8;

// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;

// if ($page < 1) {
//     $page = 1;
// }

// $t_sql = "SELECT COUNT(1) FROM course";
// $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

// echo $totalRows;
// exit;


// $totalPages = ceil($totalRows / $perpage);

// $sql = sprintf("SELECT * FROM  course LIMIT %s, %s", ($page - 1) * $perpage, $perpage);

// $rows = $pdo->query($sql)->fetchAll();

$rows = $pdo->query("SELECT * FROM course")->fetchAll();
// query 查詢是否正確執行

echo json_encode(($rows));
