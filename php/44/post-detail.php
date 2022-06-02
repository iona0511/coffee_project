<?php
require __DIR__ . '/part/connect_db.php';


$pid = isset($_GET['pid']) ? intval($_GET['pid']) : '';


// 判斷有沒有pid，沒有id導回前一頁
if (empty($pid)) {
    header("Location:post-list.php");
} else {
    //用id進sql判斷有沒有該文章，
    $t_sql = "SELECT COUNT(1) FROM post WHERE `delete_state`='0' AND `sid`='$pid'";
    $havePost = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
    if ($havePost == 0) {
        header("Location:post-list.php");
    }
}


$sql = sprintf("SELECT * FROM post WHERE `delete_state`='0' AND `sid`=%s", $pid);
$tag_sql = sprintf("SELECT * FROM post_tag WHERE `post_sid`=%s", $pid);


$rows = $pdo->query($sql)->fetch();
$tags = $pdo->query($tag_sql)->fetchAll();


if ($rows['topic_sid'] == 1) {
    $topic_name = '課程';
} elseif ($rows['topic_sid'] == 1) {
    $topic_name = '商品';
} else {
    $topic_name = '其它';
}

// echo json_encode($rows, JSON_UNESCAPED_UNICODE);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include __DIR__ . "/part/nav.php" ?>
    <div class="container" class="abc">
      
        
        <?= json_encode($tags, JSON_UNESCAPED_UNICODE); ?>
        <div class="row mt-3">
            <div class="post-content col-7">
                <div class="member-info mb-2">
                    <div class="avatar">
                        <i class="fa-solid fa-circle-user text-primary"></i>
                    </div>
                    <div class="info">
                        <h5 class="m-nickname"><?= $rows['member_nickname'] ?></h5>
                        <p>#<?= $rows['member_sid'] ?></p>
                    </div>
                </div>
                <h3 class="mb-3"><?= $rows['title'] ?></h3>
                <div class="d-flex mb-3">
                    <a class="mr-3" href="post-list.php?topic=<?= $rows['topic_sid'] ?>">
                        <?= $topic_name ?>
                    </a>
                    <span class="c-date"><?= $rows['created_at'] ?></span>
                </div>
                <p class="post-text">
                    <?= $rows['content'] ?>
                </p>

                <div class="social">
                    <a href="javascript:;" class="mr-3">
                        <span style="color:black;">
                            <i class="fa-solid fa-thumbs-up text-primary"></i>
                            <?=$rows['likes']?>
                        </span>
                    </a>
                    <span>留言:<?=$rows['comments']?></span>
                </div>
            </div>
            <div class="pic-wrap col-5">
                <img src="" class="pic" alt="">
            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        const pic = document.querySelector(".pic");

        async function getData() {

            const pd = JSON.stringify({
                pid: <?= $pid ?>
            });

            function render() {
                pic.src = response[0].img_src;
            }

            const data = await fetch("post-detail-api.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: pd

            });
            const response = await data.json();
            console.log(response[0].img_src);
            render();
        }
        getData()
    </script>
</body>

</html>