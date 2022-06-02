<?php
require __DIR__ . '/connect_db.php';


$sid = isset($_GET['pid']) ? intval($_GET['pid']) : '';


// 判斷有沒有sid，沒有id導回前一頁
if (empty($sid)) {
    header("Location:post-list.php");
} else {
    //用id進sql判斷有沒有該文章，
    $t_sql = "SELECT COUNT(1) FROM post WHERE `delete_state`='0' AND `sid`='$sid'";
    $havePost=$pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
    if ($havePost==0) {
        header("Location:post-list.php");
    }
}


$sql = sprintf("SELECT * FROM post WHERE `delete_state`='0' AND `sid`=%s", $sid);

$rows = $pdo->query($sql)->fetch();


// echo json_encode($rows, JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.css">
    <style>

    </style>
</head>

<body>
    <div class="container">
        <?= json_encode($rows, JSON_UNESCAPED_UNICODE); ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>