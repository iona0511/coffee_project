<?php 
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

$pageName = 'lastest-news';
$title = '活動消息前台';

$perPage = 6;

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
    body {
        background-image: url('/coffee_project/images/18/coffee_img1.jpg');
        background-size: cover;
    }
    .title01{
        color: #756134;
        font-weight:700
    }
    .display_justify_content {
        display: flex;
        justify-content: center;
    }
    .page-link {
        color:#BE77FF;
    }
</style>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar.php'; ?>
<section>
    <div class="container">
    <div  class="display_justify_content title01" style=" margin:20px auto;font-size:30px;" >活動消息</div>
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
                </nav>

            </div>
        </div>
    </div>
</section>

<?php include dirname(dirname(__DIR__, 1)) . '/parts/scripts.php'; ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-foot.php'; ?>