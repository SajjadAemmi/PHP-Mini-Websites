<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php

	if(isset($_POST['register']))
	{
        $name = $_POST['name'];
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
		$password2 = MD5($_POST['password2']);
		$phone_number = $_POST['phone_number'];
		$start_time = $_POST['start_time'];		
        $end_time = $_POST['end_time'];

        if($password == $password2)
        {
            $query = "SELECT * FROM storage_keepers WHERE username = '$username'";

            $storage_keeper = mysqli_query($connection, $query);

            if(mysqli_num_rows($storage_keeper) > 0)
            {
                redirect('register.php', 'این نام کاربری قبلا انتخاب شده است!', 'danger');
            }
            else
            {
                 if(isset($_FILES['image']))
                {
                    move_uploaded_file($_FILES["image"]["tmp_name"],"images/storage_keppers/". $username .".jpg");
                    $image = $username . ".jpg";
                }
                else
                {
                    $image = 'noimage.png';
                }

                $query = "INSERT INTO storage_keepers (name, username, password, phone_number, start_time,end_time ,image) VALUES ('$name', '$username', '$password', '$phone_number', '$start_time', '$end_time' ,'$image')";

                mysqli_query($connection, $query);

                redirect('index.php', 'ثبت نام شما با موفقیت انجام شد!', 'success');
            }
           
		}
		else
		{
			redirect('register.php', 'در وارد نمودن کلمه عبور دقت فرمایید!', 'danger');
		}
	}
?>	

<?php include ('header.php'); ?>

<div class="col-md-6 col-md-offset-3">
    
    <p>
        <a href="index.php" class="btn btn-default">
            بازگشت <i class="fa fa-arrow-left"></i>
        </a>
    </p>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">فرم ثبت نام</h3>
        </div>
        <div class="panel-body">
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
                    <input type="file" name="image" class="btn btn-primary">
                    <p class="help-block"></p>
                  </div>  
                  <button type="submit" name="register" class="btn btn-success">ثبت نام</button>
            </form>
        </div>
    </div>
</div>
</div>
</div><!-- /.container -->

  </body>
</html>