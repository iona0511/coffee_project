<?php require __DIR__ . '/parts/connect_db.php';
$pageName = '';
$title = '';

$perPage = 1; // 每一頁有幾筆

// 用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM member";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 總筆數

$totalPages = ceil($totalRows / $perPage); // 總共有幾頁


if ($totalRows > 0) {
    // 頁碼若超過總頁數
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }

    $sql = ("SELECT * FROM member");
    $rows = $pdo->query($sql);
}

?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<style>




</style>
<?php include __DIR__ . '/parts/navbar.php' ?>

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
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-angle-right"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>


    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                <th scope="col">#</th>
                <th scope="col">姓名</th>
                <th scope="col">暱稱</th>
                <th scope="col">帳號</th>
                <th scope="col">密碼</th>
                <th scope="col">生日</th>
                <th scope="col">手機</th>
                <th scope="col">地址</th>
                <th scope="col">信箱</th>
                <th scope="col">等級</th>
                <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td>                        
                        <a href="javascript: delete_it(<?= $r['sid'] ?>)">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                    <td><?= $r['member_sid'] ?></td>
                    <td><?= htmlentities($r['member_name']) ?></td>
                    <td><?= $r['member_nickname'] ?></td>
                    <td><?= $r['member_account'] ?></td>
                    <td><?= $r['member_password'] ?></td>
                    <td><?= $r['member_birthday'] ?></td>
                    <td><?= $r['member_mobile'] ?></td>
                    <td><?= strip_tags($r['member_address']) ?></td>
                    <td><?= $r['member_mail'] ?></td>
                    <td><?= $r['member_level'] ?></td>
                    <td>
                        <a href="ab-edit.php?sid=<?= $r['sid'] ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>


</div>


<?php include __DIR__ . '/parts/scripts.php' ?>

<script>
    function delete_it(sid) {
        if (confirm(`確定要刪除編號為 ${member_sid} 的資料嗎?`)) {
            location.href = `ab-delete.php?sid=${member_sid}`;
        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>