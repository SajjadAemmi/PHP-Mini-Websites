<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php include 'header.php'; ?>
<?php
    $query = "SELECT * FROM kalas";
	$kalas = mysqli_query($connection, $query);
    $numberOfKalas = mysqli_num_rows($kalas);

    $query = "SELECT * FROM storage_keepers";
	$storage_keepers = mysqli_query($connection, $query);
    $numberOfStorage_keepers = mysqli_num_rows($storage_keepers);

    $query = "SELECT * FROM categories";
	$categories = mysqli_query($connection, $query);
    $numberOfCategories = mysqli_num_rows($categories);

    $query = "SELECT * FROM units";
	$units = mysqli_query($connection, $query);
    $numberOfUnits = mysqli_num_rows($units);
?>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "admin"): ?>

    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">مدیریت وبسایت</h3>
            </div>
            <div class="panel-body">	
                <div class="list-group">                 
                    <a class="list-group-item" href="main.php">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-thumbnail img-responsive" src="images/kala.png" />
                            </div>
                            <div class="col-md-8">
                                <h4 class="list-group-item-heading">
                                    <p> کالا ها </p>
                                </h4>
                                <hr>
                                <p class="list-group-item-text">
                                    <span class="badge pull-right">
                                        تعداد: <b><?php echo $numberOfKalas; ?></b>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                     <a class="list-group-item" href="storage_keepers_admin.php">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-thumbnail img-responsive" src="images/storage%20keeper.png" />
                            </div>
                            <div class="col-md-8">
                                <h4 class="list-group-item-heading">
                                    <p> مسئولان انبار </p>
                                </h4>
                                <hr>
                                <p class="list-group-item-text">
                                    <span class="badge pull-right">
                                         تعداد: <b><?php echo $numberOfStorage_keepers; ?></b>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                    <a class="list-group-item" href="reports_admin.php">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-thumbnail img-responsive" src="images/report.png" />
                            </div>
                            <div class="col-md-8">
                                <h4 class="list-group-item-heading">
                                    <p> گزارشات و فاکتور ها </p>
                                </h4>
                                <hr>
                            </div>
                        </div>
                    </a>
                     <a class="list-group-item" href="categories_admin.php">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-thumbnail img-responsive" src="images/category.png" />
                            </div>
                            <div class="col-md-8">
                                <h4 class="list-group-item-heading">
                                    <p> دسته بندی ها </p>
                                </h4>
                                <hr>
                                <p class="list-group-item-text">
                                    <span class="badge pull-right">
                                        تعداد:  <b><?php echo $numberOfCategories; ?></b>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </a>
                     <a class="list-group-item" href="units_admin.php">
                        <div class="row">
                            <div class="col-md-4">
                                <img class="img-thumbnail img-responsive" src="images/unit.png" />
                            </div>
                            <div class="col-md-8">
                                <h4 class="list-group-item-heading">
                                    <p> واحد های اندازه گیری </p>
                                </h4>
                                <hr>
                                <p class="list-group-item-text">
                                    <span class="badge pull-right">
                                        تعداد:  <b><?php echo $numberOfUnits; ?></b>
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
</div><!-- /.container -->
  </body>
</html>
<?php else: ?>

<?php header("Location: index.php") ?>

<?php endif; ?>