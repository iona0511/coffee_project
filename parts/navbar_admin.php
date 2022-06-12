<style>
    .navinner_pc a {
        color: rgba(0, 0, 0, .55);
        text-decoration: none;
    }

    .nav_pc {
        transition: 0.3s;
        transform: translateY(-160px);
    }

    button {
        cursor: pointer;
        border: none;
        outline: none;
    }

    .m_btn {
        cursor: pointer;
        border: none;
        outline: none;
    }

    .is-open {
        opacity: 1;
        transform: translateY(52px);
        z-index: 100;
    }

    .PCBtn {
        border: none;
        border-radius: 0;
        box-shadow: none;
        background: none;
        appearance: none;
        outline: none;
    }

    .bac-img {
        background: url(/coffee_project/images/material/picwish.png);
    }
</style>

<div style="width: 100%;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="#">首頁</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
                <img style="width: 50px; aspect-ratio:1;" src="/coffee_project/images/09/picwish.png" alt="">
                <ul class="nav navbar-nav  me-auto mb-2 mb-lg-0" style="height: 45px;">

                    <li class="nav-item">
                        <a class="nav-link pe-4" href="/coffee_project/php/18/lastest-news.php">消息管理</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-4" href="/coffee_project/php/35/products.php">商品</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-4" href="/coffee_project/php/11/menu_list.php">點餐</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-4" href="/coffee_project/php/29/delete-data.html">課程後台</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pe-4" href="/coffee_project/php/44/post-list.php">分享列表</a>
                    </li>
                    <li class="nav-item pe-4" style="position: relative;">
                        <button class="PCBtn nav-link" style="position:absolute;width: 60px;" type="button" onclick="ShowMyPC()">
                            會員
                        </button>
                        <ul class="navlist navinner_pc nav_pc ps-0 bg-light" style="background-color: #F3F1EE;position:absolute;width: 100px;">
                            <div class="nav-item ">
                                <a class="nav-link" href="/coffee_project/php/09/user_list.php">會員中心</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="/coffee_project/php/41/coupon_record_list.php">優惠券系統</a>
                            </div>
                            <div class="nav-item">
                                <a class="nav-link" href="/coffee_project/php/41/points_formanager.php">積分系統</a>
                            </div>
                        </ul>
                    </li>


                </ul>
                <form class="d-flex">
                    <a href="/coffee_project/php/09/logout.php" style="text-decoration: none;">
                        <h5>登出</h5>
                    </a>
                </form>
            </div>
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