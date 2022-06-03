<?php require __DIR__ . '/parts/connect_db.php';

$pageName = 'points_foruser_get';

$title = '積分獲取紀錄';
// ==================

$type = isset($_GET['type']) ? intval($_GET['type']) : 1;


if ($type == 2) {
    $type = 2;
} else {
    $type = 1;
}

// ============================================

$t_sql = sprintf("SELECT COUNT(1)FROM`points_record`JOIN`member`ON`points_record`.`member_sid`=`member`.`member_sid`WHERE`points_record`.`type`= %s;", $type);


$perPage = 5;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
// ========================================

$rows = [];

if ($totalRows > 0) {
    if ($page > $totalPages) {
        // header("Location: ?page=$totalPages");
        // print_r($totalPages);
        exit;
    }

    $sql = sprintf("SELECT`points_record`.`create_at`,`points_record`.`points_get`,`member`.`member_sid`FROM`points_record`JOIN`member`ON`points_record`.`member_sid`=`member`.`member_sid`WHERE`points_record`.`type`=%s LIMIT %s, %s", $type, ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
}

$sql_points = sprintf("SELECT `points_user`.`total_points`,`member`.`member_sid`FROM`points_user`JOIN`member`ON`points_user`.`member_sid`=`member`.`member_sid`WHERE`points_user`.`member_sid`=1 ");
$t_points = $pdo->query($sql_points)->fetchAll();
$a = $t_points[0];

?>

<?php include __DIR__ . '/parts/html-head.php' ?>

<style>
    .display_justify_content {
        display: flex;
        justify-content: center;
    }

    .px24 {
        font-size: 24px;
    }


    .display_flex_wrap {
        display: flex;
        flex-wrap: wrap;
    }

    .display_none {
        display: none;
    }

    .border_collapse {
        border-collapse: collapse;

    }

    @keyframes sheen {
        0% {
            transform: skewY(-45deg) translateX(0);
        }

        100% {
            transform: skewY(-45deg) translateX(12.5em);
        }
    }

    .wrapper {
        display: block;
        /* transform: translate(-50%, -50%); */
    }

    .button {
        padding: 0.5em 1.8em;
        text-align: center;
        text-decoration: none;
        color: #B79973;
        border: 2px solid #B79973;
        font-size: 24px;
        display: inline-block;
        border-radius: 0.3em;
        transition: all 0.2s ease-in-out;
        position: relative;
        overflow: hidden;
    }

    .button:before {
        content: "";
        background-color: rgba(255, 255, 255, 0.5);
        height: 100%;
        width: 3em;
        display: block;
        position: absolute;
        top: 0;
        left: -4.5em;
        transform: skewX(-45deg) translateX(0);
        transition: none;
    }

    .button:hover {
        background-color: #B79973;
        color: #fff;
        /* border-bottom: 4px solid #893429; */
    }

    .button:hover:before {
        transform: skewX(-45deg) translateX(13.5em);
        transition: all 0.5s ease-in-out;
    }

    .active {
        background-color: #B79973;
        color: #fff;
    }

    body {
        background: url(./copon_img/img1.jpg);
        background-position: 50% 80%;
        opacity: 0.9;
    }

    .bg {
        background-color: #fff;
    }
    table{
        border-collapse: separate;
    }
    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #B79973;
        border-color: #B79973;
    }
    a {
        color: #B79973;
        text-decoration: underline;
    }
    .page-link{
        color: #B79973;
    }
</style>
<div class="display_justify_content px24" style="font-weight:bold; margin-top: 20px;">
    <p>積分紀錄</p>
</div>
<div class="display_justify_content">
    <p style="color: #893429;font-weight: bold;"> <?= $a['total_points'] ?></p>
    <p>可用積分</p>
</div>
<!-- 上面的按紐 -->
<div class="display_justify_content" class="margin-top:25px;">
    <div class=" display_justify_content wrapper">
        <a style="text-decoration:none;margin-top:0px;margin-right:10px;margin-bottom:20px;" class="button <?= $type == 1 ? 'active' : '' ?> " href="?type=1">獲取紀錄</a>
    </div>
    <div class=" display_justify_content wrapper">
        <a style="text-decoration:none;margin-top:0px;" class="button <?= $type == 2 ? 'active' : '' ?>" href="?type=2">使用記錄</a>
    </div>
</div>
<div id="points_record" class="display_justify_content">
    <div id="points_record_table_a" class="display_justify_content" style="height: 500px; width:1200px;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius: 20px 0 0 0;">日期</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">類別</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius:0 20px 0 0 ;"><?= $type == 1 ? '已獲得' : '已兌換'; ?></th>
                </tr>
            </thead>
            <tbody class="bg">
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= $r['create_at'] ?></td>
                        <td><?= $type == 1 ? '每日簽到獎勵' : '咖啡拿鐵兌換券'; ?></td>
                        <!-- 根據type顯示不同的自 -->
                        <td><?= $r['points_get'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!--  -->
<div class="row display_justify_content">
    <div class="col-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination display_justify_content">
                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>