<?php 
    include 'functions.php'; 
    include 'database.php'; 

	if(isset($_POST['delete']))
	{
        $id = $_POST['id'];
		
        $query = "DELETE FROM taxies WHERE id = '$id'";
        mysqli_query($connection, $query);
	}
	
	$query = "SELECT taxies.*, cars.title 
                FROM taxies INNER JOIN cars
                ON taxies.car_id = cars.id";
	$taxies = mysqli_query($connection, $query);    
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
                <h3 class="panel-title">لیست راننده های تاکسی</h3>
            </div>
            <div class="panel-body">	
                <?php if($taxies): ?>
                    <ul class="list-group"> 
                        <?php foreach($taxies as $taxi): ?>                      
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img class="img-circle pull-right img-responsive" src="images/taxies/<?php echo $taxi['avatar']; ?>" />
                                    </div>
                                    <div class="col-md-7">
                                        <h4 class="list-group-item-heading"><?php echo $taxi['name']; ?></h4>
                                        <hr>
                                        <p class="list-group-item-text"> نام کاربری: <?php echo $taxi['username']; ?> </p>
                                        <hr>
                                        <p class="list-group-item-text"> شماره همراه: <?php echo $taxi['phone_number']; ?> </p>
                                        <hr>
                                        <p class="list-group-item-text"> نوع اتومبیل: <?php echo $taxi['title']; ?> </p>
                                        <hr>
                                        
                                        <?php list($part1, $part2, $part3, $part4) = explode(' ', $taxi['pelak']); ?>
                                        
                                        <span class="list-group-item-text"> شماره پلاک: </span>
                                            
                                            
                                            <table dir="ltr" class="table" style="display:inline;">
                                              <tr>
                                                <td> <?php echo $part1; ?> </td>
                                                <td> <?php echo $part2; ?> </td>
                                                <td> <?php echo $part3; ?> </td>
                                                <td> | </td>
                                                <td> <?php echo $part4; ?> </td>
                                                
                                                </tr>
                                            </table>
                                            
                                        <hr>
                                        <p class="list-group-item-text"> ساعت شروع شیفت: <?php echo $taxi['start_time']; ?> </p>
                                        <hr>
                                        <p class="list-group-item-text"> ساعت پایان شیفت: <?php echo $taxi['end_time']; ?> </p>
                                        <hr>
                                    </div>
                                    <div class="col-md-3">
   <a href="taxi_location_admin.php?taxi_id=<?php echo $taxi['id']; ?>" class="btn btn-success btn-lg btn-block"><i class="fa fa-map-marker"></i> مشاهده مکان تاکسی </a>
                                        <br>
                                        <form method="post" action="taxies_admin.php">
                                            <button type="submit" name="delete" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> حذف</button>
                                            <input type="hidden" name="id" value="<?php echo $taxi['id']; ?>">
                                        </form>

                                    </div>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p> تاکسی جهت نمایش وجود ندارد </p>
                <?php endif; ?>	
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<?php header("Location: index.php"); exit(); ?>

<?php endif; ?>

<?php include ('footer.php'); ?>