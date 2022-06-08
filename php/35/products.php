<?php 
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';


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
    /* .products_add_btn {
        display: flex;
        justify-content: flex-end;
    } */
    .products_nav_btn{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0px;
        margin-top: 10px;
    }
    .products_single_img{
        width: 100px;
        height: 100px;
    }
    .products_multi_img{
        width: 100px;
        height: 100px;
    }
</style>

<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar_admin.php' ?>

<!-- server side render -->
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example" class="products_nav_btn">
                <ul class="pagination">

                    <!-- php寫在class裡面, 讓使用者按頁術限定在1到最大頁面之間 -->
                    <li class="page-item <?= $page == 1 ? 'disabled' : ''; ?>"><a class="page-link" href="?page=1">
                            <i class="fa-solid fa-angles-left"></i>
                        </a></li>
                    <li class="page-item <?= $page == 1 ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?= $page - 1 ?>"><i class="fa-solid fa-angle-left"></i></a></li>

                    <?php for ($i = $page - 3; $i <= $page + 3; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>

                            <li class="page-item <?= $page == $i ? 'active ' : ''; ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>

                    <?php endif;
                    endfor; ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : ''; ?>"><a class="page-link" href="?page=<?= $page + 1 ?>"><i class="fa-solid fa-angle-right"></i></a></li>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : ''; ?>">
                        <a class="page-link" href="?page=<?= $totalPages ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                </ul>

                <a class="products_add_btn" href="./products_add.php">
                    <button type="button" class="btn btn-primary">新增</button>
                </a>
            </nav>
        </div>
    </div>


    <table class="table table-success table-striped">
        <thead>
            <tr>
                <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                <th scope="col">#</th>
                <th scope="col">商品編號</th>
                <th scope="col">商品名稱</th>
                <th scope="col">商品簡介</th>
                <th scope="col">商品介紹</th>
                <th scope="col">價格</th>
                <th scope="col">上架中</th>
                <th scope="col">特價中</th>
                <th scope="col">庫存</th>
                <th scope="col">商品分類</th>
                <th scope="col">商品圖片(商品頁)</th>
                <th scope="col">商品圖片(詳細頁)</th>
                <th scope="col">商品風格</th>
                <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $r) : ?>
                <tr>
                    <td>
                        <?php /*    
                    <a href="ab-delete.php?sid=<?= $r['sid'] ?>" onclick="return comfirm('確定要刪除編號為<?= $r['sid'] ?>的資料嗎?'">
                    */ ?>
                        <a href="javascript: delete_it(<?= $r['products_sid'] ?>)">
                            <i class=" fa-solid fa-trash-can"></i>
                        </a>
                    </td>
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
                    <td> <?php $multiPic =  explode(",", $r['products_pic_multi']) ?>
                        <?php for ($i = 0; $i < count($multiPic); $i++) : ?>
                            <img class="products_multi_img" src="<?= '/../../coffee_project/images/35/' . $multiPic[$i] ?>" alt="" id="<?= "products_pic_multi" . $i ?>" title="<?= $r['products_pic_multi'] ?>" />
                        <?php endfor; ?>
                    </td>
                    <td><?= $r['products_style_filter_categroies'] ?></td>
                    <td><a href="products_edit.php?products_sid=<?= $r['products_sid'] ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include dirname(dirname(__DIR__, 1)) . '/parts/scripts.php' ?>
<script>
    function delete_it(sid) {
        alert('onwork');
    }
</script>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-foot.php' ?>