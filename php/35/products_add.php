<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';


if (!isset($_SESSION['user']['admin_account'])){
    header('Location:/coffee_project/php/09/admin-login.html');
    exit;
}


$pageName = 'products-add';
$title = '新增商品';


$row_cate = $pdo->query("SELECT * FROM`products_categroies`")->fetchAll();
$row_pic = $pdo->query("SELECT * FROM`products_pic`")->fetchAll();
$row_style = $pdo->query("SELECT * FROM`products_style_filter`")->fetchAll();
?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-head.php' ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar_admin.php' ?>
<style>
    .form-control.red {
        border: 1px solid red;
    }

    .form-text.red {
        color: red;
    }

    .single-img {
        width: 100px;
        height: 100px;
        display: none;

    }

    #multiDiv img {
        width: 100px;
        height: 100px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>
                    <form name="form1" onsubmit="sendData(); return false;" novalidate>
                        <div class="mb-3">
                            <label for="products_name" class="form-label">商品名稱</label>
                            <input type="text" class="form-control" id="products_name" name="products_name" required placeholder="請輸入商品名稱">
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_introduction" class="form-label">商品簡介</label>
                            <input type="products_introduction" class="form-control" id="products_introduction" name="products_introduction" placeholder="商品簡介">
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_detail_introduction" class="form-label">商品詳細介紹</label>
                            <textarea class="form-control" name="products_detail_introduction" id="products_detail_introduction" cols="30" rows="3"></textarea>
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_price" class="form-label">價錢</label>
                            <input type="number" class="form-control" id="products_price" name="products_price">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_forsale" class="form-label">是否販賣中</label><br>
                            <input type="radio" id="products_forsale" name="products_forsale" value="1" checked>
                            <label for="products_forsale">是</label>
                            <input type="radio" id="products_forsale" name="products_forsale" value="0">
                            <label for="products_forsale">否</label>
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_onsale" class="form-label">是否有特價</label><br>
                            <input type="radio" id="products_onsale" name="products_onsale" value="1" checked>
                            <label for="products_onsale">是</label>
                            <input type="radio" id="products_onsale" name="products_onsale" value="0">
                            <label for="products_onsale">否</label>
                        </div>

                        <div class="mb-3">
                            <label for="products_stocks" class="form-label">商品庫存</label>
                            <input type="number" class="form-control" id="products_stocks" name="products_stocks">
                            <div class="form-text"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_with_products_categroies_sid" class="form-label">商品分類</label>
                            <select name="products_with_products_categroies_sid" id="products_with_products_categroies_sid">
                                <option value="1">-- 請選擇 --</option>
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
                            <img class="single-img" src="" alt="" id="products_pic_one" />
                        </div>

                        <div class="mb-3">
                            <label for="products_pic_multi" class="form-label">商品圖片(詳細頁)</label><br>
                            <input type="file" name="products_pic_multi[]" accept="image/*" onchange="changeMultiImg(event)" multiple />
                            <div id="multiDiv" class="multiDiv"></div>
                        </div>

                        <div class="mb-3">
                            <label for="products_with_products_style_filter_sid" class="form-label">商品風格</label>
                            <select name="products_with_products_style_filter_sid" id="products_with_products_style_filter_sid">
                                <option value="1">-- 請選擇 -- </option>
                                <?php foreach ($row_style as $r) : ?>
                                    <option value="<?= $r['products_style_filter_sid'] ?>">
                                        <?= $r['products_style_filter_categroies'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">新增</button>
                        <a href="products.php">
                            <button type="button" class="btn btn-primary">取消</button>
                        </a>
                    </form>
                    <div id="info_bar" class="alert alert-success" role="alert" style="display:none;">
                        資料新增成功
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/scripts.php' ?>
<script>
    const info_bar = document.querySelector('#info_bar');
    const name_f = document.form1.products_name;

    const fields = [name_f];
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
            // console.log(reader.result);
            document.querySelector("#products_pic_one").style.display = 'block';
            document.querySelector("#products_pic_one").src = reader.result;
        };
        reader.readAsDataURL(file);
    }



    function changeMultiImg() {
        if (event.currentTarget.files.length = 3) {
            for (i = 0; i < event.currentTarget.files.length; i++) {
                let file = event.currentTarget.files[i];
                console.log(file);
                let reader = new FileReader();
                let idName = `#products_pic_multi${i}`;
                // let imgSet = document.querySelector("#multiDiv");
                // wrap.innerHTML = '';
                // 資料載入後 (讀取完成後)
                // console.log(reader.result);
                reader.onload = function() {
                    // console.log(reader.result);
                    // console.log(document.querySelector(idName));
                    const r = reader.result
                    let newImg = document.createElement("div");
                    newImg.innerHTML = `<img src="${r}"/>`
                    document.getElementById("multiDiv").appendChild(newImg);
                    // document.querySelector(idName).style.display = 'block';
                    // document.querySelector(idName).src = reader.result;
                };
                reader.readAsDataURL(file);
            };
        } else {
            alert('圖片請上傳3張');
        }
    }



    async function sendData() {
        // 當格式正確後讓欄位的外觀回復原來的狀態
        for (let i in fields) {
            fields[i].classList.remove('red');
            fieldTexts[i].innerText = '';
        }
        info_bar.style.display = 'none'; // 都沒有時先隱藏訊息列


        // TODO: 1.檢查欄位, 前端的檢查 2.取表單內容
        let isPass = true; // 預設是通過檢查

        if (!isPass) {
            return; // 結束函式
        }

        const fd = new FormData(document.form1);
        const r = await fetch('products_add_api.php', {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
        info_bar.style.display = 'block'; // 顯示訊息列
        if (result.success) {
            info_bar.classList.remove('alert-danger');
            info_bar.classList.add('alert-success');
            info_bar.innerText = '新增成功';

            // setTimeout(() => {
            // location.href = 'products.php'; // 跳轉到列表頁
            // }, 2000);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料無法新增';
        }

    }
</script>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-foot.php' ?>