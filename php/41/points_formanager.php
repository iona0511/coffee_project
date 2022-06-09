<?php
require __DIR__ . '/parts/connect_db.php';



// require dirname(__DIR__,2) . '/parts/connect_db.php';
// ======================================

// session_start();

if (!isset($_SESSION['user']['admin_account'])){
    header('Location:/coffee_project/php/09/admin-login.html');
    // header('Location: http://www.example.com/');
    exit;
}

// =====================

$pageName = 'points_formanager';

$title = '會員積分紀錄';

$t_sql = sprintf("SELECT`points_user`.`total_points`,`points_user`.`voucher_amount`,`member`.`member_sid`,`member`.`member_account`FROM`points_user`JOIN`member`ON`points_user`.`member_sid`=`member`.`member_sid`");



// =============================
$perPage = 5;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header('Location: ?page=1');
    exit;
}

$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);
// ===========================
$rows = [];
if ($totalRows > 0) {
    if ($page > $totalPages) {
        exit;
    }

    $sql = sprintf("SELECT`points_user`.`total_points`,`points_user`.`voucher_amount`,`member`.`member_sid`,`member`.`member_account`FROM`points_user`JOIN`member`ON`points_user`.`member_sid`=`member`.`member_sid`");

    if(isset($_GET['account'])){
        $member_account = $_GET['account'];
        $sql = $sql.sprintf(" WHERE `member`.`member_account`= '%s'",$member_account);
    }

    $sql = $sql.sprintf(" LIMIT %s, %s",($page - 1) * $perPage, $perPage);


    $rows = $pdo->query($sql)->fetchAll();

}
// ==========================



?>

