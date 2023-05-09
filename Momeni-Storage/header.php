<?php
	date_default_timezone_set("Asia/Tehran");
	session_start();
?>
<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="author" content="Sajjad Aemmi">
        <meta name="description" content="">

        <title> انبار کالا </title>

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/glyphicons.css"> 
        <link href='css/font-awesome.css' rel='stylesheet'>

        <!-- Custom styles for this template -->
        <link href="css/custom.css" rel="stylesheet" type="text/css">
        
        <link rel="icon" href="images/kala.ico">
      
        
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/topbutton.js"></script>
   
    </head>

    <body>
        <?php if(isset($_SESSION['is_logged_in'])) : ?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"> انبار مومنی </a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-left">
                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> موجودی انبار</a></li>
                <li><a href="add_kala.php"><span class="glyphicon glyphicon-log-in"></span> رسید انبار </a></li>
                <li><a href="remove_kala.php"><span class="glyphicon glyphicon-log-out"></span> حواله انبار </a></li>

                <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "admin"): ?>
                <li><a href="panel_admin.php"><span class="glyphicon glyphicon-th-large"></span> پنل ادمین</a></li>
                <?php endif; ?>

                <li class="active"><a href="logout.php"><span class="glyphicon glyphicon-user"></span> خروج از حساب کاربری</a></li>    

              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </nav>
        <?php endif; ?>
        <a href="#" class="topbutton"><img src="images/top.png"></a>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php displayMessage(); ?>
                </div>