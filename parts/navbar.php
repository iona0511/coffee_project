<?php
    if(!session_id()) {
        session_start();
    }
?>

<div class="container-fluid bg-light">

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- <a class="navbar-brand" href="#">首頁</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
                    <img style="width: 50px; aspect-ratio:1;" src="/coffee_project/images/09/picwish.png" alt="">
                    <ul class="nav navbar-nav  me-auto mb-2 mb-lg-0">
                        <li class="nav-item px-2">
                            <a class="nav-link" aria-current="page" href="/coffee_project/index_.php">首頁</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="#">店家資訊</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="#">商品</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="/coffee_project/php/11/food_order.html">點餐</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="/coffee_project/php/29/class-index.html">課程資訊</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="">分享牆</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="#">客服</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="#">遊戲</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="/coffee_project/php/40/40.html">購物車</a>
                        </li>
                        <li class="nav-item px-2">
                            <a class="nav-link" href="<?php if (isset($_SESSION['user'])) : ?>
                                <?= "/coffee_project/php/09/welcome.php" ?>
                                <?php else : ?>
                                    <?= "/coffee_project/php/09/login.html" ?>
                                <?php endif ?>">
                                    會員中心</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/coffee_project/php/41/points_foruser.php">優惠券</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <?php if (isset($_SESSION['user'])) : ?>
                            <h5 class="mr-3">會員:<?= $_SESSION['user']['member_name'] ?></h5>
                            <h5 class="mr-3">暱稱:<?= $_SESSION['user']['member_nickname'] ?></h5>
                            <h5 class="mr-3">ID:<?= $_SESSION['user']['member_sid'] ?></h5>
                            <a href="/coffee_project/php/09/logout.php">
                                <h5>登出</h5>
                            </a>
                        <?php else : ?>
                            <a href="/coffee_project/php/09/login.html"  style="text-decoration:none;color:#B79973;" >
                                <h6 class="mr-3 mb-0">會員登入</h6>
                            </a>
                        <?php endif ?>
                    </form>
                </div>
            </div>
        </nav>
    </div>
</div>