<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php

	if(isset($_POST['add']))
	{
		$type = $_POST['type'];
			
        $query = "INSERT INTO categories (type) VALUES ('$type')";
			 
        mysqli_query($connection, $query);
        
        redirect('categories_admin.php', 'دسته بندی جدید افزوده شد', 'success');
        exit();
	}

?>	

<?php include ('header.php'); ?>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "admin"): ?>

    <div class="col-md-4 col-md-offset-4">
        <p>
            <a href="panel_admin.php" class="btn btn-default"> بازگشت به پنل ادمین <i class="fa fa-arrow-left"></i>
            </a>
        </p>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title text-center">افزودن دسته بندی جدید</h3>
            </div>
            <div class="panel-body">	
                <form method="post" action="add_category_admin.php">
                    <div class="form-group">
                        <label>نام دسته بندی</label>
                        <input type="text" name="type" class="form-control" required>
                    </div>	
                    <button type="submit" name="add" class="btn btn-success"> افزودن</button>
                </form>	
            </div>		
        </div>
    </div>

</div>
</div><!-- /.container -->
  </body>
</html>
<?php else: ?>

<?php header("Location: index.php"); ?>

<?php endif; ?>