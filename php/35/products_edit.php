<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
$pageName = 'products_edit';
$title = '編輯商品資料';

$products_sid = isset($_GET['products_sid']) ? intval($_GET['products_sid']) : 0;
if (empty($products_sid)) {
    header('Location: products.php');
    exit;
}

$row = $pdo->query("SELECT * FROM`products`
                    JOIN `products_categroies` 
                        ON`products`.`products_with_products_categroies_sid` = `products_categroies`.`products_categroies_sid`
                    JOIN `products_pic` 
                        ON`products`.`products_with_products_pic` = `products_pic`.`products_pic_sid`
                    JOIN `products_style_filter`
                        ON`products`.`products_with_products_style_filter_sid` = `products_style_filter`.`products_style_filter_sid`
                    WHERE products_sid=$products_sid")->fetch();
$row_cate = $pdo->query("SELECT * FROM`products_categroies`")->fetchAll();
$row_pic = $pdo->query("SELECT * FROM`products_pic`")->fetchAll();
$row_style = $pdo->query("SELECT * FROM`products_style_filter`")->fetchAll();

if (empty($row)) {
    header('Location: products.php');
    echo "console.log('a')";
    exit;
}



?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-head.php' ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar.php' ?>
<style>
    .form-control.red {
        border: 1px solid red;
    }

    .form-text.red {
        color: red;
    }

    .single-img {
        width: 320px;
        height: 320px;
        /* display: none; */
    }

    .multi-img {
        width: 320px;
        height: 320px;
        /* display: none; */
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯資料</h5>
                    <form name="form1" onsubmit="sendData();return false;" novalidate>
                        <input type="hidden" name="products_sid" value="<?= $row['products_sid'] ?>">

                        <div class="mb-3">
                            <label for="products_name" class="form-label">商品名稱</label>
                            <input type="text" class="form-control" id="products_name" name="products_name" required value="<?= htmlentities($row['products_name']) ?>">
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_introduction" class="form-label">商品簡介</label>
                            <input type="products_introduction" class="form-control" id="products_introduction" name="products_introduction" value="<?= $row['products_introduction'] ?>">
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_detail_introduction" class="form-label">商品詳細介紹</label>
                            <textarea class="form-control" name="products_detail_introduction" id="products_detail_introduction" cols="30" rows="3"><?= htmlentities($row['products_detail_introduction']) ?></textarea>
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_price" class="form-label">價錢</label>
                            <input type="number" class="form-control" id="products_price" name="products_price" value="<?= $row['products_price'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_forsale" class="form-label">是否販賣中</label>

                            <input type="radio" id="products_forsale" name="products_forsale" value="1" <?= $row['products_forsale'] == 1 ? 'checked' : ''; ?>>
                            <label for="products_onsale">是</label>
                            <input type="radio" id="products_forsale" name="products_forsale" value="0" <?= $row['products_forsale'] == 0 ? 'checked' : ''; ?>>
                            <label for="products_onsale">否</label>

                        </div>

                        <div class="mb-3">
                            <label for="products_onsale" class="form-label">是否有特價</label>

                            <input type="radio" id="products_onsale" name="products_onsale" value="1" <?= $row['products_onsale'] == 1 ? 'checked' : ''; ?>>
                            <label for="products_onsale">是</label>
                            <input type="radio" id="products_onsale" name="products_onsale" value="0" <?= $row['products_onsale'] == 0 ? 'checked' : ''; ?>>
                            <label for="products_onsale">否</label>

                        </div>

                        <div class="mb-3">
                            <label for="products_stocks" class="form-label">商品庫存</label>
                            <input type="number" class="form-control" id="products_stocks" name="products_stocks" value="<?= $row['products_stocks'] ?>">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_with_products_categroies_sid" class="form-label">商品分類</label>
                            <select name="products_with_products_categroies_sid" id="products_with_products_categroies_sid">
                                <option value="" selected disabled>-- 請選擇 --</option>
                                <?php foreach ($row_cate as $r) : ?>
                                    <option value="<?= $r['products_categroies_sid'] ?>">
                                        <?= $r['products_categroies_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="products_pic_one" class="form-label">商品圖片(商品頁)</label><br>
                            <input type="file" name="products_pic_one[]" accept="image/*" onchange="changeOneImg(event)" />
                            <div class="form-text"></div>
                            <img class="single-img" src="
                            <?php if ($row['products_pic_one']) : echo '/coffee_project/images/35/' . $row['products_pic_one'];
                            endif; ?>" <?php if (!$row['products_pic_one']) : echo "style" . "=" . "display:none;" ?> <?php endif; ?> alt="" id="products_pic_one" />
                        </div>

                        <div class="mb-3" id="multiDiv">
                            <label for="products_pic_multi" class="form-label">商品圖片(詳細頁)</label><br>
                            <input type="file" name="products_pic_multi[]" accept="image/*" onchange="changeMultiImg(event)" multiple />
                            <?php $multiPic =  explode(",", $row['products_pic_multi']) ?>
                            <?php for ($i = 0; $i < count($multiPic); $i++) : ?>
                                <img class="multi-img" src="<?= '/coffee_project/images/35/' . $multiPic[$i] ?>" alt="" id="<?= "products_pic_multi" . $i ?>" />
                            <?php endfor; ?>
                        </div>

                        <div class="mb-3">
                            <label for="products_with_products_style_filter_sid" class="form-label">商品風格</label>
                            <select name="products_with_products_style_filter_sid" id="products_with_products_style_filter_sid">
                                <option value="" selected disabled>-- 請選擇 -- </option>
                                <?php foreach ($row_style as $r) : ?>
                                    <option value="<?= $r['products_style_filter_sid'] ?>">
                                        <?= $r['products_style_filter_categroies'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">修改</button>
                        <a href="./products.php">
                        <button type="button" class="btn btn-primary">取消</button>
                        </a>
                    </form>
                    <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                        資料編輯成功
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php dirname(dirname(__DIR__, 1)) . '/parts/scripts.php' ?>
<script>
    const row = <?= json_encode($row, JSON_UNESCAPED_UNICODE); ?>;


    const info_bar = document.querySelector('#info-bar');
    const name_f = document.form1.products_name;
    const price_f = document.form1.products_price;
    const forsale_f = document.form1.products_forsale;

    const fields = [name_f, price_f, forsale_f];
    const fieldTexts = [];
    for (let f of fields) {
        fieldTexts.push(f.nextElementSibling);
    }


    function changeOneImg() {
        const file = event.currentTarget.files[0];
        console.log(file);
        const reader = new FileReader();

        // 資料載入後 (讀取完成後)
        reader.onload = function() {
            console.log(reader.result);
            document.querySelector("#products_pic_one").style.display = 'block';
            document.querySelector("#products_pic_one").src = reader.result;
        };
        reader.readAsDataURL(file);
    }

    function changeMultiImg() {
        if (event.currentTarget.files.length <= 3) {
            for (i = 0; i < event.currentTarget.files.length; i++) {
                let file = event.currentTarget.files[i];
                console.log(file);
                let reader = new FileReader();
                let idName = `#products_pic_multi${i}`;
                // wrap.innerHTML = '';
                // 資料載入後 (讀取完成後)
                // console.log(reader.result);
                reader.onload = function() {
                    // console.log(reader.result);
                    // console.log(document.querySelector(idName));
                    document.querySelector(idName).style.display = 'block';
                    document.querySelector(idName).src = reader.result;
                };
                reader.readAsDataURL(file);
            };
        } else {
            alert('圖片上限3張');
        }
    }


    async function sendData() {
        // 讓欄位的外觀回復原來的狀態
        // for (let i in fields) {
        //     fields[i].classList.remove('red');
        //     fieldTexts[i].innerText = '';
        // }
        info_bar.style.display = 'none'; // 隱藏訊息列

        // // TODO: 欄位檢查, 前端的檢查
        let isPass = true; // 預設是通過檢查的

        // if (name_f.value.length < 2) {
        //     fields[0].classList.add('red');
        //     fieldTexts[0].innerText = '商品名稱至少兩個字';
        //     isPass = false;
        // }

        if (!isPass) {
            return; // 結束函式
        }

        const fd = new FormData(document.form1);
        const r = await fetch('products_edit_api.php', {
            method: 'POST',
            body: fd,
        });

        const result = await r.json();
        console.log(result);
        info_bar.style.display = 'block';
        if (result.success) {
            info_bar.classList.remove('alert-danger');
            info_bar.classList.add('alert-success');
            info_bar.innerText = '修改成功';

            setTimeout(() => {}, 2000);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料沒有修改';
        }

    }
</script>
<?php dirname(dirname(__DIR__, 1)) . '/parts/html-foot.php' ?>