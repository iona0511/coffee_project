<?php require dirname(dirname(__DIR__,1)) . '/parts/connect_db.php'; 

$pageName ='lastest-news';
$title ='最新消息';

$perPage = 10;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header('Location ?page=1');
    exit;
}
?>
<?php include dirname(dirname(__DIR__,1)) . '/parts/html-head.php'; ?>
<?php include dirname(dirname(__DIR__,1)) . '/parts/navbar.php'; ?>

<div class="container">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button"data-bs-toggle="collapse" data-bs-target="#navbarNav"aria-controls="navbarNav" aria-expanded="false" aria-label="Togglenavigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">Home<a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Features</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>
    </ul>
  </div>
</div>

<?php include dirname(dirname(__DIR__,1)) . '/parts/scripts.php'; ?>
<?php include dirname(dirname(__DIR__,1)) . '/parts/html-foot.php'; ?>
