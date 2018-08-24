<?php
include 'database.php';
include 'functions.php';

	if(isset($_POST['login_user']))
	{
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
			
		$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
								
		$user = mysqli_query($connection, $query);
		
		if(mysqli_num_rows($user) > 0)
		{
			$user = mysqli_fetch_assoc($user);
			
			$_SESSION['is_logged_in'] = true;
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['name'] = $user['name'];	
			$_SESSION['login_type'] = "user";
			
			redirect('user_panel.php', 'شما وارد شدید', 'success');
			return true;
		}
		else
		{
			redirect('index.php', 'خطا در ورود! دوباره تلاش نمایید!', 'error');
			return false;
		}	
	}
    elseif(isset($_POST['login_taxi']))
	{
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
			
		$query = "SELECT * FROM taxies WHERE username = '$username' AND password = '$password'";
								
		$taxi = mysqli_query($connection, $query);
		
		if(mysqli_num_rows($taxi) > 0)
		{
			$taxi = mysqli_fetch_assoc($taxi);
			
			$_SESSION['is_logged_in'] = true;
			$_SESSION['taxi_id'] = $taxi['id'];
			$_SESSION['username'] = $taxi['username'];
			$_SESSION['name'] = $taxi['name'];	
			$_SESSION['login_type'] = "taxi";
			
			redirect('taxi_panel.php', 'شما وارد شدید', 'success');
			return true;
		}
		else
		{
			redirect('index.php', 'خطا در ورود! دوباره تلاش نمایید!', 'error');
			return false;
		}	
	}
    elseif(isset($_POST['login_admin']))
	{
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
		
        if($username == 'admin' && $password == MD5('1234'))
		{
            $_SESSION['is_logged_in'] = true;
			$_SESSION['name'] = "مدیریت";	
			$_SESSION['login_type'] = "admin";
            
			redirect('admin_panel.php', 'درود بر ادمین!', 'success');
		}
	}
	else
	{
		redirect('index.php');
	}