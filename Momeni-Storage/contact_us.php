<?php require('core/init.php'); ?>
<?php
		
	$cooky = new Cooky;
	$user = new User;
	
	$db = new Database;
	
	$db->query("SET CHARACTER SET utf8");
	$db->execute();
	
	if(isset($_POST['send']))
	{
		$data = array();
		$data['name'] = $_POST['name'];
		$data['email'] = $_POST['email'];
		$data['body'] = $_POST['body'];
			
		if($user->sendMessage($data))
		{
			redirect('contact_us.php', 'پیام شما با موفقیت ارسال شد', 'success');
		}
		else
		{
			redirect('contact_us.php', 'مشکلی رخ داد. لطفا دوباره تلاش نمایید', 'error');
		}
	}
	
   	$totalCookies = $cooky->getTotalCookies();
	$totalCategories = $cooky->getTotalCategories();
?>

<?php include ('header.php'); ?>

<div class="alert alert-danger" role="alert">
شما عزیزان می توانید از راه های ارتباطی زیر، با ما در تماس باشید:
</div>
<div class="alert alert-danger" role="alert">
تلفن: 051312345678
</div>
<div class="alert alert-danger" role="alert">
Email: mail@gmail.com
</div>

<form role="form" enctype="multipart/form-data" method="post" action="contact_us.php">

	  <div class="form-group">
		<label>نام</label>
		<input type="text" name="name" class="form-control" required>
	  </div>
	  <div class="form-group">
		<label>پست الکترونیکی</label>
		<input type="email" name="email" class="form-control" placeholder="Email" required>
	  </div>
		<div class="form-group">
			<label>متن پیام</label>
			<textarea name="body" rows="10" cols="80" class="form-control" id="body"></textarea>
			<script>CKEDITOR.replace('body');</script>
		</div>
  
		<div class="form-group">
			<div class="g-recaptcha" data-sitekey="6LcHnSQTAAAAADCG_qRhTPdtdfectkkg1pqLQIcU"></div>
		</div>	
		<button type="submit" name="send" class="btn btn-success"><span class="glyphicon glyphicon-envelope"></span> ارسال</button>
	</form>		

<?php include ('footer.php'); ?>