<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar_admin.php' ?>
<style>
    .display_justify_content {
        display: flex;
        justify-content: center;
    }
    
    .bg {
        background-color: #fff;
    }
    body {
        background-color: #CAAD87;
        background-size: cover;
        opacity: 0.9;
    }
    input:focus{
        background: transparent;
    }
    input:-internal-autofill-previewed,
    input:-internal-autofill-selected {
        -webkit-text-fill-color: #807c7c;
        transition: background-color 5000s ease-out 0.5s;
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
        text-decoration: underline;
    }
    .page-link{
        color: #B79973;
    }
        .side {
        position: fixed;
        width: 30%;
        height: 100vh;
        top: 0;
        left: 0;
    }
    /* ============================= */
        .animation-container {
        height: 454px;
        margin: 0 auto;
        overflow: hidden;
        position: relative;
        width: 806px;
    }
    span {
        display: block;
    }
    .coffee-bag {
        height: 170px;
        left: 50%;
        position: absolute;
        top: 50%;
        width: 72px;
        -webkit-transform: translate(-50%, -50%) rotate(0);
        -webkit-transform-orign: top right;
        -webkit-animation: coffee-bag 2.5s 1 2s forwards;
    }
    .mast {
        background: #73271f;
        height: 12px;
        position: absolute;
        width: 72px;
        z-index: 2;
        -webkit-transform: translate(806px, 0);
        -webkit-animation: coffee-bag-mast 1s 1 0.5s forwards;
    }
    .bag-top {
        border-radius: 8px 8px 0 0;
        background: #8e4542;
        height: 38px;
        position: absolute;
        width: 72px;
        z-index: 1;
        -webkit-transform: translate(-806px, 0);
        -webkit-animation: coffee-bag-top 1s 1 forwards;
    }
    .bag-body {
        border-radius: 0 0 8px 8px;
        background: #73271f;
        height: 125px;
        width: 72px;
        z-index: 1;
        -webkit-transform: translate(-806px, 38px);
        -webkit-animation: coffee-bag-body 1s 1 forwards;
    }
    .logo {
        border-radius: 50%;
        background: #af8757;
        height: 40px;
        position: absolute;
        width: 40px;
        z-index: 2;
        -webkit-transform: translate(15px, -75px) scale(0.25);
        -webkit-animation: coffee-logo 1s 1 forwards;
    }
    .logo .bean {
        border-radius: 20px;
        background: #4b2603;
        height: 8px;
        position: absolute;
        width: 20px;
        -webkit-transform: rotate(45deg) scale(0.25);
        -webkit-animation: bean-logo 1s 1 0.5s forwards;
    }
    .logo .bean.bean-one {
        left: 3px;
        top: 16px;
    }
    .logo .bean.bean-two {
        left: 16px;
        top: 14px;
    }
    .info {
        background: #d4a575;
        height: 10px;
        position: absolute;
        width: 54px;
        z-index: 2;
    }
    .info.info-one {
        -webkit-transform: translate(-806px, -25px);
        -webkit-animation: info-one 1s 1 0.25s forwards;
    }
    .info.info-two {
        -webkit-transform: translate(-806px, -10px);
        -webkit-animation: info-two 1s 1 0.5s forwards;
    }
    .info.info-three {
        -webkit-transform: translate(-806px, 5px);
        -webkit-animation: info-three 1s 1 0.75s forwards;
    }
    .bag-bottom {
        border-radius: 0 0 8px 8px;
        background: #4a0b10;
        bottom: 0;
        height: 12px;
        left: -806px;
        position: absolute;
        width: 72px;
        z-index: 2;
        -webkit-animation: coffee-bag-bottom 0.75s 1 forwards;
    }
    .grounds-container {
        opacity: 0;
        position: absolute;
        -webkit-animation: grounds 1.25s 1 forwards 2.75s;
    }
    .grounds {
        background: #4b0b09;
        height: 2px;
        width: 2px;
        z-index: 1;
        position: absolute;
    }
    .grounds:before, .grounds:after {
        background: #4b0b09;
        content: '';
        display: block;
        height: 2px;
        width: 2px;
        position: absolute;
    }
    .grounds:before {
        top: 5px;
        left: 5px;
    }
    .grounds:after {
        bottom: 5px;
        right: 5px;
    }
    .grounds-one {
        left: 10px;
        top: 10px;
    }
    .grounds-two {
        left: 10px;
        top: 20px;
    }
    .grounds-three {
        left: 10px;
        top: 30px;
    }
    .grounds-four {
        left: 10px;
        top: 40px;
    }
    .filter {
        background: #d1a978;
        border-radius: 0 0 10px 10px;
        height: 90px;
        position: relative;
        width: 100px;
        -webkit-transform: translate(400px, 550px);
        -webkit-animation: filter 2.5s 1 2s forwards;
    }
    .filter:after, .filter:before {
        border-radius: 50%;
        content: '';
        display: block;
        left: 50%;
        position: absolute;
    }
    .filter:before {
        background: #d1a978;
        height: 35px;
        margin-left: -60px;
        top: -10px;
        width: 120px;
        z-index: 1;
    }
    .filter:after {
        background: #b18957;
        height: 20px;
        margin-left: -50px;
        top: -2px;
        width: 100px;
        z-index: 2;
    }
    .roasting-top {
        background: #32262c;
        border-radius: 4px;
        height: 16px;
        position: relative;
        width: 125px;
        z-index: 2;
        -webkit-transform: translate(387px, -150px);
        -webkit-animation: roasting-top 2s 1 3s forwards;
    }
    .roasting-top:before {
        background: #32262c;
        border-radius: 4px;
        content: '';
        display: block;
        height: 18px;
        position: absolute;
        top: -12px;
        width: 125px;
    }
    .roasting-body {
        background: #1d1615;
        border-radius: 0 0 10px 10px;
        height: 90px;
        position: relative;
        width: 100px;
        -webkit-transform: translate(400px, 550px);
        -webkit-animation: roasting-body 2s 1 3s forwards;
    }
    .roasting-body:before, .roasting-body:after {
        content: '';
        display: block;
        position: absolute;
    }
    .roasting-body:before {
        border-radius: 50%;
        left: 50%;
        background: #1d1615;
        height: 35px;
        margin-left: -60px;
        top: -10px;
        width: 120px;
        z-index: 1;
    }
    .roasting-body:after {
        background: #2f2827;
        border-radius: 0 0 10px 10px;
        bottom: 0;
        height: 20px;
        width: 100px;
    }
    .handle-container {
        position: absolute;
        height: 48px;
        right: -25px;
        top: 23px;
        width: 26px;
    }
    .handle-one {
        background: #1d1615;
        height: 17px;
        position: absolute;
        width: 26px;
        z-index: 1;
    }
    .handle-two {
        background: #2f2827;
        height: 48px;
        position: absolute;
        right: 0;
        width: 8px;
        z-index: 2;
    }
    .screen {
        background: #1d1615;
        border-radius: 4px;
        height: 12px;
        width: 164px;
        -webkit-transform: translate(-806px, -66px);
        -webkit-animation: screen 1.5s 1 4.25s forwards;
    }
    .coffee-pot-top {
        background: #1c1616;
        border-radius: 6px;
        height: 16px;
        position: relative;
        width: 92px;
        z-index: 2;
        -webkit-transform: translate(806px, -303px);
        -webkit-animation: coffee-pot-top 1.5s 1 5s forwards;
    }
    .coffee-pot-glass-top {
        background: #dfe3e6;
        border: 3px solid #f3f2f7;
        border-radius: 6px;
        height: 16px;
        width: 92px;
        -webkit-transform: translate(806px, -315px) skewX(25deg);
        -webkit-animation: glass-top 1.5s 1 4.25s forwards;
    }
    .coffee-pot-glass-connector {
        background: #1c1616;
        border-radius: 6px;
        height: 7px;
        position: relative;
        width: 96px;
        z-index: 2;
        -webkit-transform: translate(806px, -313px);
        -webkit-animation: pot-connector 1.5s 1 5.25s forwards;
    }
    .coffee-pot-glass-base {
        background: #dfe3e6;
        border: 3px solid #f3f2f7;
        border-radius: 6px;
        height: 66px;
        position: relative;
        width: 92px;
        -webkit-transform: translate(806px, -312px);
        -webkit-animation: glass-bottom 1.5s 1 4.5s forwards;
    }
    .coffee-pot-gloss {
        background: #eff2f1;
        border-radius: 16px;
        height: 50px;
        left: 6px;
        position: absolute;
        top: 6px;
        width: 16px;
        z-index: 4;
    }
    .coffee-pot-handle-container {
        height: 86px;
        position: relative;
        width: 52px;
        -webkit-transform: translate(806px, -411px);
        -webkit-animation: coffee-pot-handle 1.5s 1 5s forwards;
    }
    .handle-top {
        background: #1d1614;
        border-radius: 10px 10px 0 10px;
        height: 26px;
        position: absolute;
        right: 0;
        top: 0;
        width: 48px;
    }
    .handle-bottom {
        background: transparent;
        border: 4px solid #1d1614;
        bottom: 10px;
        height: 52px;
        position: absolute;
        right: 0;
        width: 20px;
    }
    .water-attachment {
        background: #b3b2b4;
        border-radius: 4px;
        height: 12px;
        width: 110px;
        -webkit-transform: translate(-806px, -66px);
        -webkit-animation: water-attachment 1.5s 1 4.5s forwards;
    }
    .water-lid {
        background: #130f10;
        border-radius: 4px;
        height: 12px;
        left: 13px;
        position: relative;
        width: 110px;
        -webkit-transform: translate(-806px, -201px);
        -webkit-animation: water-lid 1.5s 1 4.5s forwards;
    }
    .water-lid:before {
        background: #2f2828;
        border-radius: 6px 6px 0 0;
        content: '';
        display: block;
        height: 14px;
        left: 12px;
        position: absolute;
        top: -14px;
        width: 85px;
    }
    .water-pot {
        background: #eaeceb;
        border-radius: 4px;
        height: 64px;
        left: 13px;
        position: relative;
        width: 110px;
        -webkit-transform: translate(806px, -201px);
        -webkit-animation: water-pot 1.5s 1 4.75s forwards;
    }
    .water-pot:before {
        background: #2f2828;
        border-radius: 0 0 6px 6px;
        content: '';
        display: block;
        height: 6px;
        left: 12px;
        position: absolute;
        top: 0;
        width: 85px;
    }
    .fill-line {
        background: #1d1614;
        border-radius: 50%;
        height: 3px;
        left: 50%;
        margin-left: -11px;
        position: absolute;
        width: 22px;
        z-index: 3;
    }
    .fill-line:after {
        background: #1d1614;
        border-radius: 50%;
        content: '';
        display: block;
        height: 3px;
        left: 50%;
        margin-left: -11px;
        position: absolute;
        top: 14px;
        width: 22px;
    }
    .fill-line-first {
        top: 12px;
    }
    .fill-line-last {
        top: 40px;
    }
    .water {
        background: #0093be;
        border-radius: 0 0 4px 4px;
        bottom: 5px;
        height: 32px;
        left: 50%;
        margin-left: -50px;
        position: absolute;
        width: 100px;
        z-index: 1;
        -webkit-animation: water-fill 4s 1 8.25s forwards;
    }
    .water-pot-gloss {
        background: rgba(255, 255, 255, .6);
        border-radius: 18px;
        height: 45px;
        left: 11px;
        position: absolute;
        top: 10px;
        width: 18px;
        z-index: 4;
    }
    .warmer-plate {
        background: #191112;
        border-radius: 4px;
        height: 10px;
        width: 88px;
        -webkit-transform: translate(806px, -200px);
        -webkit-animation: warmer-plate 1.5s 1 4.5s forwards;
    }
    .warmer {
        background: #9b9187;
        border-radius: 6px;
        height: 130px;
        position: relative;
        width: 94px;
        -webkit-transform: translate(806px, -200px);
        -webkit-animation: big-warmer 1.5s 1 5s forwards;
    }
    .warmer-accent {
        background: #d5d4d5;
        border-radius: 24px;
        position: absolute;
        width: 24px;
    }
    .accent-one {
        height: 86px;
        left: 10px;
        top: 6px;
    }
    .accent-two {
        bottom: 6px;
        height: 24px;
        left: 10px;
    }
    .accent-three {
        height: 120px;
        right: 10px;
        top: 6px;
    }
    .warmer-base {
        background: #191112;
        border-radius: 4px;
        height: 10px;
        position: relative;
        width: 88px;
        -webkit-transform: translate(806px, -200px);
        -webkit-animation: warmer-base 1.5s 1 5s forwards;
    }
    .warmer-base:before {
        background: #191112;
        border-radius: 4px;
        bottom: -16px;
        content: '';
        display: block;
        height: 22px;
        left: 0;
        position: absolute;
        width: 88px;
    }
    .coffee-warmer-plate {
        background: #191112;
        border-radius: 4px;
        height: 10px;
        width: 94px;
        -webkit-transform: translate(-806px, -397px);
        -webkit-animation: coffee-warmer-plate 1.5s 1 4s forwards;
    }
    .coffee-base-left-end, .coffee-base-right-end {
        background: #1c1512;
        height: 34px;
        position: relative;
        width: 16px;
        z-index: 3;
    }
    .coffee-base-left-end {
        border-radius: 10px 0 0 10px;
        -webkit-transform: translate(806px, -397px);
        -webkit-animation: base-left 1.5s 1 5.5s forwards;
    }
    .coffee-base-right-end {
        border-radius: 0 10px 10px 0;
        -webkit-transform: translate(806px, -487px);
        -webkit-animation: base-right 1.5s 1 5.5s forwards;
    }
    .coffee-maker-base {
        background: #97938d;
        border-radius: 10px;
        height: 34px;
        position: relative;
        width: 344px;
        z-index: 2;
        -webkit-transform: translate(806px, -431px);
        -webkit-animation: coffee-base 1.5s 1 5.5s forwards;
    }
    .control-panel {
        background: #d4d4d4;
        border-radius: 15px;
        height: 22px;
        position: relative;
        width: 283px;
        z-index: 3;
        -webkit-transform: translate(806px, -459px);
        -webkit-animation: control-panel 1.5s 1 5.75s forwards;
    }
    .control-panel span {
        background: #2a2225;
        border-radius: 4px;
        height: 14px;
        position: relative;
        width: 28px;
    }
    .control-panel span:after {
        border-radius: 8px;
        content: '';
        display: block;
        height: 8px;
        margin-top: -4px;
        position: absolute;
        top: 50%;
        width: 8px;
    }
    .gauge-one {
        -webkit-transform: translate(15px, 4px);
    }
    .gauge-one:after {
        background: #4ac861;
        left: 4px;
    }
    .gauge-two {
        -webkit-transform: translate(55px, -10px);
    }
    .gauge-two:after {
        background: #f00;
        right: 4px;
        -webkit-animation: ready 0.75s 1 7.5s forwards;
    }
    .leg {
        background: #1b1317;
        border-radius: 4px;
        height: 20px;
        position: relative;
        width: 20px;
        z-index: 1;
    }
    .leg-one {
        -webkit-transform: translate(806px, -498px);
        -webkit-animation: leg-one 1.5s 1 6s forwards;
    }
    .leg-two {
        -webkit-transform: translate(806px, -518px);
        -webkit-animation: leg-two 1.5s 1 6s forwards;
    }
    .coffee-drip {
        background: #38271d;
        height: 0;
        left: 450px;
        position: absolute;
        top: 159px;
        width: 5px;
        z-index: 1;
        -webkit-animation: drip 1.25s 1 8.5s forwards;
    }
    .drip-cover {
        background: #dfe3e6;
        height: 0;
        left: 450px;
        position: absolute;
        top: 159px;
        width: 5px;
        z-index: 1;
        -webkit-animation: drip 2.5s 1 10s forwards;
    }
    .coffee {
        background: #38271d;
        border-radius: 0 0 6px 6px;
        bottom: 202px;
        left: 404px;
        height: 0;
        position: absolute;
        width: 99px;
        z-index: 3;
        -webkit-animation: coffee 3.5s 1 9.25s forwards;
    }
    @-webkit-keyframes coffee-bag-mast {
        0% {
            -webkit-transform: translate(806px, 0);
        }
        100% {
            -webkit-transform: translate(0, 0);
        }
    }
    @-webkit-keyframes coffee-bag-top {
        0% {
            -webkit-transform: translate(-806px, 0);
        }
        100% {
            -webkit-transform: translate(0, 0);
        }
    }
    @-webkit-keyframes info-one {
        0% {
            -webkit-transform: translate(-806px, -25px);
        }
        100% {
            -webkit-transform: translate(8px, -25px);
        }
    }
    @-webkit-keyframes info-two {
        0% {
            -webkit-transform: translate(-806px, -10px);
        }
        100% {
            -webkit-transform: translate(8px, -10px);
        }
    }
    @-webkit-keyframes info-three {
        0% {
            -webkit-transform: translate(-806px, 5px);
        }
        100% {
            -webkit-transform: translate(8px, 5px);
        }
    }
    @-webkit-keyframes coffee-bag-body {
        0% {
            -webkit-transform: translate(806px, 38px);
        }
        100% {
            -webkit-transform: translate(0, 38px);
        }
    }
    @-webkit-keyframes coffee-bag-bottom {
        0% {
            left: -806px;
        }
        100% {
            left: 0;
        }
    }
    @-webkit-keyframes coffee-logo {
        0% {
            -webkit-transform: translate(15px, -75px) scale(0.25);
        }
        100% {
            -webkit-transform: translate(15px, -75px) scale(1);
        }
    }
    @-webkit-keyframes bean-logo {
        0% {
            -webkit-transform: rotate(45deg) scale(0.25);
        }
        100% {
            -webkit-transform: rotate(45deg) scale(1);
        }
    }
    @-webkit-keyframes coffee-bag {
        0% {
            -webkit-transform: translate(-50%, -50%) rotate(0);
        }
        50% {
            -webkit-transform: translate(180%, -100%) rotate(-95deg);
        }
        100% {
            -webkit-transform: translate(806px, -100%);
        }
    }
    @-webkit-keyframes coffee-bag-exit {
        100% {
            -webkit-transform: translate(860px, -100%);
        }
    }
    @-webkit-keyframes filter {
        0% {
            -webkit-transform: translate(400px, 550px);
        }
        50% {
            -webkit-transform: translate(400px, 250px);
        }
        100% {
            -webkit-transform: translate(400px, 40px);
        }
    }
    @-webkit-keyframes roasting-body {
        0% {
            -webkit-transform: translate(400px, 550px);
        }
        100% {
            -webkit-transform: translate(400px, -65px);
        }
    }
    @-webkit-keyframes roasting-top {
        0% {
            -webkit-transform: translate(387px, -150px);
        }
        100% {
            -webkit-transform: translate(387px, -48px);
        }
    }
    @-webkit-keyframes screen {
        0% {
            -webkit-transform: translate(806px, -66px);
        }
        100% {
            -webkit-transform: translate(355px, -66px);
        }
    }
    @-webkit-keyframes water-attachment {
        0% {
            -webkit-transform: translate(806px, -190px);
        }
        100% {
            -webkit-transform: translate(340px, -190px);
        }
    }
    @-webkit-keyframes water-lid {
        0% {
            -webkit-transform: translate(-806px, -201px);
        }
        100% {
            -webkit-transform: translate(234px, -201px);
        }
    }
    @-webkit-keyframes glass-top {
        0% {
            -webkit-transform: translate(806px, -315px) skewX(25deg);
        }
        100% {
            -webkit-transform: translate(397px, -315px) skewX(25deg);
        }
    }
    @-webkit-keyframes glass-bottom {
        0% {
            -webkit-transform: translate(806px, -312px);
        }
        100% {
            -webkit-transform: translate(404px, -312px);
        }
    }
    @-webkit-keyframes coffee-warmer-plate {
        0% {
            -webkit-transform: translate(-806px, -397px);
        }
        100% {
            -webkit-transform: translate(407px, -397px);
        }
    }
    @-webkit-keyframes water-pot {
        0% {
            -webkit-transform: translate(806px, -201px);
        }
        100% {
            -webkit-transform: translate(233px, -201px);
        }
    }
    @-webkit-keyframes warmer-plate {
        0% {
            -webkit-transform: translate(806px, -200px);
        }
        100% {
            -webkit-transform: translate(258px, -200px);
        }
    }
    @-webkit-keyframes big-warmer {
        0% {
            -webkit-transform: translate(806px, -200px);
        }
        100% {
            -webkit-transform: translate(255px, -200px);
        }
    }
    @-webkit-keyframes warmer-base {
        0% {
            -webkit-transform: translate(-806px, -200px);
        }
        100% {
            -webkit-transform: translate(258px, -200px);
        }
    }
    @-webkit-keyframes coffee-pot-top {
        0% {
            -webkit-transform: translate(-806px, -503px);
        }
        100% {
            -webkit-transform: translate(408px, -303px);
        }
    }
    @-webkit-keyframes coffee-pot-handle {
        0% {
            -webkit-transform: translate(-806px, 703px);
        }
        100% {
            -webkit-transform: translate(479px, -411px);
        }
    }
    @-webkit-keyframes pot-connector {
        0% {
            -webkit-transform: translate(806px, 403px);
        }
        100% {
            -webkit-transform: translate(404px, -313px);
        }
    }
    @-webkit-keyframes base-left {
        0% {
            -webkit-transform: translate(806px, 703px);
        }
        100% {
            -webkit-transform: translate(218px, -397px);
        }
    }
    @-webkit-keyframes base-right {
        0% {
            -webkit-transform: translate(-806px, 703px);
        }
        100% {
            -webkit-transform: translate(546px, -487px);
        }
    }
    @-webkit-keyframes coffee-base {
        0% {
            -webkit-transform: translate(806px, 903px);
        }
        100% {
            -webkit-transform: translate(218px, -431px);
        }
    }
    @-webkit-keyframes control-panel {
        0% {
            -webkit-transform: translate(-806px, -459px);
        }
        100% {
            -webkit-transform: translate(246px, -459px);
        }
    }
    @-webkit-keyframes leg-one {
        0% {
            -webkit-transform: translate(-806px, -800px);
        }
        100% {
            -webkit-transform: translate(248px, -498px);
        }
    }
    @-webkit-keyframes leg-two {
        0% {
            -webkit-transform: translate(-806px, -800px);
        }
        100% {
            -webkit-transform: translate(508px, -518px);
        }
    }
    @-webkit-keyframes water-fill {
        0% {
            height: 32px;
        }
        100% {
            height: 0;
        }
    }
    @-webkit-keyframes drip {
        0% {
            height: 0;
        }
        100% {
            height: 93px;
        }
    }
    @-webkit-keyframes coffee {
        0% {
            height: 0;
        }
        100% {
            height: 26px;
        }
    }
    @-webkit-keyframes ready {
        0% {
            background: #f00;
        }
        100% {
            background: #4ac861;
        }
    }
    @-webkit-keyframes grounds {
        0% {
            opacity: 0;
            left: 450px;
            top: 110px;
        }
        10% {
            opacity: 1;
        }
        100% {
            left: 440px;
            top: 170px;
            opacity: 0;
        }
    }


    
