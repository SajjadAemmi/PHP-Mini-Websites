<?php 

    session_start();

    unset($_SESSION['login']);
    unset($_SESSION['user_id']);
    unset($_SESSION['login_type']);
    unset($_SESSION['owner_id']);
    unset($_SESSION['username']);
    unset($_SESSION['name']);

    $_SESSION['message'] = "شما از حساب کاربری خود خارج شدید";
    $_SESSION['message_type'] = "info";

    header('Location:index.php');
    exit();

?>