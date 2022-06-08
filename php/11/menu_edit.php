<?php require dirname(__DIR__, 2) . '/parts/connect_db.php';
$pageName = 'menu_edit';
$title = '修改餐點資料';


$menu_sid = isset($_GET['menu_sid']) ? intval($_GET['menu_sid']) : 0;
if (empty($menu_sid)) {
    header('Location: menu_list.php');
    exit;
}

$row = $pdo->query("SELECT * FROM menu WHERE menu_sid = $menu_sid")->fetch();
if (empty($row)) {
    header('Location: menu_list.php');
    exit;
}




?>
<?php include dirname(__DIR__, 2) . '/parts/html-head.php' ?>
<?php include dirname(__DIR__, 2) . '/parts/navbar_admin.php' ?>
<style>
    .form-control.red {
        border: 1px solid red;
    }

    .form-text.red {
        color: red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">編輯餐點資料</h5>
                    <form name="form1" onsubmit="sendData();return false;novalidate">
                    <input type ="hidden" name="menu_sid" value="<?=$row['menu_sid']?>">
                        <div class="mb-3">
                            <label for="menu_categories" class="form-label">種類</label>
                            <input type="text" class="form-control" id="menu_categories" name="menu_categories" required value="<?=$row['menu_categories']?>">
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="menu_photo" class="form-label">圖片</label>
                            <input type="text" class="form-control" id="menu_photo" name="menu_photo" value="<?=$row['menu_photo']?>">
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="menu_name" class="form-label">名稱</label>
                            <input type="text" class="form-control" id="menu_name" name="menu_name" value="<?=$row['menu_name']?>">
                            <div class="form-text red"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="menu_kcal" class="form-label">熱量</label>
                            <input type="text" class="form-control" id="menu_kcal" name="menu_kcal"value="<?=$row['menu_kcal']?>">
                            <div class="form-text"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="menu_price_m" class="form-label">價格</label>
                            <input class="form-control" name="menu_price_m" id="menu_price_m" cols="30" rows="3" value="<?=$row['menu_price_m']?>"></input>
                            <div class="form-text"></div>
                        </div>
                        
                        
                        <div class="mb-3">
                            <label for="menu_nutrition" class="form-label">營養標示資訊</label>
                            <textarea class="form-control" name="menu_nutrition" id="menu_nutrition" cols="30" rows="3"><?=htmlentities($row['menu_nutrition'])?></textarea>
                            <div class="form-text"></div>
                        </div>
                        <!-- htmlentities是為了跳脫字元，strip_tags是為了把內容的tag移除 -->

                        <button type="submit" class="btn btn-primary">編輯</button>
                    </form>
                    <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                        資料編輯成功
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include dirname(__DIR__, 2) . '/parts/scripts.php' ?>



<script>
    const row = <?= json_encode($row, JSON_UNESCAPED_UNICODE); ?>;
    const info_bar = document.querySelector('#info-bar');
    const menu_categories_f = document.form1.menu_categories;
    const menu_photo_f = document.form1.menu_photo;
    const menu_name_f = document.form1.menu_name;
    const menu_kcal_f	= document.form1.menu_kcal;
    const menu_price_m_f = document.form1.menu_price_m;
    const menu_nutrition_f = document.form1.menu_nutrition;

    const fields = [menu_categories_f,menu_photo_f,menu_name_f,menu_kcal_f,menu_price_m_f,menu_nutrition_f];

    const fieldTexts = [];

    // f是拿到fields裡面的參照
    for(let f of fields){
        fieldTexts.push(f.nextElementSibling);
        
    }


    async function sendData() {
        // 讓欄位的外觀回復原來的狀態
        for (let i in fields) {
            fields[i].classList.remove('red');
            console.log('fieldTexts ', fieldTexts)
            // console.log('i  ', i)
            fieldTexts[i].innerText = '';

        }
        info_bar.style.display = 'none'; // 隱藏訊息列

        // TODO: 欄位檢查, 前端的檢查
        let isPass = true; // 預設是通過檢查的

        if (menu_categories_f.value.length < 2) {
            // alert('至少兩個字');
            // name_f.classList.add('red');
            // name_f.nextElementSibling.classList.add('red');
            // name_f.closest('.mb-3').querySelector('.form-text').classList.add('red');
            fields[0].classList.add('red');
            fieldTexts[0].innerText = '姓名至少兩個字';
            isPass = false;
        }
        if (menu_photo_f.value.length< 2) {
            fields[1].classList.add('red');
            fieldTexts[1].innerText = '至少上傳一張照片';
            isPass = false;
        }
        if (menu_name_f.value.length< 2) {
            fields[2].classList.add('red');
            fieldTexts[2].innerText = '姓名至少兩個字';
            isPass = false;
        }
        if (menu_kcal_f.value.length< 2) {
            fields[3].classList.add('red');
            fieldTexts[3].innerText = '姓名至少兩個字';
            isPass = false;
        }
        if (menu_price_m_f.value.length< 2) {
            fields[4].classList.add('red');
            fieldTexts[4].innerText = '姓名至少兩個字';
            isPass = false;
        }
        if (menu_nutrition_f.value.length< 2) {
            fields[6].classList.add('red');
            fieldTexts[6].innerText = '姓名至少兩個字';
            isPass = false;
        }
        if (!isPass) {
            return; // 結束函式
        }

        const fd = new FormData(document.form1);
        const r = await fetch('menu_edit_api.php', {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
        info_bar.style.display = 'block'; // 顯示訊息列
        if (result.success) {
            // success是對應到後端
            info_bar.classList.remove('alert-danger');
            info_bar.classList.add('alert-success');
            info_bar.innerText = '編輯成功';

            setTimeout(() => {
                location.href = 'menu_list.php'; // 跳轉到列表頁
            }, 2000);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料沒有修改';
        }

    }
    



</script>



<?php include dirname(__DIR__, 2) . '/parts/html-foot.php' ?>












