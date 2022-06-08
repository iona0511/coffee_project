<?php

if (! isset($_SESSION)) {
    session_start();
}

unset($_SESSION['user']); 


header('Location: /coffee_project/index_.php');
