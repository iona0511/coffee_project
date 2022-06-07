<?php

if (! isset($_SESSION)) {
    session_start();
}

unset($_SESSION['user']['member_sid']); 


header('Location: login.html');
