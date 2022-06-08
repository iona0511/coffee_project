
<style>
    .navinner_pc a{
        color: rgba(0,0,0,.55);
        text-decoration: none;
    }
    .nav_pc{
        transition: 0.3s;
        transform: translateY(-160px);
    }
    button{
        cursor: pointer;
        border: none;
        outline: none;
    }
    .m_btn{
        cursor: pointer;
        border: none;
        outline: none;
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

    .bac-img{
        background: url(./images/18/coffee_img1.jpg);
    }
</style>

<div style="width: 100%;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid" >
            <!-- <a class="navbar-brand" href="#">首頁</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarSupportedContent">
                <ul class="nav navbar-nav  me-auto mb-2 mb-lg-0" style="height: 45px;">
                    <li class="nav-item">
                        <a class="nav-link bac-img" aria-current="page" href="#">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">店家資訊</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/coffee_project/php/18/lastest-news.php">活動消息</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/coffee_project/php/35/products.php">商品</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/coffee_project/php/11/menu_list.php">點餐</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/coffee_project/php/29/delete-data.html">課程後台</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/coffee_project/php/44/post-list.php">分享牆</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">客服</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">遊戲</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="">購物車</a>
                    </li>
                    <li class="nav-item">
                        <button class="PCBtn nav-link" type="button" onclick="ShowMyPC()">
                        會員
                        </button>
                            <ul class="navlist navinner_pc nav_pc ps-0 bg-light" style="background-color: #F3F1EE;">
                                <li class="nav-item ">
                                    <a class="nav-link" href="/coffee_project/php/09/user_list.php">會員中心</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/coffee_project/php/41/coupon_record_list.php">優惠券系統</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/coffee_project/php/41/points_formanager.php">積分系統</a>
                                </li>
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