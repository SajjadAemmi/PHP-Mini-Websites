<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php
	
    if(isset($_POST['delete']))
	{
        $id = $_POST['id'];
		
        $query = "DELETE FROM storage_keepers WHERE id = '$id'";
        mysqli_query($connection, $query);
	}

    $query = "SELECT * FROM storage_keepers";
	$storage_keepers = mysqli_query($connection, $query);
?>	

<?php include ('header.php');?>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "admin"): ?>

    <div class="col-md-6 col-md-offset-3">
        <p>
            <a href="panel_admin.php" class="btn btn-default">
                بازگشت به پنل ادمین <i class="fa fa-arrow-left"></i>
            </a>
        </p>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">لیست کاربران</h3>
            </div>
            <div class="panel-body">	
                <?php if($storage_keepers): ?>
                    <ul class="list-group"> 
                        <?php foreach($storage_keepers as $storage_keeper): ?>                      
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img class="img-circle pull-right img-responsive" src="images/users/<?php echo $storage_keeper['image']; ?>" />
                                    </div>
                                    <div class="col-md-7">
                                        <h4 class="list-group-item-heading"><?php echo $storage_keeper['name']; ?></h4>
                                        <hr>
                                        <p class="list-group-item-text"> نام کاربری: <?php echo $storage_keeper['username']; ?> </p>
                                       
                                        <hr>
                                        <p class="list-group-item-text"> شماره همراه: <?php echo $storage_keeper['phone_number']; ?> </p>
                                        
                                    </div>
                                    <div class="col-md-3">

                                        <form method="post" action="storage_keepers_admin.php">
                                            <button type="submit" name="delete" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> حذف</button>
                                            <input type="hidden" name="id" value="<?php echo $storage_keeper['id']; ?>">
                                        </form>

                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>انبارداری جهت نمایش وجود ندارد</p>
                <?php endif; ?>	
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