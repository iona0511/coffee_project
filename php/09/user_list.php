<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

$pageName = 'user_list';
$title = '會員資料';

$perPage = 5;


$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM `member`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage); 

$rows = [];

if( $totalRows > 0){
    if( $page > $totalPages ){
        header("Location: ?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM member LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}
?>


<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar_admin.php'?>

<style>

body{
    background-color: #B79973;
}
.tableBox{
    background-color: white;
    margin-top: 150px;
    margin-bottom: 100px;
    line-height: 3rem;
}

.btnG{
    position: relative;
    left: 43%;
}
.container{
    padding: 0;
    border-radius: 20px 20px 0 0;
}
a{
    color: #B79973;
}
.page-link{
    color: #B79973;
}
.page-link:hover{
    color: #B79973;
}
.page-item.active .page-link{
    background-color: #B79973;
    border-color: #B79973;
}

</style>

<div class="container tableBox">

    <table class="table table-striped">
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
                <th scope="col">點數</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td>                        
                    <div class="trash_img">
                        <a style="width:30px;height:30px;" href="javascript: delete_it(2)">
                            <img class="a1" style="width:25px ;" src="./copon_img/6154713uV6k8WyP.gif" alt="">
                            <img class="b1" style="width:24px ;" src="./copon_img/nnihi123-removebg-preview.png" alt="">
                        </a>
                        </div>
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
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<div class="row container btnG">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?= $page==1 ? 'disable' : '' ?>">                 
                        <a class="page-link" href="?page=1">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>
                    <li class="page-item $page==1 ? 'disable' : '' ?> ">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-angle-left"></i>
                        </a>
                    </li>

                    <?php for( $i = $page-5  ; $i <= $page + 5 ; $i++ ):
                        if ($i >= 1 and $i <= $totalPages) : ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"> <?= $i  ?></a>
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



<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    function delete_it(sid){
        if(confirm(`確定要刪除編號為${sid}的資料嗎？`)){
            location.href = `delete.php?member_sid=${sid}`;

        }
    }
</script>



<?php include __DIR__ . '/parts/html-foot.php' ?>