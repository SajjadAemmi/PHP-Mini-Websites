<?php require('core/init.php'); ?>
<?php
	$topic = new Topic;
	$user = new User;

	if(isset($_POST['register']))
	{
		$data = array();
		$data['name'] = $_POST['name'];
		$data['email'] = $_POST['email'];
		$data['username'] = $_POST['username'];
		$data['password'] = MD5($_POST['password']);
		$data['password2'] = MD5($_POST['password2']);
		$data['about'] = $_POST['about'];
		$data['join_date'] = date("Y-m-d H:j:s");
		
        if($data['password'] == $data['password2'])
        {
            if($user->uplodeAvatar($data['username']))
            {
                $data['avatar'] = $data['username'] . ".jpg";
            }
            else
            {
                $data['avatar'] = 'noimage.png';
            }

            $user->register($data);
            redirect('index.php', 'You are registered and Please wait Until Admin Accpet you!', 'success');
		}
		else
		{
			redirect('register.php', 'Passwords Not Matched!', 'error');
		}
	}
	
	$totalTopics = $topic->getTotalTopics();
	$totalCategories = $topic->getTotalCategories();
?>	

<?php include ('header.php'); ?>
	<form role="form" enctype="multipart/form-data" method="post" action="register.php">
	  <div class="form-group">
		<label>Name*</label>
		<input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
	  </div>
	  <div class="form-group">
		<label>Email*</label>
		<input type="email" name="email" class="form-control" placeholder="Enter Your Email"  required>
	  </div>
	  <div class="form-group">
		<label>Username*</label>
		<input type="text" name="username" class="form-control" placeholder="Enter Your Username" required>
	  </div>
	  <div class="form-group">
		<label>Password*</label>
		<input type="password" name="password" class="form-control" placeholder="Enter Your Password" required>
	  </div>
	  <div class="form-group">
		<label>Confirm Password*</label>
		<input type="password" name="password2" class="form-control" placeholder="Enter Your Password Again" required>
	  </div>
	  <div class="form-group">
		<label>Uplode Avatar</label>
		<input type="file" name="avatar">
		<p class="help-block"></p>
	  </div>
	  <div class="form-group">
		<label>About</label>
		<textarea id="about" rows="6" cols="80" name="about" class="form-control" placeholder="Tell us about yourself"></textarea>
	  </div>
		<div class="form-group">
			<div class="g-recaptcha" data-sitekey="6LcHnSQTAAAAADCG_qRhTPdtdfectkkg1pqLQIcU"></div>
	  </div>	  
	  <button type="submit" name="register" class="btn btn-default">Register</button>
	</form>		
			
<?php include ('footer.php'); ?>