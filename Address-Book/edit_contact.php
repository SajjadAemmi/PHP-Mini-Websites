<?php include ('core/init.php'); ?>
<?php

$db = new Database();

if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $contact_group = $_POST['contact_group'];
    $phone_number = $_POST['phone_number'];
    $note = $_POST['note'];

    if($_FILES["avatar"]["size"] > 1)
    {	
        unlink("images/avatars/"."avatar".$id.".jpg");
        move_uploaded_file($_FILES["avatar"]["tmp_name"],"images/avatars/"."avatar".$id.".jpg");
        $avatar = "avatar".$id.".jpg";

        $query = "UPDATE contacts SET first_name='$first_name', last_name='$last_name', email='$email', phone_number='$phone_number', address='$address', contact_group='$contact_group', state='$state', note='$note', avatar='$avatar' 
					WHERE id='$id'";
    }
    else
    {
        $query = "UPDATE contacts SET first_name='$first_name', last_name='$last_name', email='$email', phone_number='$phone_number', address='$address', contact_group='$contact_group', state='$state', note='$note' 
					WHERE id='$id'";
    }	

    $insert_row = $db->update($query);

    header("Location: index.php");
    exit();			
}
?>