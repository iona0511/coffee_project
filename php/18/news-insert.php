<?php require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
$pageName = 'news-insert';
$title = '最新消息新增頁';

?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-head.php'; ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar.php'; ?>
<style>
    .form-control.red {
        border: 1px soid blue;
    }
    .form-text.red {
        color:red;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">新增資料頁</h5>
                    <form name="form1" onsubmit="sendData();return false;" novalidate>
                        <!-- <input type="hidden" name="sid" > -->
                        <div class="mb-3">
                            <label for="news_title" class="form-label">活動標題</label>
                            <!-- label for跟input id 是對應的-->
                            <input type="text" class="form-control" id="news_title" name="news_title" required>
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <select for="news_class_sid" class="form-label">活動類別</select>
                            <input type="text" class="form-control" id="news_class_sid" name="news_class_sid">
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="news_content" class="form-label">活動內容</label>
                            <textarea type="text" class="form-control" id="news_content" name="news_content"></textarea>
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3">
                            <label for="news_start_date" class="form-label">活動區間</label>
                            <input type="date" class="form-control w-" id="news_start_date" name="news_start_date">
                            <p>~</p>
                            <input type="date" class="form-control w-2" id="news_end_date" name="news_end_date">
                        </div>
                        <!-- <p>消息圖片上傳</p><br>
                        <input type="file" id="btn" name="avatar" accept="image/*" onclick="uploadAvatar()"></input>
                        <img src="#" alt="">
                        <br> -->
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

<?php include dirname(dirname(__DIR__, 1)) . '/parts/scripts.php'; ?>
<script>

    const info_bar = document.querySelector('#info_bar');
    const title = document.form1.news_title;
    const class_sid = document.form1.news_class_sid;
    const content = document.form1.news_content;
    const start_date = document.form1.news_start_date;
    const end_date = document.form1.news_end_date;

    const fields = [title , class_sid, content, start_date, end_date];
    const fieldTexts = [];
    for (let f of fields) {
        fieldTexts.push(f.nextElementSibling);
    }



    async function sendData() {
        // 讓欄位的外觀回復原來的狀態
        // for (let i in fields) {
        //     fields[i].classList.remove('red');
        //     fieldTexts[i].innerText = '';
        // }
        // info_bar.style.display = 'none'; // 隱藏訊息列
       

        const fd = new FormData(document.form1);
        const r = await fetch('news-insert-api.php', {
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

            setTimeout(() => {
                // location.href = 'ab-list.php'; // 跳轉到列表頁
            }, 2000);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料無法新增';
        }

    }
</script>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-foot.php'; ?>