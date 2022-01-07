<?php include ('core/init.php'); ?>
<?php

	$db = new Database();
	
	if(isset($_POST['submit']))
	{
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$state = $_POST['state'];
        $contact_group = $_POST['contact_group'];
		$phone_number = $_POST['phone_number'];
		$note = $_POST['note'];
		
		$id = $db->numOfRows() + 1;
		
		if($_FILES["avatar"]["size"] > 1)
		{	
			move_uploaded_file($_FILES["avatar"]["tmp_name"],"images/avatars/"."avatar".$id.".jpg");
			$avatar = "avatar".$id.".jpg";
		}
		else
		{
			$avatar = "noimage.png";
		}	
		$query = "INSERT INTO contacts (first_name, last_name, email, phone_number, address, contact_group, state, avatar, note) 
					VALUES('$first_name', '$last_name', '$email', '$phone_number', '$address', '$contact_group', '$state', '$avatar', '$note')";
					
		$insert_row = $db->insert($query);
            
        header("Location: index.php");
        exit();			
	}
?>