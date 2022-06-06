<?php require dirname(dirname(__DIR__, 2)) . '/parts/connect_db.php';
$pageName = 'news-edit';
$title = '最新消息編輯頁';

$news_sid = isset($_GET['news_sid']) ? intval($_GET['news_sid']) : 0;

if (empty($news_sid)) {
    header('Location:lastest-news.php');
    exit;
}

$row = $pdo->query("SELECT * FROM lastest_news WHERE news_sid = $news_sid")->fetch();

if (empty($row)) {
    header('Location: lastest-news.php');
    exit;
}


?>
<?php include dirname(dirname(__DIR__, 2)) . '/parts/html-head.php'; ?>
<?php include dirname(dirname(__DIR__, 2)) . '/parts/navbar.php'; ?>
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
                    <h5 class="card-title">最新消息編輯頁</h5>
                    <form name="form1" onsubmit="sendData();return false;" novalidate>
                        <input type="hidden" name="sid" value="<?= $row['news_sid'] ?>">
                        <div class="mb-3">
                            <label for="news_title" class="form-label">活動標題</label>
                            <!-- label for跟input id 是對應的-->
                            <input type="text" class="form-control" id="news_title" name="news_title" required value="<?= htmlentities($row['news_title']) ?>">
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="news_class_sid" class="form-label">活動類別</label>
                            <input type="text" class="form-control" id="news_class_sid" name="news_class_sid" value="<?= $row['news_class_sid'] ?>">
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="news_content" class="form-label">活動內容</label>
                            <input type="text" class="form-control" id="news_content" name="news_content" value="<?= $row['news_content'] ?>">
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="news_date" class="form-label">活動區間</label>
                            <input type="date" class="form-control w-" id="news_start_date" name="news_start_date" value="<?= $row['news_start_date'] ?>">
                            <p>~</p>
                            <input type="date" class="form-control w-2" id="news_end_date" name="news_end_date" value="<?= $row['news_end_date'] ?>">
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
<?php include dirname(dirname(__DIR__, 2)) . '/parts/scripts.php'; ?>
<script>
    const row = <?= json_encode($row, JSON_UNESCAPED_UNICODE); ?>;


    const email_re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zAZ]{2,}))$/;
    const mobile_re = /^09\d{2}-?\d{3}-?\d{3}$/;

    const info_bar = document.querySelector('#info-bar');
    const name_f = document.form1.name;
    const email_f = document.form1.email;
    const mobile_f = document.form1.mobile;

    const fields = [name_f, email_f, mobile_f];
    const fieldTexts = [];
    for (let f of fields) {
        fieldTexts.push(f.nextElementSibling);
    }



    async function sendData() {
        // 讓欄位的外觀回復原來的狀態
        for (let i in fields) {
            fields[i].classList.remove('red');
            fieldTexts[i].innerText = '';
        }
        info_bar.style.display = 'none'; // 隱藏訊息列

        // TODO: 欄位檢查, 前端的檢查
        let isPass = true; // 預設是通過檢查的

        if (name_f.value.length < 2) {
            // alert('姓名至少兩個字');
            // name_f.classList.add('red');
            // name_f.nextElementSibling.classList.add('red');
            // name_f.closest('.mb-3').querySelector('.form-text').classList.add('red');
            fields[0].classList.add('red');
            fieldTexts[0].innerText = '姓名至少兩個字';
            isPass = false;
        }
        if (email_f.value && !email_re.test(email_f.value)) {
            // alert('email 格式錯誤');
            fields[1].classList.add('red');
            fieldTexts[1].innerText = 'email 格式錯誤';
            isPass = false;
        }
        if (mobile_f.value && !mobile_re.test(mobile_f.value)) {
            // alert('手機號碼格式錯誤');
            fields[2].classList.add('red');
            fieldTexts[2].innerText = '手機號碼格式錯誤';
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
<?php include dirname(dirname(__DIR__, 2)) . '/parts/html-foot.php'; ?>