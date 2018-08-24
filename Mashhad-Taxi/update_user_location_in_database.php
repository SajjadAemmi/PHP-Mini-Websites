<?php 
    include 'database.php';
	session_start();

	$location_lat = mysqli_real_escape_string($connection, $_POST['lat']);
	$location_lng = mysqli_real_escape_string($connection, $_POST['lng']);
	$user_id = $_SESSION['user_id'];

	$query = "UPDATE users SET location_lat = '$location_lat', location_lng = '$location_lng' WHERE id = '$user_id'";
	
	if(!mysqli_query($connection, $query))
	{
		echo 'Error: '.mysqli_error($connection);
	} 
	else 
	{
		echo "";
	}