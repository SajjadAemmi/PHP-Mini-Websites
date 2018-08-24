<?php
	date_default_timezone_set("Asia/Tehran");
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>مشهد تاکسی</title>

        <link rel="icon" href="images/icon.ico">

        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href='css/font-awesome.css' rel='stylesheet'>
        
        <!-- Custom styles for this template -->
        <link href="css/custom.css" rel="stylesheet">
        
		<script src="js/bootstrap.js"></script>
        <script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/typed.js"></script>
        
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_Pwg4JUkUz6bYv4Tx4eq-dRGLzUr-_zM&sensor=true&callback=myMap" 
          type="text/javascript"></script>
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
                        <a class="navbar-brand" href="index.php"> 
                            <span class="glyphicon glyphicon-car" aria-hidden="true"></span><i class="fa fa-taxi"></i> مشهد تاکسی 
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            
                        </ul>
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="about_us.php">
                                    <i class="fa fa-info-circle"></i> درباره ما 
                                </a>
                            </li>
                            <?php if(isset($_SESSION['is_logged_in'])): ?>
                            
                                <li>
                                    <a href="#">
                                        <?php echo $_SESSION['name']; ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="logout.php">
                                        <i class="fa fa-sign-out"></i> خروج از حساب کاربری
                                    </a>
                                </li>
                                <?php if($_SESSION['login_type'] == "user"): ?>
                                    <li>
                                        <a href="edit_information_user.php">
                                            <i class="fa fa-pencil-square-o"></i> ویرایش اطلاعات
                                        </a>
                                    </li>
                                <?php elseif($_SESSION['login_type'] == "taxi"): ?>
                                    <li>
                                        <a href="edit_information_taxi.php">
                                            <i class="fa fa-pencil-square-o"></i> ویرایش اطلاعات
                                        </a>
                                    </li>
                            
                                <?php endif; ?>
                            <?php else: ?>
                            
                            <li>
                                <a href="register.php">
                                    <i class="fa fa-user-plus"></i> ثبت نام 
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="row">
                <div class="col-md-12">
                    <div class="clearfix"></div>
                    <?php displayMessage(); ?>