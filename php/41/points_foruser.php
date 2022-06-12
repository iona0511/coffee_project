<?php 
// require __DIR__ . '/parts/connect_db.php';
require dirname(__DIR__,2) . '/parts/connect_db.php';
// session_start();


if (!isset($_SESSION['user']['member_account'])){
    header('Location:/coffee_project/php/09/login.html');
    exit;
}

$pageName = 'points_foruser_get';

$title = '積分獲取紀錄';
// ==================

$type = isset($_GET['type']) ? intval($_GET['type']) : 1;


if ($type == 2) {
    $type = 2;
} else {
    $type = 1;
}

// ============================================
$a=$_SESSION['user']['member_sid'];

$t_sql = sprintf("SELECT COUNT(1)FROM`points_record`JOIN`member`ON`points_record`.`member_sid`=`member`.`member_sid`WHERE`points_record`.`type`= %s AND`points_record`.`member_sid`=%s", $type, $a);

$perPage = 5;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
// ========================================

$rows = [];

if ($totalRows > 0) {
    if ($page > $totalPages) {
        // header("Location: ?page=$totalPages");
        // print_r($totalPages);
        exit;
    }

    $sql = sprintf("SELECT`points_record`.`create_at`,`points_record`.`points_get`,`member`.`member_sid`FROM`points_record`JOIN`member`ON`points_record`.`member_sid`=`member`.`member_sid`WHERE`points_record`.`type`=%s AND `points_record`.`member_sid`=%s ORDER BY create_at DESC LIMIT %s, %s", $type, $a , ($page - 1) * $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
}

// $a=$_SESSION['user']['member_sid'];

$sql_points = sprintf("SELECT `points_user`.`total_points`,`member`.`member_sid`FROM`points_user`JOIN`member`ON`points_user`.`member_sid`=`member`.`member_sid`WHERE`points_user`.`member_sid`=%s",$a );



$t_points = $pdo->query($sql_points)->fetchAll();
$a = $t_points[0];

?>

<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar.php' ?>

<style>
    .display_justify_content {
        display: flex;
        justify-content: center;
    }

    .px24 {
        font-size: 24px;
    }


    .display_flex_wrap {
        display: flex;
        flex-wrap: wrap;
    }

    .display_none {
        display: none;
    }

    .border_collapse {
        border-collapse: collapse;
    }

    @keyframes sheen {
        0% {
            transform: skewY(-45deg) translateX(0);
        }

        100% {
            transform: skewY(-45deg) translateX(12.5em);
        }
    }

    .wrapper {
        display: block;
        /* transform: translate(-50%, -50%); */
    }

    .button {
        padding: 0.5em 1.8em;
        text-align: center;
        text-decoration: none;
        color: #fff;
        border: 2px solid #B79973;
        font-size: 24px;
        display: inline-block;
        border-radius: 0.3em;
        transition: all 0.2s ease-in-out;
        position: relative;
        overflow: hidden;
    }

    .button:before {
        content: "";
        background-color: rgba(255, 255, 255, 0.5);
        height: 100%;
        width: 3em;
        display: block;
        position: absolute;
        top: 0;
        left: -4.5em;
        transform: skewX(-45deg) translateX(0);
        transition: none;
    }

    .button:hover {
        background-color: #B79973;
        color: #fff;
        /* border-bottom: 4px solid #893429; */
    }

    .button:hover:before {
        transform: skewX(-45deg) translateX(13.5em);
        transition: all 0.5s ease-in-out;
    }

    .active {
        background-color: #B79973;
        color: #fff;
    }

    body {
        /* background: url(./copon_img/img1.jpg); */
        background-position: 50% 80%;
        opacity: 0.9;
    }

    .bg {
        background-color: #fff;
        opacity: 0.9;
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
    a {
        color: #B79973;
        text-decoration:none;
    }
    .page-link{
        color: #B79973;
    }
    #myVideo {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: -1;
    }
    /* ========================= */

    .loading {
        font-size: 24px;
        
        font-weight: 300;
        text-align: center;
    }
    .loading span {
        display: inline-block;
        margin: 0 8px;
    }

    .loading07 span {
        position: relative;
        color:#fff;
    }
    .loading07 span::after {
        position: absolute;
        /* top: 0;
        left: 0; */
        content: attr(data-text);
        color: #fff;
        opacity: 0;
        transform: scale(1.5);
        animation: loading07 10s infinite;
    }
    .loading07 span:nth-child(2)::after {
        animation-delay: 0.1s;
    }
    .loading07 span:nth-child(3)::after {
        animation-delay: 0.2s;
    }
    .loading07 span:nth-child(4)::after {
        animation-delay: 0.3s;
    }
    .loading07 span:nth-child(5)::after {
        animation-delay: 0.4s;
    }
    .loading07 span:nth-child(6)::after {
        animation-delay: 0.5s;
    }
    .loading07 span:nth-child(7)::after {
        animation-delay: 0.6s;
    }
    @keyframes loading07 {
        0%, 75%, 100% {
            transform: scale(1.5);
            opacity: 0;
        }
        25%, 50% {
            transform: scale(1);
            opacity: 1;
        }
    }

</style>


<video autoplay muted loop id="myVideo">
    <source src="./copon_img/Writing in a notebook at a coffee shop.mp4" type="video/mp4">
</video>

<section>
    <div class=" loading loading07 load">
        <span data-text="查"></span>
        <span data-text="看"></span>
        <span data-text="我"></span>
        <span data-text="的"></span>
        <span data-text="積"></span>
        <span data-text="分"></span>
        <span data-text="表"></span> 
        
    </div>
</section>



<!-- Button_up -->
<!-- <div class="display_justify_content px24 load" style="font-weight:bold;color:#fff; margin-top: 20px;">
    <p>積分紀錄</p>
</div> -->
<div class="display_justify_content load" style="margin-top: 30px; ">
    <p style="color: #893429;font-weight: bold;"> <?= $a['total_points'] ?></p>
    <p>可用積分</p>
</div>
<!-- middle -->
<div class="display_justify_content load" style="margin-top:5px;">
    <div class=" display_justify_content wrapper">
        <a style="text-decoration:none;margin-top:0px;margin-right:10px;margin-bottom:20px;" class="button <?= $type == 1 ? 'active' : '' ?> " href="?type=1">獲取紀錄</a>
    </div>
    <div class=" display_justify_content wrapper">
        <a style="text-decoration:none;margin-top:0px;" class="button <?= $type == 2 ? 'active' : '' ?>" href="?type=2">使用記錄</a>
    </div>
</div>
<div id="points_record" class="display_justify_content">
    <div id="points_record_table_a" class="display_justify_content" style="height: 500px; width:1200px;">
        <table class="table table-striped">
            <thead >
                <tr >
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius: 20px 0 0 0;">日期</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">類別</th>
                    <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius:0 20px 0 0 ;"><?= $type == 1 ? '已獲得' : '已兌換'; ?></th>
                </tr>
            </thead>
            <tbody class="bg">
                <?php foreach ($rows as $r) : ?>
                    <tr class=" load">
                        <td><?= $r['create_at'] ?></td>
                        <td><?= $type == 1 ? '每日簽到獎勵' : '咖啡拿鐵兌換券'; ?></td>
                        <td><?= $r['points_get'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- button_bottom -->
<div class="row display_justify_content  load">
    <div class="col-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination display_justify_content">
                <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">Next</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    function load() {
    var element = $(this);
    element.fadeOut(0, function() {
    element.fadeIn(2000);
    });
}

    window.addEventListener('load', function() {
        $('.load').one('appear', load);
    })


</script>
