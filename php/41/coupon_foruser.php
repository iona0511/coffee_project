<?php 
require __DIR__ . '/parts/connect_db.php';
// require dirname(__DIR__,2) . '/parts/connect_db.php';
// session_start();

if (!isset($_SESSION['user']['member_account'])){
    header('Location:/coffee_project/php/09/login.html');
    exit;
}

$pageName = 'coupon_foruser';

$title = '我的優惠券';
// ===================================
$type = isset($_GET['type']) ? intval($_GET['type']) : 1;


if ($type == 2) {
    $type = 2;
} else {
    $type = 1;
}
// ================

if($type==1){
    
    $t_sql = sprintf("SELECT COUNT(1)FROM`coupon_receive`JOIN`coupon`ON`coupon_receive`.`coupon_sid`=`coupon`.`sid`WHERE `coupon_receive`.`end_time`>NOW();");

    $perPage = 5;

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    if ($page < 1) {
        header('Location: ?page=1');
        exit;
    }

    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

    $totalPages = ceil($totalRows / $perPage);

    $rows = [];

    if ($totalRows > 0) {
        if ($page > $totalPages) {
            // header("Location: ?page=$totalPages");
            exit;
        }
    
        $sql = sprintf("SELECT`coupon`.`coupon_name`,`coupon`.`coupon_money`,`coupon_receive`.`end_time`,`coupon_receive`.`status`FROM`coupon_receive`JOIN`coupon`ON`coupon_receive`.`coupon_sid`=`coupon`.`sid`WHERE `coupon_receive`.`end_time`>NOW() LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    
        $rows = $pdo->query($sql)->fetchAll();
    }
    
    $a=$_SESSION['user']['member_sid'];
    
    $sql_points = sprintf("SELECT`coupon`.`coupon_name`,`coupon`.`coupon_money`,`coupon_receive`.`end_time`,`coupon_receive`.`status`,`coupon_receive`.`member_sid`FROM`coupon_receive`JOIN`coupon`ON`coupon_receive`.`coupon_sid`=`coupon`.`sid`JOIN`member`ON`coupon_receive`.`member_sid`=`member`.`member_sid`WHERE`coupon_receive`.`member_sid`=%s",$a );
    
    $t_points = $pdo->query($sql_points)->fetchAll();
    $a = $t_points[0];

}else{
    $t_sql = sprintf("SELECT COUNT(1)FROM`coupon_receive`JOIN`coupon`ON`coupon_receive`.`coupon_sid`=`coupon`.`sid`JOIN`coupon_logs`ON`coupon_receive`.`sid`=`coupon_logs`.`coupon_receive_sid`JOIN`member`ON`coupon_receive`.`member_sid`=`member`.`member_sid`WHERE `coupon_receive`.`end_time`<NOW()||`coupon_logs`.`used_time`>0;");

    $perPage = 5;

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    if ($page < 1) {
        header('Location: ?page=1');
        exit;
    }

    $totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

    $totalPages = ceil($totalRows / $perPage);

    $rows = [];

    if ($totalRows > 0) {
        if ($page > $totalPages) {
            // header("Location: ?page=$totalPages");
            exit;
        }
        $sql = sprintf("SELECT`coupon`.`coupon_name`,`coupon`.`coupon_money`,`coupon_receive`.`end_time`,`coupon_receive`.`status`,`coupon_logs`.`used_time`,`coupon_receive`.`member_sid`FROM`coupon_receive`JOIN`coupon`ON`coupon_receive`.`coupon_sid`=`coupon`.`sid`JOIN`coupon_logs`ON`coupon_receive`.`sid`=`coupon_logs`.`coupon_receive_sid`JOIN`member`ON`coupon_receive`.`member_sid`=`member`.`member_sid`WHERE `coupon_receive`.`end_time`<NOW()||`coupon_logs`.`used_time`>0 LIMIT %s, %s", ($page - 1) * $perPage, $perPage);
    
        $rows = $pdo->query($sql)->fetchAll();
    }
    $a=$_SESSION['user']['member_sid'];
    
    $sql_points = sprintf("SELECT`coupon`.`coupon_name`,`coupon`.`coupon_money`,`coupon_receive`.`end_time`,`coupon_receive`.`status`,`coupon_logs`.`used_time`,`coupon_receive`.`member_sid`FROM`coupon_receive`JOIN`coupon`ON`coupon_receive`.`coupon_sid`=`coupon`.`sid`JOIN`coupon_logs`ON`coupon_receive`.`sid`=`coupon_logs`.`coupon_receive_sid`JOIN`member`ON`coupon_receive`.`member_sid`=`member`.`member_sid`WHERE`coupon_receive`.`member_sid`=%s",$a );
    
    $t_points = $pdo->query($sql_points)->fetchAll();
    $a = $t_points[0];

}


// ===================================


?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar.php' ?>

<style>
    .display_justify_content {
        display: flex;
        justify-content: center;
    }
    .wrapper {
        display: block;
    }

    .button {
        padding: 0.5em 1.8em;
        text-align: center;
        text-decoration: none;
        color: #B79973;
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
    .coupon_style{
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.6);
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
    body{
        background: url(../41/copon_img/bg_1.png) 50% 100% / cover #000 fixed;
        
    }
    .c_p_disabled{
        filter:contrast(50%);
    }
    a{
        text-decoration: none;
        color: #000;
    }

    a{
        text-decoration: none;
        color: #000;
    }
    a:hover{
        background-color: rgba(183, 153, 115, 0.3);
        border: 1px solid rgba(183, 153, 115, 0.3);
        color: #fff;
    }



</style>

<div class="display_justify_content px24" style="font-weight:bold; margin-top: 30px;font-size: 24px;">
    <p>我的優惠券</p>
</div>
<!-- 上面的按紐 -->
<div class="display_justify_content" style="margin-top:25px;">
    <div class=" display_justify_content wrapper">
        <a style="text-decoration:none;margin-top:0px;margin-right:10px;margin-bottom:20px;" class="button <?= $type == 1 ? 'active' : '' ?> " href="?type=1">可使用</a>
    </div>
    <div class=" display_justify_content wrapper">
        <a style="text-decoration:none;margin-top:0px;" class="button <?= $type == 2 ? 'active' : '' ?>" href="?type=2">已使用或過期</a>
    </div>
</div>
<!-- 中間 -->
<div style="width: 100%;">
    <div class="display_justify_content coupon_style" style="margin:20px auto;width:60%;flex-direction: column;padding-bottom: 20px;">
        <?php foreach ($rows as $r) : ?>
            <a class="display_justify_content" style="width:50%;margin: 5px auto;flex-direction: row;" >
            <span class="tilt tilt-1"></span><span class="tilt tilt-2"></span><span class="tilt tilt-3"></span><span class="tilt tilt-4"></span><span class="tilt tilt-5"></span><span class="tilt tilt-6"></span><span class="tilt tilt-7"></span><span class="tilt tilt-8"></span><span class="tilt tilt-9"></span><span class="tilt tilt-10"></span><span class="tilt tilt-11"></span><span class="tilt tilt-12"></span><span class="tilt tilt-13"></span><span class="tilt tilt-14"></span><span class="tilt tilt-15"></span>
                <div style="width: 50%;text-align:right;">
                    <div>
                        <img style="width:250px;<?= $type == 2 ? ' display: none;' : '' ?>" src="../41/copon_img/coupon_icon-removebg-preview.png" alt="">
                    </div>
                    <div>
                        <img style="width:250px;<?= $type == 1 ? ' display: none;' : '' ?>" src="../41/copon_img/coupon_icon-removebg-preview_02.png" alt="">
                    </div>
                </div>
                <div style="width: 4%;"></div>
                <div style="width: 46%;margin-top:25px;text-align:left;">
                    <div>
                        <div>
                            <?= $r['coupon_name'] ?>
                        </div>
                        <div style="flex-direction: row;margin-top:25px;">
                            <div style="font-size: 14px;">
                                <?= $type == 1 ?$r['end_time'] :$r['used_time']; ?>
                            </div>
                            <div style="width: 50px;font-size: 14px;">
                                <?= $type == 1 ? '到期' : '已過期'; ?>
                            </div>
                        </div>
                    </div>    
                </div>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- 下面的按紐 -->
<div class="row display_justify_content">
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