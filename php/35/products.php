<?php
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';


if (!isset($_SESSION['user']['admin_account'])){
    header('Location:/coffee_project/php/09/admin-login.html');
    exit;
}

$pageName = 'product';
$title = '商品列表';

//每一頁最多有幾筆
$perPage = 2;

// 用戶要看第幾頁
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$t_sql = "SELECT count(1) FROM products";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];
$totalPages = ceil($totalRows / $perPage);
//總共有幾頁, 這邊要無條件進位

$rows = [];
if ($totalRows > 0) {
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }
    $sql = sprintf("SELECT * FROM`products`
                JOIN `products_categroies` 
                    ON`products`.`products_with_products_categroies_sid` = `products_categroies`.`products_categroies_sid`
                JOIN `products_pic` 
                    ON`products`.`products_sid` = `products_pic`.`products_pic_sid`
                JOIN `products_style_filter`
                    ON`products`.`products_with_products_style_filter_sid` = `products_style_filter`.`products_style_filter_sid`
                ORDER BY products_sid ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}

?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-head.php' ?>
<style>
    .products_nav_btn {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0px;
        margin-top: 10px;
    }

    .products_single_img {
        width: 100px;
        height: 100px;
    }

    .products_multi_img {
        width: 100px;
        height: 100px;
    }



</style>

<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar_admin.php' ?>

<style>
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
        color: rgb(255, 255, 255);
        background: rgb(51, 51, 51);
        /* margin: 40px 0px 0px; */
        /* width: 100%; */
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

    .products_page a {
        text-decoration: none;
    }

    .products_page a:hover {
        background-color: #B2ADAA;
        text-decoration: none;
        color: #fff;
    }
</style>

<!-- server side render -->
<section class="products_page">
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example d-flex flex-" class="products_nav_btn">
                <a class="products_add_btn" href="./products_add.php">
                    <button type="button" class="css-8cha5q-SubmitButton">新增</button>
                </a>
            </nav>
        </div>
    </div>

    <div class="display_justify_content" style="height: 500px; width:1200px;margin-top:25px; margin:20px auto;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius: 20px 0 0 0;">#</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">商品編號</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">商品名稱</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">商品簡介</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">商品介紹</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">價格</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">上架中</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">特價中</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">庫存</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">商品分類</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">商品圖片(商品頁)</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">商品圖片(詳細頁)</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">商品風格</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius:0 20px 0 0 ;">修改</th>
                </tr>
            </thead>
            <tbody class="bg">
                <?php foreach ($rows as $r) : ?>
                    <tr>
                        <td><?= htmlentities($r['products_sid']) ?></td>
                        <td><?= $r['products_number'] ?></td>
                        <td><?= htmlentities($r['products_name']) ?></td>
                        <td><?= htmlentities($r['products_introduction']) ?></td>
                        <td><?= htmlentities($r['products_detail_introduction']) ?></td>
                        <td><?= $r['products_price'] ?></td>
                        <td><?= $r['products_forsale'] ? '是' : '否'; ?></td>
                        <td><?= $r['products_onsale'] ? '是' : '否'; ?></td>
                        <td><?= $r['products_stocks'] ?></td>
                        <td><?= $r['products_categroies_name'] ?></td>
                        <td><img class="products_single_img" src="
                            <?php if ($r['products_pic_one']) : echo '/../../coffee_project/images/35/' . $r['products_pic_one'];
                            endif; ?>" <?php if (!$r['products_pic_one']) : echo "style" . "=" . "display:none;" ?> <?php endif; ?> alt="" id="products_pic_one" title="<?= $r['products_pic_one'] ?>" /></td>
                        <td class="d-flex"> <?php $multiPic =  explode(",", $r['products_pic_multi']) ?>
                            <?php for ($i = 0; $i < count($multiPic); $i++) : ?>
                                <img class="products_multi_img" src="<?= '/../../coffee_project/images/35/' . $multiPic[$i] ?>" alt="" id="<?= "products_pic_multi" . $i ?>" title="<?= $r['products_pic_multi'] ?>" />
                            <?php endfor; ?>
                        </td>
                        <td><?= $r['products_style_filter_categroies'] ?></td>
                        <td>
                            <div class="edit_img">
                                <a href="products_edit.php?products_sid=<?= $r['products_sid'] ?>">
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
</section>
    <?php include dirname(dirname(__DIR__, 1)) . '/parts/scripts.php' ?>
    <script>
        function delete_it(sid) {
            alert('onwork');
        }
    </script>
    <?php include dirname(dirname(__DIR__, 1)) . '/parts/html-foot.php' ?>