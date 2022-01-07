<?php include ('core/init.php'); ?>
<?php

	$db = new Database();
	
	if(isset($_POST['submit']))
	{
        $id = $_POST['id'];
		
		unlink("images/avatars/"."avatar".$id.".jpg");
		
		$query = "DELETE FROM contacts WHERE id='$id'";
					
		$insert_row = $db->delete($query);
            
            header("Location: index.php");
            exit();			
	}
?>