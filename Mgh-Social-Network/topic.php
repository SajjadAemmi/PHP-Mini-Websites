<?php require('core/init.php'); ?>
<?php
	$topic = new Topic;
	
    $db = new Database;
    $db->query("SET CHARACTER SET utf8");
    $db->execute();

	$topic_id = $_GET['id'];

	if(isset($_POST['reply']))
	{
		$data = array();
		$data['topic_id'] = $topic_id;
		$data['body'] = $_POST['body'];
		$data['user_id'] = getUser()['user_id'];
		
		$topic->reply($data);
		redirect('topic.php?id='.$topic_id, 'Your reply sent', 'success');
	}
	
	$replies = $topic->getReplies($topic_id);
	$title = $topic->getTopic($topic_id)->title;
	$totalTopics = $topic->getTotalTopics();
	$totalCategories = $topic->getTotalCategories();
    $topic = $topic->getTopic($topic_id);
?>	

<?php include ('header.php'); ?>

<ul id="topics">
	<li id="main-topic" class="topic topic">
		<div class="row">
			<div class="col-md-2">
				<div class="user-info">
					<img class="avatar img-circle pull-left" src="<?php echo BASE_URI; ?>images/avatars/<?php echo $topic->avatar; ?>" />
					<ul>
						<li><strong><?php echo $topic->username; ?></strong></li>
						<li><?php echo userPostCount($topic->user_id); ?> Posts</li>
						<li><a href="<?php echo BASE_URI; ?>index.php?user=<?php echo $topic->user_id; ?>">View topics</a></li>
					</ul>	
				</div>
			</div>
			<div class="col-md-10">
                <?php if($topic->image != "0"): ?>
                    <div class="row">
                        <div class="col-md-12">
                            <img class="avatar pull-left" src="<?php echo BASE_URI; ?>images/topics/<?php echo $topic->image; ?>" />
                        </div>
                    </div>
                <?php endif; ?>
				<div class="topic-content pull-right">
                    <p class="bg-danger">
					   <?php echo $topic->body; ?>
                    </p>
				</div>
			</div>
		</div>	
	<?php foreach($replies as $reply) : ?>
	<li class="topic topic">
		<div class="row">
			<div class="col-md-2">
				<div class="user-info">
					<img class="avatar img-circle pull-left" src="<?php echo BASE_URI; ?>images/avatars/<?php echo $reply->avatar; ?>" />
					<ul>
						<li><strong><?php echo $reply->username; ?></strong></li>
						<li><?php echo userPostCount($reply->user_id); ?> Posts</li>
                        <li><a href="<?php echo BASE_URI; ?>index.php?user=<?php echo $reply->user_id; ?>">View topics</a></li>
					</ul>	
				</div>
			</div>
			<div class="col-md-10">
				<div class="topic-content pull-right">
					<?php echo $reply->body; ?>
				</div>
			</div>
		</div>	
	</li>	
	<?php endforeach; ?>	
</ul>

<?php if(isLoggedIn()): ?>	
<h3>Reply to topic</h3>
<form role="form" method="post" action="topic.php?id=<?php echo $topic->id; ?>">
	<div class="form-group">
		<textarea name="body" rows="10" cols="80" class="form-control" id="body"></textarea>
		<script>CKEDITOR.replace('body');</script>
	</div>
	 <button type="submit" name="reply" class="btn btn-default">Send Reply</button>
</form>
<?php endif; ?>			
<?php include ('footer.php'); ?>