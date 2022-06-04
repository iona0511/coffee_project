<?php
  session_start();

  //session_destroy(); //清除所以有的session

  unset($_SESSION['user']);//移除user對應的值

  header('Location: ' . $_SERVER['HTTP_REFERER']);