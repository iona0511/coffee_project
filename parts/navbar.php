<?php
if (!session_id()) {
    session_start();
}
?>

<style>
    .navinner_pc a {
        color: rgba(0, 0, 0, .55);
        text-decoration: none;
        z-index: 999;
    }

    .nav_pc {
        transition: 0.3s;
        transform: translateY(-150px);
    }

    button {
        cursor: pointer;
        border: none;
        outline: none;
    }

    .is-open {
        opacity: 1;
        transform: translateY(52px);
        z-index: 999;
    }

    .PCBtn {
        border: none;
        border-radius: 0;
        box-shadow: none;
        background: none;
        appearance: none;
        outline: none;
    }

    .cart {
        position: relative;
    }

    .cart::before {
        content: attr(data-content-before);
        position: absolute;
        top: 0px;
        right: 0px;
        background-color: red;
        color: white;
        padding: 0px 5px;
        font-size: 9px;
        border-radius: 50%;
    }

    .fa-cart-shopping {
        font-size: 24px;
    }
    .z-up {
        z-index: 999;
    }
</style>
<div class="bg-light" style="width:100%">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent" style="width: 100%;">
            <img style="width: 50px; aspect-ratio:1;" src="/coffee_project/images/09/picwish.png" alt="">
            <ul class="nav navbar-nav  me-auto mb-2 mb-lg-0" style="height: 45px;position: relative;">
                <li class="nav-item px-2">
                    <a class="nav-link" aria-current="page" href="/coffee_project/index_.php">首頁</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/coffee_project/php/18/news_index_font.php">活動消息</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/coffee_project/php/35/products_font.php">商品</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/coffee_project/php/11/food_order.html">點餐</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/coffee_project/php/29/class-index.html">課程資訊</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/coffee_project/php/44/share.html">分享牆</a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link" href="/coffee_project/php/44/post-add.php">新增分享</a>
                </li>
                <li class="nav-item" style="position: relative;">
                    <button class="PCBtn nav-link" style="position:absolute;width: 70px;" type="button" onclick="ShowMyPC()">
                        會員頁
                    </button>
                    <ul class="navlist navinner_pc nav_pc ps-0 bg-light" style="background-color: #F3F1EE;color: rgba(0,0,0,.55);position:absolute;width: 100px;">
                        <div class="nav-item z-up">
                            <a href="<?php if (isset($_SESSION['user'])) : ?>
                                    <?= "/coffee_project/php/09/welcome.php" ?>
                                    <?php else : ?>
                                        <?= "/coffee_project/php/09/login.html" ?>
                                    <?php endif ?>">會員中心</a>
                        </div>
                        <div class="nav-item">
                            <a href="/coffee_project/php/41/coupon_foruser.php">我的優惠券</a>
                        </div>
                        <div class="nav-item">
                            <a href="/coffee_project/php/41/points_foruser.php">我的積分</a>
                        </div>
                    </ul>
                </li>
            </ul>
            <ul class="d-flex nav navbar-nav  me-auto mb-0 align-items-center" style="margin-left:auto;">
                <a class="nav-link cart" href="/coffee_project/php/40/cart.html" data-content-before><i class="fa-solid fa-cart-shopping"></i></a>
                <?php if (isset($_SESSION['user'])) : ?>
                    <li class="mr-3 nav-item px-2" style="margin-top:5px; display: none;">會員:<?= $_SESSION['user']['member_name'] ?></li>
                    <li class="mr-3 nav-item px-2 " style="">哈囉! <?= $_SESSION['user']['member_nickname'] ?></li>
                    <li class="mr-3 nav-item px-2" style="margin-top:5px; display:none;">ID:<?= $_SESSION['user']['member_sid'] ?></li>
                    <a class="nav-link" href="/coffee_project/php/09/logout.php" style="text-decoration: none;">
                        登出
                    </a>
                <?php else : ?>
                    <a href="/coffee_project/php/09/login.html" style="text-decoration:none;color:#B79973;">
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

    function checkQuantity() {
        const cart_quantity = document.querySelector("[data-content-before]");
        const myHref = window.location.href.replace(/coffee_project.*/, "coffee_project/parts/read_quantity_api.php");
        fetch(myHref)
            .then(data => data.json())
            .then(data => {
                cart_quantity.setAttribute("data-content-before", data.food.length + data.product.length);
            })
            .catch(() => {
                cart_quantity.setAttribute("data-content-before", 0);
            })
    };
    checkQuantity();
</script>