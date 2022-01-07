<?php
	class User
	{
		private $db;
		
		public function __construct()
		{
			$this->db = new Database;
		}
		
		public function register($data)
		{
            $this->db->query("SET CHARACTER SET utf8");
	        $this->db->execute();
            
			$this->db->query('INSERT INTO unregistered_users (name, email, avatar, username, password, about, join_date) 
								VALUES (:name, :email, :avatar, :username, :password, :about, :join_date)');
			
			$this->db->bind(':name', $data['name']);
			$this->db->bind(':email', $data['email']);
			$this->db->bind(':avatar', $data['avatar']);
			$this->db->bind(':username', $data['username']);
			$this->db->bind(':password', $data['password']);
			$this->db->bind(':about', $data['about']);
			$this->db->bind(':join_date', $data['join_date']);
			
			if($this->db->execute())
			{
				return true;
			}
			else
			{
				return false;
			}					
		}
		
		public function uplodeAvatar($username)
		{   
			$allowedExts = array("gif", "jpeg", "jpg", "png");
			$temp = explode(".", $_FILES["avatar"]["name"]);
			$extension = end($temp);
			
			if((($_FILES["avatar"]["type"] == "image/gif")
				|| ($_FILES["avatar"]["type"] == "image/jpeg")
				|| ($_FILES["avatar"]["type"] == "image/jpg")
				|| ($_FILES["avatar"]["type"] == "image/pjpeg")
				|| ($_FILES["avatar"]["type"] == "image/x-png")
				|| ($_FILES["avatar"]["type"] == "image/png"))
				&& ($_FILES["avatar"]["size"] < 5000000)
				&& in_array($extension, $allowedExts))
			{
				if($_FILES["avatar"]["error"] > 0)
				{
					redirect('register.php', $_FILES["avatar"]["error"], 'error');
				}
				else
				{
					if(file_exists("images/avatars/". $username .".jpg"))
					{
						redirect('register.php', 'File already exists', 'error');
					}
					else
					{
						move_uploaded_file($_FILES["avatar"]["tmp_name"],"images/avatars/". $username .".jpg");
						
						return true;
					}
				}
			}	
			else
			{
				return false;
			}
		}
		
		public function login($username, $password)
		{
			$this->db->query("SELECT * FROM users
								WHERE username = :username
								AND password = :password");
								
			$this->db->bind(':username', $username);
			$this->db->bind(':password', $password);
			
			$row = $this->db->single();
			
			if($this->db->rowCount() > 0)
			{
				$this->setUserData($row);
				return true;
			}
			else
			{
				return false;
			}					
		}
		public function setUserData($row)
		{
			$_SESSION['is_logged_in'] = true;
			$_SESSION['user_id'] = $row->id;
			$_SESSION['username'] = $row->username;
			$_SESSION['name'] = $row->name;
			$_SESSION['avatar'] = $row->avatar;	
		}
		
		public function logout()
		{
			unset($_SESSION['is_logged_in']);
			unset($_SESSION['user_id']);
			unset($_SESSION['username']);
			unset($_SESSION['name']);
			return true;	
		}
		
		public function getTotalUsers()
		{
			$this->db->query('SELECT * FROM users');
			$rows = $this->db->resultset();
			return  $this->db->rowCount();
		}
        
        public function block($id)
		{
			$this->db->query("SET CHARACTER SET utf8");
			$this->db->execute();

			$this->db->query('UPDATE users SET block = 1 WHERE id = :id');
			$this->db->bind(':id', $id);

			if($this->db->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function unblock($id)
		{
			$this->db->query("SET CHARACTER SET utf8");
			$this->db->execute();

			$this->db->query('UPDATE users SET block = 0 WHERE id = :id');
			$this->db->bind(':id', $id);

			if($this->db->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function isblock($id)
		{
			$this->db->query('SELECT * FROM users WHERE id = :id');
			$this->db->bind(':id', $id);

			$row = $this->db->single();

			if($row->block == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
        
        public function delete_unregistered($id)
		{	
			$this->db->query("SET CHARACTER SET utf8");
			$this->db->execute();

			$this->db->query('DELETE FROM unregistered_users WHERE id = :id');			
			$this->db->bind(':id', $id);

			if($this->db->execute())
			{
				return true;
			}
			else
			{
				return false;
			}									
		}

		public function accept($id)
		{	
            $this->db->query("SET CHARACTER SET utf8");
	        $this->db->execute();

			$this->db->query('SELECT * FROM unregistered_users WHERE id = :id');			
			$this->db->bind(':id', $id);
			
			$row = $this->db->single();

			$name = $row->name;
			$email = $row->email;
			$avatar = $row->avatar;
			$username = $row->username;
			$password = $row->password;
			$about = $row->about;
			$join_date = $row->join_date;

			$this->db->query('INSERT INTO users (name, email, avatar, username, password, about, join_date, block) 
								VALUES (:name, :email, :avatar, :username, :password ,:about, :join_date, 0)');
			
			$this->db->bind(':name', $name);
			$this->db->bind(':email', $email);
			$this->db->bind(':avatar', $avatar);
			$this->db->bind(':username', $username);
			$this->db->bind(':password', $password);
			$this->db->bind(':about', $about);
			$this->db->bind(':join_date', $join_date);
			
			if($this->db->execute())
			{
				$this->db->query('DELETE FROM unregistered_users WHERE id = :id');			
				$this->db->bind(':id', $id);

				if($this->db->execute())
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}					
		}
        
        public function getTotalUnregisteredUsers()
		{
			$this->db->query('SELECT * FROM unregistered_users');
			$rows = $this->db->resultset();
			return  $this->db->rowCount();
		}

		public function getAllUsers()
		{
			$this->db->query('SELECT * FROM users');
								
			$results = $this->db->resultset();
			return $results;				
		}

		public function getAllUnregisteredUsers()
		{
			$this->db->query('SELECT * FROM unregistered_users');
								
			$results = $this->db->resultset();
			return $results;
		}

		public function getUser($id)
		{	
			$this->db->query('SELECT users.*
								FROM users 
								WHERE users.id = :id');
								
			$this->db->bind(':id',$id);
			$row = $this->db->single();
			return $row;
		}

		public function getUnregisteredUser($id)
		{	
			$this->db->query('SELECT unregistered_users.*
								FROM unregistered_users 
								WHERE unregistered_users.id = :id');
								
			$this->db->bind(':id',$id);
			$row = $this->db->single();
			return $row;
		}
        
        public function getTopicsCount($user_id)
		{
			$this->db->query('SELECT * FROM topics INNER JOIN users
								ON topics.user_id = users.id
								WHERE users.id = :user_id');
			$this->db->bind(':user_id', $user_id);

			$rows = $this->db->resultset();
			return  $this->db->rowCount();
		}
        
        public function delete($id)
		{	
			$this->db->query("SET CHARACTER SET utf8");
			$this->db->execute();

			$this->db->query('DELETE FROM users WHERE id = :id');			
			$this->db->bind(':id', $id);
			
			if($this->db->execute())
			{
				$this->db->query('DELETE FROM topics WHERE user_id = :id');			
				$this->db->bind(':id', $id);

				if($this->db->execute())
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}										
		}
	}	
?>	