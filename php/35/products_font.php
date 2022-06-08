<?php
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
if (!isset($_SESSION)) {
    session_start();
}

$pageName = 'product';
$title = '商品列表';

//每一頁最多有幾筆
$perPage = 6;

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
                WHERE `products`.`products_forsale` != 0
                ORDER BY products_sid ASC LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    $rows = $pdo->query($sql)->fetchAll();
}


?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-head.php' ?>
<style>

</style>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar.php' ?>
<section>
    <nav aria-label="Page navigation example" class="products_nav_btn">
        <div class="container d-flex justify-content-center">

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
        </div>

    </nav>
    <div class="container">
        <div class="row">
            <div class="col-8 d-flex flex-wrap justify-content-around">
                <?php foreach ($rows as $r) : ?>
                    <div class="card col-4 py-3 my-2" style="width: 18rem;">

                        <img class="card-img-top" src="
                                        <?php if ($r['products_pic_one']) : echo '/../../coffee_project/images/35/' . $r['products_pic_one'];
                                        endif; ?>" <?php if (!$r['products_pic_one']) : echo "style" . "=" . "display:none;" ?> <?php endif; ?> alt="" id="products_pic_one" title="<?= $r['products_pic_one'] ?>" />

                        <div class="card-body">

                            <h5 class="card-title"><?= $r['products_name'] ?></h5>

                            <p class="card-text"><?= $r['products_introduction'] ?></p>

                            <p class="card-text">價錢: <?= $r['products_price'] ?></p>

                            <div class="d-flex">

                                <i class="fa-solid fa-minus" onclick="minus_number()" style="margin-left:20px;margin-right:20px; cursor: pointer;"></i>

                                <p class="plus_minus_number" name="plus_minus_number<?= $r['products_sid'] ?>">1</p>

                                <i class="fa-solid fa-plus" onclick="plus_number()" style="margin-left:20px;margin-right:20px; cursor: pointer;"></i>

                            </div>

                            <form action="" name="form2" onsubmit="sendData();return false;">
                                <input type="hidden" name="products_sid" value="<?= $r['products_sid'] ?>">
                                <input type="hidden" name="products_name" value="<?= $r['products_name'] ?>">
                                <input type="hidden" name="products_price" value="<?= $r['products_price'] ?>">
                                <input type="hidden" name="products_pic_one" value="<?= $r['products_pic_one'] ?>">
                                <input type="hidden" name="products_onsale" value="<?= $r['products_onsale'] ?>">
                                <input type="hidden" name="products_stocks" value="<?= $r['products_stocks'] ?>">
                                <input type="hidden" name="products_buy_count" class="products_buy_count" value="1">

                                <button type="submit" class="addtocart_button" style="width:100%;height:30px;background-color:rgb(248, 179, 5);text-align:center;border-radius:10px;" id="add_to_cart">加入購物車</button>
                            </form>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="card col" id="products_cart">
                <?php
                if (isset($_SESSION['products_order'])) :
                    echo implode(",", $_SESSION['products_order']);
                else :
                    echo '';
                endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
    function plus_number() {
        let x = event.currentTarget.closest("div").querySelector("p").innerHTML;
        let buyCount = event.currentTarget.closest(".card-body").querySelector(".products_buy_count")
        x = parseInt(x) + 1;
        event.currentTarget.closest("div").querySelector("p").innerHTML = x;
        console.log("x", x);
        buyCount.value = x;
    }

    function minus_number() {
        let x = event.currentTarget.closest("div").querySelector("p").innerHTML;
        let buyCount = event.currentTarget.closest(".card-body").querySelector(".products_buy_count")
        if (x > 1) {
            x = parseInt(x) - 1;
            event.currentTarget.closest("div").querySelector("p").innerHTML = x;
            buyCount.value = x;
        }
        console.log("x1", x);
    }

    function sendToArray() {

    }

    async function sendData() {
        const fd = new FormData(event.currentTarget.closest("form"));
        const r = await fetch('products_session_api.php', {
            method: 'POST',
            body: fd,
        });
        const productsCart = document.querySelector("#products_cart")
        const result = await r.json();
        productsCart.innerHTML += result + "</br>";
        console.log(result);

    }
</script>

<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-foot.php' ?>