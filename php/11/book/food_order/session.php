<?php
session_start();

$_SESSION ['a']++;

echo $_SESSION['a'];