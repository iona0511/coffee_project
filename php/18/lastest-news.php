<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

$pageName = 'lastest-news';
$title = '最新消息';

$perPage = 10;

$page = isset($_POST['page']) ? intval($_POST['page']) : 1;

if ($page < 1) {
    header('Location ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM `lastest_news`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);

$rows = [];

if ($totalRows > 0) {
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM `lastest_news` ORDER BY news_sid DESC LIMIT %s,%s", ($page - 1) *  $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
}
?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-head.php'; ?>

<head>
    <style>
        *{
        box-sizing: border-box;
        margin: 0;
        }

        body {
        /* background-color: #CAAD87; */
        background-image: url('/coffee_project/images/18/coffee_img1.jpg');
        background-size: cover;
        opacity: 0.8;
        }
        .add_btn {
            display: flex;
            justify-content: flex-end;
        }
    </style>
</head>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar_admin.php'; ?>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>

                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>

                    <?php endif;
                    endfor; ?>

                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link <?= $page == $totalPages ? 'disabled' : '' ?>" href="?page=<?= $totalPages ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                </ul>
                <a class="add_btn" href="news-insert.php">
                    <button type="button" class="btn btn-primary">新增</button>
                </a>
            </nav>

        </div>
    </div>

    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">活動圖片</th>
                <th scope="col" class="title-w">活動標題</th>
                <th scope="col">類別</th>
                <th scope="col">活動內容</th>
                <th scope="col">建立日期</th>
                <th scope="col">
                    <i class="fa-solid fa-pen-to-square"></i>
                </th>
                <th scope="col">
                    <i class="fa-solid fa-trash-can"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td><?= $r['news_sid'] ?></td>
                    <td><img src = "../../images/18/<?= $r['news_img'] ?>" height="100"></td>
                    <td><?= htmlentities($r['news_title']) ?></td>
                    <td><?= $r['news_class_sid'] ?></td>
                    <td><?= htmlentities($r['news_content']) ?></td>
                    <td><?= $r['news_create_time'] ?></td>
                    <td><a href="news-edit.php?news_sid=<?= $r['news_sid'] ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                    <td>
                        <a href="javascript: delete_it(<?= $r['news_sid'] ?>)">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<?php include dirname(dirname(__DIR__, 1)) . '/parts/scripts.php'; ?>

<script>
    function delete_it(news_sid) {
        if (confirm(`確定要刪除編號為${news_sid}的資料嗎?`)) {
            location.href = `news-delete.php?news_sid=${news_sid}`;
        }
    }
</script>

<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-foot.php'; ?>