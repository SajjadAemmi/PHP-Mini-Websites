<?php 
    include 'functions.php'; 
    include 'database.php'; 
	
    if(isset($_POST['delete']))
	{
        $id = $_POST['id'];
		
        $query = "DELETE FROM users WHERE id = '$id'";
        mysqli_query($connection, $query);
	}

    $query = "SELECT * FROM users";
	$users = mysqli_query($connection, $query);
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
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">لیست کاربران</h3>
            </div>
            <div class="panel-body">	
                <?php if($users): ?>
                    <ul class="list-group"> 
                        <?php foreach($users as $user): ?>                      
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img class="img-circle pull-right img-responsive" src="images/users/<?php echo $user['avatar']; ?>" />
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="list-group-item-heading"><?php echo $user['name']; ?></h4>
                                        <hr>
                                        <p class="list-group-item-text"> نام کاربری: <?php echo $user['username']; ?> </p>
                                       
                                        <hr>
                                        <p class="list-group-item-text"> شماره همراه: <?php echo $user['phone_number']; ?> </p>
                                        
                                    </div>
                                    <div class="col-md-2">

                                        <form method="post" action="users_admin.php">
                                            <button type="submit" name="delete" class="btn btn-danger btn-lg btn-block"><span class="glyphicon glyphicon-trash"></span> حذف</button>
                                            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        </form>

                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p> کاربری جهت نمایش وجود ندارد </p>
                <?php endif; ?>	
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<?php header("Location: index.php"); exit(); ?>

<?php endif; ?>

<?php include ('footer.php'); ?>