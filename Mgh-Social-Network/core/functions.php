<?php
	function redirect($page = FALSE, $message = NULL, $message_type = NULL)
	{
		if(is_string($page))
		{
			$location = $page;
		}
		else
		{
			$location = $_SERVER['SCRIPT_NAME'];
		}
		
		if($message != NULL)
		{
			$_SESSION['message'] = $message;
		}
		
		if($message_type != NULL)
		{
			$_SESSION['message_type'] = $message_type;
		}
		
		header('Location: '.$location);
		exit;
	}	
	
	function displayMessage()
	{
		if(!empty($_SESSION['message']))
		{
			$message = $_SESSION['message'];
			
			if(!empty($_SESSION['message_type']))
			{
				$message_type = $_SESSION['message_type'];
			
				if($message_type == 'error')
				{
					echo '<div class="alert alert-danger">'.$message.'</div>';
				}
				else
				{
					echo '<div class="alert alert-success">'.$message.'</div>';
				}
			}
			unset($_SESSION['message']);
			unset($_SESSION['message_type']);
		}
		else
		{
			echo '';
		}
	}
	
	function isLoggedIn()
	{
		if(isset($_SESSION['is_logged_in']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function getUser()
	{
		$userArray = array();
		$userArray['user_id'] = $_SESSION['user_id'];
		$userArray['username'] = $_SESSION['username'];
		$userArray['name'] = $_SESSION['name'];
		$userArray['avatar'] = $_SESSION['avatar'];
		return $userArray;
	}

	function is_active($category)
	{
		if(isset($_GET['category']))
		{
			if($_GET['category'] == $category)
			{
				return 'list-group-item-danger';	
			}
			else
			{
				return '';
			}
		}
		else
		{
			if($category == null)
			{
				return 'list-group-item-danger';
			}
		}
	}
	
		function replyCount($topic_id)
	{
		$db = new Database;
		
		$db->query('SELECT * FROM replies WHERE topic_id = :topic_id');
		
		$db->bind(':topic_id', $topic_id);
		
		$rows = $db->resultset();
		
		return $db->rowCount();
	}
	
	function getCategories()
	{
		$db = new Database;
		
		$db->query('SELECT * FROM categories');
		
		$results = $db->resultset();
		
		return $results;
	}
	
	function userPostCount($user_id)
	{
		$db = new Database;
		
		$db->query('SELECT * FROM topics WHERE user_id = :user_id');
		
		$db->bind(':user_id', $user_id);
		
		$rows = $db->resultset();
		
		$topic_count = $db->rowCount();
		
		$db->query('SELECT * FROM replies WHERE user_id = :user_id');
		
		$db->bind(':user_id', $user_id);
		
		$rows = $db->resultset();
		
		$reply_count = $db->rowCount();
		
		return $topic_count + $reply_count;
	}
	
	function getNumPostOfCategory($category_id)
	{
		$db = new Database;
		
		$db->query('SELECT topics.*, categories.name, users.username, users.avatar
							FROM topics INNER JOIN categories
							ON topics.category_id = categories.id
							INNER JOIN users
							ON topics.user_id = users.id
							WHERE topics.category_id = :category_id');
							
		$db->bind(':category_id',$category_id);					
		$rows = $db->resultset();
		return  $db->rowCount();				
	}
	
	function getLinks()
	{
		$db = new Database;
		
		$db->query('SELECT * FROM links');
		
		$results = $db->resultset();
		
		return $results;
	}
?>	