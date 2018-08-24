<?php 
    include 'database.php'; 
    include 'functions.php'; 

	if(isset($_POST['register_user']))
	{
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
		$password2 = MD5($_POST['password2']);
		$phone_number = $_POST['phone_number'];
		
        if($password == $password2)
        {
            $query = "SELECT * FROM users WHERE username = '$username'";
								
            $user = mysqli_query($connection, $query);

            if(mysqli_num_rows($user) > 0)
            {
                redirect('register.php', 'این نام کاربری قبلا انتخاب شده است', 'error');
                return false;
            }
            else
            {
               if(isset($_FILES['avatar']))
                {
                    move_uploaded_file($_FILES["avatar"]["tmp_name"],"images/users/". $username .".jpg");
                    $avatar = $username . ".jpg";
                }
                else
                {
                    $avatar = 'noimage.png';
                }

                $query = "INSERT INTO users (name, username, password, phone_number ,avatar) VALUES ('$name', '$username', '$password', '$phone_number' ,'$avatar')";

                mysqli_query($connection, $query);

                redirect('index.php', 'ثبت نام شما با موفقیت انجام شد!', 'success'); 
            }	
		}
		else
		{
			redirect('register.php', 'در وارد نمودن کلمه عبور دقت فرمایید!', 'error');
		}
	}
    elseif(isset($_POST['register_taxi']))
	{
	    $name = $_POST['name'];
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
		$password2 = MD5($_POST['password2']);
		$phone_number = $_POST['phone_number'];
		$car_id = $_POST['car'];
        
        $pelak = $_POST['pelak_part1'] . " " . $_POST['pelak_part2'] . " " . $_POST['pelak_part3'] . " " . $_POST['pelak_part4'];
        
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

            $query = "INSERT INTO taxies (name, username, password, phone_number, car_id, start_time,end_time ,avatar, pelak) VALUES ('$name', '$username', '$password', '$phone_number', '$car_id', '$start_time','$end_time' ,'$avatar', '$pelak')";

            mysqli_query($connection, $query);

            redirect('index.php', 'ثبت نام شما با موفقیت انجام شد!', 'success');
		}
		else
		{
			redirect('register.php', 'در وارد نمودن کلمه عبور دقت فرمایید!', 'error');
		}
	}

    $query = "SELECT * FROM cars";
    $cars = mysqli_query($connection, $query);
?>

<?php if(!isset($_SESSION['is_logged_in'])): ?>

<?php include 'header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-danger">
         <div class="panel-body">
            <div>

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#user" aria-controls="user" role="tab" data-toggle="tab">ثبت نام مسافر</a></li>
                <li role="presentation"><a href="#taxi" aria-controls="taxi" role="tab" data-toggle="tab">ثبت نام راننده تاکسی</a></li>
              </ul>
              <br>
              <!-- Tab panes -->
              <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="user">
                
                    <form role="form" enctype="multipart/form-data" method="post" action="register.php">
                      <div class="form-group">
                        <label>نام و نام خانوادگی</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                      </div>
                      <div class="form-group">
                        <label>شماره همراه</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="Enter Your Phone Number" required>
                      </div>
                    
                   <div class="form-group has-success has-feedback">
                      <label class="control-label">نام کاربری</label>
                      <div class="input-group"  dir="ltr">
                        <span class="input-group-addon">@</span>
                        <input type="text" name="username" class="form-control" placeholder="Enter Your Username" required>
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
                      <button type="submit" name="register_user" class="btn btn-success btn-lg btn-block">ثبت نام</button>
                    </form>		

                </div>
                <div role="tabpanel" class="tab-pane" id="taxi">
                     <form role="form" enctype="multipart/form-data" method="post" action="register.php">
                      <div class="form-group">
                        <label>نام و نام خانوادگی</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                      </div>
                     <div class="form-group">
                        <label>شماره همراه</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="Enter Your Phone Number" required>
                      </div>
                     <div class="form-group">
                        <label>نوع اتومبیل</label>
                         <select class="form-control" name="car" required>
                             <?php foreach($cars as $car): ?>
                                <option value="<?php echo $car['id']; ?>"><?php echo $car['title']; ?></option>
                             <?php endforeach; ?>
                        </select>
                      </div>
                      <label>شماره پلاک</label>
                         <div class="row">
                             
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="text" name="pelak_part1" class="form-control" required>
                            </div>
                             <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="text" name="pelak_part2" class="form-control" required>
                            </div>
                             <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="text" name="pelak_part3" class="form-control" required>
                            </div>
                             <div class="col-md-3 col-sm-3 col-xs-3">
                                <input type="text" name="pelak_part4" class="form-control" required>
                            </div>
                         </div>
                         <br>
                    <div class="form-group">
                        <label>ساعت کاری</label>
                        <input type="time" name="start_time" class="form-control" required>
                        <label>تا</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>
                    <div class="form-group has-success has-feedback">
                      <label class="control-label">نام کاربری</label>
                      <div class="input-group" dir="ltr">
                        <span class="input-group-addon">@</span>
                        <input type="text" name="username" class="form-control" placeholder="Enter Your Username" required>
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
                      <button type="submit" name="register_taxi" class="btn btn-success btn-lg btn-block">ثبت نام</button>
                    </form>
                </div>
              </div>

            </div>
             	
            </div>
        </div>
    </div>
</div>

<?php 
    else:
    
        if($_SESSION['login_type'] == "user")
        {
            header("Location: user_panel.php"); exit(); 
        }
        elseif($_SESSION['login_type'] == "taxi")
        {
            header("Location: taxi_panel.php"); exit(); 
        }
        elseif($_SESSION['login_type'] == "admin")
        {
            header("Location: admin_panel.php"); exit(); 
        }
?>

<?php endif; ?>

<?php include ('footer.php'); ?>