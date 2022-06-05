<?php 
require dirname(__DIR__,2) . '/parts/connect_db.php';
session_start();

if (!isset($_SESSION['user']['member_account'])){
    header('Location:/coffee_project/php/09/login.html');
    exit;
}

?>
<?php include __DIR__ . '/parts/html-head.php' ?>

<style>
    .display_justify_content {
        display: flex;
        justify-content: center;
    }
    .wrapper {
        display: block;
        /* transform: translate(-50%, -50%); */
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
</style>

<div class="display_justify_content px24" style="font-weight:bold; margin-top: 20px;">
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