<?php 
require __DIR__ . '/parts/connect_db.php';
// require dirname(__DIR__,2) . '/parts/connect_db.php';
// session_start();

if (!isset($_SESSION['user']['admin_account'])){
    header('Location:/coffee_project/php/09/admin-login.html');
    exit;
}

$pageName = 'points_record_list';
$title = '優惠券管理頁面';
$perPage = 5;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = sprintf("SELECT COUNT(1)FROM`coupon`");

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; 

$totalPages = ceil($totalRows / $perPage); 

// ==================== page ============================
$rows = [];

if ($totalRows > 0) {
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }
    $sql = sprintf("SELECT * FROM `coupon` LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    
    $rows = $pdo->query($sql)->fetchAll();
}


?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar_admin.php' ?>

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
    .page-link{
        color: #B79973;
    }
    body {
        background-color: #CAAD87;
        background-size: cover;
        opacity: 0.9;
    }

    .trash_img a .a1{
        display: none;
    }
    .trash_img a .b1{
        display: block;
    }
    .trash_img a:hover .a1{
        display: block;
    }
    .trash_img a:hover .b1{
        display: none;
    }

    .edit_img a .c1{
        display: none;
    }
    .edit_img a .d1{
        display: block;
    }
    .edit_img a:hover .c1{
        display: block;
    }
    .edit_img a:hover .d1{
        display: none;
    }
    .css-8cha5q-SubmitButton {
    color: rgb(255, 255, 255);
    background: rgb(51, 51, 51);
    font-size: 14px;
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
    a{
        text-decoration: none;
    }
    a:hover{
        background-color: #B2ADAA;
        text-decoration: none;
        color: #fff;
    }

</style>

<div class="display_justify_content" style=" margin:20px auto;font-size:24px;">優惠券管理</div>
<div class="display_justify_content" style="width:100px; margin:5px auto;font-size:12px;">
    <a type="submit" class="css-8cha5q-SubmitButton" href="/coffee_project/php/41/coupon_record_add.php">新增</a>
</div>
<div class="display_justify_content" style="height: 500px; width:1200px;margin-top:25px; margin:20px auto;" >
    <table class="table table-striped" >
        <thead>
            <tr>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius: 20px 0 0 0;"><i class="fa-solid fa-trash-can"></i></th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">優惠券編號</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">優惠券名稱</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">優惠券發放類別</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">優惠券折扣類別</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">優惠券金額</th>

                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">餐點編號</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">產品編號</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">類別</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">優惠券有效期限</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">優惠券開放狀態</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius:0 20px 0 0 ;"></th>
            </tr>
        </thead>
        <tbody class="bg">
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td>
                        <div class="trash_img" >
                        <a style="width:30px;height:30px;"  href="javascript: delete_it(<?= $r['sid'] ?>)" >
                            <img class="a1" style="width:24px ;" src="./copon_img/6154713uV6k8WyP.gif" alt="">
                            <img class="b1" style="width:24px ;" src="./copon_img/nnihi123-removebg-preview.png" alt="">
                        </a>
                        </div>
                    </td>
                    <td><?= $r['sid'] ?></td>
                    <td><?= $r['coupon_name'] ?></td>
                    <td><?= $r['coupon_send_type'] ?></td>
                    <td><?= $r['coupon_setting_type'] ?></td>
                    <td><?= $r['coupon_money'] ?></td>
                    <td><?= $r['menu_sid'] ?></td>
                    <td><?= $r['products_sid'] ?></td>
                    <td><?= $r['type'] ?></td>
                    <td><?= $r['coupon_validity_period'] ?></td>
                    <td><?= $r['coupon_status'] ?></td>
                    <td>
                        <div class="edit_img" >
                        <a style="width:30px;height:30px;" class="edit_img" href="coupon_record_edit.php?sid=<?= $r['sid'] ?>">
                            <img class="c1" style="width:24px; " src="./copon_img/6154151jyaaGIbA.gif" alt="">
                            <img class="d1" style="width:24px; " src="./copon_img/nnneji90-removebg-preview.png" alt="">
                        </a>
                        </div>
                    </td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="row  display_justify_content" style="margin:20px auto;width:300px;">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination display_justify_content"  >
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
    <script>
        function delete_it(sid) {
        if (confirm(`確定要刪除編號為 ${sid} 的資料嗎?`)) {
            location.href = `coupon_record_delete.php?sid=${sid}`; //去執行delete，再回來
        }
    }

    </script>
<?php include __DIR__ . '/parts/html-foot.php' ?>