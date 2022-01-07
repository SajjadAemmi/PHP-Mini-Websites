<?php require('core/init.php'); ?>
<?php

	$topic = new Topic;
	$category = new Category;

	$db = new Database;
	
	$db->query("SET CHARACTER SET utf8");
	$db->execute();
	
	if(isset($_POST['delete']))
	{
        $id = $_POST['id'];
		
		$delete = $category->delete($id);		
	}

	$categories = $category->getAllCategories();	
	$totalTopics = $topic->getTotalTopics();
?>	

<?php include ('header.php');?>
	<p><a href="dashboard.php" class="btn btn-default">Back to Admin Panel</a></p>
<ul id="topics">
		<li class="topic">
			<div class="row">
				<div class="col-md-9">
					<div class="topic-content pull-left">
						<h3>New Category</h3>
					</div>
				</div>
				<div class="col-md-3">
						<a href="add_category_admin.php" class="btn btn-success btn-lg btn-block"><span class="glyphicon glyphicon-plus"></span> Add</a>
				</div>	
			</div>
		</li>
<?php if($categories): ?>	
	<?php foreach($categories as $category): ?>
		<li class="topic">
			<div class="row">
				<div class="col-md-9">
					<div class="topic-content pull-left">
						<h3><?php echo $category->name; ?></h3>
					</div>
				</div>
				<div class="col-md-3">
					<form method="post" action="categories_admin.php">
						<button type="submit" name="delete" class="btn btn-danger btn-lg btn-block"><span class="glyphicon glyphicon-trash"></span> Delete</button>
						<input type="hidden" name="id" value="<?php echo $category->id; ?>">
					</form>
				</div>
			</div>
		</li>
		<?php endforeach; ?>
	<?php else: ?>
		<p>No Categories!</p>
	<?php endif; ?>
</ul>	
<?php include ('footer.php'); ?>