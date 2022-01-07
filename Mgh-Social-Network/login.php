<?php require('core/init.php'); ?>
<?php
	if(isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
		$login_type = $_POST['login_type'];
        
		$user = new User;
		
        if($login_type == 2 && $username == 'mahbube' && $password == MD5('1234'))
		{
			redirect('dashboard.php', 'WellCome Dear Admin!', 'success');
		}
		else if($login_type == 1 && $user->login($username, $password))
		{
			redirect('index.php', 'You logged in', 'success');
		}
		else
		{
			redirect('index.php', 'Error login!', 'error');
		}
	}
	else
	{
		redirect('index.php');
	}
?>	