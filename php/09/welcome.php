<?php
require dirname(dirname(__DIR__, 1)) . '/parts/connect_db.php';
if (! isset($_SESSION)) {
    session_start();
}
// 解決跨頁無法取得SESSION的問題
$sid = isset($_SESSION['user']['member_sid']) ? intval($_SESSION['user']['member_sid']) : 0;
$row = $pdo->query("SELECT * FROM member WHERE `member_sid`=$sid")->fetch();


// 取得點數欄位的外鍵
$user=$_SESSION['user']['member_sid'];
$sql_points = sprintf("SELECT `points_user`.`total_points`,`member`.`member_sid`,`member`.`member_level`FROM`points_user`JOIN`member`ON`points_user`.`member_sid`=`member`.`member_sid`WHERE`points_user`.`member_sid`=%s",$user );
$t_points = $pdo->query($sql_points)->fetch();
// $t_points = $pdo->query($sql_points)->fetchAll();
// $a = $t_points[0];


?>

<?php include dirname(dirname(__DIR__, 1)) . '/parts/html-head.php' ?>

<style>
    *{
        box-sizing: border-box;
        margin: 0;
    }
body{
    background-size: cover;
    background-image: url('/coffee_project/images/09/henry-co-tqu0IOMaiU8-unsplash.jpg');
}
.bg{
    position: relative;
    width: 100%;
    height: 100vh;
}
.mycard{
    width: 500px;
    height: 300px;
    border-radius: 20px;
    border:1px solid rgba(255, 255, 255, 0.18);
    box-shadow: 0 8px 20px 0 rgba(0, 0, 0, 0.2);
    position: absolute;
    top: 35%;
    right: 15%;
    transition: transform 1s;
    transform-style: preserve-3d;
    cursor: pointer;
}
.flipped {
    transform: rotateY(180deg);
}


.cardF{
    position: relative;
    width: 500px;
    height: 300px;
    border-radius: 20px;
    background-color: rgba(240, 255, 255, 0.1);
    backface-visibility: hidden; 
}
.cardB{
    position: absolute;
    top: 0;
    left: 0;
    width: 500px;
    height: 300px;
    border-radius: 20px;
    background-color: rgba(240, 255, 255, 0.1);
    transform: rotateY(180deg);
    backface-visibility: hidden; 
}

.btn{
    width: 250px;
    padding: 0;
    cursor: pointer;
    background: black;
    border: 0;
    outline: none;
    margin-top: 30px;
    } 

.btn>a{
    display: inline-block;
    padding: 10px 60px;
    text-decoration: none;
    color:white;
}
.cardText{
    font-size: 1.3rem;
    position: absolute;
    top: 45%;
    right: 20%;
}
.cardLogo{
    position: absolute;
    font-size: 1.5rem;
    top: 27%;
    left: 15%;
}
.cardID{
    position: absolute;
    font-size: 1rem;
    top: 65%;
    right: 20%;
}
.userText{
    font-size: 3rem;
}

.userText>span{
    font-size: 1.5rem;
}
.memCenter{
    position: absolute;
    top: 45%;
    left: 20%;
}
.silver{
    background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    width: 500px;
    height: 300px;
    border-radius: 20px;
}
.gold{
    /* background-image: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%); */
    background-image: linear-gradient(to top, #fae1c0 0%, #eacda3 100%);
    width: 500px;
    height: 300px;
    border-radius: 20px;
}

</style>

<body>

<?php include dirname(dirname(__DIR__, 1)) . '/parts/navbar.php' ?>




    <div class="bg">
        <div class="mycard">         
            <div class="cardF">
            <?php if (isset($t_points['total_points'])) :  if ($t_points['total_points']>1000) : echo "<div class='gold'></div>"; elseif($t_points['total_points']>500): echo "<div class='silver'></div>"; endif; endif; ?> 
                <div class="cardLogo">
                    <img src="/coffee_project/images/09/member-card-logo.png" alt="">
                </div>
                <p class="cardText"><?= $row['member_name'] ?></p>
                <p class="cardID"><span>ID:</span><?= "&nbsp".$_SESSION['user']['member_sid']=str_pad($_SESSION['user']['member_sid'],6,"0",STR_PAD_LEFT) ?></p>                
            </div>
            <div class="cardB">
            <?php if (isset($t_points['total_points'])) :  if ($t_points['total_points']>1000) : echo "<div class='gold'></div>"; elseif($t_points['total_points']>500): echo "<div class='silver'></div>"; endif; endif; ?> 

                <p class="cardText">
                    <?= isset($t_points['total_points']) ? ($t_points['total_points'])."&nbsp"."&nbsp"."points" : "0" ."&nbsp"."&nbsp"."points" ?>
                </p>
            </div>
        </div>

        <div class="memCenter">
            <?php if (isset($_SESSION['user'])) : ?>
                <!-- 解決跨頁無法取得SESSION的問題 -->
                <h2 class="userText"><?= $row['member_nickname'] ?> <span>您好！</span></h2>
            <?php endif; ?>  
        
            <button type='submit'class='btn'><a href="edit.html">修改會員資料</a></button>
        </div>
        
    </div>


    <script>

    
    const card = document.querySelector(".mycard");
    const cardF = document.querySelector(".cardF");
    const cardB = document.querySelector(".cardB");

    card.addEventListener("click", function (e) {
    card.classList.toggle('flipped');
    });




    </script>
</body>
</html>