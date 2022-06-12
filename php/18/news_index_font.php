<?php
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';

// if (!session_id()) {
//     session_start();
// }

// if (!isset($_SESSION['user']['member_account'])) {
//     header('Location:/coffee_project/php/09/login.html');
//     exit;
// }


$pageName = 'lastest-news';
$title = '活動消息前台';

$perPage = 6;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if ($page < 1) {
    header('Location ?page=1');
    exit;
}

$t_sql = "SELECT COUNT(1) FROM `lastest_news`";
$totalRows = $pdo->query($t_sql)->fetch(PDO::FETCH_NUM)[0];

$totalPages = ceil($totalRows / $perPage);

$rows = [];

if ($totalRows > 0) {
    if ($page > $totalPages) {
        header("Location: ?page=$totalPages");
        exit;
    }

    $sql = sprintf("SELECT * FROM `lastest_news` ORDER BY news_sid DESC LIMIT %s,%s", ($page - 1) *  $perPage, $perPage);

    $rows = $pdo->query($sql)->fetchAll();
}
?>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-head.php'; ?>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        background: url('/coffee_project/images/18/coffee_brg.jpg') no-repeat;
        background-size: cover;
        background-attachment: fixed;
    }

    .brg-content {
        background: rgba(255, 255, 255, 0.5);
        border-radius: 20px;
    }

    .display_justify_content {
        display: flex;
        justify-content: center;
    }

    .page-link {
        color: #FFFF37;
        background-color: #CECEFF;
    }

    .time-border-top-bottom {
        border-top: 2px solid #9F5000;
        border-bottom: 2px solid #9F5000;
    }

    .test {
        background: rgba(255, 255, 255, 0.528);
        line-height: 2;
        padding-bottom: 5px;
        background-clip: content-box;
        border-bottom: 5px solid rgba(255, 255, 255, 0.528);
        padding-top: 5px;
        border-top: 5px solid rgba(255, 255, 255, 0.528);
        text-align: center;
    }

    .box-shadow:hover {
        box-shadow: 0 16px 32px 0 rgba(48, 55, 66, 0.15);
        transform: translate(0, -5px);
        transition-delay: 0s;
        box-shadow: 1px 1px 8px 1px #333;
    }

    .box-shadow {
        /* box-shadow: 0 13px 27px -5px rgba(50,50,93,0.25), 10px 10px 20px -5px #bb69ff; */
        box-shadow: 0 13px 27px -5px rgba(50, 50, 93, 0.25), 10px 10px 20px -5px #4c95f4;
    }

    /* 標題動畫開始 */

    .title01 {
        width: 100%;
        /* position: absolute;
    top: 50%;
    /* left: 50%; */*/
    transform: translateX(-50%) translateY(-50%);
    }

    h1 {
        font-size: 4.3em;
        letter-spacing: 1px;
        font-weight: 700;
        color: #97CBFF;
        text-align: center;
    }

    .cssanimation,
    .cssanimation span {
        animation-duration: 1s;
        animation-fill-mode: both;
    }

    .cssanimation span {
        display: inline-block
    }

    .leFlyInBottom span {
        animation-name: leFlyInBottom
    }

    @keyframes leFlyInBottom {
        0% {
            transform: translate(0px, 80px);
            opacity: 0
        }

        50% {
            transform: translate(10px, -50px);
            animation-timing-function: ease-in-out
        }
    }

    /* 標題動畫結束 */
