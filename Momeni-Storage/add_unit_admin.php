<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php

	if(isset($_POST['add']))
	{
		$title = $_POST['title'];
			
        $query = "INSERT INTO units (title) VALUES ('$title')";
			 
        mysqli_query($connection, $query);
        
        redirect('units_admin.php', 'واحد جدید افزوده شد', 'success');
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
                <h3 class="panel-title text-center">افزودن واحد جدید</h3>
            </div>
            <div class="panel-body">	
                <form method="post" action="add_unit_admin.php">
                    <div class="form-group">
                        <label>نام واحد</label>
                        <input type="text" name="title" class="form-control" required>
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