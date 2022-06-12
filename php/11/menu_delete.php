<?php require dirname(__DIR__, 2) . '/parts/connect_db.php'; 

// session_start();



// intval 轉換成整數就不會有sql injection的問題
$menu_sid = isset($_GET['menu_sid']) ? intval($_GET['menu_sid']) : 0;
if(!empty($menu_sid)){
    $pdo->query("DELETE FROM `menu` WHERE menu_sid = $menu_sid");
};

$come_from = 'menu_list.php';
if (!empty($_SERVER['HTTP_REFERER'])) {
    $come_from = $_SERVER['HTTP_REFERER'];
}


header("Location: $come_from");

