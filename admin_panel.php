<?php 
    include 'functions.php';
    include 'database.php'; 

    $query = "SELECT * FROM taxies";
	$taxies = mysqli_query($connection, $query);
    $numberOfTaxies = mysqli_num_rows($taxies);

    $query = "SELECT * FROM users";
	$users = mysqli_query($connection, $query);
    $numberOfUsers = mysqli_num_rows($users);

    $query = "SELECT * FROM cars";
	$cars = mysqli_query($connection, $query);
    $numberOfCars = mysqli_num_rows($cars);
?>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "admin"): ?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title"> پنل ادمین </h3>
            </div>
            <div class="panel-body">	
                <div class="list-group">                 
                    <a class="list-group-item" href="taxies_admin.php">
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <img class="avatar pull-right" src="images/taxies.png" />
                            </div>
                            <div class="col-md-10 col-sm-9 col-xs-8">
                                <h4 class="list-group-item-heading">
                                    <p> راننده ها </p>
                                </h4>
                                <hr>
                                <p class="list-group-item-text">
                                    <span class="badge pull-right">
                                        تعداد: <b><?php echo $numberOfTaxies; ?></b>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                     <a class="list-group-item" href="users_admin.php">
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <img class="avatar pull-right" src="images/users.png" />
                            </div>
                            <div class="col-md-10 col-sm-9 col-xs-8">
                                <h4 class="list-group-item-heading">
                                    <p> کاربران </p>
                                </h4>
                                <hr>
                                <p class="list-group-item-text">
                                    <span class="badge pull-right">
                                         تعداد: <b><?php echo $numberOfUsers; ?></b>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                    
                     <a class="list-group-item" href="cars_admin.php">
                        <div class="row">
                            <div class="col-md-2 col-sm-3 col-xs-4">
                                <img class="avatar pull-right" src="images/cars.png" />
                            </div>
                            <div class="col-md-10 col-sm-9 col-xs-8">
                                <h4 class="list-group-item-heading">
                                    <p> اتومبیل ها </p>
                                </h4>
                                <hr>
                                <p class="list-group-item-text">
                                    <span class="badge pull-right">
                                        تعداد:  <b><?php echo $numberOfCars; ?></b>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<?php header("Location: index.php"); exit(); ?>

<?php endif; ?>

<?php include ('footer.php'); ?>