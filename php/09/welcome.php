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
$sql_points = sprintf("SELECT `points_user`.`total_points`,`member`.`member_sid`FROM`points_user`JOIN`member`ON`points_user`.`member_sid`=`member`.`member_sid`WHERE`points_user`.`member_sid`=%s",$user );
$t_points = $pdo->query($sql_points)->fetch();
// $t_points = $pdo->query($sql_points)->fetchAll();
// $a = $t_points[0];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    *{
        box-sizing: border-box;
        margin: 0;
    }
.container{
    position: relative;
    width: 100%;
    height: 100vh;
    background-size: cover;
    background-image: url(./imgs/pexels-gradienta-7134986.jpg);
}
.card{
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
    padding: 10px 80px;
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
    background-image: linear-gradient(135deg, #fdfcfb 0%, #e2d1c3 100%);
    width: 500px;
    height: 300px;
    border-radius: 20px;
}

/* nav  */
.select {
        margin-top: 0px;
        margin-bottom: 20px;
        text-align: center;
}
.wrap{
    position: relative;
}
.nav {
        text-decoration: none;
        font-size: 1rem;
        margin-left: 35px;
        padding: 5px;
    }
a:hover {
        color: rgb(205, 111, 3);
    }
</style>

<body>

    <div class="container">

        <div class="wrap">
        <div class="select">
            <img src="" style="width: 60px" />
            <a href="#nav" class="nav">首頁</a>
            <a href="" class="nav">店家資訊</a>
            <a href="" class="nav">商品</a>
            <a href="" class="nav">訂位點餐</a>
            <a href="" class="nav">課程資訊</a>
            <a href="" class="nav">分享牆</a>
            <a href="" class="nav">客服</a>
            <a href="" class="nav">遊戲</a>
            <a href="" class="nav">購物車</a>
            <a href="welcome.php" class="nav">會員中心</a>
            <a href="logout.php" class="nav">會員登出</a>
        </div>
        </div>


        <div class="card">         
            <div class="cardF">
                <?php if ($t_points['total_points']>1000) : echo "<div class='gold'></div>"; elseif($t_points['total_points']>500): echo "<div class='silver'></div>"; endif; ?>
                <div class="cardLogo">
                    <img src="/coffee_project/images/09/member-card-logo" alt="">
                </div>
                <p class="cardText"><?= $row['member_name'] ?></p>
                <p class="cardID"><span>ID:</span><?= "&nbsp".$_SESSION['user']['member_sid']=str_pad($_SESSION['user']['member_sid'],6,"0",STR_PAD_LEFT) ?></p>                
            </div>
            <div class="cardB">
                <?php if ($t_points['total_points']>1000) : echo "<div class='gold'></div>"; elseif($t_points['total_points']>500): echo "<div class='silver'></div>"; endif; ?>
                <p class="cardText"><?= $t_points['total_points']."&nbsp"."&nbsp"."points" ?></p>
            </div>
        </div>

        <div class="memCenter">
            <?php if (isset($_SESSION['user'])) : ?>
                <!-- 解決跨頁無法取得SESSION的問題 -->
                <h2 class="userText"><?= $row['member_nickname'] ?> <span>您好！</span></h2>
            <?php endif; ?>  
        
            <button type='submit'class='btn'><a href="edit.html">進入會員中心</a></button>
        </div>
        
    </div>


    <script>

    
    const card = document.querySelector(".card");
    const cardF = document.querySelector(".cardF");
    const cardB = document.querySelector(".cardB");

    card.addEventListener("click", function (e) {
    card.classList.toggle('flipped');
    });




    </script>
</body>
</html>