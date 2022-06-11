<?php require dirname(__DIR__, 2) . '/parts/connect_db.php';
// session_start();

// if (!isset($_SESSION['user']['admin_account'])) {
//     header('Location:/coffee_project/php/09/admin-login.html');
//     exit;
// }

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

    .a{
        border: 1px solid rgb(156,121,93);
    }
    .b{
        background: rgb(61,52,41);
        color:bisque;
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
<!-- 
                        <div class="mb-3">
                            <label for="menu_photo" class="form-label">圖片</label>
                            <input type="text" class="form-control" id="menu_photo" name="menu_photo" value="<?=$row['menu_photo']?>">
                            <div class="form-text red"></div>
                        </div>
 -->

<!-- 
                        <div class="mb-3">
                            <label for="menu_photo" class="form-label ">餐點圖片</label>
                            <!-- <div><img src="" id="myimg" ></div> -->

                            <!-- <input type="file" class="form-control btn btn-outline-secondary" id="menu_photo" name="menu_photo" accept="image/*" onchange="showphoto()" multiple>  
                            <div class="form-text red"></div>
                            <div id="preview"></div>

                            <!-- onclick="uploadphoto() -->
                            <!-- <div class="form-text red"></div>
                        </div> --> 




                        
                        <!-- <div class="mb-3">
                            <label for="menu_photo" class="form-label ">餐點圖片</label>

                            <input type="file" class="form-control btn btn-outline-secondary" id="menu_photo" name="menu_photo" accept="image/*" onchange="showphoto()" multiple>  
                            <div class="form-text red"></div>
                            <div id="preview"></div>

                            <div class="form-text red"></div>
                        </div> -->

                        <div class="mb-3">
                            <label for="menu_photo" class="form-label">餐點圖片</label><br>
                            <input type="file" name="menu_photo[]" accept="image/*" onchange="changeOneImg(event)" value="<?= '../../images/11/' . $row['menu_photo'] ?>" />
                            <div class="form-text"></div>
                            <img style="width:100px" class="single-img" src="
                            <?php if ($row['menu_photo']) : 
                            echo '../../images/11/' . $row['menu_photo'];
                            endif; ?>" 
                            <?php if (!$row['menu_photo']) : 
                            echo "style" . "=" . "display:none;" ?>
                            <?php endif; ?> alt="" id="menu_photo" />
                        </div> 



                        
                        <!-- <div class="mb-3">
                            <label for="menu_photo" class="form-label">餐點圖片</label><br>
                            <input type="file" name="menu_photo" accept="image/*" onchange="changeOneImg(event)" />
                            <div class="form-text"></div>
                            <img style="width:100px" class="single-img" src="
                            <?php if ($row['menu_photo']) : 
                            echo '/coffee_project/images/11/' . $row['menu_photo'];
                            endif; ?>" 
                            <?php if (!$row['menu_photo']) : 
                            echo "style" . "=" . "display:none;" ?>
                            <?php endif; ?> alt="" id="menu_photo" />
                        </div> -->







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

                        <button type="button" class="btn a">
                            <a href="./menu_edit.php" style="text-decoration:none;color:rgb(60,40,35)">取消</a>
                        </button>
                        <button type="submit" class="btn b">送出</button>

                      


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
        
    };


    function changeOneImg() {
        const file = event.currentTarget.files[0];
        console.log(file);
        const reader = new FileReader();

        // 資料載入後 (讀取完成後)
        reader.onload = function() {
            console.log(reader.result);
            document.querySelector("#menu_photo").style.display = 'block';
            document.querySelector("#menu_photo").src = reader.result;
        };
        reader.readAsDataURL(file);
    }





    async function sendData() {
        // 讓欄位的外觀回復原來的狀態
        // for (let i in fields) {
        //     fields[i].classList.remove('red');
        //     console.log('fieldTexts ', fieldTexts)
        //     // console.log('i  ', i)
        //     fieldTexts[i].innerText = '';

        // }
        info_bar.style.display = 'none'; // 隱藏訊息列

        // TODO: 欄位檢查, 前端的檢查
        let isPass = true; // 預設是通過檢查的


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
            }, 1000);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料沒有修改';
        }

    }
    



</script>



<?php include dirname(__DIR__, 2) . '/parts/html-foot.php' ?>












