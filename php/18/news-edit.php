<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
$pageName = 'news-edit';
$title = '消息編輯頁';

$news_sid = isset($_GET['news_sid']) ? intval($_GET['news_sid']) : 0;

if (empty($news_sid)) {
    header('Location:lastest-news.php');
    exit;
}

$row = $pdo->query("SELECT * FROM lastest_news WHERE news_sid = $news_sid")->fetch();

$row_class = $pdo->query("SELECT * FROM  `news_class`")->fetchAll();

if (empty($row)) {
    header('Location: lastest-news.php');
    exit;
}


?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-head.php'; ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar_admin.php'; ?>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
    }

    body {
        /* background-color: #CD853F; */
        background-color: #CAAD87;
        background-size: cover;
        opacity: 0.9;
    }

    .color-y {
        background-color: aliceblue;
        opacity: 0.8;
    }

    .form-control.red {
        border: 1px solid red;
    }

    .form-text.red {
        color: red;
    }

    .act {
        display: flex;
        flex-direction: row;
        height: 30px;
    }
    .single-img {
        width: 400px;
        height: 320px;
        /* display: none; */
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card color-y">
                <div class="card-body">
                    <h2 class="card-title mb-4">編輯消息</h2>
                    <form name="form1" onsubmit="sendData();return false;" novalidate enctype="multipart/form-data">
                        <input type="hidden" name="news_sid" value="<?= $row['news_sid'] ?>">
                        <div class="mb-3">
                            <label for="news_title" class="form-label">活動標題</label>
                            
                            <!-- label for跟input id 是對應的-->
                            <input type="text" class="form-control" id="news_title" name="news_title" required value="<?= htmlentities($row['news_title']) ?>">
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="news_class" class="form-label">活動類別</label>
                            </br>
                            <!-- 這邊無法顯示出資料庫裡的類別，可以參考老師的01 form -->
                            <select name="news_class_sid" id="news_class_sid" value="">
                                <option value="0" disabled>-- 請選擇 --</option>
                                <?php foreach ($row_class as $r) : ?>
                                    <option value="<?= $r['class_sid'] ?>" <?= $r['class_sid'] == $row['news_class_sid'] ? 'selected' : '' ?>>
                                        <?= $r['class_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text red"></div>
                        </div>

                        <label for="news_start_date" class="form-label">活動區間</label>
                        <div class="mb-3 act">
                            <input type="date" class="form-control w-" id="news_start_date" name="news_start_date" value="<?= $row['news_start_date'] ?>">
                            <div class="form-text red"></div>
                            <p>~</p>
                            <input type="date" class="form-control w-2" id="news_end_date" name="news_end_date" value="<?= $row['news_end_date'] ?>">
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="news_content" class="form-label">活動內容</label>
                            <textarea type="text" class="form-control" id="news_content" name="news_content"><?= $row['news_content'] ?></textarea>
                            <div class="form-text red"></div>
                        </div>

                        <!-- <div class="mb-3">
                            <label for="news_img" class="form-label">活動圖片</label>
                            <input type="file" class="form-control btn btn-outline-secondary" id="news_img" name="news_img" accept="image/*" onchange="showphoto()" multiple>   
                            <div class="form-text red">
                                <img src="" alt="">
                            </div>                    
                            <div id="preview"></div>
                        </div> -->
                        <div class="mb-3">
                            <label for="news_img" class="form-label">消息圖片</label><br>
                            <input type="file" name="news_img[]" accept="image/*" onchange="changeOneImg(event)" />
                            <div class="form-text"></div>
                            <img class="single-img" src="
                            <?php if ($row['news_img']) : echo '/coffee_project/images/18/' . $row['news_img'];
                            endif; ?>" <?php if (!$row['news_img']) : echo "style" . "=" . "display:none;" ?> <?php endif; ?> alt="" id="news_img" />
                        </div>

                        <button type="submit" class="btn btn-primary">修改</button>
                    </form>
                    <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                        資料編輯成功
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/scripts.php'; ?>

<script>
    const row = <?= json_encode($row, JSON_UNESCAPED_UNICODE); ?>;

    const info_bar = document.querySelector('#info-bar');
    // const news_img = document.querySelector('#news_img');
    const title_f = document.form1.news_title;
    // const class_sid_f = document.form1.news_class_sid;
    const class_sid_f = document.form1.news_class_sid;
    // const start_date_f = document.form1.news_start_date;
    // const end_date_f = document.form1.news_end_date;
    const content_f = document.form1.news_content;
    const img_f = document.form1.news_img;
    //這裡要確認資料庫欄位是否名稱有對應到
    const fields = [title_f,class_sid_f,content_f,img_f];

    const fieldTexts = [];

    for (let f of fields) {
        fieldTexts.push(f.nextElementSibling);
    }
    // console.log(fieldTexts)

    // showphoto照片上傳的功能要再看一下
    function showphoto() {
    // let container = document.querySelector('#preview');
    // let files    = document.querySelector('input[type=file]').files;
 
    // for (i = 0; i < files.length; i++) {
    //     const reader  = new FileReader();
    //     reader.addEventListener("load", function () {
    //         container.innerHTML += `<img height="200" alt="" src="${reader.result}">`;
    //     }, false);

    //     if (files[i]) {
    //             reader.readAsDataURL(files[i]);
    
    //     }                       
    // }    
};
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

    async function sendData() {
        // 讓欄位的外觀回復原來的狀態
        for (let i in fields) {
            fields[i].classList.remove('red');
            // console.log('fieldTexts ', fieldTexts)
            fieldTexts[i].innerText = '';
        }
        info_bar.style.display = 'none'; // 隱藏訊息列

        // TODO: 欄位檢查, 前端的檢查
        let isPass = true; // 預設是通過檢查的

        if (title_f.value.length < 2) {
            // alert('姓名至少兩個字');
            // name_f.classList.add('red');
            // name_f.nextElementSibling.classList.add('red');
            // name_f.closest('.mb-3').querySelector('.form-text').classList.add('red');
            fields[0].classList.add('red');
            fieldTexts[0].innerText = '標題至少要2個字';
            isPass = false;
        }
        if (class_sid_f.value.length < 1) {
            fields[1].classList.add('red');
            fieldTexts[1].innerText = '請輸入內容';
            isPass = false;
        }
        if (content_f.value.length < 5) {
            fields[2].classList.add('red');
            fieldTexts[2].innerText = '內容至少要5個字';
            isPass = false;
        }

        if (img_f.value.length< 1) {
            fields[3].classList.add('red');
            fieldTexts[3].innerText = '請先上傳圖片';
            isPass = false;
        }

        if (!isPass) {
            return; // 結束函式
        }

        const fd = new FormData(document.form1);
        const r = await fetch('news-edit-api.php', {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
        info_bar.style.display = 'block'; // 顯示訊息列
        if (result.success) {
            info_bar.classList.remove('alert-danger');
            info_bar.classList.add('alert-success');
            info_bar.innerText = '修改成功';

            setTimeout(() => {
                location.href = 'lastest-news.php'; // 跳轉到列表頁
            }, 1500);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料沒有修改';
        }

    }

   
</script>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-foot.php'; ?>