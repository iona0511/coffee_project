<?php 
require dirname(__DIR__,2) . '/parts/connect_db.php';
session_start();

if (!isset($_SESSION['user']['admin_account'])){
    header('Location:/coffee_project/php/18/news-insert.php');
    // header('Location: http://www.example.com/');
    exit;
}

$pageName = 'news-insert';
$title = '新增消息';

$row_class = $pdo->query("SELECT * FROM `news_class`")->fetchAll();

?>
<?php include dirname(__DIR__, 2) . '/parts/html-head.php'; ?>
<?php include dirname(__DIR__, 2) . '/parts/navbar.php'; ?>
<style>
    .form-control.red {
        border: 1px soid blue;
    }

    .form-text.red {
        color: red;
    }
    .act {
        display: flex;
        flex-direction: row;
        height: 30px;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增消息</h5>
                    <form name="form1" onsubmit="sendData();return false;" novalidate>
                        <!-- <input type="hidden" name="sid" > -->
                        <div class="mb-3">
                            <label for="news_title" class="form-label">活動標題</label>
                            <!-- label for跟input id 是對應的-->
                            <input type="text" class="form-control" id="news_title" name="news_title" required>
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="news_class_name" class="form-label">活動類別</label>
                            </br>
                            <select name="news_class_name" id="news_class_name">
                                <option value="">-- 請選擇 --</option>
                                <?php foreach ($row_class as $r) : ?>
                                    <option value="<?= $r['news_class_sid'] ?>">
                                        <?= $r['news_class_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text red"></div>
                        </div>

                        <label for="news_start_date" class="form-label">活動區間</label>
                        <div class="mb-3 act">                         
                            <input type="date" class="form-control w-" id="news_start_date" name="news_start_date">
                            <div class="form-text red"></div>
                            <p>~</p>
                            <input type="date" class="form-control w-2" id="news_end_date" name="news_end_date">
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="news_content" class="form-label">活動內容</label>
                            <textarea type="text" class="form-control" id="news_content" name="news_content"></textarea>
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="news_img" class="form-label">活動圖片</label>
                            <input type="file" class="form-control btn btn-outline-secondary" id="news_img" name="news_img" accept="image/*" onchange="showphoto()" multiple>  
                            <div id="preview"></div>
                            <div class="form-text red"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>
                    <div id="info_bar" class="alert alert-success" role="alert" style="display:none;">
                        資料新增成功
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include dirname(__DIR__, 2) . '/parts/scripts.php'; ?>
<script>
    const info_bar = document.querySelector('#info_bar');

    // const news_img = document.querySelector('#news_img');
    const title_f = document.form1.news_title;
    const class_name_f = document.form1.news_class_name;
    const start_date_f = document.form1.news_start_date;
    const end_date_f = document.form1.news_end_date;
    const content_f = document.form1.news_content;
    const img_f = document.form1.news_img;
    //這裡要確認資料庫欄位是否名稱有對應到
    const fields = [title_f, class_name_f, start_date_f, end_date_f, content_f, img_f];

    const fieldTexts = [];

    for (let f of fields) {
        fieldTexts.push(f?.nextElementSibling);
    }
    // console.log(fieldTexts)


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


    async function sendData() {
        // 讓欄位的外觀回復原來的狀態
        for (let i in fields) {
            fields[i].classList.remove('red');
            fieldTexts[i].innerText = '';
        }
        info_bar.style.display = 'none'; // 隱藏訊息列


        let isPass = true; // 預設是通過檢查

        if (title_f.value.length < 2) {
            // alert('標題至少要兩個字');
            fields[0].classList.add('red');
            fieldTexts[0].innerText = '標題至少要2個字';
            isPass = false;
        }
        // if (content_f.value.length < 10) {
        //     alert('內容至少要10個字');
        //     fields[4].classList.add('red');
        //     fieldTexts[4].innerText = '內容至少要10個字';
        //     isPass = false;
        // }

        if (img_f.value.length< 2) {
            fields[5].classList.add('red');
            fieldTexts[5].innerText = '請先上傳圖片';
            isPass = false;
        }

        if (!isPass) {
            return; // 結束函式
        }

        const fd = new FormData(document.form1);
        const r = await fetch('news-insert-api.php', {
            method: 'POST',
            body: fd,
        });

        console.log(r);
        const result = await r.json();
        console.log(result);


        info_bar.style.display = 'block'; // 顯示訊息列
        if (result.success) {
            info_bar.classList.remove('alert-danger');
            info_bar.classList.add('alert-success');
            info_bar.innerText = '新增成功';

            setTimeout(() => {
                location.href = 'news-insert.php'; // 跳轉到列表頁
            }, 2000);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料無法新增';
        }

    }
</script>
<?php include dirname(__DIR__, 2) . '/parts/html-foot.php'; ?>