<?php 
    include 'database.php'; 
    include 'functions.php'; 

    $taxi_id = $_SESSION['taxi_id'];

	if(isset($_POST['edit_taxi']))
	{
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
		$password2 = MD5($_POST['password2']);
		$phone_number = $_POST['phone_number'];
        $car_id = $_POST['car'];
		$start_time = $_POST['start_time'];		
        $end_time = $_POST['end_time'];
        
        if($password == $password2)
        {
            if(isset($_FILES['avatar']))
            {
                move_uploaded_file($_FILES["avatar"]["tmp_name"],"images/taxies/". $username .".jpg");
                $avatar = $username . ".jpg";
            }
            else
            {
                $avatar = 'noimage.png';
            }
            
            $query = "UPDATE taxies SET name = '$name' , username = '$username', password = '$password', phone_number = '$phone_number', avatar = '$avatar', start_time = '$start_time', end_time = '$end_time' WHERE id = $taxi_id";
			  
            mysqli_query($connection, $query);
        
            redirect('taxi_panel.php', 'ویرایش اطلاعات با موفقیت انجام شد!', 'success');
		}
		else
		{
			redirect('edit_information_taxi.php', 'در وارد نمودن کلمه عبور دقت فرمایید!', 'error');
		}
	}
    
    $query = "SELECT taxies.*, cars.title 
                FROM taxies INNER JOIN cars
                ON taxies.car_id = cars.id
                WHERE taxies.id = '$taxi_id'";

    $taxi_table = mysqli_query($connection, $query);
    $taxi = mysqli_fetch_assoc($taxi_table);

    $query = "SELECT * FROM cars";
    $cars = mysqli_query($connection, $query);
?>	

<?php if(isset($_SESSION['is_logged_in']) && $_SESSION['login_type'] == "taxi"): ?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title text-center"> ویرایش اطلاعات </h3>
            </div>
         <div class="panel-body">
          
            <form role="form" enctype="multipart/form-data" method="post" action="edit_information_taxi.php">
                      <div class="form-group">
                        <label>نام و نام خانوادگی</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Your Name" value="<?php echo $taxi['name']; ?>" required>
                      </div>
                      <div class="form-group">
                        <label>شماره همراه</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="Enter Your Phone Number" value="<?php echo $taxi['phone_number']; ?>" required>
                      </div>
                    <div class="form-group">
                        <label>نوع اتومبیل</label>
                         <select class="form-control" name="car" required>
                             <?php foreach($cars as $car): ?>
                                <option <?php if($car['id'] == $taxi['car_id']){echo "selected"; } ?> value="<?php echo $car['id']; ?>"><?php echo $car['title']; ?></option>
                             <?php endforeach; ?>
                        </select>
                      </div>
                    <div class="form-group">
                        <label>ساعت کاری</label>
                        <input type="time" name="start_time" class="form-control" value="<?php echo $taxi['start_time']; ?>" required>
                        <label>تا</label>
                        <input type="time" name="end_time" class="form-control" value="<?php echo $taxi['end_time']; ?>" required>
                    </div>
                   <div class="form-group has-success has-feedback">
                      <label class="control-label">نام کاربری</label>
                      <div class="input-group"  dir="ltr">
                        <span class="input-group-addon">@</span>
                        <input type="text" name="username" class="form-control" placeholder="Enter Your Username" value="<?php echo $taxi['username']; ?>" required>
                      </div>
                    </div>
                   
                    <div class="form-group has-success has-feedback">
                        <label class="control-label">کلمه عبور</label>
                        <div class="input-group"  dir="ltr">
                            <span class="input-group-addon"> <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> </span>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                        </div>
                    </div>
                    <div class="form-group has-success has-feedback">
                        <label class="control-label">تکرار کلمه عبور</label>
                        <div class="input-group"  dir="ltr">
                            <span class="input-group-addon"> <span class="glyphicon glyphicon-lock" aria-hidden="true"></span> </span>
                            <input type="password" name="password2" class="form-control" placeholder="Enter Password Again" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>بارگزاری تصویر</label>
                        <input type="file" name="avatar" class="btn btn-warning">
                        <p class="help-block"></p>
                    </div>
                    <button type="submit" name="edit_taxi" class="btn btn-success btn-block btn-lg"> ثبت تغییرات </button>
                </form>		
            </div>
        </div>
    </div>
</div>

<?php else: ?>

<?php header("Location: index.php"); exit(); ?>

<?php endif; ?>

<?php include ('footer.php'); ?>