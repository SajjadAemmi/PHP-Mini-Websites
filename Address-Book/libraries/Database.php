<?php
	
	class database
	{
		public $host = DB_HOST;
		public $username = DB_USER;
		public $password = DB_PASS;
		public $name = DB_NAME;
		
		public $error;
		public $link;
		
		// class costractor
		
		public function __construct()
		{
			 $this->connect();
		}
		
		private function connect()
		{
			$this->link = new mysqli($this->host, $this->username, $this->password, $this->name);
			
			if(!$this->link)
			{
				$this->error = "Connection Failed: " . $this->link->connect_error;
			}
		}
		
		public function numOfRows()
		{
			$query = "SELECT * FROM contacts";
    		$result = $this->link->query($query) or die($this->link->error.__LINE__);
    		return $result->num_rows;
		}
		
		public function select($query)
		{
			$result = $this->link->query($query) or die($this->link->error.__LINE__);
			
			if($result->num_rows > 0)
				return $result;
			else
				return false;
		}
		
		public function insert($query)
		{
			$insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
			
			if($insert_row)
			{
				header('Location: index.php?msg='.urlencode('Record Added'));
				exit();
			}
			else
			{
				die('Error: ('. $this->link->errno.')'.$this->link->error);
			}
		}
		
		public function update($query)
		{
			$update_row = $this->link->query($query) or die($this->link->error.__LINE__);
			
			if($update_row)
			{
				header('Location: index.php?msg='.urlencode('Record updated'));
				exit();
			}
			else
			{
				die('Error: ('. $this->link->errno.')'.$this->link->error);
			}
		}
		
		public function delete($query)
		{
			$delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
			
			if($delete_row)
			{
				header('Location: index.php?msg='.urlencode('Record deleted'));
				exit();
			}
			else
			{
				die('Error: ('. $this->link->errno.')'.$this->link->error);
			}
		}
	}