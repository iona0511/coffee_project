<?php 
// require __DIR__ . '/parts/connect_db.php';
require dirname(__DIR__,2) . '/parts/connect_db.php';
session_start();

if (!isset($_SESSION['user']['admin_account'])){
    header('Location:/coffee_project/php/09/admin-login.html');
    // header('Location: http://www.example.com/');
    exit;
}


$pageName = 'points_record_add';
$title = '新增積分歷史紀錄';


// `WHERE`member`.`member_account`=
?>
<?php include __DIR__ . '/parts/html-head.php' ?>

<style>
    .form-control.red {
        border: 1px solid red;
    }

    .form-text.red {
        color: red;
    }
    .display_justify_content {
        display: flex;
        justify-content: center;

    }
    .css-8cha5q-SubmitButton {
    color: rgb(255, 255, 255);
    background: rgb(51, 51, 51);
    margin: 40px 0px 0px;
    width: 100%;
    font-size: 14px;
    text-align: center;
    padding: 40px 16px;
    letter-spacing: 0.2em;
    line-height: 1.4;
    transition: background 0.4s ease-out 0s, color 0.3s ease-out 0s;
    transition-property: background, color;
    transition-duration: 0.4s, 0.3s;
    transition-timing-function: ease-out, ease-out;
    transition-delay: 0s, 0s;
    }
    .css-qkktdp-TextField {
        background: rgb(255, 255, 255);
        border: 1px solid rgba(0, 0, 0, 0.08);
        font-size: 11px;
        width: 100%;
        padding: 15px 20px;
        letter-spacing: 0.05em;
        
    }
    button:hover{
        background-color: #B2ADAA;
        border: 1px solid #B2ADAA;
    }
    body{
        background-color: #F2F0ED;
    }
</style>

<div class="display_justify_content" style="margin-top: 50px;">
    <div style="width: 636px;padding: 20px;border: 1px solid #000; border-bottom: 1px solid #000;">
        <div >
            <div >
                <div >
                    <h5 >新增會員積分資料(For Demo)</h5>
                    <form name="form1" onsubmit="sendData();return false;" novalidate>
                        <div class="mb-3" style="border-top: 1px solid #D0D0D0;margin-top: 25px; padding: 15px 0;">
                            <label for="name">* 會員帳號</label>
                            <input type="text" id="name" class="css-qkktdp-TextField" name="member_account" required>
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3" style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;">
                            <label for="number" >狀態</label>
                            
                            <input type="number" id="number" class="css-qkktdp-TextField" name="number" required>
                            
                            <div class="form-text red"></div>
                        </div>
                        <div class="mb-3" style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;">
                            <label for="score" >獲得</label>
                            <input type="number"  id="score" class="css-qkktdp-TextField" name="score">
                            <div class="form-text red"></div>
                        </div>
                        <button type="submit" class="css-8cha5q-SubmitButton" >新增</button>
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
    const member_account_f = document.form1.member_account;
    const number_f = document.form1.number;
    const score_f = document.form1.score;
    const info_bar = document.querySelector('#info-bar');
    const number_re = /^\+?[1-9][0-9]*$/;
    const score_re = /^-?\d+$/;

    const fields = [member_account_f, number_f, score_f];
    const fieldTexts = [];
    for (let f of fields) {
        fieldTexts.push(f.nextElementSibling);
    }
    async function sendData() {
        for (let i in fields) {
            fields[i].classList.remove('red');
            fieldTexts[i].innerText = '';
        }
        info_bar.style.display = 'none';
        let isPass = true;

        if (member_account_f.value.length < 2) {
            fields[0].classList.add('red');
            fieldTexts[0].innerText = '請輸入會員帳號';
            isPass = false;
        }
        if (number_f.value && !number_re.test(number_f.value)) {
            fields[1].classList.add('red');
            fieldTexts[1].innerText = '請輸入正整數';
            isPass = false;
        }
        if (score_f.value && !score_re.test(score_f.value)) {
            fields[2].classList.add('red');
            fieldTexts[2].innerText = '請輸入數字';
            isPass = false;
        }

        if (!isPass) {
            return;
        }
        const fd = new FormData(document.form1);
        const r = await fetch('points_record_add_api.php', {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
        info_bar.style.display = 'block';

        if (result.success) {
            info_bar.classList.remove('alert-danger');
            info_bar.classList.add('alert-success');
            info_bar.innerText = '新增成功';
            setTimeout(() => {
                location.href = 'points_record_list.php';
            }, 2000);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料沒有修改';
        }
    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>