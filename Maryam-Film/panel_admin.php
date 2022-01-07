<?php 
    include 'database.php';
    include 'functions.php';

    $query = "SELECT * FROM users";
    $users = mysqli_query($connection, $query);
    
    $number_of_users = mysqli_num_rows($users);

    $query = "SELECT * FROM films";
    $films = mysqli_query($connection,$query);
    
    $number_of_films = mysqli_num_rows($films);
    
    $query = "SELECT * FROM categories";
    $categories = mysqli_query($connection, $query);
    
    $number_of_categories = mysqli_num_rows($categories);

    $query = "SELECT * FROM news";
    $news = mysqli_query($connection ,$query);
    
    $number_of_news = mysqli_num_rows($news);
?>

<?php include 'header.php'; ?>

<?php if(isset($_SESSION['login']) && $_SESSION['login'] == 1 && $_SESSION['login_type'] == "admin"):  ?>

<div class="row">
   
    <div class="col-md-4 col-md-offset-4">
        <div class="list-group">
        <h3 class="list-group-item active">
            پنل مدیریت سایت
        </h3>
         
          <a href="users_admin.php" class="list-group-item"><h4><span class="badge pull-left"><?php echo $number_of_users; ?></span> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> کاربران </h4></a>
          <a href="films_admin.php" class="list-group-item"><h4><span class="badge pull-left"><?php echo $number_of_films; ?></span> <span class="glyphicon glyphicon-film" aria-hidden="true"></span> فیلم ها </h4></a>
          <a href="categories_admin.php" class="list-group-item"><h4><span class="badge pull-left"><?php echo $number_of_categories; ?></span> <span class="glyphicon glyphicon-th-large" aria-hidden="true"></span> گروه بندی ها </h4></a>
          <a href="news_admin.php" class="list-group-item"><h4><span class="badge pull-left"><?php echo $number_of_news; ?></span> <span class="glyphicon glyphicon-align-right" aria-hidden="true"></span> اخبار </h4></a>
          <a href="reports_admin1.php" class="list-group-item"><h4><span class="badge pull-left"></span> <span class="glyphicon glyphicon-stats" aria-hidden="true"></span> گزارش پر کار ترین کاربران</h4></a>
          <a href="reports_admin2.php" class="list-group-item"><h4><span class="badge pull-left"></span> <span class="glyphicon glyphicon-stats" aria-hidden="true"></span> گزارش داغ ترین فیلم ها</h4></a>
          <a href="reports_admin3.php" class="list-group-item"><h4><span class="badge pull-left"></span> <span class="glyphicon glyphicon-stats" aria-hidden="true"></span> گزارش داغ ترین ژانر ها</h4></a>
        </div> 
            
        </div>
       
    </div>

<?php else: ?>

<?php header("Location: index.php"); exit(); ?>

<?php endif; ?>

<?php include 'footer.php'; ?> 