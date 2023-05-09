<?php
	
	class database
	{
		public $host = DB_HOST;
		public $username = DB_USER;
		public $password = DB_PASS;
		public $dbname = DB_NAME;
		
		public $error;
		public $dbh;
		public $stmt;
		
		// class costractor
		
		public function __construct()
		{
			 // set DSN
			 $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
			 // set options
			 $options = array(
				 PDO::ATTR_PERSISTENT =>true,
				 PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
			 );
			 // create a new PDO instance
			 try
			 {
				 $this->dbh = new PDO($dsn, $this->username, $this->password, $options);
			 }
			 catch(PDOException $e)
			 {
				 $this->error = $e->getMessage();
			 }
		}
		
		public function query($query)
		{
			$this->stmt = $this->dbh->prepare($query);
		}
		
		public function bind($param, $value,$type = null)
		{
			if(is_null($type))
			{
				switch(true)
				{
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}
			$this->stmt->bindvalue($param, $value, $type);
		}
		
		public function  execute()
		{
			return $this->stmt->execute();
		}
		
		public function  resultset()
		{
			$this->execute();
			return $this->stmt->fetchall(PDO::FETCH_OBJ);
		}
		
		public function  single()
		{
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_OBJ);
		}
		
		public function  rowCount()
		{
			return $this->stmt->rowCount();
		}
		
		public function  lastInsertId()
		{
			return $this->dbh->lastInsertId();
		}
		
		public function  beginTransaction()
		{
			return $this->dbh->beginTransaction();
		}
		
		public function  endTransaction()
		{
			return $this->dbh->commit();
		}
		
		public function  canselTransaction()
		{
			return $this->dbh->rollBack();
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
?>