</style>
<div class="display_justify_content px24" style="font-weight:bold; margin-top: 5px;font-size: 24px;">
    總會員積分紀錄
</div>
<div>
    <div style="width:300px;margin-left:auto;margin-right: 5%;margin-top:50px;display:flex;">
        <svg style="margin-top:10px;" xmlns="HLM/images/common/_l_search.svg" width="17.494" height="17.33" viewBox="0 0 17.494 17.33">
        <g stroke="#111" fill="none">
        <g transform="translate(-341 -23) translate(341 23)">
        <circle cx="7.492" cy="7.492" r="7.492" stroke="none"></circle>
        <circle cx="7.492" cy="7.492" r="6.992"></circle>
        </g>
        <path d="M12.308 12.308l4.839 4.662"></path>
        </g>
        </svg>

        <form name="form_pfm" style="margin-left: 5px;" novalidate> 
                <input style="outline:none;border: none;border-bottom: 1px solid #000;padding: 7px 0px;background: transparent;" type="text" name="account" value="" placeholder="輸入會員帳號">
            </div>

        </form>
    </div>

</div>
<div style="display: flex;">
    <div class="display_justify_content" style="margin-top: 50px;margin-left:5%;">
        <div class="display_justify_content" style="height: 500px; width:1000px;">
            <table class="table table-striped" style="width: 90%;">
                <thead>
                    <tr>
                        <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius: 20px 0 0 0;">會員基本資料編號</th>
                        <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">會員帳號</th>
                        <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);">總積分</th>
                        <th scope="col" style=" background:linear-gradient(#F4F2EE, #F4EBDE, #F4F2EE);border-radius:0 20px 0 0 ;">兌換券總張數</th>
                    </tr>
                </thead>
                <tbody class="bg">
                    <?php foreach ($rows as $r) : ?>
                        <tr>
                            <td><?= $r['member_sid'] ?></td>
                            <td><?= $r['member_account']  ?></td>
                            <td><?= $r['total_points'] ?></td>
                            <td><?= $r['voucher_amount'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="animation-container" style="width:50%;margin-top:300px;">
        
        <div class="coffee-bag-container">
            <div class="coffee-bag">
            <span class="mast"></span>
            <span class="bag-top"></span>
            <span class="bag-body"></span>
            <span class="logo">
                <span class="bean bean-one"></span>
                <span class="bean bean-two"></span>
            </span>
            <span class="info info-one"></span>
            <span class="info info-two"></span>
            <span class="info info-three"></span>
            <span class="bag-bottom"></span>
            
            </div><!-- ./coffee-bag -->
        </div><!-- ./coffee-bag-container -->
    <span class="grounds-container">
    <span class="grounds grounds-one"></span>
    <span class="grounds grounds-two"></span>
    <span class="grounds grounds-three"></span>
    <span class="grounds grounds-four"></span>
    </span>
        
        <div class="filter"></div><!-- ./filter -->
        
        <!-- TODO: create coffee grounds falling from the bag into the filter -->
        
        <span class="roasting-top"></span>
        
        <div class="roasting-body">
            <span class="handle-container">
            <span class="handle-one"></span>
            <span class="handle-two"></span>
            </span>
        </div><!-- ./roasting-body -->
        
        <!-- the black part between the coffee pot and the filter -->
        <span class="screen"></span>
        
        <span class="water-attachment"></span>
        
        <span class="water-lid"></span>
        
        <span class="water-pot">
            <span class="water-pot-gloss"></span>
            <span class="fill-line fill-line-first"></span>
            <span class="fill-line fill-line-last"></span>
            <span class="water"></span>
        </span>
        
        <span class="warmer-plate"></span>
        
        <span class="warmer">
            <span class="warmer-accent accent-one"></span>
            <span class="warmer-accent accent-two"></span>
            <span class="warmer-accent accent-three"></span>
        </span>
        
        <span class="warmer-base"></span>
        
        <span class="coffee-pot-container">
        
            <span class="coffee-pot-top"></span>
            
            <span class="coffee-pot-glass-top"></span>
            
            <span class="coffee-pot-glass-connector"></span>
            
            <span class="coffee-pot-glass-base">
            <span class="coffee-pot-gloss"></span>
            </span>
            
            <span class="coffee-pot-handle-container">
            <span class="handle-top"></span>
            <span class="handle-bottom"></span>
            </span>
            
            <span class="coffee-drip"></span>
        
            <span class="drip-cover"></span>
            
            <span class="coffee"></span>
        
        </span>
        
        <span class="coffee-warmer-plate"></span>
        
        <span class="coffee-base-left-end"></span>
        
        <span class="coffee-maker-base"></span>
        
        <span class="control-panel">
            <span class="gauge-one"></span>
            <span class="gauge-two"></span>
        </span>
        
        <span class="coffee-base-right-end"></span>
        
        <span class="leg leg-one"></span>
        
        <span class="leg leg-two"></span>
        
        </div>
</div>
<!-- ======= JS ======== -->
<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
    async function sendData() {
        
        const fd = new FormData(document.form_pfm);

        const r = await fetch('points_formanager_api.php', {
            method: 'POST',
            body: fd,
        });

        const result = await r.json();

        console.log(result);
    }
</script>
