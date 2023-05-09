<?php require('core/init.php'); ?>
<?php
	
	$topic = new Topic;
	$category = new Category;
	
	$db = new Database;
	
	$db->query("SET CHARACTER SET utf8");
	$db->execute();

	if(isset($_POST['add']))
	{
		$data = array();
		$data['name'] = $_POST['name'];
			
        $category->add($data);
        
        redirect('categories_admin.php', 'New Category Added', 'success');
        exit();
	}

    $totalCategories = $topic->getTotalCategories();
	$totalTopics = $topic->getTotalTopics();
?>	

<?php include ('header.php'); ?>
<p><a href="dashboard.php" class="btn btn-default">Back to Admin Panel</a></p>
	<form role="form" enctype="multipart/form-data" method="post" action="add_category_admin.php">
	  <div class="form-group">
			<label>Category Title</label>
			<input type="text" name="name" class="form-control" placeholder="Enter Name" required>
	  </div>	
	  <div class="form-group">
			<div class="g-recaptcha" data-sitekey="6LcHnSQTAAAAADCG_qRhTPdtdfectkkg1pqLQIcU"></div>
	  </div>	
		<button type="submit" name="add" class="btn btn-danger"> Add</button>
	</form>		
			
<?php include ('footer.php'); ?>