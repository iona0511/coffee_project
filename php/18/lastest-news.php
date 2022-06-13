<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

if (!session_id()) {
    session_start();
}

if (!isset($_SESSION['user']['admin_account'])){
    header('Location:/coffee_project/php/09/admin-login.html');
    exit;
}




$pageName = 'lastest-news';
$title = '活動消息後台';

$perPage = 5;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

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
<style>
    * {
        box-sizing: border-box;
        margin: 0;
    }

    body {
        background-color: #caad87;
        opacity: 0.9;
    }

    /* .pic > img {
                width: 100px;
                height: 100px;
            } */
    .wrap {
        line-height: 100px;
    }

    .trash-yellow {
        /* color: #E1B03E; */
        color: #842B00;
        font-size: 1.2rem;
    }

    .trash-yellow:hover {
        color: rgb(210, 100, 133);
        transform:scale(2,2);
    }

    .pen-edit {
        /* color: #E1B03E; */
        color: #842B00;
        font-size: 1.2rem;
    }

    .pen-edit:hover {
        color: rgb(210, 100, 133);
        transform:scale(2,2);
    }

    a {
        text-decoration: none;
    }

    /* .add_btn {
            display: flex;
            justify-content: flex-end;
        } */


    .display_justify_content {
        display: flex;
        justify-content: center;
    }

    .bg {
        background-color: #fff;
    }

    table {
        border-collapse: separate;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #B79973;
        border-color: #B79973;
    }

    .page-link {
        color: #B79973;
    }

    body {
        background-color: #CAAD87;
        background-size: cover;
        opacity: 0.9;
    }

    .title01{
        color: #756134;
        font-weight:700
    }
    .table {
        margin-top: 20px;
    }
    .trash_img a .a1 {
        display: none;
    }

    .trash_img a .b1 {
        display: block;
    }

    .trash_img a:hover .a1 {
        display: block;
    }

    .trash_img a:hover .b1 {
        display: none;
    }

    .edit_img a .c1 {
        display: none;
    }

    .edit_img a .d1 {
        display: block;
    }

    .edit_img a:hover .c1 {
        display: block;
    }

    .edit_img a:hover .d1 {
        display: none;
    }

    .css-8cha5q-SubmitButton {
        color: #FFE153;
        background: #D26900;
        font-size: 16px;
        text-align: center;
        padding: 10px 16px;
        letter-spacing: 0.2em;
        line-height: 1.4;
        transition: background 0.4s ease-out 0s, color 0.3s ease-out 0s;
        transition-property: background, color;
        transition-duration: 0.4s, 0.3s;
        transition-timing-function: ease-out, ease-out;
        transition-delay: 0s, 0s;
    }

    a {
        text-decoration: none;
    }

    a:hover {
        background-color: #B2ADAA;
        text-decoration: none;
        color: #fff;
    }
    .t {
        font-size: 1.1rem;
    }

</style>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar_admin.php'; ?>
<div class="container">
    <div  class="display_justify_content title01" style=" margin:20px auto;font-size:30px;" >消息管理</div>
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example" style="display:flex; flex-direction:row;">
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

                    <li class="page-item  <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item  <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="display_justify_content" style="width:100px; margin:5px auto;font-size:12px;">
            <a type="submit" class="css-8cha5q-SubmitButton" href="/coffee_project/php/18/news-insert.php">新增</a>
        </div>
    </div>

    <table class="table table-warning table-striped">
        <thead class="t">
            <tr>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE); border-radius: 30px 0 0 0;">編號</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">活動圖片</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);" class="title-w">活動標題</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">類別</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">活動內容</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">活動開始日期</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">活動結束日期</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">建立時間</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">
                    <i class="fa-solid fa-pen-to-square" ></i>
                </th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE); border-radius: 0 30px 0 0 ;">
                    <i class="fa-solid fa-trash-can"></i>
                </th>
            </tr>
        </thead>
        <tbody class="wrap bg">
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td><?= $r['news_sid'] ?></td>
                    <td><img src="../../images/18/$r['news_img'] ?>" height="100"></td>
                    <td style="line-height:40px"><?= htmlentities($r['news_title']) ?></td>
                    <td><?= $r['news_class_sid'] ?></td>
                    <td style="line-height:40px"><?= htmlentities($r['news_content']) ?></td>
                    <td style="line-height:40px"><?= $r['news_start_date'] ?></td>
                    <td style="line-height:40px"><?= $r['news_end_date'] ?></td>
                    <td style="line-height:40px"><?= $r['news_create_time'] ?></td>
                    <td><a style="width:50px;height:50px;" href="news-edit.php?news_sid=<?= $r['news_sid'] ?>">
                            <i class="fa-solid fa-pen-to-square pen-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a style="width:50px;height:50px;" href=" javascript: delete_it(<?= $r['news_sid'] ?>)">
                            <i class="fa-solid fa-trash-can trash-yellow"></i>
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