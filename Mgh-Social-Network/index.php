<?php require('core/init.php'); ?>
<?php
	$topic = new Topic;
	$user = new User;

    $db = new Database;
    $db->query("SET CHARACTER SET utf8");
    $db->execute();

	$category = isset($_GET['category']) ? $_GET['category'] : null;
	
	$user_id = isset($_GET['user']) ? $_GET['user'] : null;
	
	if(isset($category))
	{
		$topics = $topic->getByCategory($category);
		$title = 'Posts In "'.$topic->getCategory($category)->name.'"';
	}
	
	if(isset($user_id))
	{
		$topics = $topic->getByUser($user_id);
		$title = $user->getUser($user_id)->username."'s posts";
	}
	
	if(!isset($category) && !isset($user_id))
	{
		$topics = $topic->getAllTopics();	
	}
	
	$totalTopics = $topic->getTotalTopics();
	$totalCategories = $topic->getTotalCategories();
	$totalUsers = $user->getTotalUsers();
?>

<?php include ('header.php'); ?>	

<?php if($topics): ?>	
	<ul id="topics">
		<?php foreach($topics as $topic): ?>
		<li class="topic">
			<div class="row">
				<div class="col-md-2">
					<img class="avatar img-circle pull-left" src="images/avatars/<?php echo $topic->avatar; ?>" />
				</div>
				<div class="col-md-10">
					<div class="topic-content pull-right">
						<h3><a href="topic.php?id=<?php echo $topic->id; ?>"><?php echo $topic->title; ?></a></h3>
						<div class="topic-info">
							<a href="index.php?category=<?php echo urlencode($topic->category_id); ?>"><?php echo $topic->name; ?></a> - <a href="index.php?user=<?php echo urlencode($topic->user_id); ?>"><?php echo $topic->username; ?></a> - <?php echo $topic->create_date; ?>
							<span class="badge pull-right">Replies: <b><?php echo replyCount($topic->id); ?></b></span>
						</div>
					</div>
				</div>	
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
<?php else: ?>
	<p>No Topic To Display</p>
<?php endif; ?>	
	<h3>Forum Statistics</h3>
	<ul>
		<li>Number of Topics: <strong><?php echo $totalTopics; ?></strong></li>
		<li>Number of Users: <strong><?php echo $totalUsers; ?></strong></li>
		<li>Number of Categories: <strong><?php echo $totalCategories; ?></strong></li>
	</ul>
<?php include ('footer.php'); ?>