</style>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar.php'; ?>
<section>
    <div class="container">
        <div class="title01">
            <h1 class="display_justify_content cssanimation sequence leFlyInBottom" style=" margin:35px auto;font-size:35px;">活動消息</h1>
        </div>
        <div class="row brg-content">
            <nav class="justify-content-center mt-4 mb-4 " aria-label="Page navigation example" style="display:flex; flex-direction:row;">
                <ul class="pagination">
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1">
                            start
                        </a>
                    </li>
                    <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">
                            <i class="fa-solid fa-angles-left"></i>
                        </a>
                    </li>

                    <?php for ($i = $page - 5; $i <= $page + 5; $i++) :
                        if ($i >= 1 and $i <= $totalPages) :
                    ?>

                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>

                    <?php endif;
                    endfor; ?>

                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    </li>
                    <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link " href="?page=<?= $totalPages ?>">
                            end
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="col-12 d-flex flex-wrap justify-content-around">
                <?php foreach ($rows as $r) : ?>
                    <div class="card col-3 m-3 box-shadow" style="background-color:rgb(243, 174, 54);border-radius:20px;">

                        <img class="card-img-top w-100" style="height: 200px; border-radius:20px;" src="
                                        <?php if ($r['news_img']) : echo '/../../coffee_project/images/18/' . $r['news_img'];
                                        endif; ?>" <?php if (!$r['news_img']) : echo "style" . "=" . "display:none;" ?> <?php endif; ?> alt="" id="news_img" title="<?= $r['news_img'] ?>" />

                        <div class="card-body">

                            <h4 class="card-title test mb-3" style="border-radius:10px;"><?= $r['news_title'] ?></h4>
                            <div class="d-flex justify-content-center mb-2">
                                <p class="me-2 text-success" id="news_start_date"><?= $r['news_start_date'] ?></p>
                                <p>~</p>
                                <p class="ms-2 text-success" id="news_end_date"><?= $r['news_end_date'] ?></p>
                            </div>
                            <p class="card-text" style="text-indent:25px; overflow: hidden;
                                                        text-overflow: ellipsis;
                                                        display: -webkit-box;
                                                        -webkit-line-clamp: 7;
                                                        -webkit-box-orient: vertical;
                                                        white-space:normal;"><?= $r['news_content'] ?></p>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>


            <!-- <section class="mt-5"></section> -->

        </div>
    </div>
</section>

<?php include dirname(dirname(__DIR__, 1)) . '/parts/scripts.php'; ?>
<script>
    window.onload = function() {
        animateSequence();
        animateRandom();
    };

    function animateSequence() {
        var a = document.getElementsByClassName('sequence');
        for (var i = 0; i < a.length; i++) {
            var $this = a[i];
            var letter = $this.innerHTML;
            letter = letter.trim();
            var str = '';
            var delay = 100;
            for (l = 0; l < letter.length; l++) {
                if (letter[l] != ' ') {
                    str += '<span style="animation-delay:' + delay + 'ms; -moz-animation-delay:' + delay + 'ms; -webkit-animation-delay:' + delay + 'ms; ">' + letter[l] + '</span>';
                    delay += 150;
                } else
                    str += letter[l];
            }
            $this.innerHTML = str;
        }
    }

    function animateRandom() {
        var a = document.getElementsByClassName('random');
        for (var i = 0; i < a.length; i++) {
            var $this = a[i];
            var letter = $this.innerHTML;
            letter = letter.trim();
            var delay = 70;
            var delayArray = new Array;
            var randLetter = new Array;
            for (j = 0; j < letter.length; j++) {
                while (1) {
                    var random = getRandomInt(0, (letter.length - 1));
                    if (delayArray.indexOf(random) == -1)
                        break;
                }
                delayArray[j] = random;
            }
            for (l = 0; l < delayArray.length; l++) {
                var str = '';
                var index = delayArray[l];
                if (letter[index] != ' ') {
                    str = '<span style="animation-delay:' + delay + 'ms; -moz-animation-delay:' + delay + 'ms; -webkit-animation-delay:' + delay + 'ms; ">' + letter[index] + '</span>';
                    randLetter[index] = str;
                } else
                    randLetter[index] = letter[index];
                delay += 80;
            }
            randLetter = randLetter.join("");
            $this.innerHTML = randLetter;
        }
    }

    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
    // 標題動畫js結束
</script>
<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-foot.php'; ?>