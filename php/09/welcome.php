<?php
session_start();
require __DIR__ . '/parts/connect_db.php';


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
        margin: 0;
    }
.container{
    position: relative;
    width: 100%;
    height: 100vh;
    background-size: cover;
    /* background-image: url(./imgs/pexels-gradienta-7134986.jpg); */
}
.card{
    width: 500px;
    height: 300px;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1));
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
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
    background-color: lightgray;   
}
.cardB{
    position: absolute;
    top: 0;
    left: 0;
    width: 500px;
    height: 300px;
    border-radius: 20px;
    background-color: black;   
    transform: rotateY(180deg);
}

.btn{
    width: 250px;
    padding: 10px 30px;
    cursor: pointer;
    background: hsl(24, 100%, 86%);
    border: 0;
    outline: none;
    } 

</style>
<body>
    
    <?php if (isset($_SESSION['user'])) : ?>
        <h2><?= $_SESSION['user']['member_nickname'] ?> 您好！</h2>
    <?php endif; ?>  
    
    <div>
        <button type='submit'class='btn'>進入會員中心</button>
    </div>

    <div class="container">
        <div class="card">      
            <div class="cardF">
                <?= $_SESSION['user']['member_nickname'] ?>
                <?= $_SESSION['user']['member_level']."points" ?>
            </div>
            <div class="cardB"></div>
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