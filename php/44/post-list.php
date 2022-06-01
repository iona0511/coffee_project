<?php
require __DIR__ . '/connect_db.php';

$perPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : '1';
$topic = isset($_GET['topic']) ? intval($_GET['topic']) : '';
$topic = empty($topic) ? '' : $topic;

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
// $search = isset($_GET['search']) ? intval($_GET['search']) : '';
$by = isset($_GET['by']) ? intval($_GET['by']) : '1';

if ($page < 1) {
    header("Location:?topic=$topic&page=1");
}


if ($by == 1 and isset($search)) {
    $t_sql = sprintf("SELECT COUNT(1) FROM post WHERE `delete_state`='0' AND `topic_sid` LIKE '%%%s' AND `title` LIKE'%%%s%%'", $topic, $search);
} elseif ($by == 2 and isset($search)) {
    $t_sql = sprintf("SELECT COUNT(1) FROM post WHERE `delete_state`='0' AND `topic_sid` LIKE '%%%s' AND `member_sid` LIKE'%%%s%%'", $topic, $search);
} else {
    $t_sql = sprintf("SELECT COUNT(1) FROM post WHERE `delete_state`='0' AND `topic_sid` LIKE '%%%s'", $topic);
}

// 判斷主題topic=empty 全選計算資料表rows

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);

