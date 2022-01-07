<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php
	if(isset($_POST['delete']))
	{
        $id = $_POST['id'];
		
        $query = "DELETE FROM categories WHERE id = '$id'";
        mysqli_query($connection, $query);
	}

    $query = "SELECT * FROM categories";
	$categories = mysqli_query($connection, $query);
?>	

<?php include ('header.php');?>

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "admin"): ?>

    <div class="col-md-4 col-md-offset-4">
        <p><a href="panel_admin.php" class="btn btn-default"> بازگشت به پنل ادمین <i class="fa fa-arrow-left"></i></a></p>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"> دسته بندی های انبار</h3>
            </div>
            <div class="panel-body">

                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="add_category_admin.php" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-plus"></span> افزودن دسته بندی جدید</a>
                    </li>
                    <?php if($categories): ?>	
                        <?php foreach($categories as $category): ?>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-9 col-sm-6 col-xs-6">
                                        <h4><?php echo $category['type']; ?></h4>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <form method="post" action="categories_admin.php">
                                            <button type="submit" name="delete" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> حذف</button>
                                            <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                        </form>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>هیچ دسته بندی وجود ندارد</p>
                    <?php endif; ?>
                </ul>	
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