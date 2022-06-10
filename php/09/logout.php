<?php

if (! isset($_SESSION)) {
    session_start();
}

unset($_SESSION["user"]); 
unset($_SESSION["products_order"]);
unset($_SESSION["food_order"]);
unset($_SESSION["productJSON"]);
unset($_SESSION["foodJSON"]);
unset($_SESSION["couponJSON"]);
unset($_SESSION["displayTotal"]);

header('Location: /coffee_project/index_.php');
