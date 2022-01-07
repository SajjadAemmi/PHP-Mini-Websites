<?php 
    include 'database.php';
    include 'functions.php'; 
 
	if(isset($_POST['delete']))
	{
        $id = $_POST['id'];
		
        $query = "DELETE FROM cars WHERE id = '$id'";
        mysqli_query($connection, $query);
	}

    $query = "SELECT * FROM cars";
	$cars = mysqli_query($connection, $query);
?>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "admin"): ?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <a href="admin_panel.php" class="btn btn-warning btn-lg btn-block">
            بازگشت به پنل ادمین <i class="fa fa-arrow-left"></i>
        </a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"> لیست اتومبیل ها </h3>
            </div>
            <div class="panel-body">

                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="add_car_admin.php" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-plus"></span> افزودن اتومبیل جدید</a>
                    </li>
                    <?php if($cars): ?>	
                        <?php foreach($cars as $car): ?>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-9 col-sm-6 col-xs-6">
                                        <?php echo $car['title']; ?>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <form method="post" action="cars_admin.php">
                                            <button type="submit" name="delete" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> حذف</button>
                                            <input type="hidden" name="id" value="<?php echo $car['id']; ?>">
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>هیچ اتومبیلی وجود ندارد</p>
                    <?php endif; ?>
                </ul>	
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<?php header("Location: index.php"); exit(); ?>

<?php endif; ?>

<?php include ('footer.php'); ?>