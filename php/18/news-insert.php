<?php
require dirname(__DIR__, 2) . '/parts/connect_db.php';



$news_sid = isset($_GET['news_sid']) ? intval($_GET['news_sid']) : 0;

$pageName = 'news-insert';
$title = '新增消息';

// $row_class = $pdo->query("SELECT * FROM `lastest_news` l JOIN `news_class` n on `l`.`news_class_sid` = `n`.`class_sid` where l.news_sid = $news_sid")->fetchAll();
$row_class = $pdo->query("SELECT * FROM  `news_class`")->fetchAll();

?>
<?php include dirname(__DIR__, 2) . '/parts/html-head.php'; ?>
<?php include dirname(__DIR__, 2) . '/parts/navbar_admin.php'; ?>
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

    .margin {
        margin-right: 0, 150px;
    }
    .exit-size {
        font-size: 1.7rem;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6 margin">
            <div class="card">
                <div class="card-body color-y"">
                    <div class="d-flex justify-content-between">
                        <h2 class="card-title mb-4">新增消息</h2>
                        <a  href="././lastest-news.php"><i class="fa-solid fa-arrow-right-from-bracket exit-size"></i></a>
                    </div>
                    <form name="form1" onsubmit="sendData();return false;" novalidate enctype="multipart/form-data">
                        <!-- <input type="hidden" name="sid" > -->
                        <div class="mb-3">
                            <label for="news_title" class="form-label">活動標題</label>
                            <!-- label for跟input id 是對應的-->
                            <input type="text" class="form-control" id="news_title" name="news_title" placeholder='標題' required>
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="news_class_sid" class="form-label">活動類別</label>
                            </br>
                            <select name="news_class_sid" id="news_class_sid">
                                <option value="0" selected disabled>-- 請選擇 --</option>
                                <?php foreach ($row_class as $r) : ?>
                                    <option value="<?= $r['class_sid'] ?>">
                                        <?= $r['class_name'] ?>
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
                            <textarea type="text" class="form-control" id="news_content" name="news_content" placeholder='請輸入內容' ></textarea>
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3">
                            <label for="news_img" class="form-label">活動圖片</label>
                            <input type="file" class="form-control btn btn-outline-secondary" id="news_img" name="news_img" accept="image/*" onchange="showphoto()" multiple>
                            <div class="form-text red"></div>
                            <div id="preview"></div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <!-- <a type="submit" class="btn btn-warning" href="././lastest-news.php">離開</a> -->
                            <button type="submit" class="btn btn-primary">新增</button>
                        </div>
                    </form>
                    <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                        資料新增成功
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include dirname(__DIR__, 2) . '/parts/scripts.php'; ?>
<script>
    const info_bar = document.querySelector('#info-bar');

    // const news_img = document.querySelector('#news_img');
    const title_f = document.form1.news_title;
    const class_sid_f = document.form1.news_class_sid;
    const start_date_f = document.form1.news_start_date;
    const end_date_f = document.form1.news_end_date;
    const content_f = document.form1.news_content;
    const img_f = document.form1.news_img;
    //這裡要確認資料庫欄位是否名稱有對應到
    const fields = [title_f, class_sid_f, start_date_f, end_date_f, content_f, img_f];


    const fieldTexts = [];

    for (let f of fields) {
        fieldTexts.push(f.nextElementSibling);
    }
    // console.log(fieldTexts)


    function showphoto() {
        let container = document.querySelector('#preview');
        let files = document.querySelector('input[type=file]').files;

        for (i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.addEventListener("load", function() {
                container.innerHTML += `<img height="200" alt="" src="${reader.result}">`;
            }, false);

            if (files[i]) {
                reader.readAsDataURL(files[i]);

            }
        }
    };

    //寫的是活動結束日期無法選擇比開始日期還早
    const startDate = document.querySelector("#news_start_date");
    const endDate = document.querySelector("#news_end_date");


    function getToday(yourDate) {
        const offset = yourDate.getTimezoneOffset();
        yourDate = new Date(yourDate.getTime() - (offset * 60 * 1000));
        return yourDate.toISOString().split('T')[0];
    }

    const now = new Date();

    startDate.setAttribute("min", getToday(now));

    startDate.addEventListener("input", () => {
        endDate.value = "";
        endDate.setAttribute("min", startDate.value);
    })

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
        if (content_f.value.length < 5) {
            // alert('內容至少要10個字');
            fields[4].classList.add('red');
            fieldTexts[4].innerText = '內容至少要5個字';
            isPass = false;
        }

        if (img_f.value.length < 2) {
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
                location.href = 'lastest-news.php'; // 跳轉到列表頁
            }, 1500);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料無法新增';
        }

    }
</script>
<?php include dirname(__DIR__, 2) . '/parts/html-foot.php'; ?>