<?php 
// require __DIR__ . '/parts/connect_db.php';
require dirname(__DIR__,2) . '/parts/connect_db.php';
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
    .coupon_style{
        background: rgba(255, 255, 255, 0.2);
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
        /* background-color: rgba(183, 153, 115, 0.3);
        border: 1px solid rgba(183, 153, 115, 0.3); */
        text-decoration: none;
        color: #000;
    }

/* ====================== */
    p.photographer:after {
        content: "View on Upsplash";
        font-size: 16px;
        margin-top: 6px;
        letter-spacing: 0;
        display: block;
        color: #000;
        z-index: 1000;
    }
    /* ============== */
    .card {
        z-index: 1;
        margin: 12px 12px;
        position: relative;
        height: 185px;
        width: 285px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        background:url(../41/copon_img/41_Card_01.JPG);
        background-size: 100%;
        background-repeat: no-repeat;
    }
    .card p {
        width: 100%;
        top: 184px;
        text-align: center;
        position: absolute;
        font-size: 30px;
        font-weight: 100;
        letter-spacing: 4px;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }
    .card:hover > .social {
        opacity: 1;
    }
    .card .social {
        width: 100%;
        height: 100%;
        opacity: 0;
    }
    .card .social ul {
        z-index: 5;
        padding-left: 0;
        list-style: none;
        position: absolute;
        right: 0;
        margin-right: 16px;
    }
    .card .social ul a {
        color: #fff;
        position: relative;
    }
    .card .social ul .f, .card .social ul .t, .card .social ul .m, .card .social ul .g, .card .social ul .star {
        font-size: 12px;
        height: 20px;
        width: 20px;
        position: relative;
    }
    .card .social ul .star a {
        color: #444;
    }
    .card .social ul .star {
        background-color: #ddd;
        margin-bottom: 8px;
        color: #444;
    }
    .card .social ul .f {
        background-color: #1565c0;
    }
    .card .social ul .t {
        background-color: #29b6f6;
    }
    .card .social ul .m {
        background-color: #00e676;
    }
    .card .social ul .g {
        background-color: #212121;
    }

    /* ============= */

    .card2 {
        z-index: 1;
        margin: 12px 12px;
        position: relative;
        height: 185px;
        width: 285px;
        background-color: #BFBFB5;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        background-size: 100%;
        background-repeat: no-repeat;
    }
    .card2 p {
        width: 100%;
        top: 184px;
        text-align: center;
        position: absolute;
        font-size: 30px;
        font-weight: 100;
        letter-spacing: 4px;
    }
    .card2:hover {
        transform: translateY(-5px);
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
    }
    .card2:hover > .social {
        opacity: 1;
    }
    .card2 .social {
        width: 100%;
        height: 100%;
        opacity: 0;
    }
    .card2 .social ul {
        z-index: 5;
        padding-left: 0;
        list-style: none;
        position: absolute;
        right: 0;
        margin-right: 16px;
    }
    .card2 .social ul a {
        color: #fff;
        position: relative;
    }
    .card2 .social ul .f, .card2 .social ul .t, .card2 .social ul .m, .card2 .social ul .g, .card2 .social ul .star {
        font-size: 12px;
        height: 20px;
        width: 20px;
        position: relative;
    }
    .card2 .social ul .star a {
        color: #444;
    }
    .card2 .social ul .star {
        background-color: #ddd;
        margin-bottom: 8px;
        color: #444;
    }
    .card2 .social ul .f {
        background-color: #1565c0;
    }
    .card2 .social ul .t {
        background-color: #29b6f6;
    }
    .card2 .social ul .m {
        background-color: #00e676;
    }
    .card2 .social ul .g {
        background-color: #212121;
    }

    /* ============= */
    .star:hover:after {
        content: "Favorite";
        right: -70px;
    }
    .f:hover:after {
        content: "Share on Facebook";
        right: -132px;
    }
    .t:hover:after {
        content: "Share on Twitter";
        right: -112px;
    }
    .m:hover:after {
        content: "Share on Medium";
        right: -122px;
    }
    .g:hover:after {
        content: "Fork on Github";
        right: -106px;
    }
    .star:hover:after, .f:hover:after, .t:hover:after, .m:hover:after, .g:hover:after {
        display: inline;
        background-color: #f06292;
        padding: 4px 8px;
        transition-delay: 300ms;
        transition: 300ms;
        color: #000;
        position: absolute;
        top: 0;
        font-size: 12px;
        font-weight: 100;
    }
    .star:hover:before, .f:hover:before, .t:hover:before, .m:hover:before, .g:hover:before {
        display: block;
        content: "";
        position: absolute;
        right: -12px;
        width: 0;
        height: 0;
        border-top: 6px solid transparent;
        border-bottom: 6px solid transparent;
        border-right: 10px solid #f06292;
    }
    .star:after, .f:after, .t:after, .m:after, .g:after {
        z-index: 100;
    }
    /* ============================ */

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
    
    
    #myVideo {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: -1;
    }

</style>


<video autoplay muted loop id="myVideo">
    <source src="./copon_img/Grinding up coffee beans.mp4" type="video/mp4">
</video>



<section>
    <div class=" loading loading07 load">
        <span data-text="查"></span>
        <span data-text="看"></span>
        <span data-text="我"></span>
        <span data-text="的"></span>
        <span data-text="優"></span>
        <span data-text="惠"></span>
        <span data-text="券"></span> 
        
    </div>
</section>


<!-- 上面的按紐 -->
<div class="display_justify_content load" style="margin-top:45px;">
    <div class=" display_justify_content wrapper">
        <a style="text-decoration:none;margin-top:0px;margin-right:10px;margin-bottom:20px;" class="button <?= $type == 1 ? 'active' : '' ?> " href="?type=1">可使用</a>
    </div>
    <div class=" display_justify_content wrapper">
        <a style="text-decoration:none;margin-top:0px;" class="button <?= $type == 2 ? 'active' : '' ?>" href="?type=2">已使用或過期</a>
    </div>
</div>
<!-- 中間 -->
<div style="width: 100%;">
    <div class="display_justify_content coupon_style load" style="margin:20px auto;width:60%;flex-direction: column;padding-bottom: 20px;">
        <?php foreach ($rows as $r) : ?>
            <a class="display_justify_content" style="width:50%;margin: 5px auto;flex-direction: row;" >
                <!-- <div style="width: 100%;display:flex;flex-direction: row;" class="card load"> -->
                <div style="width: 100%;display:flex;flex-direction: row;" class="<?= $type ==1 ? 'card':'card2' ?> load">
                    <div>
                        <img style="width:250px;<?= $type == 2 ? ' display: none;' : '' ?>" src="../41/copon_img/coupon_icon-removebg-preview.png" alt="">
                    </div>
                    <div>
                        <img style="width:250px;<?= $type == 1 ? ' display: none;' : '' ?>" src="../41/copon_img/coupon_icon-removebg-preview_02.png" alt="">
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
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>

<!-- 下面的按紐 -->
<div class=" display_justify_content load">
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

