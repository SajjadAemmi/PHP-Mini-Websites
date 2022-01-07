<?php
	class Category
	{
		private $db;
		
		public function __construct()
		{
			$this->db = new Database;
			$this->db->query("SET CHARACTER SET utf8");
			$this->db->execute();
		}
		
		public function add($data)
		{
			$this->db->query("SET CHARACTER SET utf8");
			$this->db->execute();

			$this->db->query('INSERT INTO categories (name) VALUES (:name)');
			
			$this->db->bind(':name', $data['name']);
			
			if($this->db->execute())
			{
				return true;
			}
			else
			{
				return false;
			}					
		}
		
		public function getTotalCategories()
		{
			$this->db->query('SELECT * FROM categories');
			$rows = $this->db->resultset();
			return  $this->db->rowCount();
		}

		public function getAllCategories()
		{
			$this->db->query('SELECT * FROM categories');
								
			$results = $this->db->resultset();
			return $results;				
		}

		public function delete($id)
		{	
			$this->db->query("SET CHARACTER SET utf8");
			$this->db->execute();

			$this->db->query('DELETE FROM categories WHERE id = :id');			
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
	}	
?>	