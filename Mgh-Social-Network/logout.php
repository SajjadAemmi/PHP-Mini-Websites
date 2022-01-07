<?php require('core/init.php'); ?>
<?php
	if(isset($_POST['logout']))
	{
		$user = new User;
		
		if($user->logout())
		{
			redirect('index.php', 'You are now logged out', 'success');
		}
	}
	else
	{
		redirect('index.php');
	}
?>	