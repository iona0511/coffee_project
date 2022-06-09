<?php require dirname(__DIR__, 2) . '/parts/connect_db.php'; 
// MVC是把資料處理 呈現 用戶的互動
$perPage = 5; // 每一頁有幾筆
$page = isset($_GET['page'])? intval($_GET['page']) : 1; // 用戶要看第幾頁
if($page<1){
    // 頁面轉向
    header('Location:?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM menu";

// PHP走的是同步的方式,如果結果沒有回傳,就不會再往下執行
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0]; // 總筆數

$totalPages = ceil($totalRows / $perPage); // 總頁數

$rows = [];

// 有資料才執行
if($totalRows>0){

    // 頁碼如果超過總頁數
    if($page>$totalPages){
        header("Location:?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM menu LIMIT %s,%s",($page-1) * $perPage,$perPage);
    $rows = $pdo->query($sql)->fetchAll();
}


?>





<!-- 以下是html 呈現 -->
<?php include __DIR__ . '/parts/html_menu_head.php' ?>
<?php include dirname(__DIR__, 2) . '/parts/navbar_admin.php' ?>

<style>
.display_justify_content {
        display: flex;
        justify-content: center;
    }
    .bg {
        background-color: #fff;
    }
    table{
        border-collapse: separate;
    }
    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #B79973;
        border-color: #B79973;
    }
    .page-link{
        color: #B79973;
    }
    body {
        background-color: #CAAD87;
        background-size: cover;
        opacity: 0.9;
    }

    .trash_img a .a1{
        display: none;
    }
    .trash_img a .b1{
        display: block;
    }
    .trash_img a:hover .a1{
        display: block;
    }
    .trash_img a:hover .b1{
        display: none;
    }

    .edit_img a .c1{
        display: none;
    }
    .edit_img a .d1{
        display: block;
    }
    .edit_img a:hover .c1{
        display: block;
    }
    .edit_img a:hover .d1{
        display: none;
    }
    .css-8cha5q-SubmitButton {
    color: rgb(255, 255, 255);
    background: rgb(51, 51, 51);
    /* margin: 40px 0px 0px; */
    /* width: 100%; */
    font-size: 14px;
    text-align: center;
    padding: 10px 16px;
    letter-spacing: 0.2em;
    line-height: 1.4;
    transition: background 0.4s ease-out 0s, color 0.3s ease-out 0s;
    transition-property: background, color;
    transition-duration: 0.4s, 0.3s;
    transition-timing-function: ease-out, ease-out;
    transition-delay: 0s, 0s;
    }
    a{
        text-decoration: none;
    }
    a:hover{
        background-color: #B2ADAA;
        text-decoration: none;
        color: #fff;
    }

</style>

<div class="display_justify_content" style=" margin:20px auto;font-size:24px;">餐點管理</div>
<div class="display_justify_content" style="width:100px; margin:5px auto;font-size:12px;">
    
        <a type="submit" class="css-8cha5q-SubmitButton" href="munu_add.php?sid=<?= $r['sid'] ?>">新增</a>
    
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?=$page == 1 ? 'disabled' : ''?>"><a class="page-link" href="?page=1"><i class="fa-solid fa-angles-left"></i></a></li>
                    <li class="page-item <?=$page ==$page ? '$page-1' : ''?>"><a class="page-link" href="?page=<?=$page-1?>"><i class="fa-solid fa-angle-left"></i></a></li>

                    <?php for($i=1;$i<=$totalPages;$i++):?>
                        <!-- active這段是為了讓頁碼反白 -->
                        <li class="page-item <?= $page ==$i?'active' : '' ?>">
                            <a class="page-link" href="?page=<?=$i?>"><?=$i?></a>
                        </li>
                    <?php endfor;?>
                    <li class="page-item <?=$page ==$page ? '$page' : ''?>"><a class="page-link" href="?page=<?=$page+1?>"><i class="fa-solid fa-angle-right"></i></a></li>
                    <li class="page-item <?= $page ==$totalPages ? 'disabled' : '' ?>"><a class="page-link" href="?page=<?=$totalPages?>"><i class="fa-solid fa-angles-right"></i></a></li>
                </ul>

            </nav>
        </div>
    </div>

    <table class="table ">
        <thead>
            <tr>                
                <th scope="col" style="background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius: 20px 0 0 0;"><i class="fa-solid fa-trash-can"></i></th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">編號</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">種類</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">圖片</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">名稱</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">熱量</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">價格</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">營養標示資訊</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">建立日期</th>
                <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius:0 20px 0 0 ;"><i class="fa-solid fa-pen-to-square"></i></th>
            </tr>
        </thead>
        <tbody class="bg">
            <!-- $r 會拿到某一筆, foreach是跑迴圈 -->
            <?php foreach ($rows as $r ):?>
                <tr>
                    <td> 
                        <a href="javascript: delete_it(<?= $r['menu_sid'] ?>)">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
                    </td>
                    <td><?= $r['menu_sid'] ?></td>
                    <td><?= htmlentities($r['menu_categories'])?></td>
                    <td><img src = "../../images/11/<?= $r['menu_photo'] ?>" height="100"></td>
                    <td><?= $r['menu_name'] ?></td>
                    <td><?= $r['menu_kcal'] ?>大卡</td>
                    <td><?= $r['menu_price_m'] ?>元</td>
                    <td><?= $r['menu_nutrition'] ?></td>
                    <td><?= $r['created_at'] ?></td>
                    <td>
                        <a href="menu_edit.php?menu_sid=<?= $r['menu_sid'] ?>">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include dirname(__DIR__, 2) . '/parts/scripts.php' ?>
<script>
    function delete_it(menu_sid){
        if (confirm(`確定要刪除資料編號為${menu_sid}的資料嗎`)){
            location.href = `menu_delete.php?menu_sid=${menu_sid}`;
        }
    }
// 小作業 
// 做一個checkbox 就可以刪除全部

                
</script>

