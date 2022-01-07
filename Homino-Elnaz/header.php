<?php 
include "database.php";
include "jdf.php"; 

if(!isset($_SESSION['login']) && isset($_COOKIE['user_id']) && $_COOKIE['user_id'] != '')
{
    $user_id = $_COOKIE['user_id'];
    $q = "SELECT * FROM users WHERE id = $user_id";
    $user = mysqli_fetch_assoc(mysqli_query($con,$q));

    $_SESSION['login'] = 1;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['family'] = $user['family'];
}
?>
<!DOCTYPE html>
<html lang="fa">
    <head>
        <title>هومینو</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="images/icon.ico" rel="icon">

        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="css/jquery.Bootstrap-PersianDateTimePicker.css" />
        <link rel="stylesheet" href="css/custom.css" />

        <script src="js/bootstrap.js"></script>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/chart.min.js"></script>
        <script src="js/jalaali.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand font" href="index.php">هومینو</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav font">

                            <li class="font"><a href="times.php">رزرو</a></li>
                            <li class="font"><a href="admin_login.php">پنل ادمین</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-left">
                            <?php if(isset($_SESSION['login']) && $_SESSION['login'] == 1): ?>

                            <li><a href="#"> <?php echo $_SESSION['name'] . " " . $_SESSION['family']; ?> </a></li>
                            <li class="font"><a href="user_panel.php">پنل کاربری</a></li>
                            <li class="font"><a href="logout.php">خروج</a></li>

                            <?php else: ?>

                            <li class="font"><a href="register.php">ثبت نام</a></li>
                            <li class="font"><a href="login.php">ورود</a></li>

                            <?php endif; ?>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>

            <?php if(isset($_SESSION['message'])): ?>
            <div class="alert alert-success fade in">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php endif; ?>
            <?php unset($_SESSION['message']); ?>