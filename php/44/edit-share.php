<?php
require  dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

$pid = isset($_GET['pid']) ? intval($_GET['pid']) : '';
$user = isset($_SESSION['user']) ? $_SESSION['user'] : ['member_sid' => 0];


// 判斷有沒有pid，沒有id導回前一頁
if (empty($pid)) {
    header("Location:share.html");
} else {
    //用id進sql判斷有沒有該文章，
    $t_sql = "SELECT COUNT(1) FROM post WHERE `delete_state`='0' AND `sid`='$pid'";
    $havePost = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
    if ($havePost == 0) {
        header("Location:share.html");
    }
}


$sql = sprintf("SELECT p.*,m.avatar FROM `post` p
JOIN `member` m ON p.member_sid = m.member_sid
WHERE `delete_state`='0' AND p.sid = '%s'", $pid);


$tag_sql = sprintf("SELECT pt.*,t.name,t.times FROM `post_tag` pt JOIN `tag` t ON pt.tag_sid = t.sid WHERE pt.post_sid = '%s';", $pid);

$rows = $pdo->query($sql)->fetch();
$tags = $pdo->query($tag_sql)->fetchAll();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>編輯-<?= $rows['title'] ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css" integrity="sha512-NmLkDIU1C/C88wi324HBc+S2kLhi08PN5GDeUVVVC/BVt/9Izdsc9SVeVfA1UZbY3sHUlDSyRXhCzHfr6hmPPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="css/style.css">
    <style>
        .wrap {
            position: relative;
            z-index: 100;

            height: 40px;
        }

        .form-control {
            box-shadow: 2px 2px 6px 3px #d5d5d571;
        }

        .search_col {
            position: absolute;
            width: 33.3%;
            margin-left: .25rem;
            border-radius: 4px;
            background-color: #fff;
            overflow: hidden;
            box-shadow: 2px 2px 6px 3px #d5d5d571;

        }



        .s_col {
            background-color: #fff;
            padding: 6px 12px 6px 18px;
            position: relative;
        }

        .s_col::before {
            display: block;
            content: '#';
            position: absolute;
            left: 6px;
            font-weight: 900;
            color: rgb(6, 95, 212)
        }

        .s_col:hover {
            background-color: #bfbfbf;

        }


        .form-control:focus {
            box-shadow: none !important;
        }

        .h_tag {
            display: inline-block;
            height: 32px;
            font-weight: 500;
            color: rgba(0, 0, 0, 0.75);

            font-size: 14px;
            border-radius: 16px;
            background: #e7e7e7da;
            padding: 0 16px;
            white-space: nowrap;
            position: relative;
            margin-right: .5rem;
            margin-bottom: .5rem;
            line-height: 32px;
        }

        .h_tag:hover {
            background-color: #c1c1c1c5;
        }

        .tag-rect {
            display: flex;
            flex-wrap: wrap;
            margin-right: .25rem;
            margin-left: .25rem;
        }
    </style>
</head>

<body>
    <?php include (dirname(__DIR__, 2)) . "/parts/navbar.php"; ?>
    <div class="page pt-3">
        <div class="post-wrap d-flex">
            <div class="pic-wrap" id="p_wrap">
                <div class="drag-row">
                    <!--  -->
                </div>
                <!-- 如果只有一張圖不需要下面這兩個 -->
                <div class="drag-nav">
                    <ul class="nav-ul">
                        <!-- 小點點放這 -->
                    </ul>
                </div>
                <div class="pn-nav">
                    <!-- 左右 -->

                </div>
            </div>
            <form class="post-content" name="main_form" onsubmit="sendData();return false;" id="main_form">
                <div class="content-top">
                    <div class="member-info mb-2">
                        <div class="avatar">
                            <img src="../../images/09/<?= $rows['avatar'] ?>" alt="">
                        </div>
                        <div class="info">
                            <h5 class="m-nickname"><?= $rows['member_nickname'] ?></h5>
                            <p class="info-id">#<?= $rows['member_sid'] ?></p>
                        </div>
                    </div>
                    <!-- 找session sid=文章sid才出現 -->

                    <div class="d-flex mb-3">
                        <select name="topic" style="width: 25%;height:40px;" class="form-select mx-1 form-control" aria-label="Default select example">
                            <option value="1" <?= $rows['topic_sid'] == 1 ? 'selected' : '' ?>>課程</option>
                            <option value="2" <?= $rows['topic_sid'] == 2 ? 'selected' : '' ?>>商品</option>
                            <option value="3" <?= $rows['topic_sid'] == 3 ? 'selected' : '' ?>>其他</option>
                        </select>
                        <input type="text" name="title" class="mb-1 form-control mx-2" style="width: 70%;height:40px" value="<?= $rows['title'] ?>"></input>

                    </div>

                    <textarea type="text" class="form-control mb-3 mx-1" style="width: 97%;" id="content" name="content" col="20" rows="14"><?= $rows['content'] ?></textarea>

                    <div class="wrap mb-3">
                        <div class="search_col">
                            <input type="text" class="form-control f_tag" id="tag" name="tag" placeholder="標籤名稱" autocomplete="off">
                            <!-- 搜尋列 -->
                            <div class="s_result">
                                <!-- 預覽搜尋 -->
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="tags" value="[]" />

                    <div class="tag-rect">
                        <!-- 標籤列 -->
                        <?php foreach ($tags as $k => $v) : ?>
                            <div class="h_tag mr-1" onclick="removeTag(event)"><?= $v['name'] ?></div>
                        <?php endforeach; ?>
                    </div>




                </div>
                <div class="content-bot cmt-bar  ml-auto">
                    <button type="button" class="btn btn-secondary mr-2" onclick="location.href=`share-detail.php?pid=<?= $rows['sid'] ?>`">取消</button>
                    <button type="submit" class="btn btn-primary">修改分享</button>
                </div>
            </form>
        </div>
    </div>
    <div class="control" style="text-align:center;margin-top: 10px;">


    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        // Get pic&reder
        async function getData() {
            // 取得當下文章的post_sid
            const pd = JSON.stringify({
                pid: <?= $pid ?>
            });

            // render畫面
            function render(r) {
                const d_row = document.querySelector(".drag-row");

                // 有幾張圖片d_row就幾倍寬
                d_row.style.width = r.length * 100 + "%";
                for (let v of r) {
                    d_row.innerHTML += `
                    <div class="drag-col">
                    <img src="uploaded/${v.img_name}" class="pic" alt="">
                    </div>
                    `;

                    // 有一張圖片以上才render 小點跟左右
                    if (r.length > 1) {
                        document.querySelector(".nav-ul").innerHTML += `
                        <li class="drag-ctrl" onclick=""><i class="fa-solid fa-circle"></i></li>
                        `;

                    }
                }
                if (r.length > 1) {
                    document.querySelector(".pn-nav").innerHTML = `
                <i class="fa-solid fa-circle-chevron-left prvnxt prv" onclick="prev_pic()"></i>
                    <i class="fa-solid fa-circle-chevron-right prvnxt nxt" onclick="next_pic()"></i>
                    `;
                    document.querySelector(".drag-col").classList.add("selected");
                    document.querySelector(".drag-ctrl").classList.add("n-selected");
                }

            }

            const data = await fetch("api/detail-getInfo-api.php", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: pd
            });
            const response = await data.json();
            console.log(response);
            render(response);
            addPicCtrl();
        }
        getData();
        let s_ind = 0;

        function slide(direction) {
            const d_row = document.querySelector(".drag-row");
            const d_cols = document.querySelectorAll(".drag-col");
            const cols = d_cols.length;
            const nav_li = document.querySelectorAll(".drag-ctrl");

            document.querySelector(".drag-col.selected").classList.remove("selected");
            document.querySelector(".n-selected").classList.remove("n-selected");
            if (direction == "next") {
                if (s_ind < (cols - 1)) {
                    s_ind++;
                } else {
                    s_ind = 0;
                }
            } else if (direction == "prev") {
                if (s_ind > 0) {
                    s_ind--;
                } else {
                    s_ind = cols - 1;
                }
            } else {
                s_ind = direction;
            }
            d_row.style.left = -d_cols[s_ind].offsetLeft + "px";
            d_cols[s_ind].classList.add("selected");
            nav_li[s_ind].classList.add("n-selected");
        }

        function addPicCtrl() {
            document.querySelectorAll(".drag-ctrl").forEach((v, ind) => {
                v.addEventListener("click", () => {
                    slide(ind);
                });
            });

        }

        // 處理resize
        window.addEventListener('resize', () => {
            const d_row = document.querySelector(".drag-row");
            const d_cols = document.querySelectorAll(".drag-col");

            d_row.style.left = -d_cols[s_ind].offsetLeft + "px";
        });

        const prev_pic = () => {
            slide("prev");
        };
        const next_pic = () => {
            slide("next");
        };



        //TAG動態預覽
        let tagAr = [];
        tagAr = [<?php foreach ($tags as $k => $v) {
                        echo '"' . $v['name'] . '",';
                    };
                    ?>];
        document.main_form.tags.value = JSON.stringify(tagAr);


        async function preview_tag() {

            const v = document.main_form.tag.value;
            if (v < 1) {
                document.querySelector(".s_result").innerHTML = "";
                return;
            }

            const pData = new FormData(document.main_form);
            const r = await fetch("api/preview-tag-api.php", {
                method: "POST",
                body: pData
            });
            const obj = await r.json();

            if (obj.length > 0) {
                const el = document.createElement("div");
                obj.forEach((v, ind) => {
                    el.innerHTML += `
        <div class="s_col" onclick="render_h_tag(event);">${v['name']}</div>`;
                });
                document.querySelector(".s_result").innerHTML = el.innerHTML;
            }
        }

        document.main_form.tag.addEventListener("input", preview_tag);



        const removeTag = (event) => {
            const f = event.target.innerText;
            event.target.remove();

            if (tagAr.indexOf(f) !== -1) {
                tagAr.splice(tagAr.indexOf(f), 1);
            }
            document.main_form.tags.value = JSON.stringify(tagAr);
        };

        window.addEventListener("click", () => {

            document.querySelector(".search_col").style.width = "33.3%";

            if (event.target == document.main_form.tag) return;
            if (document.querySelector(".s_result")) {
                document.querySelector(".s_result").innerHTML = "";
            }
        });

        document.main_form.tag.addEventListener("click", async () => {
            event.cancelBubble = true;

            document.querySelector(".search_col").style.width = "40%";

            const v = document.main_form.tag.value;
            if (v < 1) {
                document.querySelector(".s_result").innerHTML = "";
                return;
            }

            const pData = new FormData(document.main_form);
            const r = await fetch("api/preview-tag-api.php", {
                method: "POST",
                body: pData
            });
            const obj = await r.json();

            if (obj.length > 0) {
                const el = document.createElement("div");
                obj.forEach((v, ind) => {
                    el.innerHTML += `<div class="s_col" onclick="render_h_tag(event)">${v['name']}</div>`;
                });
                document.querySelector(".s_result").innerHTML = el.innerHTML;
            }
        });


        function render_h_tag(event) {
            // 判斷是用click來的還是keydown(按enter)來的
            let v = event.target.innerText || document.main_form.tag.value;

            let exist = false;

            // 如果已經有現有標籤
            if (document.querySelector(".h_tag")) {
                document.querySelectorAll(".h_tag").forEach((now_tag) => {
                    if (v == now_tag.innerText) {
                        exist = (v == now_tag.innerText);
                        return
                    }
                });
            }

            // 不存在才render並清空input value
            if (!exist) {
                document.querySelector(".tag-rect").innerHTML += `
                    <span class="h_tag" onclick="removeTag(event)">${v}</span>`;
                // push資料進arr
                tagAr.push(v);
                document.main_form.tags.value = JSON.stringify(tagAr);

                document.main_form.tag.value = "";
            }

        }

        document.main_form.tag.addEventListener("keydown", (event) => {

            if (event.key == "Enter") {
                // render h_tag
                render_h_tag(event);
                event.preventDefault();
            }
            document.querySelector("#main_form").setAttribute("onsubmit", "event.preventDefault();sendData();return false;");
        });

        async function sendData() {
            console.log("abc")
            function show_msg(msg) {
                if (msg['success']) {
                    alert("修改成功");
                } else {
                    alert(`修改失敗 : ${msg.error}`)

                }
            }

            const fd = new FormData(document.main_form);
            fd.append("pid", <?= $pid ?>);

            const r = await fetch('api/edit-share-api.php', {
                method: 'POST',
                body: fd,
            });
            const result = await r.json();
            console.log(result);

            show_msg(result);

        }
    </script>

</body>

</html>