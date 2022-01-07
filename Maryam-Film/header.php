<?php

    date_default_timezone_set("Asia/Tehran");

    if(!isset($_SESSION['login']))
    {
        $_SESSION['login'] = 0;
    }

    $query = "SELECT * FROM categories";
    $categories = mysqli_query($connection, $query);

?>
<!DOCTYPE html>
<html lang="fa">
    <head>
        <title> دانلود فیلم و سریال  </title>
        <style>

            .slider
            {
                width: 100%;
            }

        </style>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="stylesheet" href="css/jquery.Bootstrap-PersianDateTimePicker.css" />
        <link href="css/bootstrap.css" type="text/css" rel="stylesheet">
        <link href="css/custom.css" type="text/css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet"/>
        
        <link rel="icon" href="images/icon.ico">
        
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/topbutton.js"></script>

    </head>    
    <body>
        <div class="container">   
        <br>
            <div class="row">
                <div class="col-md-12">
                         <img class="img-rounded img-responsive" src="images/header.jpg">
                    
                </div>
            </div>
            <br>
       
       <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
              <a class="navbar-brand" href="index.php"> وبسایت دانلود فیلم  </a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> صفحه نخست</a></li>
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-film"></span>    فیلم ها <span  class="caret" ></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="films.php">همه</a></li>
                        <li role="separator" class="divider"></li>
                        
                        <?php foreach($categories as $category): ?>  
                        <li><a href="films.php?category_id=<?php echo $category['id']; ?>"><?php echo $category['title']; ?></a></li>
                        <?php endforeach; ?>
                      </ul>
                    </li>
                  
                    <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> جستجوی پیشرفته </a></li>
                    <li><a href="news.php"><span class="glyphicon glyphicon-align-right"></span> اخبار</a></li>
                    <li><a href="about_us.php"><span class="glyphicon glyphicon-envelope"></span> درباره ما </a></li>
                </ul>
              <ul class="nav navbar-nav navbar-left">

                <?php if($_SESSION['login'] == 1): ?>
                    <li>
                        <a href="#">
                            <?php echo $_SESSION['name']; ?>
                        </a>
                    </li>
                    <li>
                    <a href="logout.php"><span class="glyphicon glyphicon-user"></span> خروج از حساب </a>
                    </li>

                <?php else: ?>  
                    <li><a href="#" data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-user"></span> ورود </a></li>
                    <li><a href="register.php"><span class="glyphicon glyphicon-log-in"></span> ثبت نام </a></li>
         
                <?php endif; ?> 

              </ul>
            </div>
          </div>
        </nav>
            
        <div class="modal fade modal-login" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">ورود به حساب کاربری</h4>
                    </div>
                    <form method="post" action="login.php">
                        <div class="modal-body"> 
                            
                            <label >
                                <input type="radio" value="1" name="loginmode" checked>  کاربر 
                            </label>
                            <br>
                             <label class="radio-title">
                                <input type="radio" value="2" name="loginmode"> مدیر 
                            </label>
                                        <hr>
                            
                            <div class="form-group">
                                    <label for="exampleInputEmail1"> نام کاربری </label>
                                    <input name="username" type="text" class="form-control"  placeholder="نام کاربری*">
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputPassword1">کلمه عبور</label>
                                    <input name="password" type="password" class="form-control" placeholder="کلمه عبور*">
                            </div>  
                        </div>
                        <div class="modal-footer">
                            <button name="login" type="submit" class="btn btn-success">  ورود به حساب کاربری</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            
        <a href="#" class="topbutton"><img src="images/top.png"></a>
            
        <div class="clearfix"></div>
            <?php displayMessage(); ?>