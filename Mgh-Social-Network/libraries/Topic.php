<?php
	class Topic
	{
		private $db;
		
		public function __construct()
		{
			$this->db = new Database;
		}
		
		public function getAllTopics()
		{
			$this->db->query('SELECT topics.*, users.username, users.avatar, categories.name
								FROM topics INNER JOIN users
								ON topics.user_id = users.id
								INNER JOIN categories
								ON topics.category_id = categories.id
								ORDER BY create_date DESC');
								
			$results = $this->db->resultset();
			return $results;				
		}
		public function getTotalTopics()
		{
			$this->db->query('SELECT * FROM topics');
			$rows = $this->db->resultset();
			return  $this->db->rowCount();
		}
		
		public function getTotalCategories()
		{
			$this->db->query('SELECT * FROM categories');
			$rows = $this->db->resultset();
			return  $this->db->rowCount();
		}
		
		public function getTotalReplies($topic_id)
		{
			$this->db->query('SELECT * FROM replies WHERE topic_id = '.$topic_id);
			$rows = $this->db->resultset();
			return  $this->db->rowCount();
		}
		
		public function getCategory($category_id)
		{
			$this->db->query('SELECT * FROM categories WHERE id = :category_id');
			$this->db->bind(':category_id',$category_id);
			$row = $this->db->single();
			return  $row;
		}
		
		public function getByCategory($category_id)
		{
			$this->db->query('SELECT topics.*, categories.name, users.username, users.avatar
								FROM topics INNER JOIN categories
								ON topics.category_id = categories.id
								INNER JOIN users
								ON topics.user_id = users.id
								WHERE topics.category_id = :category_id');
								
			$this->db->bind(':category_id',$category_id);					
			$results = $this->db->resultset();
			return $results;				
		}
		
		public function getByUser($user_id)
		{
			$this->db->query('SELECT topics.*, categories.name, users.username, users.avatar
								FROM topics INNER JOIN categories
								ON topics.category_id = categories.id
								INNER JOIN users
								ON topics.user_id = users.id
								WHERE topics.user_id = :user_id');
								
			$this->db->bind(':user_id',$user_id);					
			$results = $this->db->resultset();
			return $results;				
		}
		
		public function getTopic($id)
		{
			$this->db->query('SELECT topics.*, users.username, users.name, users.avatar
								FROM topics INNER JOIN users
								ON topics.user_id = users.id
								WHERE topics.id = :id');
								
			$this->db->bind(':id',$id);
			$row = $this->db->single();
			return  $row;
		}
	
		public function getReplies($topic_id)
		{
			$this->db->query('SELECT replies.*, users.*
								FROM replies INNER JOIN users
								ON replies.user_id = users.id
								WHERE replies.topic_id = :topic_id
								ORDER BY create_date ASC');
								
			$this->db->bind(':topic_id',$topic_id);
			$results = $this->db->resultset();
			return $results;
		}
		
		public function create($data)
		{
            $this->db->query("SET CHARACTER SET utf8");
	        $this->db->execute();
            
			$this->db->query('INSERT INTO topics (category_id, user_id, title, body, create_date, image)
								VALUES (:category_id, :user_id, :title, :body, :create_date, :image)');
								
			$this->db->bind(':category_id', $data['category_id']);
			$this->db->bind(':user_id', $data['user_id']);
			$this->db->bind(':title', $data['title']);
			$this->db->bind(':body', $data['body']);
			$this->db->bind(':create_date', $data['create_date']);
            $this->db->bind(':image', $data['image']);
            
			if($this->db->execute())
			{
				return true;
			}
			else
			{
				return false;
			}										
		}
		
		public function reply($data)
		{
            $this->db->query("SET CHARACTER SET utf8");
	        $this->db->execute();
            
			$this->db->query('INSERT INTO replies (user_id, body, topic_id)
								VALUES (:user_id, :body, :topic_id)');
								
			$this->db->bind(':user_id', $data['user_id']);
			$this->db->bind(':body', $data['body']);
			$this->db->bind(':topic_id', $data['topic_id']);
			
			if($this->db->execute())
			{
				return true;
			}
			else
			{
				return false;
			}										
		}
        
        public function uplodeImage($x)
		{
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["image"]["name"]);
			$extension = end($temp);
			
			if((($_FILES["image"]["type"] == "image/gif")
				|| ($_FILES["image"]["type"] == "image/jpeg")
				|| ($_FILES["image"]["type"] == "image/jpg")
				|| ($_FILES["image"]["type"] == "image/png"))
				&& ($_FILES["image"]["size"] < 5000000)
				&& in_array($extension, $allowedExts))
			{
				if($_FILES["image"]["error"] > 0)
				{
					redirect('create.php', $_FILES["image"]["error"], 'error');
				}
				else
				{
					if(file_exists("images/topics/". $_FILES["image"]["name"]))
					{
						redirect('create.php', 'File already exists', 'error');
					}
					else
					{
						move_uploaded_file($_FILES["image"]["tmp_name"],"images/topics/".basename($_FILES["image"]["name"]));
						return true;
					}
				}
			}	
			else
			{
				return false;
			}
		}
	}	
?>	