<?php require __DIR__ . '/parts/connect_db.php';
$pageName = 'menu_add';
$title = '新增菜單資料';

    $items= [
    '經典義式系列'=>'經典義式系列',
    '精品咖啡'=>'精品咖啡',
    '其他飲品'=>'其他飲品',
    '貝果'=>'貝果',
    '瑪芬堡'=>'瑪芬堡',
    '三明治'=>'三明治',
    '口袋歐姆蛋'=>'口袋歐姆蛋',]



?>
<?php include __DIR__ . '/parts/html_menu_head.php' ?>
<?php include __DIR__ . '/parts/navbar.php'  ?>
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
                    <h5 class="card-title">新增菜單資料</h5>
                    <form name="form1" onsubmit="sendData();return false;novalidate" enctype="multipart/form-data">

                            <!-- 如果是是用radio,name要一樣才會是相同的group,id可以不一樣,也要記得下value -->
                        <div class ="mb-3">
                            <label for="" class ="form-label">餐點類別</label>
                            <select class="form-select form-select-lg  mb-3" aria-label=".form-select-lg example" data-multiple name = "menu_categories">
                                <option value = ""selected disabled>--請選擇--</option>       
                                <?php foreach($items as $k => $v):?>
                                <option value="<?=$k?>"><?=$v?></option>
                                
                            <?php endforeach; ?>
                            </select>
                            <div class="form-text red"></div>
                        </div>




                        <!-- <div class="mb-3">
                            <label for="menu_categories" class="form-label">種類</label>
                            <input type="text" class="form-control" id="menu_categories" name="menu_categories" required>
                            <div class="form-text red"></div>
                        </div> -->

                        <div class="mb-3">
                            <label for="menu_photo" class="form-label">餐點圖片</label>
                            <!-- <div><img src="" id="myimg" ></div> -->

                            <input type="file" class="form-control btn btn-outline-secondary" id="menu_photo" name="menu_photo" accept="image/*" onchange="showphoto()" multiple>  
                            <div id="preview"></div>
                        


                            <!-- onclick="uploadphoto() -->
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="menu_name" class="form-label">餐點名稱</label>
                            <input type="text" class="form-control" id="menu_name" name="menu_name">
                            <div class="form-text red"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="menu_kcal" class="form-label">熱量(Kcal)</label>
                            <input type="text" class="form-control" id="menu_kcal" name="menu_kcal">
                            <div class="form-text"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="menu_price_m" class="form-label">價格(M)</label>
                            <input class="form-control" name="menu_price_m" id="menu_price_m" cols="30" rows="3"></input>
                            <div class="form-text"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="menu_price_l" class="form-label">價格(L)</label>
                            <input class="form-control" name="menu_price_l" id="menu_price_l" cols="30" rows="3"></input>
                            <div class="form-text"></div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="menu_nutrition" class="form-label">營養標示資訊</label>
                            <textarea class="form-control" name="menu_nutrition" id="menu_nutrition" cols="30" rows="3"></textarea>
                            <div class="form-text"></div>
                        </div>
                        

                        <button type="submit" class="btn btn-info">新增</button>
                    </form>
                    <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                        資料新增成功
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include __DIR__ . '/parts/scripts.php' ?>



<script>

    const info_bar = document.querySelector('#info-bar');
    const menu_categories_f = document.form1.menu_categories;
    const menu_photo_f = document.form1.menu_photo;
    const menu_name_f = document.form1.menu_name;
    const menu_kcal_f	= document.form1.menu_kcal;
    const menu_price_m_f = document.form1.menu_price_m;
    const menu_price_l_f = document.form1.menu_price_l;
    const menu_nutrition_f = document.form1.menu_nutrition;
    const myimg = document.querySelector('#myimg');
    const fields = [menu_categories_f,menu_photo_f,menu_name_f,menu_kcal_f,menu_price_m_f,menu_price_l_f,menu_nutrition_f];


    // 預覽圖片
    function showphoto() {
    let container = document.querySelector('#preview');
    let files    = document.querySelector('input[type=file]').files;
 
    for (i = 0; i < files.length; i++) {
        const reader  = new FileReader();
        reader.addEventListener("load", function () {
            container.innerHTML += `<img height="200" alt="" src="${reader.result}">`;
        }, false);

        if (files[i]) {
                reader.readAsDataURL(files[i]);
    
        }                       
    }    
};




    const fieldTexts = [];

    // f是拿到fields裡面的參照
    for(let f of fields){
        fieldTexts.push(f.nextElementSibling);
    }
    console.log(fieldTexts)


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

        if (menu_categories_f.value.length < 1) {
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
            fieldTexts[1].innerText = '尚未上傳照片';
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
        if (menu_price_l_f.value.length< 2) {
            fields[5].classList.add('red');
            fieldTexts[5].innerText = '姓名至少兩個字';
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
        const r = await fetch('menu_add_api.php', {
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
            info_bar.innerText = '新增成功';

            setTimeout(() => {
                // location.href = 'menu＿list.php'; // 跳轉到列表頁
            }, 2000);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料無法新增';
        }
    };

    
    

    




</script>



<?php include __DIR__ . '/parts/html_menu_foot.php' ?>