$rows = [];
if ($totalRows > 0) {
    if ($page > $totalPages) {
        header("Location:?topic=$topic&page=$totalPages");
        exit;
    }

    if ($by == 1 and isset($search)) {
        $sql = sprintf("SELECT * FROM post WHERE `delete_state`='0' AND `topic_sid` LIKE '%%%s' AND `title` LIKE'%%%s%%'", $topic, $search);
    } elseif ($by == 2 and isset($search)) {
        $sql = sprintf("SELECT * FROM post WHERE `delete_state`='0' AND `topic_sid` LIKE '%%%s' AND `member_sid` LIKE'%%%s%%' ORDER BY `post`.`member_sid` ASC", $topic, $search);
    } else {
        //選資料by topic,page,perPages
        $sql = sprintf("SELECT * FROM post WHERE `delete_state`='0' AND `topic_sid`LIKE '%%%s' LIMIT %s,%s", $topic, ($page - 1) * $perPage, $perPage);
    }

    $rows = $pdo->query($sql)->fetchAll();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .ml-auto {
            margin-left: auto;
        }

        .mr-20 {
            margin-right: 20px;
        }

        select {
            border-right: 0px;
            border-radius: 4px 0 0 4px;
            border-color: #dee2e6;

        }

        #search {
            border-radius: 0 4px 4px 0;
            border-width: 0.5px;
            border-style: solid;
            margin-right: 5px;
            padding: 0px;
            border-color: #dee2e6;
            box-shadow: none;
            outline: none;
        }

        .search-result {
            display: flex;
            align-items: end;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-primary" style="font-weight:bold;">文章列表</h2>
        <div class="d-flex">
            <nav aria-label="Page navigation example" id="pagination">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?topic=<?= $topic ?>&page=1">First</a>
                    </li>
                    <li class="page-item <?= $page == 1 ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?topic=<?= $topic ?>&page=<?= $page - 1 ?>">Prev</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <?php if ($i >= $page - 2 and $i <= $page + 2) : ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>"><a class="page-link" href="?topic=<?= $topic ?>&page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?topic=<?= $topic ?>&page=<?= $page + 1 ?>">Next</a>
                    </li>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?topic=<?= $topic ?>&page=<?= $totalPages ?>">End</a>
                    </li>
                </ul>
            </nav>
            <div class="search-result" style="display: none;">
                <h3 style="font-weight:bold;">搜尋紀錄</h3>
                <span><a href="?page=1" class="link-danger">清除</a></span>
            </div>

            <div class="ml-auto d-flex">
                <form name="form1" action="" class="d-flex mr-20" onsubmit="return false;">
                    <select name="by">
                        <option value="1">文章標題</option>
                        <option value="2">會員編號</option>
                    </select>
                    <input type="search" name="search" id="search">
                    <button class="btn btn-primary" name="searchBtn">搜尋</button>
                </form>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        if (empty($topic)) {
                            echo '全部分享';
                        } else if ($topic == 1) {
                            echo '課程分享';
                        } else if ($topic == 2) {
                            echo '商品分享';
                        } else if ($topic == 3) {
                            echo '其他';
                        }
                        ?>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" href="?">全部分享</a></li>
                        <li><a class="dropdown-item" href="?topic=1">課程分享</a></li>
                        <li><a class="dropdown-item" href="?topic=2">商品分享</a></li>
                        <li><a class="dropdown-item" href="?topic=3">其它</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bd-example">
            <table class="table table-hover" id="table">
                <thead>
                    <tr>
                        <th style="width: 5%"><i class="fa-solid fa-trash-can"></i></th>
                        <th scope="col" style="width: 10%">Post#</th>
                        <th scope="col" style="width: 10%">會員暱稱</th>
                        <th scope="col" style="width: 10%">會員編號</th>
                        <th scope="col">文章標題</th>
                        <th scope="col" style="width: 5%">按讚</th>
                        <th scope="col" style="width: 5%">回覆</th>
                        <th scope="col" style="width: 8%">主題編號</th>
                        <th scope="col" style="width: 10%">貼文</th>
                        <th scope="col" style="width: 10%">修改</th>
                        <th style="width: 5%"><i class="fa-solid fa-pen-to-square"></i></th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <?php foreach ($rows as $r) : ?>
                        <tr id="<?= "tr" . $r['sid'] ?>">
                            <td>
                                <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                            <td><?= $r['sid'] ?></td>
                            <td><?= $r['member_nickname'] ?></td>
                            <td><?= $r['member_sid'] ?></td>
                            <td><a href="post-detail.php?pid=<?= $r['sid'] ?>"><?= $r['title'] ?></a></td>
                            <td><?= $r['likes'] ?></td>
                            <td><?= $r['comments'] ?></td>
                            <td><?= $r['topic_sid'] ?></td>
                            <td><?= $r['created_at'] ?></td>
                            <td><?= $r['updated_at'] ?></td>
                            <td><i class="fa-solid fa-pen-to-square"></i></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>

            </table>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function delete_it(sid) {

            fetch(`post-delete-api.php?sid=${sid}`)
                .then(data => data.json())
                .then((data) => {
                    const d = data;
                    console.log(d);
                });

            document.querySelector("#tr" + sid).remove();
        }

        function more() {
            const tr = document.querySelectorAll("tr");
            tr.forEach((v) => {
                v.style.display = "table-row";
            })
            document.querySelector(".continue").remove();
        }

        document.form1.searchBtn.addEventListener("click", async function() {

            function render() {
                const table = document.querySelector("#table");
                const tbody = document.querySelector("#tbody");
                const bd = document.querySelector(".bd-example");
                tbody.classList.add("bg-primary");
                tbody.classList.add("bg-opacity-25");
                tbody.innerHTML = ``;
                document.querySelector("#pagination").style.display = "none";
                document.querySelector(".search-result").style.display = "flex";



                for (let ind in rows) {
                    const v = rows[ind];
                    if (rows.length > 0) {
                        const rowContent = `<td>
                            <a href="javascript: delete_it(${v['sid']})">
                                    <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </td>
                        <td>${v['sid']}</td>
                        <td>${v['member_nickname']}</td>
                        <td>${v['member_sid']}</td>
                        <td>
                            <a href="post-detail.php?pid=${v['sid']}">
                                ${v['title']}
                            </a>
                        </td>
                        <td>${v['likes']}</td>
                        <td>${v['comments']}</td>
                        <td>${v['topic_sid']}</td>
                        <td>${v['created_at']}></td>
                        <td>${v['updated_at']}</td>
                        <td><i class="fa-solid fa-pen-to-square"></i></td>`;


                        if (ind < 10) {
                            tbody.innerHTML += `<tr class="tr" id="tr${v['sid']}">${rowContent}</tr>`;
                        } else {
                            if (ind == 10) {
                                const continueBtn = document.createElement("h3");
                                continueBtn.classList.add("continue");
                                continueBtn.innerHTML = `<div onclick="more()">查看更多...(${rows.length-10})筆</div>`;
                                table.parentNode.appendChild(continueBtn);
                            }
                            tbody.innerHTML += `<tr class="tr" id="tr${v['sid']}" style="display:none;">
                            ${rowContent}
                        </tr>`;

                        }

                    }
                }

            }

            const fd = new FormData(document.form1);
            const data = await fetch("post-list-api.php", {
                method: "POST",
                body: fd,
            });
            const rows = await data.json();

            console.log(rows);
            let recoding_rows_ind = 0;
            render();
        });
    </script>
</body>

</html>