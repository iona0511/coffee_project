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
    <button type="button" class="btn btn-outline-success">
                <a href="./menu_add.php"> 新增餐點</a>
            </button>
    <table class="table table-warning table-striped">
        <thead>
            <tr>                
                <th scope="col"><i class="fa-solid fa-trash-can"></i></th>
                <th scope="col">編號</th>
                <th scope="col">種類</th>
                <th scope="col">圖片</th>
                <th scope="col">名稱</th>
                <th scope="col">熱量</th>
                <th scope="col">價格</th>
                <th scope="col">營養標示資訊</th>
                <th scope="col">建立日期</th>
                <th scope="col"><i class="fa-solid fa-pen-to-square"></i></th>
            </tr>
        </thead>
        <tbody>
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

