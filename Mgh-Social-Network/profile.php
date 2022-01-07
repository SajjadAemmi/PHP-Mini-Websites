<?php require('core/init.php'); ?>

<?php
	
	$user = new User;
	$topic = new Topic;
	
	$user_id = $_GET['id'];
	
	$db = new Database;
	
	$db->query("SET CHARACTER SET utf8");
	$db->execute();
	
	$user = $user->getUser($user_id);

	$totalTopics = $topic->getTotalTopics();
	$totalCategories = $topic->getTotalCategories();
	
?>	

<?php include ('header.php'); ?>

<div class="list-group">
  <a href="#" class="list-group-item active">
    <p class="list-group-item-text">Name</p>
	<h4 class="list-group-item-heading"><?php echo $user->name; ?></h4>
  </a>
<a href="#" class="list-group-item">
    <p class="list-group-item-text">Username</p>
	<h4 class="list-group-item-heading"><?php echo $user->username; ?></h4>
  </a>
<a href="#" class="list-group-item">
    <p class="list-group-item-text">Email</p>
	<h4 class="list-group-item-heading"><?php echo $user->email; ?></h4>
  </a>
<a href="#" class="list-group-item">
    <p class="list-group-item-text">About</p>
	<h4 class="list-group-item-heading"><?php echo $user->about; ?></h4>
  </a>
</div>

<?php include ('footer.php'); ?>