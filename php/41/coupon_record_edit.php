<?php
require dirname(__DIR__, 2) . '/parts/connect_db.php';
// session_start();

if (!isset($_SESSION['user']['admin_account'])) {
    header('Location:/coffee_project/php/09/admin-login.html');
    exit;
}

$pageName = 'coupon_record_edit';
$title = '優惠券條件設定';

$sid = isset($_GET['sid']) ? intval($_GET['sid']) : 0;
if (empty($sid)) {
    header('Location:/coffee_project/php/41/coupon_record_list.php');
    exit;
}

$row_s = $pdo->query("SELECT * FROM `coupon` WHERE sid=$sid")->fetch();

if (empty($row_s)) {
    header('Location:/coffee_project/php/41/coupon_record_list.php');
    exit;
}
// ========================

$coupon_send_type = [
    '1' => '1 生日時發送',
    '2' => '2 註冊時發送',
    '3' => '3 玩遊戲時發送',
    '4' => '4 購物完發送',
];
$coupon_setting_type = [
    '1' => '1 折扣金額',
    '2' => '2 打折',
];
// ========================================
$rows = [];

$sql = sprintf("SELECT `menu_sid` FROM `menu`");

$rows = $pdo->query($sql)->fetchAll();


// ==========================================
$rows_products = [];

$sql_p = sprintf("SELECT `products_sid` FROM `products`");

$rows_products = $pdo->query($sql_p)->fetchAll();

// =========================================
$t_type = [
    '1' => '1 餐點類',
    '2' => '2 商品類',
    '3' => '3 全品項',
];
// =========================================
$coupon_validity_period = [
    '1' => '1 個月',
    '2' => '2 個月',
    '3' => '3 個月',
    '4' => '4 個月',
    '5' => '5 個月',
    '6' => '6 個月',
    '7' => '7 個月',
    '8' => '8 個月',
    '9' => '9 個月',
    '10' => '10 個月',
    '11' => '11 個月',
    '12' => '12 個月',
];
// =========================================

$coupon_status  = [
    '1' => '0 不開放',
    '2' => '1 開放',
];

?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar_admin.php' ?>

<style>
    .form-control.red {
        border: 1px solid red;
    }

    .form-text.red {
        color: red;
    }

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

    button:hover {
        background-color: #B2ADAA;
        border: 1px solid #B2ADAA;
    }

    body {
        background-color: #F2F0ED;
    }
    .d_colum{
        display:flex; flex-direction: column;width:100%;
    }
    .s_padding{
        padding: 15px 10px;
        border: none;
    }
</style>

<div class="display_justify_content" style="margin-top: 50px;">
    <div style="width: 636px;padding: 20px;border: 1px solid #000; border-bottom: 1px solid #000;">
        <div>
            <div>
                <div>
                    <h5 class="card-title">編輯資料</h5>

                    <form name="form1" onsubmit="sendData();return false;" novalidate>
                        <input type="hidden" name="sid" value="<?= $row_s['sid'] ?>">
                        <div class="mb-3 d_colum" style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;">
                            <label for="name" >* 優惠券名稱</label>
                            <input class ="css-qkktdp-TextField" style="border: 1px solid #D0D0D0;padding: 15px 10px;" type="text" id="name" name="coupon_name" required value="<?= htmlentities($row_s['coupon_name']) ?>">
                            <div class="form-text red"></div>
                        </div>


                        <div class="mb-3 d_colum" style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;display:flex; flex-direction: column;width:100%;">
                            <label for="">優惠券發放類別</label>

                            <select class="s_padding" name="cst_type">
                                <option value="" selected disabled>- 請選擇 -</option>

                                <?php foreach ($coupon_send_type as $k => $v) : ?>
                                    <option value="<?= $k ?>"> <?= $v ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3 d_colum" style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;">
                            <label for="">優惠券折扣類別</label>

                            <select class="s_padding" name="cstt_type">
                                <option value="" selected disabled>- 請選擇 -</option>

                                <?php foreach ($coupon_setting_type as $k => $v) : ?>
                                    <option value="<?= $k ?>"> <?= $v ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3 d_colum " style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;">
                            <label for="number">* 優惠券金額/折數</label>

                            <input type="number" id="number" class="css-qkktdp-TextField" name="number" required>

                            <div class="form-text red"></div>
                        </div>

                        <div class="mb-3 d_colum" style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;">
                            <label for="">餐點編號</label>
                            <select class="s_padding" name="m_sid">
                                <option value="" selected disabled>- 請選擇 -</option>
                                <?php foreach ($rows as $k => $v) : ?>
                                    <option value="<?= $k ?>"> <?= $v['menu_sid'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3 d_colum" style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;">
                            <label for="">產品編號</label>
                            <select class="s_padding" name="p_sid">
                                <option value="" selected disabled>- 請選擇 -</option>
                                <?php foreach ($rows_products as $k => $v) : ?>
                                    <option value="<?= $k ?>"> <?= $v['products_sid'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3 d_colum" style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;">
                            <label for="">類別</label>

                            <select class="s_padding" name="t_type">
                                <option value="" selected disabled>- 請選擇 -</option>

                                <?php foreach ($t_type as $k => $v) : ?>
                                    <option value="<?= $k ?>"> <?= $v ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3 d_colum" style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;">
                            <label for="">優惠券有效期限</label>

                            <select class="s_padding" name="coupon_validity_period">
                                <option value="" selected disabled>- 請選擇 -</option>

                                <?php foreach ($coupon_validity_period as $k => $v) : ?>
                                    <option value="<?= $k ?>"> <?= $v ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 d_colum" style="border-top: 1px solid #D0D0D0;margin-top: 25px;padding: 15px 0;">
                            <label for="">優惠券開放狀態</label>

                            <select class="s_padding" name="coupon_status">
                                <option value="" selected disabled>- 請選擇 -</option>

                                <?php foreach ($coupon_status as $k => $v) : ?>
                                    <option value="<?= $k ?>"> <?= $v ?></option>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="css-8cha5q-SubmitButton" >新增</button>
                    </form>
                    <div id="info-bar" class="alert alert-success" role="alert" style="display:none;">
                        資料編輯成功
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    const info_bar = document.querySelector('#info-bar');

    const coupon_name_f = document.form1.coupon_name;
    const cst_type_f = document.form1.cst_type;
    const number_f = document.form1.number;

    const fields = [coupon_name_f,cst_type_f,number_f];
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
        if (coupon_name_f.value.length < 1) {
            fields[0].classList.add('red');
            fieldTexts[0].innerText = '請輸入內容';
            isPass = false;
        }
        if (cst_type_f.value.length < 1) {
            fields[1].classList.add('red');
            fieldTexts[1].innerText = '請輸入內容';
            isPass = false;
        }
        if (number_f.value.length < 1) {
        fields[2].classList.add('red');
        fieldTexts[2].innerText = '請輸入內容';
        isPass = false;
}
        if (!isPass) {
            return;
        }

        const fd = new FormData(document.form1);
        const r = await fetch('coupon_record_edit_api.php', {
            method: 'POST',
            body: fd,
        });
        const result = await r.json();
        console.log(result);
        info_bar.style.display = 'block'; 
        if (result.success) {
            info_bar.classList.remove('alert-danger');
            info_bar.classList.add('alert-success');
            info_bar.innerText = '修改成功';

            setTimeout(() => {
                location.href = 'coupon_record_list.php'; 
            }, 2000);
        } else {
            info_bar.classList.remove('alert-success');
            info_bar.classList.add('alert-danger');
            info_bar.innerText = result.error || '資料沒有修改';
        }

    }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>