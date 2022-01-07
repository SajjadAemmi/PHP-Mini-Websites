<?php
    include 'database.php';
    include 'functions.php';

if(isset($_POST['login']))
{
    $loginmode = $_POST['loginmode'];
    $username = $_POST['username'];
    $password = MD5($_POST['password']);
    
    if($loginmode == 1)
    {
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $user = mysqli_query($connection, $query);
        $num_of_rows = mysqli_num_rows($user);    

        if($num_of_rows != 0)
        {
            $user = mysqli_fetch_assoc($user);

            $_SESSION['login'] = 1;
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['name'] = $user['name'];	
			$_SESSION['login_type'] = "user";
			
			redirect('index.php', 'شما وارد شدید', 'success');
		}
		else
		{
			redirect('index.php', 'خطا در ورود! دوباره تلاش نمایید!', 'error');
		}	
    }
    elseif($loginmode == 2) // ورود ادمین
    {
        $username = $_POST['username'];
		$password = MD5($_POST['password']);
		
        if($username == 'admin' && $password == MD5('1234'))
		{
            $_SESSION['login'] = true;
			$_SESSION['name'] = "مدیریت";	
			$_SESSION['login_type'] = "admin";
            
			redirect('panel_admin.php', 'درود بر ادمین!', 'success');
		}
        else
		{
			redirect('index.php', 'خطا در ورود! دوباره تلاش نمایید!', 'error');
		}	
    }
}
?>