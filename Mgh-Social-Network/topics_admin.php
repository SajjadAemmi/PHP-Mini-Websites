<?php require('core/init.php'); ?>
<?php
	
	$topic = new Topic;
	$user = new User;
	
	$db = new Database;
	
	$db->query("SET CHARACTER SET utf8");
	$db->execute();
	
	$category = isset($_GET['category']) ? $_GET['category'] : null;
	
	$user_id = isset($_GET['user']) ? $_GET['user'] : null;

	if(isset($_POST['delete']))
	{
        $id = $_POST['id'];
		$delete_topic = $topic->delete($id);
	}

	$topics = $topic->getAllTopics();	
	$totalCategories = $topic->getTotalCategories();
	
	$totalTopics = $topic->getTotalTopics();
	$totalCategories = $topic->getTotalCategories();
	$totalUsers = $user->getTotalUsers();
?>	

<?php include ('header.php'); ?>
	<p><a href="dashboard.php" class="btn btn-default">Back to Admin Panel</a></p>
<?php if($topics): ?>	
	<ul id="topics">
		<?php foreach($topics as $topic): ?>
		<li class="topic">
			<div class="row">
				<div class="col-md-2">
					<img class="avatar img-circle pull-right" src="images/avatars/<?php echo $topic->avatar; ?>" />
				</div>
				<div class="col-md-7">
					<div class="topic-content pull-left">
						<h3><a href="topic.php?id=<?php echo urlencode($topic->id); ?>"><?php echo $topic->title; ?></a></h3>
						<div class="topic-info">
							<a href="topics.php?category=<?php echo urlencode($topic->category_id); ?>"><?php echo $topic->name; ?></a> - <?php echo $topic->create_date; ?> - <a href="topics.php?user=<?php echo urlencode($topic->user_id); ?>"><?php echo $topic->username; ?></a>
							<br>
							<span class="badge pull-left">Replies: <b><?php echo replyCount($topic->id); ?></b></span>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<form method="post" action="topics_admin.php">
						<button type="submit" name="delete" class="btn btn-danger btn-lg btn-block"><span class="glyphicon glyphicon-trash"></span> Delete</button>
						<input type="hidden" name="id" value="<?php echo $topic->id; ?>">
					</form>
				</div>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<p>No Topics!</p>
<?php endif; ?>	
<h3>Yas Information:</h3>
	<ul>
		<li>Topics: <strong><?php echo $totalTopics; ?></strong></li>
		<li>Users: <strong><?php echo $totalUsers; ?></strong></li>
		<li>Categories: <strong><?php echo $totalCategories; ?></strong></li>
	</ul>
<?php include ('footer.php'); ?>