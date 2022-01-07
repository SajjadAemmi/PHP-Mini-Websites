<?php require('core/init.php'); ?>
<?php
	$cooky = new Cooky;
	$user = new User;
	$db = new Database;
	
	$db->query("SET CHARACTER SET utf8");
	$db->execute();
	
	if(isset($_POST['submit']))
	{
		$data = array();
		$data['user_id'] = getUser()['user_id'];
		$data['credit'] = $_POST['credit'];
							
		$user->increaseCredit($data);
		$_SESSION['credit'] = $user->getUser($data['user_id'])->credit;
		redirect('index.php', 'افزایش اعتبار با موفقیت انجام شد', 'success');
	}
	
   	$totalCookies = $cooky->getTotalCookies();
	$totalCategories = $cooky->getTotalCategories();
?>

<?php include ('header.php'); ?>
<form role="form" enctype="multipart/form-data" method="post" action="increase_credit.php">

	  <div class="form-group">
		<label>شماره 16 رقمی کارت</label>
		<input type="text" name="card" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx" required>
	  </div>
	    <div class="form-group">
		<label>رمز دوم</label>
		<input type="password" name="pass" class="form-control" placeholder="Password" required>
	  </div>
	  <div class="form-group">
		<label>پست الکترونیکی</label>
		<input type="email" name="email" class="form-control" placeholder="Email">
	  </div>
	 <div class="form-group">
		<label>مبلغ</label>
		<div class="input-group">
		  <input type="number" name="credit" class="form-control" id="exampleInputAmount" placeholder="Amount" required>
		  <div class="input-group-addon">$</div>
		</div>
	</div>
	<button type="submit" name="submit" class="btn btn-success"><span class="glyphicon glyphicon-credit-card"></span> انجام عملیات</button>
	</form>		

<?php include ('footer.php'); ?>