<?php 
    include 'database.php';
    include 'functions.php'; 
 
	if(isset($_POST['add']))
	{
		$title = $_POST['title'];
			
        $query = "INSERT INTO cars (title) VALUES ('$title')";
			 
        mysqli_query($connection, $query);
        
        redirect('cars_admin.php', 'اتومبیل جدید افزوده شد', 'success');
        exit();
	}
 ?>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "admin"): ?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <a href="cars_admin.php" class="btn btn-warning btn-lg btn-block">
            بازگشت <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>
<br>
<div class="row">
    
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title text-center">افزودن پست جدید</h3>
            </div>
            <div class="panel-body">	
                <form method="post" action="add_car_admin.php">
                  <div class="form-group">
                        <label>نام اتومبیل</label>
                        <input type="text" name="title" class="form-control" required>
                  </div>	
                  <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LcHnSQTAAAAADCG_qRhTPdtdfectkkg1pqLQIcU"></div>
                  </div>	
                    <button type="submit" name="add" class="btn btn-success"> افزودن</button>
                </form>	
            </div>		
        </div>
    </div>
</div>

<?php else: ?>

<?php header("Location: index.php"); exit(); ?>

<?php endif; ?>

<?php include ('footer.php'); ?>