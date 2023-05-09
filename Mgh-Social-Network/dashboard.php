<?php require('core/init.php'); ?>
<?php
	
	$topic = new Topic;
	$user = new User;
	
	$db = new Database;
	
	$db->query("SET CHARACTER SET utf8");
	$db->execute();

	$totalCategories = $topic->getTotalCategories();
	$totalUsers = $user->getTotalUsers();
	$totalUnregisteredUsers = $user->getTotalUnregisteredUsers();
	$totalTopics = $topic->getTotalTopics();
	$totalCategories = $topic->getTotalCategories();
?>	

<?php include ('header.php'); ?>
<h3>Admin Panel</h3>
<hr>
	<ul id="topics">
		<li class="topic">
			<div class="row">
				<div class="col-md-2">
					<img class="avatar pull-right" src="images/unregistered_user.png" />
				</div>
				<div class="col-md-10">
					<div class="topic-content pull-left">
						<h3><a href="unregisteredusers_admin.php">Unregistered Users</a></h3>
						<span class="badge pull-right"><b><?php echo $totalUnregisteredUsers; ?></b></span>
					</div>
				</div>	
			</div>
		</li>
		<li class="topic">
			<div class="row">
				<div class="col-md-2">
					<img class="avatar pull-right" src="images/user.png" />
				</div>
				<div class="col-md-10">
					<div class="topic-content pull-left">
						<h3><a href="users_admin.php">Users</a></h3>
						<span class="badge pull-right"><b><?php echo $totalUsers; ?></b></span>
					</div>
				</div>	
			</div>
		</li>
		<li class="topic">
			<div class="row">
				<div class="col-md-2">
					<img class="avatar pull-right" src="images/topic.jpg" />
				</div>
				<div class="col-md-10">
					<div class="topic-content pull-left">
						<h3><a href="topics_admin.php">Topics</a></h3>
						<span class="badge pull-right"><b><?php echo $totalTopics; ?></b></span>
					</div>
				</div>	
			</div>
		</li>
		
		<li class="topic">
			<div class="row">
				<div class="col-md-2">
					<img class="avatar pull-right" src="images/category.jpg" />
				</div>
				<div class="col-md-10">
					<div class="topic-content pull-left">
						<h3><a href="categories_admin.php">Categories</a></h3>
						<span class="badge pull-right"><b><?php echo $totalCategories; ?></b></span>
					</div>
				</div>	
			</div>
		</li>
	</ul>
<?php include ('footer.php'); ?>