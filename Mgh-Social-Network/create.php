<?php require('core/init.php'); ?>
<?php
	$topic = new Topic;
	$user = new User;

    $db = new Database;
    $db->query("SET CHARACTER SET utf8");
    $db->execute();
	
	if(isset($_POST['create']))
	{
		$data = array();
		$data['title'] = $_POST['title'];
		$data['body'] = $_POST['body'];
		$data['category_id'] = $_POST['category'];
		$data['user_id'] = getUser()['user_id'];
		$data['create_date'] = date("Y-m-d H:j:s");
	
        if($user->isblock($data['user_id']) == false)
        {
            if($topic->uplodeImage(basename($_FILES["image"]["name"])))
            {
                $data['image'] = basename($_FILES["image"]["name"]);
            }
            else
            {
                $data['image'] = 0;
            }
            $topic->create($data);
            redirect('index.php', 'Your topic has been posted', 'success');
        }
        else
        {
            redirect('create.php', 'You Are Reported!', 'error');
        }
	}
	
	$topics = $topic->getAllTopics();
	$totalTopics = $topic->getTotalTopics();
	$totalCategories = $topic->getTotalCategories();
	$totalUsers = $user->getTotalUsers();
	
?>	
<?php include ('header.php'); ?>	

<form role="form" enctype="multipart/form-data" method="post" action="create.php">
	<div class="form-group">
		<label>Topic Title</label>
		<input name="title" type="text" class="form-control" placeholder="Enter Topic Title" required>
	</div>
	<div class="form-group">
		<label>Category</label>
		<select name="category" class="form-control">
		  <?php foreach(getCategories() as $category): ?>
		  <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
		  <?php endforeach; ?>
		</select>
	</div>
	<div class="form-group">
		<label>Topic Body</label>
		<textarea name="body" rows="10" cols="80" class="form-control" id="body" required></textarea>
		<script>CKEDITOR.replace('body');</script>
	</div>
    <div class="form-group">
		<label>Add Photo</label>
		<input type="file" name="image">
		<p class="help-block"></p>
	</div>
	<div class="form-group">
		<div class="g-recaptcha" data-sitekey="6LcHnSQTAAAAADCG_qRhTPdtdfectkkg1pqLQIcU"></div>
	</div>
	<button type="submit" name="create" class="btn btn-default">Post Topic</button>
</form>

<?php include ('footer.php'); ?>					