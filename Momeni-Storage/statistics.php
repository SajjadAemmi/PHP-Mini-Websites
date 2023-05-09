<?php require('core/init.php'); ?>
<?php
	
	$cooky = new Cooky;
	$user = new User;
	
	$db = new Database;
	
	$db->query("SET CHARACTER SET utf8");
	$db->execute();
	
	$cookies = $cooky->getAllCookies();
	
	$maxCookyId = 0;
	$maxCookyOrder = 0;
	
	foreach($cookies as $myCooky):
	
		if($maxCookyOrder < $cooky->getCookyCountOrdered($myCooky->id))
		{
			$maxCookyId = $myCooky->id;
			$maxCookyOrder = $cooky->getCookyCountOrdered($myCooky->id);
		}
		
	endforeach;
	
	$users = $user->getAllUsers();
	
	$maxUserId = 0;
	$maxUserOrder = 0;
	
	foreach($users as $myUser):
	
		if($maxUserOrder < $user->getUserCountOrdered($myUser->id))
		{
			$maxUserId = $myUser->id;
			$maxUserOrder = $user->getUserCountOrdered($myUser->id);
		}
		
	endforeach;
	
	$maxCooky = $cooky->getCooky($maxCookyId);
	$maxUser = $user->getUser($maxUserId);
	$maxCookyOrder = $maxCookyOrder;
	$maxUserOrder = $maxUserOrder;
	
	$totalOrders = $cooky->getSumOrders();
	$totalUsers = $user->getTotalUsers();
	$totalCookies = $cooky->getTotalCookies();
	$totalCategories = $cooky->getTotalCategories();
?>

<?php include ('header.php'); ?>

<ul id="topics">
	<div class="row">
	<div class="alert alert-danger" role="alert">
		<h4>محبوب ترین محصول قنادی عسلی</h4>
	</div>
		<?php if($maxCooky->image != "0"): ?>
		<div class="col-md-6">
			<div class="thumbnail">
				<img src="<?php echo BASE_URI; ?>images/cookies/<?php echo $maxCooky->image; ?>" />
			</div>
		</div>
		<?php endif; ?>
		
		<div class="col-md-6">
			<div class="alert alert-success" role="alert">
				<?php echo $maxCooky->title; ?>
			</div>	
		
			<div class="row">
				<div class="col-md-12">
					<div class="topic-content pull-right">
						<?php echo $maxCooky->body; ?>
					</div>
				</div>
			</div>
			<div class="alert alert-info" role="alert">قیمت: <?php echo $maxCooky->price; ?> تومان</div>
	
			<div class="alert alert-danger" role="alert">
				تعداد سفارش: <?php echo $maxCookyOrder; ?> مرتبه
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="alert alert-danger" role="alert">
			<h4>بهترین کاربر قنادی عسلی</h4>
		</div>	
		<div class="col-md-6">
			<div class="thumbnail">
				<img src="<?php echo BASE_URI; ?>images/avatars/<?php echo $maxUser->avatar; ?>" />
			</div>
		</div>
		<div class="col-md-6">
			<div class="alert alert-success" role="alert">
				<?php echo $maxUser->username; ?>
			</div>	
			<div class="alert alert-warning" role="alert">
				ایمیل: <?php echo $maxUser->email; ?>
			</div>
			<div class="alert alert-danger" role="alert">
				تعداد سفارش ها: <?php echo $maxUserOrder; ?> مرتبه
			</div>
		</div>
	</div>
	
		<div class="row">
		<div class="alert alert-danger" role="alert">
			<h4>تعداد سفاراشات قنادی عسلی تا اکنون</h4>
		</div>	
		<div class="col-md-6">
			<div class="alert alert-danger" role="alert">
				مجموع سفارش ها: <?php echo $totalOrders; ?>
			</div>
		</div>
	</div>
</ul>

<?php include ('footer.php'); ?>	