<nav class="navbar navbar-expand-lg navbar-light mb-3" style="background-color: #e3f2fd;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Post</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="post-list.php">文章列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="post-add.php">新增文章</a>
                </li>

            </ul>
        </div>
        <form class="d-flex">
            <?php if (!empty($_SESSION)) : ?>
                <h5 class="mr-3">會員:<?= $_SESSION['user']['member_name'] ?></h5>
                <h5 class="mr-3">暱稱:<?= $_SESSION['user']['member_nickname'] ?></h5>
                <h5 class="mr-3">ID:<?= $_SESSION['user']['member_sid'] ?></h5>
                <a href="./part/logout.php">
                    <h5>登出</h5>
                </a>
            <?php else : ?>
                <a href="part/login/login.html">
                    <h5 class="mr-3">會員登入</h5>
                </a>
            <?php endif ?>


        </form>
    </div>
</nav>