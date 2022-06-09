<?php

if (! isset($_SESSION)) {
    session_start();
}

unset($_SESSION["user"]); 
unset($_SESSION);

header('Location: /coffee_project/index_.php');
