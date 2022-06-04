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
$tag_sql = sprintf("SELECT pt.*,t.name,t.times FROM `post_tag` pt JOIN `tag` t ON pt.tag_sid = t.sid WHERE pt.post_sid = '%s';", $pid);
//[{"sid":"1","post_sid":"1","tag_sid":"2","name":"拉花","times":"7"},{"sid":"2","post_sid":"1","tag_sid":"3","name":"好有趣阿","times":"1"},{"sid":"3","post_sid":"1","tag_sid":"4","name":"拉花好好玩","times":"1"}]

$rows = $pdo->query($sql)->fetch();
$tags = $pdo->query($tag_sql)->fetchAll();


if ($rows['comments'] >= 1) {
    $cm_sql =  sprintf("SELECT c.*,m.member_nickname FROM `comment` c JOIN `member` m ON c.member_sid = m.member_sid WHERE c.post_sid = '%s'", $pid);

    $cm_rows = $pdo->query($cm_sql)->fetchAll();
    $cm_rows_id = isset($cm_rows_id) ? $cm_rows_id : 0;

    // $rply_sql = sprintf("SELECT r.*,m.member_nickname FROM `reply` r JOIN `member` m ON r.member_sid = m.member_sid WHERE r.comment_sid = '%s'", $cm_rows_id);

    // $rply_rows = $pdo->query($rply_sql)->fetchAll();
}


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
    <title>文章-<?= $rows['title'] ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include __DIR__ . "/part/nav.php" ?>
    <div class="container post-wrap">
        <div class="post-wrap d-flex">
            <div class="post-content">
                <div class="content-top">
                    <div class="member-info">
                        <div class="avatar">
                            <i class="fa-solid fa-circle-user text-primary"></i>
                        </div>
                        <div class="info">
                            <h5 class="m-nickname"><?= $rows['member_nickname'] ?></h5>
                            <p class="info-id">#<?= $rows['member_sid'] ?></p>
                        </div>
                    </div>
                    <!-- 找session sid=文章sid才出現 -->
                    <div class="post-edit mb-2" style="display:none;">
                        <a class="mr-1" href="post-edit.php?<?= $pid ?>"><i class="fa-solid fa-user-pen"></i>編輯文章</a>
                        <a href="post-delete-api.php?<?= $pid ?>"><i class="fa-solid fa-trash-can"></i>刪除文章</a>
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
                    <div class="tag-bar d-flex">
                        <?php foreach ($tags as $k => $v) : ?>
                            <a href="?">
                                <div class="tag mr-1"><?= $v['name'] ?></div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                    <div class="social mb-2">
                        <a href="javascript:;" class="">
                            <span style="color:black;" class="like">
                                <i class="fa-solid fa-heart"></i>
                                <?= $rows['likes'] ?>
                            </span>
                        </a>
                        <a href="javascript:;" class="">
                            <span style="color:black;" onclick="cm_toggle();">
                                ・留言<?= !empty($rows['comments']) ? $rows['comments'] : '' ?>
                            </span>
                        </a>
                    </div>
                    <!-- 一次回覆 -->
                    <!-- Comment -->
                    <div class="comment-wrap" display="block">
                        <?php if (isset($cm_rows)) : foreach ($cm_rows as $k => $v) : ?>
                                <?php $cm_rows_id = $v['sid'] ?>
                                <div class="d-flex comment-card">
                                    <div class="comment-info">
                                        <div class="avatar">
                                            <i class="fa-solid fa-circle-user text-pink"></i>
                                        </div>
                                        <div class="info">
                                            <span class="c-nickname"><?= $v['member_nickname'] ?></span>
                                            <span class="info-id">#<?= $v['member_sid'] ?></span>
                                        </div>
                                    </div>
                                    <div class="comment-content">
                                        <p><?= $v['content'] ?></p>
                                        <div class="comment-msg">
                                            <p class="mr-2"><?= $v['created_at'] ?></p>
                                            <a href="">
                                                <p>回覆</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- 二次留言 -->
                                <!-- Reply -->
                                <?php
                                $rply_sql = sprintf("SELECT r.*,m.member_nickname FROM `reply` r JOIN `member` m ON r.member_sid = m.member_sid WHERE r.comment_sid = '%s'", $cm_rows_id);
                                $rply_rows = $pdo->query($rply_sql)->fetchAll();
                                if (isset($rply_rows)) :
                                    foreach ($rply_rows as $rk => $rv) :
                                ?>
                                        <div class="d-flex reply-card">
                                            <div class="comment-info">
                                                <div class="avatar">
                                                    <i class="fa-solid fa-circle-user text-primary"></i>
                                                </div>
                                                <div class="info">
                                                    <span class="c-nickname"><?= $rv['member_nickname'] ?></span>
                                                    <span class="info-id">#<?= $rv['member_sid'] ?></span>
                                                </div>
                                            </div>
                                            <div class="comment-content">
                                                <p><?= $rv['content'] ?></p>
                                                <div class="comment-msg">
                                                    <p class="mr-2"><?= $rv['created_at'] ?></p>
                                                </div>
                                            </div>
                                        </div>
                                <?php endforeach;
                                endif; ?>
                        <?php endforeach;
                        endif; ?>
                    </div>
                </div>
                <div class="content-bot">
                    <input class="form-control form-control-md msg" type="text" placeholder="留言">
                    <a href="javascript:send_msg();">發佈</a>
                </div>
            </div>
            <div class="pic-wrap mh">
                <img src="" class="pic" alt="">
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        const pic = document.querySelector(".pic");

        function cm_toggle() {
            if (document.querySelector(".comment-wrap").style.display == "none") {
                document.querySelector(".comment-wrap").style = "display:block";
            } else {
                document.querySelector(".comment-wrap").style = "display:none";
            }
        }

        async function send_msg(){

            const msg = JSON.stringify(document.querySelector(".msg").value);
            console.log(msg);

            // const data = await fetch("post-detail-api.php", {
            //     method: "POST",
            //     headers: {
            //         'Content-Type': 'application/json'
            //     },
            //     body: msg
            // });

            // const response = await data.json();
        }

        async function getData() {
            const pd = JSON.stringify({
                pid: <?= $pid ?>
            });

            function render() {
                pic.src = response[0].img_src;
                // render 編輯/刪除
                if (response[0].m_sid == <?= $rows['member_sid'] ?>) {
                    document.querySelector(".post-edit").style.display = "block";
                } else {
                    document.querySelector(".post-edit").style.display = "none";
                }
            }

            const data = await fetch("post-detail-api.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: pd

            });
            const response = await data.json();
            console.log(response[0]);
            console.log(response[0].img_src);
            render();
        }
        getData();
    </script>
</body>

</html>