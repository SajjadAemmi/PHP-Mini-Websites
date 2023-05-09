<?php require('core/init.php'); ?>
<?php
	
	$topic = new Topic;
	$user = new User;
    $User = new User;
	
	$db = new Database;
	
	$db->query("SET CHARACTER SET utf8");
	$db->execute();
	
	if(isset($_POST['block_user']))
	{
        $id = $_POST['id'];

		$delete_user = $user->block($id);		
	}
	else if(isset($_POST['unblock_user']))
	{
        $id = $_POST['id'];

		$delete_user = $user->unblock($id);
	}
	else if(isset($_POST['delete']))
	{
        $id = $_POST['id'];
		$delete_user = $user->delete($id);
	}
	
	$users = $user->getAllUsers();	
	$User = $User;
	$totalTopics = $topic->getTotalTopics();
	$totalCategories = $topic->getTotalCategories();
	$totalUsers = $user->getTotalUsers();
?>	

<?php include ('header.php');?>
	<p><a href="dashboard.php" class="btn btn-default">Back to Admin Panel</a></p>
<?php if($users): ?>	
	<ul id="topics">
		<?php foreach($users as $user): ?>
        <?php if($user->id != 0): ?>
		<li class="topic">
			<div class="row">
				<div class="col-md-3">
					<img class="avatar img-circle pull-right" src="images/avatars/<?php echo $user->avatar; ?>" />
				</div>
				<div class="col-md-6">
					<div class="topic-content pull-left">
						<h3><?php echo $user->name; ?></h3>
						<div class="topic-info">
							<h4><?php echo $user->username; ?></h4>
						
							<h4><a href="profile.php?id=<?php echo urlencode($user->id); ?>">View Profile</a></h4>
							
							<h4><a href="topics.php?user=<?php echo urlencode($user->id); ?>">View Topics</a></h4>
							
							<span class="badge pull-left">Topics: <b><?php echo $User->getTopicsCount($user->id); ?></b></span>
						</div>
					</div>
				</div>
				<div class="col-md-3">

					<form method="post" action="users_admin.php">
						<button type="submit" name="delete" class="btn btn-danger btn-lg btn-block"><span class="glyphicon glyphicon-trash"></span> Delete</button>
					<?php if($user->block == 0): ?>
							<button type="submit" name="block_user" class="btn btn-warning btn-lg btn-block"><span class="glyphicon glyphicon-ban-circle"></span> Block</button>
				    <?php else: ?>
						<button type="submit" name="unblock_user" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-ok-circle"></span> UnBlock</button>
                    <?php endif; ?>
                        <input type="hidden" name="id" value="<?php echo $user->id; ?>">
					</form>
					
				</div>
			</div>
		</li>
        <?php endif; ?>
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