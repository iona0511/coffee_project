<?php
    if(!session_id()) {
        session_start();
    }
?>

<style>
    .navinner_pc a{
        color: rgba(0,0,0,.55);
        text-decoration: none;
    }
    .nav_pc{
        transition: 0.3s;
        transform: translateY(-180px);
    }
    button{
        cursor: pointer;
        border: none;
        outline: none;
        /* padding-right: 0.5rem;
        padding-left: 0.5rem; */
    }
    .is-open{
        opacity: 1;
        transform: translateY(0);
        z-index: 100;
    }
    .PCBtn{
        position: relative;
        z-index: 999;
        border: none;
        border-radius: 0;
        box-shadow: none;
        background: none;
        appearance: none;
        outline: none;
    }
</style>
<div class="bg-light" style="width:100%">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent" style="width: 100%;">
                    <img style="width: 50px; aspect-ratio:1;" src="/coffee_project/images/09/picwish.png" alt="">
                    <ul class="nav navbar-nav  me-auto mb-2 mb-lg-0"  style="height: 45px;">
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
                            <a class="nav-link" href="/coffee_project/php/44/post-add.php">新增分享</a>
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
                        <li class="nav-item">
                            <button class="PCBtn nav-link" type="button" onclick="ShowMyPC()">
                            個人
                            </button>
                        <ul class="navlist navinner_pc nav_pc ps-0 bg-light" style="background-color: #F3F1EE;color: rgba(0,0,0,.55);">
                                    <li class="nav-item ">
                                        <a  href="<?php if (isset($_SESSION['user'])) : ?>
                                        <?= "/coffee_project/php/09/welcome.php" ?>
                                        <?php else : ?>
                                            <?= "/coffee_project/php/09/login.html" ?>
                                        <?php endif ?>">會員中心</a>
                                    </li>
                                    <li class="nav-item ">
                                        <a href="/coffee_project/php/41/points_formanager.php">優惠券系統</a>
                                    </li>
                                    <li class="nav-item">
                                        <a  href="/coffee_project/php/41/points_formanager.php">積分系統</a>
                                    </li>
                                </ul>
                        </li>
                    </ul>
                    <ul class="d-flex nav navbar-nav  me-auto mb-2 mb-lg-0 " style="margin-left:auto;">
                        <?php if (isset($_SESSION['user'])) : ?>
                            <li class="mr-3 nav-item px-2" style="margin-top:5px;">會員:<?= $_SESSION['user']['member_name'] ?></li>
                            <li class="mr-3 nav-item px-2 " style="margin-top:5px;">暱稱:<?= $_SESSION['user']['member_nickname'] ?></li>
                            <li class="mr-3 nav-item px-2" style="margin-top:5px;">ID:<?= $_SESSION['user']['member_sid'] ?></li>
                            <a class="nav-link" href="/coffee_project/php/09/logout.php" style="text-decoration: none;">
                                登出
                            </a>
                        <?php else : ?>
                            <a  href="/coffee_project/php/09/login.html"  style="text-decoration:none;color:#B79973;" >
                                <h6 class="mr-3 mb-0">會員登入</h6>
                            </a>
                        <?php endif ?>
                    </ul>
                </div>

        </nav>
</div>


<script>
    let PCBtnOpened = false; 

    const openMenu = () => {
        document.querySelector(".navinner_pc").classList.add("is-open");
    };
    const closeMenu = () => {
        document.querySelector(".navinner_pc").classList.remove("is-open");
    };

    const ShowMyPC = () => {
        PCBtnOpened = !PCBtnOpened;
        if (PCBtnOpened) {
            openMenu();
        } else {
            closeMenu();
        }
    };
</script>