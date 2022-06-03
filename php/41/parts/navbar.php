<?php
if (!isset($pageName)) {
    $pageName = '';
}
?>
<style>
    .navbar .navbar-nav .nav-link.active {
        background-color: #00f;
        color: white;
        font-weight: 800;
        border-radius: 5px;
    }
</style>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'index' ? 'active' : '' ?>" href="index_.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'points_user_list' ? 'active' : '' ?>" href="points_user_list.php">用戶積分表</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'points_user_add' ? 'active' : '' ?>" href="points_user_add.php">新增用戶積分</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'points_record_list' ? 'active' : '' ?>" href="points_record_list.php">積分歷史紀錄表</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $pageName == 'points_record_add' ? 'active' : '' ?>" href="points_record_add.php">新增積分歷史紀錄</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
