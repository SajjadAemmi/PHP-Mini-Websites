
<?php

session_start();

unset($_SESSION['login']);
unset($_SESSION['user_id']);
unset($_SESSION['employee_id']);
unset($_SESSION['name']);
unset($_SESSION['admin_login']);

setcookie('user_id', '', time() - 3600);

$_SESSION['message'] = "شما از حساب کاربری خود خارج شدید";

header("location: index.php");
?>