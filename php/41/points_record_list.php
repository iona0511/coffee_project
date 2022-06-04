<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'points_record_list';
$title = '積分歷史紀錄';
$perPage = 5;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}



$t_sql = sprintf("SELECT COUNT(1)FROM`points_record`JOIN`member`ON`points_record`.`member_sid`=`member`.`member_sid`");

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; 

$totalPages = ceil($totalRows / $perPage); 
// ==================== page ============================
$rows = [];

if ($totalRows > 0) {
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT `points_record`.`type`,`points_record`.`points_get`,`points_record`.`create_at`,`member`.`member_account` FROM`points_record`JOIN`member`ON`points_record`.`member_sid`=`member`.`member_sid` LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    
    $rows = $pdo->query($sql)->fetchAll();
}


?>


<?php include __DIR__ . '/parts/html-head.php' ?>
<style>
    .display_justify_content {
        display: flex;
        justify-content: center;
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
    /* a {
        color: #B79973;
        text-decoration: underline;
    } */
    .page-link{
        color: #B79973;
    }
    body {
        background-color: #CAAD87;
        background-size: cover;
        opacity: 0.9;
    }
    
</style>


<div class="display_justify_content" style="height: 500px; width:1200px;margin-top:25px; margin:20px auto;" >
    <table class="table table-striped" >
        <thead>
            <tr>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius: 20px 0 0 0;">會員帳號</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">狀態</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">獲得積分</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius:0 20px 0 0 ;">時間</th>
            </tr>
        </thead>
        <tbody class="bg">
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td><?= $r['member_account'] ?></td>
                    <td><?= $r['type'] ?></td>
                    <td><?= $r['points_get'] ?></td>
                    <td><?= $r['create_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="row  display_justify_content" style="margin:20px auto;width:300px;">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
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

<?php include __DIR__ . '/parts/scripts.php' ?>
<?php include __DIR__ . '/parts/html-foot.php' ?>
