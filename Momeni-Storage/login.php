<?php include 'functions.php'; ?>
<?php include 'database.php'; ?>
<?php
    
	session_start();
	
    if(isset($_POST['login']))
	{
		$login_type = $_POST['login_type'];
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
		
		if($login_type == 2 && $username == 'admin' && $password == MD5('1234'))
		{
            $_SESSION['is_logged_in'] = true;
            $_SESSION['user_id'] = 0;
            $_SESSION['username'] = "admin";
            $_SESSION['name'] = "ادمین";	
            $_SESSION['login_type'] = "admin";

			redirect('panel_admin.php', 'سلام بر ادمین بزرگ!', 'success');
		}
		else if($login_type == 1)
		{
           $query = "SELECT * FROM storage_keepers WHERE username = '$username' AND password = '$password'";

            $storage_keeper = mysqli_query($connection, $query);

            if(mysqli_num_rows($storage_keeper) > 0)
            {
                $storage_keeper = mysqli_fetch_assoc($storage_keeper);

                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_id'] = $storage_keeper['id'];
                $_SESSION['username'] = $storage_keeper['username'];
                $_SESSION['name'] = $storage_keeper['name'];	
                $_SESSION['login_type'] = "storage_keeper";

                redirect('main.php', 'شما وارد شدید', 'success');
            }
            else
            {
                redirect('index.php', 'خطا در ورود! دوباره تلاش نمایید!', 'danger');
            }	
		}
		else 
		{
			redirect('index.php', 'شما وارد نشدید!', 'danger');	
		}
	}
	else
	{
		redirect('index.php');
	}
?>	