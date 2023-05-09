<?php require('core/init.php'); ?>
<?php
	
	$topic = new Topic;
	$user = new User;
	
	$db = new Database;
	
	$db->query("SET CHARACTER SET utf8");
	$db->execute();
	
    if(isset($_POST['accept']))
	{
        $id = $_POST['id'];
		
		$accept_user = $user->accept($id);
	}

	else if(isset($_POST['delete']))
	{
        $id = $_POST['id'];
		$delete_user = $user->delete_unregistered($id);
	}

	$users = $user->getAllUnregisteredUsers();	

	$totalTopics = $topic->getTotalTopics();
	$totalCategories = $topic->getTotalCategories();
	$totalUsers = $user->getTotalUsers();
?>	

<?php include ('header.php'); ?>
	<p><a href="dashboard.php" class="btn btn-default">Back to Admin Panel</a></p>
<?php if($users): ?>	
	<ul id="topics">
		<?php foreach($users as $user): ?>
		<li class="topic">
			<div class="row">
				<div class="col-md-2">
					<img class="avatar img-circle pull-right" src="images/avatars/<?php echo $user->avatar; ?>" />
				</div>
				<div class="col-md-7">
					<div class="topic-content pull-left">
						<h3><a href="topic.php?id=<?php echo urlencode($user->id); ?>"><?php echo $user->name; ?></a>  <span class="label label-danger"><b>New!</b></span></h3>
						<div class="topic-info">
							<?php echo $user->username; ?>

							<h4><a href="profile_unregistered.php?id=<?php echo urlencode($user->id); ?>">View Profile</a></h4>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<form method="post" action="unregisteredusers_admin.php">
						<button type="submit" name="accept" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-check"></span> Accept</button>
						<button type="submit" name="delete" class="btn btn-danger btn-block"><span class="glyphicon glyphicon-trash"></span> Delete</button>
						<input type="hidden" name="id" value="<?php echo $user->id; ?>">
					</form>
				</div>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<p>No Users!</p>
<?php endif; ?>	
	<h3>Yas Information:</h3>
	<ul>
		<li>Topics: <strong><?php echo $totalTopics; ?></strong></li>
		<li>Users: <strong><?php echo $totalUsers; ?></strong></li>
		<li>Categories: <strong><?php echo $totalCategories; ?></strong></li>
	</ul>
<?php include ('footer.php'); ?>